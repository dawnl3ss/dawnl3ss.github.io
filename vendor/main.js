(function($) {
    "use strict";
    
    const cfg = {
        scrollDuration : 800,
        mailChimpURL   : ''
    };
    const $WIN = $(window);
    const doc = document.documentElement;
    doc.setAttribute('data-useragent', navigator.userAgent);

    

    const ssPrettyPrint = function() {
        $('pre').addClass('prettyprint');
        $( document ).ready(function() {
            prettyPrint();
        });
    };

    const ssMoveHeader = function () {
        const $hero = $('.s-hero'),
            $hdr = $('.s-header'),
            triggerHeight = $hero.outerHeight() - 170
        ; //oui je sais c'est putain de moche


        $WIN.on('scroll', function () {
            //ça aussi d'ailleurs
            let loc = $WIN.scrollTop();

            if (loc > triggerHeight) {
                $hdr.addClass('sticky');
            } else {
                $hdr.removeClass('sticky');
            }

            if (loc > triggerHeight + 20) {
                $hdr.addClass('offset');
            } else {
                $hdr.removeClass('offset');
            }

            if (loc > triggerHeight + 150) {
                $hdr.addClass('scrolling');
            } else {
                $hdr.removeClass('scrolling');
            }

        });

    };

    const ssMobileMenu = function() {
        const $toggleButton = $('.header-menu-toggle');
        const $headerContent = $('.header-content');
        const $siteBody = $("body");

        $toggleButton.on('click', function(event){
            event.preventDefault();
            $toggleButton.toggleClass('is-clicked');
            $siteBody.toggleClass('menu-is-open');
        });

        $headerContent.find('.header-nav a, .btn').on("click", function() {
            if (window.matchMedia('(max-width: 900px)').matches) {
                $toggleButton.toggleClass('is-clicked');
                $siteBody.toggleClass('menu-is-open');
            }
        });

        $WIN.on('resize', function() {
            if (window.matchMedia('(min-width: 901px)').matches) {
                if ($siteBody.hasClass("menu-is-open")) $siteBody.removeClass("menu-is-open");
                if ($toggleButton.hasClass("is-clicked")) $toggleButton.removeClass("is-clicked");
            }
        });

    };

    const ssAccordion = function() {
        const $allItems = $('.services-list__item');
        const $allPanels = $allItems.children('.services-list__item-body');

        $allPanels.slice(1).hide();

        $allItems.on('click', '.services-list__item-header', function() {
            const $this = $(this),
                  $curItem = $this.parent(),
                  $curPanel =  $this.next();

            if (!$curItem.hasClass('is-active')){
                $allPanels.slideUp();
                $curPanel.slideDown();
                $allItems.removeClass('is-active');
                $curItem.addClass('is-active');
            }
            return false;
        });
    };

    const ssPhotoswipe = function() {
        const items = [],
            $pswp = $('.pswp')[0],
            $folioItems = $('.folio-item');

        // on get les items, j'fais ça à la rache nsm
        $folioItems.each( function(i) {
            let $folio = $(this),
                $thumbLink =  $folio.find('.folio-item__thumb-link'),
                $title = $folio.find('.folio-item__title'),
                $caption = $folio.find('.folio-item__caption'),
                $titleText = '<h4>' + $.trim($title.html()) + '</h4>',
                $captionText = $.trim($caption.html()),
                $href = $thumbLink.attr('href'),
                $size = $thumbLink.data('size').split('x'),
                $width  = $size[0],
                $height = $size[1];
        
            let item = {
                src: $href,
                w: $width,
                h: $height
            }

            if ($caption.length > 0) {
                item.title = $.trim($titleText + $captionText);
            }

            items.push(item);
        });

        // on bind le click event (btw je t'expliquerais en voc comment ça marche Raphael
        $folioItems.each(function(i) {
            $(this).find('.folio-item__thumb-link').on('click', function(e) {
                e.preventDefault();
                let options = {
                    index: i,
                    showHideOpacity: true
                }

                let lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                lightBox.init();
            });
        });
    };

    const ssAlertBoxes = function() {
        $('.alert-box').on('click', '.alert-box__close', function() {
            $(this).parent().fadeOut(500);
        });
    };

    const ssSmoothScroll = function() {
        $('.smoothscroll').on('click', function (e) {
            const target = this.hash;
            const $target = $(target);
            e.preventDefault();
            e.stopPropagation();

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, cfg.scrollDuration, 'swing').promise().done(function () {
                window.location.hash = target;
            });
        });
    };


    const ssBackToTop = function() {
        const pxShow = 800;
        const $goTopButton = $(".ss-go-top")
        if ($(window).scrollTop() >= pxShow) $goTopButton.addClass('link-is-visible');

        $(window).on('scroll', function() {
            if ($(window).scrollTop() >= pxShow) {
                if(!$goTopButton.hasClass('link-is-visible')) $goTopButton.addClass('link-is-visible')
            } else {
                $goTopButton.removeClass('link-is-visible')
            }
        });
    };

    //fonction init, sacrément moche btw
    (function ssInit() {
        ssPrettyPrint();
        ssMoveHeader();
        ssMobileMenu();
        ssAccordion();
        ssPhotoswipe();
        ssAlertBoxes();
        ssSmoothScroll();
        ssBackToTop();
    })();
})(jQuery);

// après 2 semaines a avoir fait du js et du jquery, neptune mourut d'une crise cardiaque à cause de ce langage de merde