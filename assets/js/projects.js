const projectsData = {

    websites: {
        "Hardware-Hub": {
            description: "Startup. We allow people to build their own PC configuration through our Config-Maker.",
            link: "https://hardware-hub.fr/",
            status: "active",
            icon: "laptop",
            tags: ["Web", "Community", "E-commerce"],
            year: 2022
        },
        "Lets-Freerun": {
            description: "Website which gathers a lot of parkour spots around the world.",
            link: "https://github.com/dawnl3ss/Lets-Freerun",
            status: "development",
            icon: "human",
            tags: ["Web", "Sports", "Community"],
            year: 2023
        }
    },
    tools: {
        "Kharon": {
            description: "Automated web-server CTF scanner which performs basic tasks of webserver pentesting.",
            link: "https://github.com/dawnl3ss/Kharon",
            status: "development",
            icon: "skull",
            tags: ["Security", "Python", "Automation"],
            year: 2023
        },
        "Theia": {
            description: "IP-lookup OSINT tool for linux.",
            link: "https://github.com/dawnl3ss/Theia",
            status: "completed",
            icon: "search-web",
            tags: ["OSINT", "Linux", "Python"],
            year: 2022
        },
        "Selene": {
            description: "Database dumper written in Python3.",
            link: "https://github.com/dawnl3ss/Selene",
            status: "completed",
            icon: "database-export",
            tags: ["Database", "Python", "Security"],
            year: 2022
        }
    },
    others: {
        "ARS-ENCRYPT": {
            description: "Modified Caesar's-cipher-based encrypt system written in C++.",
            link: "https://github.com/dawnl3ss/ARS_ENCRYPT",
            status: "completed",
            icon: "lock",
            tags: ["Cryptography", "C++", "Security"],
            year: 2021
        },
        "Klephtes": {
            description: "Grab and stock your website-viewers' data in a database written in PHP & SQL.",
            link: "https://github.com/dawnl3ss/Klephtes",
            status: "completed",
            icon: "account-key",
            tags: ["Web", "PHP", "Database"],
            year: 2022
        },
        "Zephyr": {
            description: "Web router written in PHP 7.4.",
            link: "https://github.com/dawnl3ss/Zephyr",
            status: "completed",
            icon: "directions",
            tags: ["Web", "PHP", "Framework"],
            year: 2023
        }
    }
};

class ProjectRenderer {

    constructor() {
        this.projects = projectsData;
        this.containers = {
            websites: document.getElementById('websites-list'),
            tools: document.getElementById('tools-list'),
            others: document.getElementById('others-list')
        };
    }

    createProjectElement(name, project) {
        const li = document.createElement('li');
        li.className = 'tree-file';

        const link = document.createElement('a');
        link.href = project.link;
        link.target = '_blank';
        link.className = 'tree-item project-link';

        link.innerHTML = `
            <i class="mdi mdi-${project.icon}"></i>
            <span class="tree-name">${name}</span>
            <span class="project-description"> - ${project.description}</span>
        `;

        li.appendChild(link);
        return li;
    }

    renderCategory(categoryName) {
        const container = this.containers[categoryName];
        const categoryData = this.projects[categoryName];

        if (!container || !categoryData) {
            console.warn(`Container or data not found for category: ${categoryName}`);
            return;
        }

        container.innerHTML = '';

        const sortedProjects = Object.entries(categoryData)
            .sort(([a], [b]) => a.localeCompare(b));

        sortedProjects.forEach(([name, project]) => {
            const projectElement = this.createProjectElement(name, project);
            container.appendChild(projectElement);
        });
    }

    renderAllCategories() {
        Object.keys(this.containers).forEach(category => {
            this.renderCategory(category);
        });
    }

    addProjectInteractions() {
        const projectLinks = document.querySelectorAll('.project-link');

        projectLinks.forEach(link => {
            link.addEventListener('mouseenter', (e) => {
                e.target.style.transition = 'all 0.2s ease';
            });

            link.addEventListener('click', (e) => {
                const projectName = e.target.querySelector('.tree-name')?.textContent;

                if (projectName) {
                    console.log(`Project clicked: ${projectName}`);
                }
            });
        });
    }

    init() {
        this.renderAllCategories();
        this.addProjectInteractions();
    }
}

// Fuck le JS c'est nul
document.addEventListener('DOMContentLoaded', () => {
    const renderer = new ProjectRenderer();
    renderer.init();
});