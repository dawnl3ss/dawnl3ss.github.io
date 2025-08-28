(function() {
    'use strict';

    const config = {
        scrollOffset: 100,
        animationDuration: 800,
        throttleDelay: 100
    };

    const elements = {
        header: document.getElementById('header'),
        navToggle: document.getElementById('nav-toggle'),
        navMenu: document.getElementById('nav-menu'),
        navLinks: document.querySelectorAll('.nav-link'),
        sections: document.querySelectorAll('.section'),
        scrollIndicator: document.querySelector('.hero-scroll')
    };

    const toggleMobileMenu = () => {
        elements.navToggle.classList.toggle('active');
        elements.navMenu.classList.toggle('active');
        document.body.classList.toggle('menu-open');
    };

    const closeMobileMenu = () => {
        elements.navToggle.classList.remove('active');
        elements.navMenu.classList.remove('active');
        document.body.classList.remove('menu-open');
    };

    const smoothScroll = (target) => {
        const element = document.querySelector(target);
        if (!element) return;

        const offsetTop = element.offsetTop - config.scrollOffset;
        window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
        });
    };

    const handleHeaderScroll = () => {
        const scrollY = window.scrollY;
        if (scrollY > 50) {
            elements.header.classList.add('scrolled');
        } else {
            elements.header.classList.remove('scrolled');
        }
    };

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

    const handleScroll = throttle(() => {
        handleHeaderScroll();
        updateActiveSection();
    }, config.throttleDelay);

    const addEventListeners = () => {
        elements.navToggle?.addEventListener('click', toggleMobileMenu);

        elements.navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const href = link.getAttribute('href');

                if (href.startsWith('#')){
                    e.preventDefault();
                    smoothScroll(href);

                    if (window.innerWidth <= 768)
                        closeMobileMenu();
                }
            });
        });

        window.addEventListener('scroll', handleScroll);

        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                closeMobileMenu();
            }
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 &&
                elements.navMenu.classList.contains('active') &&
                !elements.navMenu.contains(e.target) &&
                !elements.navToggle.contains(e.target)) {
                closeMobileMenu();
            }
        });
    };

    const animateSkillLevels = () => {
        const skillBars = document.querySelectorAll('.level-bar');
        const observer = new IntersectionObserver((entries) => {

            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const level = entry.target.getAttribute('data-level');
                    entry.target.style.width = level + '%';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        skillBars.forEach(bar => observer.observe(bar));
    };

    const init = () => {
        handleHeaderScroll();
        updateActiveSection();
        addEventListeners();
        animateSkillLevels();

        const loader = document.getElementById('loader');

        if (loader){
            setTimeout(() => {
                loader.style.opacity = '0';

                setTimeout(() => {
                    loader.style.display = 'none';
                }, 300);
            }, 1000);
        }
    };

    if (document.readyState === 'loading')
        document.addEventListener('DOMContentLoaded', init);
    else
        init();
})();