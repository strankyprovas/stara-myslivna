<?php get_header(); ?>

        <?php get_sidebar('left'); ?>

        <main id="main-content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <?php
                // Úvodní (hero) fotka nad textem – přiřazení podle slug stránky
                $slug = $post->post_name;
                $tpl_url = get_template_directory_uri() . '/img-real';
                $tpl_dir = get_template_directory()     . '/img-real';
                $hero_map = [
                    'o-restauraci'        => 'stara-myslivna-uvod-web-interier.webp',
                    'interier'            => 'stara-myslivna-uvod-web-interier.webp',
                    'exterior'            => 'stara-myslivna-uvod-web-exterier.webp',
                    'exterier'            => 'stara-myslivna-uvod-web-exterier.webp',
                    'oburka'              => 'stara-myslivna-uvod-web-oburka.webp',
                    'zajimavosti'         => 'stara-myslivna-zajimavosti-orchestrion.webp',
                    'historie'            => 'stara-myslivna-historie-budova1900-uvod-01.webp',
                    'foto-pokrmu'         => 'food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg',
                    'sefkuchari'          => 'stara-myslivna-sefkuchari-uvod.webp',
                    'videa'               => 'stara-myslivna-uvod-web-interier.webp',
                    'publicita'           => 'stara-myslivna-igc-restaurace-01.webp',
                    'letaky'              => 'stara-myslivna-letak-obecny-cz.webp',
                    'igc'                 => 'stara-myslivna-igc-restaurace-01.webp',
                    'street-view'         => 'interier_uvod.jpg',
                    'menu'                => 'food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg',
                    'rezervace-on-line'   => 'interier_uvod.jpg',
                    'sluzby'              => 'stara-myslivna-lovecka-chata-uvod-01.webp',
                    'snez-co-zmuzes'      => 'sluzby_snez_kuchar.jpg',
                    'svatby'              => 'sluzby_svatby_dort.jpg',
                    'lovecka-chata'       => 'stara-myslivna-lovecka-chata-uvod-01.webp',
                    'hony'                => 'stara-myslivna-hony-uvod.webp',
                    'akce'                => 'stara-myslivna-uvod-web-historicka-svatba.webp',
                    'historicka-svatba'   => 'stara-myslivna-uvod-web-historicka-svatba.webp',
                    'cisarske-manevry'    => 'stara-myslivna-manevry-uvod.webp',
                    'orchestrion'         => 'stara-myslivna-orchestrion-uvod.webp',
                    'benedikace'          => 'stara-myslivna-uvod-web-svhubert.webp',
                    'knedliky'            => 'stara-myslivna-ovocne-knedliky-uvod.webp',
                    'harley-davidson'     => 'stara-myslivna-harley-davidson-uvod.webp',
                    'rozneni-byka'        => 'stara-myslivna-rozneni-byka-uvod.webp',
                    'slavnostni-otevreni' => 'stara-myslivna-otevreni-uvod.webp',
                    'expo'                => 'stara-myslivna-expo-shanghai-china-uvod.webp',
                    'shop'                => 'stara-myslivna-shop-souvenirs-uvod.webp',
                    'souvenirs'           => 'stara-myslivna-shop-souvenirs-uvod.webp',
                    'postcard'            => 'stara-myslivna-shop-postcard-uvod.webp',
                    'karty'               => 'stara-myslivna-karty-uvod.webp',
                    'darkove-poukazy'     => 'stara-myslivna-vouchery-uvod.webp',
                    'plysaci'             => 'stara-myslivna-shop-plysaci-veverka.webp',
                    'kontakty'            => 'exterier_uvod.jpg',
                    'jidelni-listek'      => 'food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg',
                    'napojovy-listek'     => 'food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg',
                    'menu-en'             => 'food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg',
                    'drink-menu-en'       => 'food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg',
                    'menu-skupiny'        => 'food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg',
                    'group-menu-en'       => 'food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg',
                    'speisekarte-de'      => 'food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg',
                    'getrankekarte-de'    => 'food_zverinovy_lovecky_gulas_stara_myslivna_s_domacim_houskovym_knedlikem.jpg',
                ];
                $hero_file = $hero_map[$slug] ?? '';
                if ($hero_file && file_exists($tpl_dir . '/' . $hero_file)) {
                    echo '<div class="page-hero"><img src="' . esc_url($tpl_url . '/' . $hero_file) . '" alt="' . esc_attr(get_the_title()) . '"></div>';
                } elseif ( has_post_thumbnail() ) {
                    the_post_thumbnail('myslivna-slide', ['class' => 'page-hero-img']);
                }
                ?>

                <header class="page-header">
                    <h1><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php
                    // Nahradit ##IMGBASE## za skutečnou URL adresáře img-real v šabloně
                    $raw = get_the_content();
                    $img_base = get_template_directory_uri() . '/img-real';
                    $raw = str_replace('##IMGBASE##', $img_base, $raw);
                    echo apply_filters('the_content', $raw);
                    wp_link_pages(['before'=>'<nav class="page-links">','after'=>'</nav>']);
                    ?>
                </div>

                <?php
                // Podstránky jako foto dlaždice (jen přímé děti, sub-sub-children se nezobrazují)
                $children = get_pages([
                    'parent'      => get_the_ID(),
                    'sort_column' => 'menu_order',
                ]);
                if ($children) : ?>
                <div class="ornament">✦</div>
                <div class="section-tiles-grid">
                    <?php foreach ($children as $child) :
                        $child_slug = $child->post_name;
                        $child_hero = $hero_map[$child_slug] ?? '';
                        if ($child_hero && file_exists($tpl_dir . '/' . $child_hero)) {
                            $child_img = $tpl_url . '/' . $child_hero;
                        } else {
                            $child_img = $tpl_url . '/logolinka.jpg';
                        }
                    ?>
                    <a href="<?php echo get_permalink($child->ID); ?>" class="section-tile">
                        <img src="<?php echo esc_url($child_img); ?>" alt="<?php echo esc_attr($child->post_title); ?>" loading="lazy">
                        <div class="section-tile-label"><?php echo esc_html($child->post_title); ?></div>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

            </article>

            <?php endwhile; ?>

        </main>

        <?php get_sidebar('right'); ?>

<?php get_footer(); ?>
