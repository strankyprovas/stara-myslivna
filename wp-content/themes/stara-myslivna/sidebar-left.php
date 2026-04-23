<aside id="left-sidebar" role="complementary">

    <?php if ( is_active_sidebar( 'sidebar-left' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-left' ); ?>
    <?php else : ?>

        <!-- Rychlý kontakt -->
        <?php
        $tel   = get_option('myslivna_telefon', '+420 317 700 280');
        $email = get_option('myslivna_email',   'myslivna@igcpraha.cz');
        $adr   = get_option('myslivna_adresa',  'Konopiště 2, 256 01 Benešov');
        $tel_raw = preg_replace('/[^+0-9]/', '', $tel);
        ?>
        <div class="sidebar-block">
            <div class="sidebar-block-header">Rychlý kontakt</div>
            <div class="sidebar-block-content">
                <p><strong>Restaurace Stará Myslivna</strong></p>
                <p><?php echo esc_html($adr); ?></p>
                <p><strong>Tel. rezervace:</strong><br><a href="tel:<?php echo esc_attr($tel_raw); ?>"><?php echo esc_html($tel); ?></a></p>
                <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                <p style="margin-top:8px;">
                    <a href="<?php echo esc_url(home_url('/rezervace-on-line')); ?>" class="btn btn-rezervace">REZERVACE ON-LINE</a>
                </p>
            </div>
        </div>

        <!-- Provozní doba (editovatelné personálem) -->
        <div class="sidebar-block">
            <div class="sidebar-block-header">Provozní doba</div>
            <div class="sidebar-block-content">
                <?php
                $prov_doba = get_option('myslivna_provozni_doba',
                    "PO–ČT od 11:00 do 21:00 hod.\nPÁ–SO od 11:00 do 22:00 hod.\nNE od 11:00 do 21:00 hod."
                );
                echo '<p>' . nl2br(esc_html($prov_doba)) . '</p>';
                ?>
            </div>
        </div>

        <!-- Zajímavosti – slideshow fotek (nové fotky od klienta 22.4.2026, BEZ OŘEZU) -->
        <?php
        $tpl = get_template_directory_uri() . '/img-real';
        $zajimavosti = [];
        for ($si = 1; $si <= 7; $si++) {
            $att_id = get_option("myslivna_slide_zajimavosti_{$si}", '');
            if ($att_id) {
                $src = wp_get_attachment_image_url($att_id, 'full');
                $alt = get_post_meta($att_id, '_wp_attachment_image_alt', true) ?: get_the_title($att_id);
                if ($src) $zajimavosti[] = ['src' => $src, 'alt' => $alt, 'href' => home_url('/o-restauraci/zajimavosti/')];
            }
        }
        if (empty($zajimavosti)) {
            $zajimavosti = [
                ['src' => $tpl . '/stara-myslivna-zajimavosti-orchestrion.webp',     'alt' => 'Orchestrion',               'href' => home_url('/o-restauraci/zajimavosti/')],
                ['src' => $tpl . '/stara-myslivna-zajimavosti-portretffdeeste.webp', 'alt' => 'Portrét F. F. d\'Este',      'href' => home_url('/o-restauraci/zajimavosti/')],
                ['src' => $tpl . '/stara-myslivna-zajimavosti-svhubert.webp',        'alt' => 'Socha sv. Huberta',          'href' => home_url('/o-restauraci/zajimavosti/')],
                ['src' => $tpl . '/stara-myslivna-zajimavosti-kukacky.webp',         'alt' => 'Schwarzwaldské kukačky',     'href' => home_url('/o-restauraci/zajimavosti/')],
                ['src' => $tpl . '/stara-myslivna-zajimavosti-medved.webp',          'alt' => 'Trofej medvěda',             'href' => home_url('/o-restauraci/zajimavosti/')],
                ['src' => $tpl . '/stara-myslivna-zajimavosti-jelen.webp',           'alt' => 'Trofej jelena',              'href' => home_url('/o-restauraci/zajimavosti/')],
                ['src' => $tpl . '/stara-myslivna-zajimavosti-bobr.webp',            'alt' => 'Trofej bobra',               'href' => home_url('/o-restauraci/zajimavosti/')],
            ];
        }
        ?>
        <div class="sidebar-block">
            <div class="sidebar-block-header">Zajímavosti restaurace</div>
            <div class="sidebar-block-content" style="padding:0;">
                <div class="sidebar-slideshow sidebar-slideshow-contain" data-interval="3000">
                    <?php foreach ($zajimavosti as $i => $img) : ?>
                    <div class="ss-slide<?php echo $i === 0 ? ' active' : ''; ?>">
                        <a href="<?php echo esc_url($img['href']); ?>">
                            <img src="<?php echo esc_url($img['src']); ?>"
                                 alt="<?php echo esc_attr($img['alt']); ?>"
                                 style="width:100%;height:auto;display:block;">
                        </a>
                        <div style="padding:3px 6px;font-size:11px;background:#ece6cb;"><?php echo esc_html($img['alt']); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Pokrmy – slideshow fotek jídel -->
        <?php
        $pokrmy = [];
        for ($si = 1; $si <= 6; $si++) {
            $att_id = get_option("myslivna_slide_pokrmy_{$si}", '');
            if ($att_id) {
                $src = wp_get_attachment_image_url($att_id, 'myslivna-thumb');
                $alt = get_post_meta($att_id, '_wp_attachment_image_alt', true) ?: get_the_title($att_id);
                if ($src) $pokrmy[] = ['src' => $src, 'alt' => $alt];
            }
        }
        if (empty($pokrmy)) {
            $pokrmy = [
                ['src' => $tpl . '/food_danci_tournedos_prince_rudolfa_s_jalovcem_hribkovou_omackou_a_stouchanym_bramborem.jpg', 'alt' => 'Dančí tournedos'],
                ['src' => $tpl . '/food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg', 'alt' => 'Zvěřinový guláš'],
                ['src' => $tpl . '/food_srnci_se_sipkovou_omackou_mramorovy_knedlik.jpg', 'alt' => 'Srnčí se šípkovou'],
                ['src' => $tpl . '/food_vypecky_z_divocaka_frantiska_josefa_staroceske_zeli_bramborovy_knedlik.jpg', 'alt' => 'Výpečky z divočáka'],
                ['src' => $tpl . '/food_pstruh_peceny_z_mlyna_Kozli_na_kminovem_masle.jpg', 'alt' => 'Pstruh z Kožlí mlýna'],
            ];
        }
        ?>
        <div class="sidebar-block">
            <div class="sidebar-block-header">Foto pokrmů</div>
            <div class="sidebar-block-content" style="padding:0;">
                <div class="sidebar-slideshow" data-interval="3500">
                    <?php foreach ($pokrmy as $i => $img) : ?>
                    <div class="ss-slide<?php echo $i === 0 ? ' active' : ''; ?>">
                        <a href="<?php echo esc_url(home_url('/o-restauraci/foto-pokrmu/')); ?>">
                            <img src="<?php echo esc_url($img['src']); ?>"
                                 alt="<?php echo esc_attr($img['alt']); ?>"
                                 style="width:100%;height:110px;object-fit:cover;display:block;">
                        </a>
                        <div style="padding:3px 6px;font-size:11px;background:#ece6cb;"><?php echo esc_html($img['alt']); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Parkoviště (zarovnané na levou zarážku dle klienta 22.4.2026) -->
        <div class="sidebar-block">
            <div class="sidebar-block-header">Parkoviště</div>
            <div class="sidebar-block-content">
                <p>Nejbližší parkoviště viz</p>
                <p><a href="https://www.konopistelevne.eu" target="_blank" rel="noopener">www.konopistelevne.eu</a></p>
                <svg width="36" height="36" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" style="display:block;margin:4px 0;">
                    <rect x="5" y="5" width="90" height="90" rx="8" fill="#1356A0" stroke="#fff" stroke-width="3"/>
                    <text x="50" y="72" font-family="Arial, sans-serif" font-size="68" font-weight="bold" fill="#fff" text-anchor="middle">P</text>
                </svg>
            </div>
        </div>

        <!-- Zámek Konopiště -->
        <div class="sidebar-block">
            <div class="sidebar-block-header">Zámek Konopiště</div>
            <div class="sidebar-block-content" style="padding:0;">
                <a href="https://www.zamek-konopiste.cz" target="_blank" rel="noopener">
                    <img src="<?php echo esc_url($tpl . '/zamek_konopiste.jpg'); ?>"
                         alt="Zámek Konopiště"
                         style="width:100%;display:block;">
                </a>
                <div style="padding:4px 6px;">
                    <p>Současně navštivte unikátní Státní zámek Konopiště</p>
                    <p><a href="https://www.zamek-konopiste.cz" target="_blank" rel="noopener">zamek-konopiste.cz</a></p>
                </div>
            </div>
        </div>

    <?php endif; ?>

</aside>
