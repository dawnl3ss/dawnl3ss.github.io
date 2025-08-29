class ProjectRenderer {

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
        this.addProjectInteractions();
    }
}

// Fuck le JS c'est nul
document.addEventListener('DOMContentLoaded', () => {
    const renderer = new ProjectRenderer();
    renderer.init();
});