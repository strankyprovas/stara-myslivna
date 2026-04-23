<?php get_header(); ?>

        <?php get_sidebar('left'); ?>

        <main id="main-content" role="main">

            <?php $tpl = get_template_directory_uri() . '/img-real'; ?>

            <!-- ÚVODNÍ FOTO (klient: "úvodní foto nad textem na každé stránce") -->
            <div class="page-hero">
                <img src="<?php echo esc_url($tpl . '/stara-myslivna-interier-03.webp'); ?>"
                     alt="Restaurace Stará Myslivna Konopiště">
            </div>

            <!-- ÚVODNÍ TEXT (reálný text z dokumentu klienta) -->
            <div class="post-content" style="margin-bottom:12px;">
                <h1 style="font-size:17px;color:#602106;margin:0 0 8px;">Restaurace Stará myslivna Konopiště</h1>
                <p>Restaurace Stará myslivna Konopiště byla po celkové rekonstrukci nově otevřena začátkem roku 2009. Sál restaurace navazuje na zámecké interiéry, dobu Františka Ferdinanda d&acute;Este a jeho loveckou zálibu. Součástí je i velký portrét dvojníka Františka Ferdinanda, bohatá umělecká a trofejní výzdoba, více jak 100 let starý plně funkční orchestrion, a vysvěcená polychromovaná socha svatého Huberta.</p>
                <p>Stylový interiér doplňuje bohatá gastronomická nabídka tvořená především ze zvěřinových specialit. Vysokou kvalitu pokrmů dle vlastních receptur zajišťuje tým zkušených kuchařských mistrů, kteří reprezentují českou gastronomii po celém světě, a působili mimo jiné i v české restauraci na světových výstavách Expo 2005 Aichi v Japonsku, EXPO 2010 v Šanghaji, EXPO 2015 v Miláně a EXPO 2017 Astana v Kazachstánu.</p>
                <p>Svojí atmosférou, prostředím, a kvalitou gastronomie se Stará myslivna Konopiště přesvědčivě řadí mezi nejlepší stylové restaurace v České republice.</p>
            </div>

            <div class="ornament">✦ &nbsp; ✦ &nbsp; ✦</div>

            <!-- FOTO DLAŽDICE – proklik do sekcí (per Kuchařka + layout klienta) -->
            <?php
            // Homepage dlaždice dle layoutu PDF klienta (22.4.2026 - Layout Úvod O restauraci)
            $tiles = [
                ['img' => $tpl.'/stara-myslivna-uvod-web-interier.webp',         'label' => 'Interiér',     'url' => home_url('/o-restauraci/interier/')],
                ['img' => $tpl.'/stara-myslivna-uvod-web-exterier.webp',         'label' => 'Exteriér',     'url' => home_url('/o-restauraci/exterier/')],
                ['img' => $tpl.'/stara-myslivna-uvod-web-oburka.webp',           'label' => 'Obůrka',       'url' => home_url('/o-restauraci/oburka/')],
                ['img' => $tpl.'/stara-myslivna-zajimavosti-orchestrion.webp',   'label' => 'Zajímavosti',  'url' => home_url('/o-restauraci/zajimavosti/')],
                ['img' => $tpl.'/stara-myslivna-sefkuchari-uvod.webp',           'label' => 'Šéfkuchaři',   'url' => home_url('/o-restauraci/sefkuchari/')],
                ['img' => $tpl.'/videa_stab.jpg',                                'label' => 'Videa',        'url' => home_url('/o-restauraci/videa/')],
                ['img' => $tpl.'/publicita_apetit.jpg',                          'label' => 'Publicita',    'url' => home_url('/o-restauraci/publicita/')],
                ['img' => $tpl.'/stara-myslivna-igc-restaurace-01.webp',         'label' => 'IGC',          'url' => home_url('/o-restauraci/igc/')],
            ];
            ?>

            <div class="home-tiles-grid">
                <?php foreach ($tiles as $tile) : ?>
                <a href="<?php echo esc_url($tile['url']); ?>" class="home-tile-card">
                    <img src="<?php echo esc_url($tile['img']); ?>"
                         alt="<?php echo esc_attr($tile['label']); ?>"
                         loading="lazy">
                    <div class="home-tile-label"><?php echo esc_html($tile['label']); ?></div>
                </a>
                <?php endforeach; ?>
            </div>

            <div class="ornament" style="margin-top:14px;">✦ &nbsp; ✦ &nbsp; ✦</div>

        </main>

        <?php get_sidebar('right'); ?>

<?php get_footer(); ?>
