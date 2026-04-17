/* Stará Myslivna – main.js */
(function () {
    'use strict';

    /* =========================================================
       HAMBURGER MENU (mobilní)
       ========================================================= */
    var toggle = document.querySelector('.nav-toggle');
    var menu   = document.getElementById('primary-menu');

    if (toggle && menu) {
        toggle.addEventListener('click', function () {
            var open = menu.classList.toggle('open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });

        // Zavři menu po kliknutí mimo
        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* =========================================================
       SLIDESHOW (homepage)
       ========================================================= */
    var slideshow = document.querySelector('.hero-slideshow');

    if (slideshow) {
        var slidesWrap = slideshow.querySelector('.slides');
        var slides     = slideshow.querySelectorAll('.slide');
        var dotsWrap   = slideshow.querySelector('.slideshow-dots');
        var prevBtn    = slideshow.querySelector('.slideshow-btn.prev');
        var nextBtn    = slideshow.querySelector('.slideshow-btn.next');
        var current    = 0;
        var total      = slides.length;
        var autoTimer;

        if (total <= 1) {
            if (prevBtn) prevBtn.style.display = 'none';
            if (nextBtn) nextBtn.style.display = 'none';
            return;
        }

        // Vytvoř tečky
        slides.forEach(function (_, i) {
            var dot = document.createElement('button');
            dot.setAttribute('role', 'tab');
            dot.setAttribute('aria-label', 'Snímek ' + (i + 1));
            dot.addEventListener('click', function () { goTo(i); });
            dotsWrap.appendChild(dot);
        });

        var dots = dotsWrap.querySelectorAll('button');

        function goTo(index) {
            slides[current].setAttribute('aria-hidden', 'true');
            dots[current].classList.remove('active');
            current = (index + total) % total;
            slidesWrap.style.transform = 'translateX(-' + current * 100 + '%)';
            dots[current].classList.add('active');
            slides[current].removeAttribute('aria-hidden');
        }

        function startAuto() {
            autoTimer = setInterval(function () { goTo(current + 1); }, 5000);
        }

        function stopAuto() {
            clearInterval(autoTimer);
        }

        if (prevBtn) prevBtn.addEventListener('click', function () { stopAuto(); goTo(current - 1); startAuto(); });
        if (nextBtn) nextBtn.addEventListener('click', function () { stopAuto(); goTo(current + 1); startAuto(); });

        // Swipe podpora (mobil)
        var touchStartX = 0;
        slideshow.addEventListener('touchstart', function (e) { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
        slideshow.addEventListener('touchend', function (e) {
            var diff = touchStartX - e.changedTouches[0].screenX;
            if (Math.abs(diff) > 40) {
                stopAuto();
                goTo(diff > 0 ? current + 1 : current - 1);
                startAuto();
            }
        }, { passive: true });

        goTo(0);
        startAuto();
    }

    /* =========================================================
       DROPDOWN NAV – přístupnost klávesnicí
       ========================================================= */
    var navItems = document.querySelectorAll('#main-navigation li');
    navItems.forEach(function (item) {
        var sub = item.querySelector('ul');
        if (!sub) return;
        var link = item.querySelector('a');
        link.setAttribute('aria-haspopup', 'true');
        link.setAttribute('aria-expanded', 'false');

        item.addEventListener('mouseenter', function () {
            link.setAttribute('aria-expanded', 'true');
        });
        item.addEventListener('mouseleave', function () {
            link.setAttribute('aria-expanded', 'false');
        });
        link.addEventListener('focus', function () {
            link.setAttribute('aria-expanded', 'true');
        });
        item.addEventListener('focusout', function (e) {
            if (!item.contains(e.relatedTarget)) {
                link.setAttribute('aria-expanded', 'false');
            }
        });
    });

    /* =========================================================
       SMOOTH SCROLL pro anchor linky
       ========================================================= */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

})();

// ============================================================
// SIDEBAR SLIDESHOW (zajímavosti + pokrmy)
// ============================================================
document.querySelectorAll('.sidebar-slideshow').forEach(function(el) {
    var slides = el.querySelectorAll('.ss-slide');
    if (slides.length < 2) return;
    var current = 0;
    var interval = parseInt(el.dataset.interval) || 3000;
    setInterval(function() {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
    }, interval);
});

// ===== LIGHTBOX =====
(function() {
    // Vytvoř lightbox element
    var lb = document.createElement('div');
    lb.id = 'myslivna-lightbox';
    lb.innerHTML = '<span class="lb-close">&#10005;</span>' +
        '<span class="lb-prev">&#10094;</span>' +
        '<img src="" alt="">' +
        '<span class="lb-next">&#10095;</span>' +
        '<div class="lb-caption"></div>';
    document.body.appendChild(lb);

    var lbImg = lb.querySelector('img');
    var lbCap = lb.querySelector('.lb-caption');
    var currentItems = [];
    var currentIndex = 0;

    function showLightbox(items, index) {
        currentItems = items;
        currentIndex = index;
        updateLightbox();
        lb.classList.add('active');
    }

    function updateLightbox() {
        var item = currentItems[currentIndex];
        lbImg.src = item.href;
        lbCap.textContent = (currentIndex + 1) + ' / ' + currentItems.length;
    }

    function closeLightbox() {
        lb.classList.remove('active');
    }

    document.addEventListener('click', function(e) {
        var a = e.target.closest('.gallery-item');
        if (!a) return;
        e.preventDefault();
        var group = a.dataset.lightbox;
        var allItems = Array.from(document.querySelectorAll('.gallery-item[data-lightbox="' + group + '"]'));
        var index = allItems.indexOf(a);
        showLightbox(allItems, index);
    });

    lb.querySelector('.lb-close').addEventListener('click', closeLightbox);
    lb.querySelector('.lb-prev').addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + currentItems.length) % currentItems.length;
        updateLightbox();
    });
    lb.querySelector('.lb-next').addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % currentItems.length;
        updateLightbox();
    });

    document.addEventListener('keydown', function(e) {
        if (!lb.classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') { currentIndex = (currentIndex - 1 + currentItems.length) % currentItems.length; updateLightbox(); }
        if (e.key === 'ArrowRight') { currentIndex = (currentIndex + 1) % currentItems.length; updateLightbox(); }
    });

    lb.addEventListener('click', function(e) {
        if (e.target === lb) closeLightbox();
    });
})();
