<aside id="right-sidebar" role="complementary">

    <?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-right' ); ?>
    <?php else : ?>

        <?php $tpl = get_template_directory_uri() . '/img-real'; ?>

        <!-- Akce – upoutávka na chystané akce (per klient 22.4.2026) -->
        <div class="sidebar-block">
            <div class="sidebar-block-header">Akce</div>
            <div class="sidebar-block-content">
                <?php
                $akce_text = get_option('myslivna_akce_upoutavka',
                    "SNĚZ, CO ZMŮŽEŠ\nNa tyto populární gastronomické akce se opět můžete těšit v zimním období od října do dubna"
                );
                echo '<p>' . nl2br(esc_html($akce_text)) . '</p>';
                $snez_url = home_url('/akce/snez-co-zmuzes/');
                ?>
                <p style="text-align:center;margin-top:6px;">
                    <a href="<?php echo esc_url($snez_url); ?>">
                        <img src="<?php echo esc_url($tpl . '/snez_flyer.jpg'); ?>"
                             alt="Sněz co zmůžeš" style="width:100%;display:block;">
                    </a>
                </p>
            </div>
        </div>

        <!-- Aktuálně (editovatelné personálem) -->
        <div class="sidebar-block">
            <div class="sidebar-block-header">Aktuálně</div>
            <div class="sidebar-block-content">
                <?php
                $aktualne = get_option('myslivna_aktualne',
                    "Blíží se LETNÍ SEZONA a my pro vás připravujeme otevření venkovní zahrádky, jakmile to počasí dovolí."
                );
                echo '<p>' . nl2br(esc_html($aktualne)) . '</p>';
                ?>
            </div>
        </div>

        <!-- Neuvěřitelný zážitek – video Oživlý páv ve smyčce -->
        <div class="sidebar-block">
            <div class="sidebar-block-header">Neuvěřitelný zážitek</div>
            <div class="sidebar-block-content" style="padding:0;">
                <video autoplay muted loop playsinline
                       style="width:100%;display:block;"
                       title="Oživlý páv">
                    <source src="<?php echo esc_url($tpl . '/ozivly_pav.mp4'); ?>" type="video/mp4">
                </video>
            </div>
        </div>

        <!-- Hodnocení -->
        <div class="sidebar-block">
            <div class="sidebar-block-header">Hodnocení</div>
            <div class="sidebar-block-content">
                <p>⭐⭐⭐⭐⭐</p>
                <p>Nejlépe hodnocená restaurace na <a href="https://mapy.cz/zakladni?q=Restaurace+Star%C3%A1+Myslivna+Konopi%C5%A1t%C4%9B" target="_blank" rel="noopener">Mapy.cz</a> 2026</p>
                <p><a href="https://www.google.com/search?q=Restaurace+Star%C3%A1+Myslivna+Konopi%C5%A1t%C4%9B" target="_blank" rel="noopener">Hodnocení Google</a></p>
                <p><a href="https://cs.wikipedia.org/wiki/Star%C3%A1_myslivna_Konopi%C5%A1t%C4%9B" target="_blank" rel="noopener">Wikipedia – Stará myslivna</a></p>
            </div>
        </div>

        <!-- Připravujeme -->
        <div class="sidebar-block">
            <div class="sidebar-block-header">Připravujeme</div>
            <div class="sidebar-block-content">
                <?php
                $pripravujeme = get_option('myslivna_pripravujeme', 'Informace o připravovaných akcích brzy...');
                echo '<p>' . nl2br(esc_html($pripravujeme)) . '</p>';
                ?>
            </div>
        </div>

        <!-- Rezervace tlačítko přesunuto do Rychlého kontaktu v levém sloupci -->

    <?php endif; ?>

</aside>
