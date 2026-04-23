    </div><!-- .content-area -->

    <!-- footer zrušen na přání klienta (opakovaná info z Rychlého kontaktu) -->

</div><!-- .site-wrapper -->

<!-- ===== COOKIE LIŠTA (GDPR) ===== -->
<div id="myslivna-cookie-banner" style="display:none;">
    <div class="cookie-inner">
        <div class="cookie-text">
            <strong>🍪 Tento web používá cookies</strong><br>
            Pro správné fungování webu používáme technické cookies. Pro zobrazení Google Street View, rezervačního systému Bookio a dalšího vloženého obsahu potřebujeme Váš souhlas s cookies třetích stran. Více v <a href="<?php echo esc_url( home_url('/kontakty/') ); ?>">zásadách</a>.
        </div>
        <div class="cookie-buttons">
            <button type="button" class="cookie-btn cookie-btn-reject" onclick="myslivnaCookies(false)">Pouze nezbytné</button>
            <button type="button" class="cookie-btn cookie-btn-accept" onclick="myslivnaCookies(true)">Přijmout vše</button>
        </div>
    </div>
</div>

<script>
(function(){
    var KEY = 'myslivna_cookie_consent';
    var stored = localStorage.getItem(KEY);
    var banner = document.getElementById('myslivna-cookie-banner');

    if (!stored) {
        banner.style.display = 'block';
    } else if (stored === 'accepted') {
        unblockEmbeds();
    }

    window.myslivnaCookies = function(accept) {
        localStorage.setItem(KEY, accept ? 'accepted' : 'rejected');
        banner.style.display = 'none';
        if (accept) unblockEmbeds();
        else blockEmbeds();
    };

    function unblockEmbeds() {
        // Aktivovat zablokované iframy (data-cookie-src → src)
        document.querySelectorAll('iframe[data-cookie-src]').forEach(function(f){
            f.src = f.getAttribute('data-cookie-src');
            f.removeAttribute('data-cookie-src');
        });
    }
    function blockEmbeds() {
        document.querySelectorAll('iframe').forEach(function(f){
            var src = f.src || '';
            if (src.indexOf('google.com/maps') >= 0 || src.indexOf('bookiopro') >= 0 || src.indexOf('youtube') >= 0) {
                f.setAttribute('data-cookie-src', src);
                f.src = 'about:blank';
                if (!f.parentNode.querySelector('.cookie-blocked-msg')) {
                    var msg = document.createElement('div');
                    msg.className = 'cookie-blocked-msg';
                    msg.innerHTML = '🔒 Pro zobrazení tohoto obsahu prosím přijměte cookies třetích stran.';
                    f.parentNode.insertBefore(msg, f);
                }
            }
        });
    }

    // Pokud uživatel odmítl, zablokovat embedy už při načtení
    if (stored === 'rejected') blockEmbeds();
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
