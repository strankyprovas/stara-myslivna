<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-wrapper">

    <!-- ===== LOGOLINKA (reálná grafika klienta 2026) ===== -->
    <header class="site-header">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/img-real/logolinka.jpg"
                 alt="<?php bloginfo('name'); ?>"
                 class="logolinka-img">
        </a>
        <div class="header-lang">
            <a href="<?php echo home_url('/'); ?>">CS</a>
            <span>|</span><a href="#">DE</a>
            <span>|</span><a href="#">EN</a>
        </div>
        <div class="header-social">
            <?php $fb = myslivna_opt('myslivna_facebook', 'https://www.facebook.com/staramyslivna'); ?>
            <?php $ig = myslivna_opt('myslivna_instagram', 'https://www.instagram.com/staramyslivnakonopiste'); ?>
            <?php if ($fb) : ?>
            <a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="Facebook">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#3b5998" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 12c0-5.522-4.478-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987H7.898V12h2.54V9.797c0-2.506 1.493-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.891h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
                </svg>
            </a>
            <?php endif; ?>
            <?php if ($ig) : ?>
            <a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="Instagram">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#C13584" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
            </a>
            <?php endif; ?>
        </div>
    </header>

    <!-- ===== HORIZONTÁLNÍ NAVIGACE (pod logolinkoy, per klient) ===== -->
    <nav class="main-nav" role="navigation" aria-label="Hlavní menu">
        <button type="button" class="hamburger-toggle" aria-label="Otevřít menu" aria-expanded="false" onclick="myslivnaToggleNav(this)">
            <span class="hamburger-icon"></span>
            <span class="hamburger-label">MENU</span>
        </button>
        <?php wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'main-nav-list',
            'fallback_cb'    => 'myslivna_horiz_nav_fallback',
        ]); ?>
    </nav>
    <script>
    function myslivnaToggleNav(btn) {
        var nav = btn.parentNode;
        var open = nav.classList.toggle('nav-open');
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    }
    </script>

    <!-- ===== 3-SLOUPCOVÝ LAYOUT ===== -->
    <div class="content-area">

<?php
function myslivna_horiz_nav_fallback() {
    $current_id = get_queried_object_id();
    // Pouze 6 položek navigace dle originálu
    $nav_slugs = ['o-restauraci','menu','rezervace-on-line','sluzby','akce','shop','kontakty'];
    $nav_labels = ['O restauraci','Jídelní lístek','Rezervace','Služby','Akce','Shop','Kontakty'];
    echo '<ul class="main-nav-list">';
    foreach ($nav_slugs as $i => $slug) {
        $page = get_page_by_path($slug);
        if (!$page) continue;
        $is_current = ($current_id === $page->ID);
        $is_ancestor = false;
        if (!$is_current) {
            $ancestors = get_post_ancestors($current_id);
            $is_ancestor = in_array($page->ID, $ancestors);
        }
        $cls = ($is_current || $is_ancestor) ? ' class="current-menu-item"' : '';
        $children = get_pages(['parent'=>$page->ID,'sort_column'=>'menu_order']);
        echo '<li' . $cls . '>';
        echo '<a href="' . get_permalink($page->ID) . '">' . esc_html($nav_labels[$i]) . '</a>';
        if ($children) {
            echo '<ul class="sub-menu">';
            foreach ($children as $c) {
                $grand = get_pages(['parent'=>$c->ID,'sort_column'=>'menu_order']);
                $li_cls = [];
                if ($current_id === $c->ID) $li_cls[] = 'current-menu-item';
                if ($grand) $li_cls[] = 'has-submenu';
                $li_attr = $li_cls ? ' class="' . implode(' ', $li_cls) . '"' : '';
                echo '<li' . $li_attr . '><a href="' . get_permalink($c->ID) . '">' . esc_html($c->post_title) . '</a>';
                if ($grand) {
                    echo '<ul class="sub-sub-menu">';
                    foreach ($grand as $gc) {
                        $gca = ($current_id === $gc->ID) ? ' class="current-menu-item"' : '';
                        echo '<li' . $gca . '><a href="' . get_permalink($gc->ID) . '">' . esc_html($gc->post_title) . '</a></li>';
                    }
                    echo '</ul>';
                }
                echo '</li>';
            }
            echo '</ul>';
        }
        echo '</li>';
    }
    echo '</ul>';
}
