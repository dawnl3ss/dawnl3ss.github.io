document.addEventListener('DOMContentLoaded', () => {

    const header = document.getElementById('header');
    if (header)
        window.addEventListener('scroll', () => {
            header.classList.toggle('scrolled', window.scrollY > 20);
        });

    const toggle  = document.getElementById('navToggle');
    const navList = document.getElementById('navList');

    if (toggle && navList){
        toggle.addEventListener('click', () => {
            navList.classList.toggle('open');
            const spans  = toggle.querySelectorAll('span');
            const isOpen = navList.classList.contains('open');
            spans[0].style.transform = isOpen ? 'rotate(45deg) translate(5px, 5px)'   : '';
            spans[1].style.opacity   = isOpen ? '0'                                    : '1';
            spans[2].style.transform = isOpen ? 'rotate(-45deg) translate(7px, -7px)' : '';
        });

        navList.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', () => navList.classList.remove('open'));
        });
    }

    document.querySelectorAll('.tb-copy').forEach(btn => {
        btn.addEventListener('click', () => {
            const target = document.getElementById(btn.dataset.target);
            if (!target) return;

            navigator.clipboard.writeText(target.innerText).then(() => {
                btn.textContent = 'copied!';
                btn.classList.add('copied');
                setTimeout(() => {
                    btn.textContent = 'copy';
                    btn.classList.remove('copied');
                }, 2000);
            }).catch(() => {
                const range = document.createRange();

                range.selectNodeContents(target);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand('copy');
                window.getSelection().removeAllRanges();
                btn.textContent = 'copied!';
                btn.classList.add('copied');

                setTimeout(() => {
                    btn.textContent = 'copy';
                    btn.classList.remove('copied');
                }, 2000);
            });
        });
    });

    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxClose = document.getElementById('lightboxClose');

    function openLightbox(src, alt){
        lightboxImg.src = src;
        lightboxImg.alt = alt || '';
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(){
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (lightbox && lightboxImg && lightboxClose){
        document.querySelectorAll('.writeup-img-wrap').forEach(wrap => {
            wrap.addEventListener('click', () => {
                const img = wrap.querySelector('img');
                if (!img || !img.complete || img.naturalWidth === 0) return;
                openLightbox(img.src, img.alt);
            });
        });

        lightboxClose.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', e => { if (e.target === lightbox) closeLightbox(); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
    }

    const sections = document.querySelectorAll('.wt-section');
    const tocLinks  = document.querySelectorAll('.toc-list a');

    if (sections.length && tocLinks.length){
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting){
                    const id = entry.target.id;
                    tocLinks.forEach(link => {
                        link.classList.toggle('active', link.getAttribute('href') === `#${id}`);
                    });
                }
            });
        }, { rootMargin: '-40% 0px -50% 0px' });

        sections.forEach(s => observer.observe(s));
    }

});