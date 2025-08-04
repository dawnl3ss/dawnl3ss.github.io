

(function() {
    'use strict';

    const config = {
        scrollOffset: 100,
        animationDuration: 800,
        throttleDelay: 100
    };

    // Cache DOM elements
    const elements = {
        header: document.getElementById('header'),
        navToggle: document.getElementById('nav-toggle'),
        navMenu: document.getElementById('nav-menu'),
        navLinks: document.querySelectorAll('.nav__link'),
        sections: document.querySelectorAll('.section'),
        revealElements: document.querySelectorAll('.reveal'),
        scrollIndicator: document.querySelector('.hero__scroll')
    };

    // State
    let isScrolling = false;
    let scrollTimeout;

    /* ========================================
       Navigation
       ======================================== */

    // Mobile menu toggle
    const toggleMobileMenu = () => {
        elements.navToggle.classList.toggle('active');
        elements.navMenu.classList.toggle('active');
        document.body.classList.toggle('menu-open');
    };

    elements.navToggle?.addEventListener('click', toggleMobileMenu);

    // Close mobile menu on link click
    elements.navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                elements.navToggle.classList.remove('active');
                elements.navMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
    });

    // Smooth scrolling
    const smoothScroll = (target) => {
        const element = document.querySelector(target);
        if (!element) return;

        const offsetTop = element.offsetTop - config.scrollOffset;
        window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
        });
    };

    // Handle navigation link clicks
    elements.navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            const href = link.getAttribute('href');
            if (href.startsWith('#')) {
                e.preventDefault();
                smoothScroll(href);
            }
        });
    });

    /* ========================================
       Scroll Effects
       ======================================== */

    // Throttle function
    const throttle = (func, delay) => {
        let timeoutId;
        let lastExecTime = 0;
        return function (...args) {
            const currentTime = Date.now();
            if (currentTime - lastExecTime > delay) {
                func.apply(this, args);
                lastExecTime = currentTime;
            } else {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    func.apply(this, args);
                    lastExecTime = Date.now();
                }, delay - (currentTime - lastExecTime));
            }
        };
    };

    // Header scroll effect
    const handleHeaderScroll = () => {
        const scrollY = window.scrollY;
        if (scrollY > 50) {
            elements.header.classList.add('scrolled');
        } else {
            elements.header.classList.remove('scrolled');
        }
    };

    // Active section detection
    const updateActiveSection = () => {
        const scrollY = window.scrollY + config.scrollOffset + 100;

        elements.sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');

            if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                elements.navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${sectionId}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    };

    // Reveal animations
    const revealOnScroll = () => {
        const windowHeight = window.innerHeight;
        const scrollY = window.scrollY;

        elements.revealElements.forEach(element => {
            const elementTop = element.offsetTop;
            const elementVisible = 150;

            if (scrollY > elementTop - windowHeight + elementVisible) {
                element.classList.add('active');
            }
        });
    };

    // Combined scroll handler
    const handleScroll = throttle(() => {
        handleHeaderScroll();
        updateActiveSection();
        revealOnScroll();
    }, config.throttleDelay);

    window.addEventListener('scroll', handleScroll);

    /* ========================================
       Terminal Effects
       ======================================== */

    // Initialize Termynal
    const initTerminal = () => {
        const terminals = document.querySelectorAll('[data-termynal]');
        terminals.forEach(terminal => {
            // Termynal will auto-initialize
            terminal.style.opacity = '0';
            terminal.style.transform = 'translateY(20px)';

            setTimeout(() => {
                terminal.style.transition = 'all 0.6s ease-out';
                terminal.style.opacity = '1';
                terminal.style.transform = 'translateY(0)';
            }, 300);
        });
    };

    /* ========================================
       Projects Rendering
       ======================================== */

    const renderProjects = () => {
        const projects = window.getProjects ? window.getProjects() : null;
        if (!projects) return;

        const renderProjectList = (category, containerId) => {
            const container = document.getElementById(containerId);
            if (!container) return;

            const projectsInCategory = projects[category];
            if (!projectsInCategory) return;

            for (const [name, project] of Object.entries(projectsInCategory)) {
                const li = document.createElement('li');
                li.className = 'tree__file';
                li.innerHTML = `
                    <a href="${project.getLink()}" target="_blank" class="tree__item project-link">
                        <i class="mdi mdi-${project.getIcon()}"></i>
                        <span>${name}</span>
                        <span class="project-description"> - ${project.getDescription()}</span>
                    </a>
                `;
                container.appendChild(li);
            }
        };

        renderProjectList('websites', 'websites-list');
        renderProjectList('tools', 'tools-list');
        renderProjectList('others', 'others-list');
    };

    /* ========================================
       Animations
       ======================================== */

    // Add stagger animation to elements
    const initStaggerAnimations = () => {
        const staggerContainers = document.querySelectorAll('.stagger-container');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const children = entry.target.children;
                    Array.from(children).forEach((child, index) => {
                        setTimeout(() => {
                            child.classList.add('animate');
                        }, index * 100);
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        staggerContainers.forEach(container => {
            observer.observe(container);
        });
    };

    /* ========================================
       Utilities
       ======================================== */

    // Debounce function
    const debounce = (func, wait) => {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    };

    // Handle window resize
    const handleResize = debounce(() => {
        // Close mobile menu on resize to desktop
        if (window.innerWidth > 768 && elements.navMenu.classList.contains('active')) {
            elements.navToggle.classList.remove('active');
            elements.navMenu.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    }, 250);

    window.addEventListener('resize', handleResize);

    /* ========================================
       Keyboard Navigation
       ======================================== */

    document.addEventListener('keydown', (e) => {
        // Close mobile menu on Escape
        if (e.key === 'Escape' && elements.navMenu.classList.contains('active')) {
            toggleMobileMenu();
        }
    });

    /* ========================================
       Page Load Animations
       ======================================== */

    const initPageAnimations = () => {
        // Add animation classes to elements
        document.body.classList.add('loaded');

        // Animate hero elements
        const heroElements = document.querySelectorAll('.hero .terminal, .hero__scroll');
        heroElements.forEach((el, index) => {
            setTimeout(() => {
                el.classList.add('animate-fadeInUp');
            }, index * 200);
        });

        // Animate section elements on load
        const animateElements = document.querySelectorAll('[data-aos]');
        const animateObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aos-animate');
                    animateObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        animateElements.forEach(el => {
            animateObserver.observe(el);
        });
    };

    /* ========================================
       Initialize
       ======================================== */

    const init = () => {
        // Initial setup
        handleHeaderScroll();
        updateActiveSection();

        // Initialize components
        initTerminal();
        renderProjects();
        initStaggerAnimations();
        initPageAnimations();

        // Hide loading screen if exists
        const loader = document.querySelector('.loader-wrapper');
        if (loader) {
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 300);
            }, 500);
        }
    };

    // Start when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Export utilities for external use
    window.appUtils = {
        smoothScroll,
        throttle,
        debounce
    };

})();