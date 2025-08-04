
(function() {
    'use strict';

    const projects = {
        websites: {
            "Hardware-Hub": {
                description: "French community and company based on hardware, software and programming.",
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

    class Project {
        constructor(name, data) {
            this.name = name;
            this.description = data.description;
            this.link = data.link;
            this.status = data.status || 'completed';
            this.icon = data.icon;
            this.tags = data.tags || [];
            this.year = data.year;
        }

        getDescription() {
            return this.description;
        }

        getLink() {
            return this.link;
        }

        getStatus() {
            return this.status;
        }

        getIcon() {
            return this.icon;
        }

        getTags() {
            return this.tags;
        }

        getYear() {
            return this.year;
        }

        getStatusBadge() {
            const statusClasses = {
                'completed': 'badge--success',
                'active': 'badge--primary',
                'development': 'badge--warning',
                'paused': 'badge--danger'
            };
            return `<span class="badge ${statusClasses[this.status]}">${this.status}</span>`;
        }

        getTagsHtml() {
            return this.tags.map(tag => `<span class="tag">${tag}</span>`).join('');
        }
    }

    const convertProjects = () => {
        const converted = {};

        for (const category in projects) {
            converted[category] = {};
            for (const name in projects[category]) {
                converted[category][name] = new Project(name, projects[category][name]);
            }
        }

        return converted;
    };

    const getAllProjects = () => {
        const allProjects = [];

        for (const category in projects) {
            for (const name in projects[category]) {
                allProjects.push({
                    name,
                    category,
                    ...projects[category][name]
                });
            }
        }

        return allProjects;
    };

    const getProjectsByStatus = (status) => {
        return getAllProjects().filter(project => project.status === status);
    };

    const getProjectsByTag = (tag) => {
        return getAllProjects().filter(project =>
            project.tags && project.tags.includes(tag)
        );
    };

    const getRecentProjects = (limit = 5) => {
        return getAllProjects()
            .sort((a, b) => (b.year || 0) - (a.year || 0))
            .slice(0, limit);
    };

    const searchProjects = (query) => {
        const lowercaseQuery = query.toLowerCase();

        return getAllProjects().filter(project =>
            project.name.toLowerCase().includes(lowercaseQuery) ||
            project.description.toLowerCase().includes(lowercaseQuery) ||
            (project.tags && project.tags.some(tag =>
                tag.toLowerCase().includes(lowercaseQuery)
            ))
        );
    };

    window.getProjects = () => convertProjects();

    window.projectUtils = {
        getAllProjects,
        getProjectsByStatus,
        getProjectsByTag,
        getRecentProjects,
        searchProjects
    };
})();