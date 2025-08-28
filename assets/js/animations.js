class AnimationManager {

    constructor() {
        this.observers = new Map();
        this.initialized = false;
    }

    createIntersectionObserver(threshold = 0.1, rootMargin = '0px') {
        return new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aos-animate');

                    if (!entry.target.hasAttribute('data-aos-repeat')) {
                        this.observers.get('main')?.unobserve(entry.target);
                    }
                }
            });
        }, {
            threshold,
            rootMargin
        });
    }

    initScrollAnimations() {
        const elements = document.querySelectorAll('[data-aos]');
        const observer = this.createIntersectionObserver();
        this.observers.set('main', observer);

        elements.forEach(el => {
            observer.observe(el);
        });
    }

    initTypingAnimations() {
        const typingElements = document.querySelectorAll('.typing-animation');

        typingElements.forEach((element, index) => {
            const text = element.textContent;
            element.textContent = '';
            element.style.borderRight = '2px solid var(--primary)';

            // Start typing after a delay based on element position
            setTimeout(() => {
                this.typeText(element, text, 100);
            }, index * 1500 + 500);
        });
    }

    typeText(element, text, speed = 100) {
        let i = 0;

        const typeInterval = setInterval(() => {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
            } else {
                clearInterval(typeInterval);
                // Remove cursor after typing is complete
                setTimeout(() => {
                    element.style.borderRight = 'none';
                }, 500);
            }
        }, speed);
    }

    initFadeInTexts() {
        const fadeElements = document.querySelectorAll('.fade-in-text');

        fadeElements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(10px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';

            setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 800 + 1000);
        });
    }

    initParallaxEffect() {
        const parallaxElements = document.querySelectorAll('[data-parallax]');

        if (parallaxElements.length === 0) return;

        const handleParallax = () => {
            const scrolled = window.pageYOffset;

            parallaxElements.forEach(element => {
                const rate = scrolled * -0.5;
                element.style.transform = `translateY(${rate}px)`;
            });
        };

        window.addEventListener('scroll', this.throttle(handleParallax, 16));
    }

    throttle(func, delay) {
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
    }

    initSectionReveals() {
        const sections = document.querySelectorAll('.section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        sections.forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            observer.observe(section);
        });
    }

    init() {
        if (this.initialized) return;

        this.initScrollAnimations();
        this.initTypingAnimations();
        this.initFadeInTexts();
        this.initParallaxEffect();
        this.initSectionReveals();

        this.initialized = true;
    }

    triggerAnimation(selector, animationType = 'fadeIn') {
        const elements = document.querySelectorAll(selector);

        elements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add(`animate-${animationType}`);
            }, index * 100);
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const animationManager = new AnimationManager();
    animationManager.init();

    window.animations = animationManager;
});