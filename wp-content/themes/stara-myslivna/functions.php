<?php
/**
 * Stará Myslivna – functions.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* =============================================================
   THEME SETUP
   ============================================================= */
function myslivna_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'custom-background', [ 'default-color' => 'e8dcc8' ] );
    add_theme_support( 'responsive-embeds' );

    // Thumbnail sizes
    add_image_size( 'myslivna-thumb',  300, 220, true );
    add_image_size( 'myslivna-slide',  800, 400, true );
    add_image_size( 'myslivna-gallery', 400, 300, true );

    // Navigation menus
    register_nav_menus( [
        'primary'  => __( 'Hlavní navigace', 'stara-myslivna' ),
        'language' => __( 'Jazykový přepínač', 'stara-myslivna' ),
        'footer'   => __( 'Patičkové menu', 'stara-myslivna' ),
    ] );
}
add_action( 'after_setup_theme', 'myslivna_setup' );

/* =============================================================
   ENQUEUE STYLES & SCRIPTS
   ============================================================= */
function myslivna_enqueue() {
    wp_enqueue_style( 'myslivna-style', get_stylesheet_uri(), [], '1.0.0' );
    wp_enqueue_script( 'myslivna-main', get_template_directory_uri() . '/js/main.js', [], '1.0.0', true );

    // Lightbox pro galerie (volitelné – přidejte plugin nebo CDN)
    // wp_enqueue_style(  'fslightbox', 'https://cdn.jsdelivr.net/npm/fslightbox@3.4.1/index.min.css' );
    // wp_enqueue_script( 'fslightbox', 'https://cdn.jsdelivr.net/npm/fslightbox@3.4.1/index.min.js', [], null, true );
}
add_action( 'wp_enqueue_scripts', 'myslivna_enqueue' );

/* =============================================================
   WIDGET AREAS (SIDEBARY)
   ============================================================= */
function myslivna_widgets_init() {

    register_sidebar( [
        'name'          => 'Levý sidebar',
        'id'            => 'sidebar-left',
        'description'   => 'Levý boční sloupec (kontakty, parkování, hrad, FB…)',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ] );

    register_sidebar( [
        'name'          => 'Pravý sidebar',
        'id'            => 'sidebar-right',
        'description'   => 'Pravý boční sloupec (otevírací doba, akce, rychlé info…)',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ] );

    register_sidebar( [
        'name'          => 'Patička – sloupec 1',
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ] );

    register_sidebar( [
        'name'          => 'Patička – sloupec 2',
        'id'            => 'footer-2',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ] );

    register_sidebar( [
        'name'          => 'Patička – sloupec 3',
        'id'            => 'footer-3',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'myslivna_widgets_init' );

/* =============================================================
   CUSTOM WALKER – NAVIGACE S DROPDOWNEM
   ============================================================= */
class Myslivna_Walker_Nav extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="sub-menu">';
    }
    function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }
}

/* =============================================================
   BREADCRUMBS
   ============================================================= */
function myslivna_breadcrumbs() {
    if ( is_front_page() ) return;

    $sep = '<span>›</span>';
    echo '<nav class="breadcrumbs" aria-label="Drobečková navigace">';
    echo '<a href="' . home_url() . '">Úvod</a> ' . $sep . ' ';

    if ( is_page() ) {
        global $post;
        if ( $post->post_parent ) {
            $ancestors = get_post_ancestors( $post );
            $ancestors = array_reverse( $ancestors );
            foreach ( $ancestors as $ancestor ) {
                echo '<a href="' . get_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a> ' . $sep . ' ';
            }
        }
        echo get_the_title();

    } elseif ( is_single() ) {
        $cats = get_the_category();
        if ( $cats ) {
            echo '<a href="' . get_category_link( $cats[0]->term_id ) . '">' . $cats[0]->name . '</a> ' . $sep . ' ';
        }
        echo get_the_title();

    } elseif ( is_category() ) {
        echo 'Kategorie: ' . single_cat_title( '', false );

    } elseif ( is_search() ) {
        echo 'Výsledky hledání: ' . get_search_query();

    } elseif ( is_404() ) {
        echo 'Stránka nenalezena';
    }

    echo '</nav>';
}

/* =============================================================
   SHORTCODE: [kontakt]
   Vypíše kontaktní box z Options (nebo pevně)
   ============================================================= */
function myslivna_shortcode_kontakt( $atts ) {
    ob_start(); ?>
    <div class="contact-card">
        <h3>Kontakt</h3>
        <div class="contact-row"><span class="label">Adresa:</span><span>Konopiště 2, 256 01 Benešov</span></div>
        <div class="contact-row"><span class="label">Telefon:</span><span><a href="tel:+420281865445">+420 281 865 445</a></span></div>
        <div class="contact-row"><span class="label">Email:</span><span><a href="mailto:myslivna@igcpraha.cz">myslivna@igcpraha.cz</a></span></div>
    </div>
    <?php return ob_get_clean();
}
add_shortcode( 'kontakt', 'myslivna_shortcode_kontakt' );

/* =============================================================
   SHORTCODE: [otviraci_doba]
   ============================================================= */
function myslivna_shortcode_otviraci( $atts ) {
    ob_start(); ?>
    <div class="contact-card">
        <h3>Otevírací doba</h3>
        <div class="contact-row"><span class="label">Po–Pá:</span><span>11:00 – 22:00</span></div>
        <div class="contact-row"><span class="label">So–Ne:</span><span>10:00 – 23:00</span></div>
    </div>
    <?php return ob_get_clean();
}
add_shortcode( 'otviraci_doba', 'myslivna_shortcode_otviraci' );

/* =============================================================
   SHORTCODE: [video url="https://youtube.com/..."]
   ============================================================= */
function myslivna_shortcode_video( $atts ) {
    $atts = shortcode_atts( [ 'url' => '' ], $atts );
    if ( empty( $atts['url'] ) ) return '';
    $embed = wp_oembed_get( esc_url( $atts['url'] ) );
    return $embed ? '<div class="video-container">' . $embed . '</div>' : '';
}
add_shortcode( 'video', 'myslivna_shortcode_video' );

/* =============================================================
   SHORTCODE: [galerie ids="1,2,3"]
   ============================================================= */
function myslivna_shortcode_galerie( $atts ) {
    $atts = shortcode_atts( [ 'ids' => '' ], $atts );
    if ( empty( $atts['ids'] ) ) return '';
    $ids = array_map( 'intval', explode( ',', $atts['ids'] ) );
    ob_start();
    echo '<div class="photo-gallery">';
    foreach ( $ids as $id ) {
        $full  = wp_get_attachment_image_url( $id, 'full' );
        $thumb = wp_get_attachment_image_url( $id, 'myslivna-gallery' );
        $alt   = get_post_meta( $id, '_wp_attachment_image_alt', true );
        if ( $full ) {
            echo '<a href="' . esc_url( $full ) . '" data-fslightbox="gallery">';
            echo '<img src="' . esc_url( $thumb ) . '" alt="' . esc_attr( $alt ) . '">';
            echo '</a>';
        }
    }
    echo '</div>';
    return ob_get_clean();
}
add_shortcode( 'galerie', 'myslivna_shortcode_galerie' );

/* =============================================================
   CLEAN UP WP HEAD
   ============================================================= */
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

/* =============================================================
   EXCERPT LENGTH
   ============================================================= */
function myslivna_excerpt_length() { return 25; }
add_filter( 'excerpt_length', 'myslivna_excerpt_length' );

/* =============================================================
   THEME OPTIONS PAGE
   ============================================================= */
function myslivna_options_page() {
    add_menu_page(
        'Myslivna – Nastavení',
        '🦌 Myslivna',
        'manage_options',
        'myslivna-options',
        'myslivna_options_render',
        'dashicons-admin-settings',
        3
    );
}
add_action( 'admin_menu', 'myslivna_options_page' );

function myslivna_options_render() {
    if ( isset( $_POST['myslivna_save'] ) && check_admin_referer( 'myslivna_save_options' ) ) {
        $fields = [ 'myslivna_telefon', 'myslivna_email', 'myslivna_adresa', 'myslivna_facebook',
                    'myslivna_instagram', 'myslivna_provozni_doba', 'myslivna_aktualne', 'myslivna_pripravujeme',
                    'myslivna_rezervace_embed' ];
        for ($i = 1; $i <= 6; $i++) {
            $fields[] = "myslivna_slide_zajimavosti_{$i}";
            $fields[] = "myslivna_slide_pokrmy_{$i}";
        }
        foreach ( $fields as $f ) {
            if ( isset( $_POST[ $f ] ) ) {
                update_option( $f, wp_kses_post( stripslashes( $_POST[ $f ] ) ) );
            }
        }
        echo '<div class="notice notice-success"><p>✅ Nastavení uloženo.</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>🦌 Nastavení webu Stará Myslivna</h1>
        <form method="post">
            <?php wp_nonce_field( 'myslivna_save_options' ); ?>
            <input type="hidden" name="myslivna_save" value="1">

            <h2>📞 Kontaktní údaje</h2>
            <table class="form-table">
                <tr><th>Telefon</th><td>
                    <input type="text" name="myslivna_telefon" value="<?php echo esc_attr( get_option('myslivna_telefon', '+420 317 700 280') ); ?>" style="width:300px">
                </td></tr>
                <tr><th>E-mail</th><td>
                    <input type="text" name="myslivna_email" value="<?php echo esc_attr( get_option('myslivna_email', 'myslivna@igcpraha.cz') ); ?>" style="width:300px">
                </td></tr>
                <tr><th>Adresa</th><td>
                    <input type="text" name="myslivna_adresa" value="<?php echo esc_attr( get_option('myslivna_adresa', 'Konopiště 2, 256 01 Benešov') ); ?>" style="width:300px">
                </td></tr>
                <tr><th>Facebook URL</th><td>
                    <input type="url" name="myslivna_facebook" value="<?php echo esc_attr( get_option('myslivna_facebook', 'https://www.facebook.com/staramyslivna') ); ?>" style="width:400px">
                </td></tr>
                <tr><th>Instagram URL</th><td>
                    <input type="url" name="myslivna_instagram" value="<?php echo esc_attr( get_option('myslivna_instagram', 'https://www.instagram.com/staramyslivnakonopiste') ); ?>" style="width:400px">
                </td></tr>
            </table>

            <h2>🕐 Provozní doba <small style="font-weight:normal;color:#666">(zobrazí se v levém sidebaru)</small></h2>
            <table class="form-table">
                <tr><th>Text provozní doby</th><td>
                    <textarea name="myslivna_provozni_doba" rows="6" style="width:400px;font-family:monospace"><?php echo esc_textarea( get_option('myslivna_provozni_doba', "PO–ČT od 11:00 do 21:00 hod.\nPÁ–SO od 11:00 do 22:00 hod.\nNE od 11:00 do 21:00 hod.") ); ?></textarea>
                    <p class="description">Každý řádek = jeden řádek na webu.</p>
                </td></tr>
            </table>

            <h2>📢 Aktuálně <small style="font-weight:normal;color:#666">(zobrazí se v pravém sidebaru)</small></h2>
            <table class="form-table">
                <tr><th>Text „Aktuálně"</th><td>
                    <textarea name="myslivna_aktualne" rows="6" style="width:400px;font-family:monospace"><?php echo esc_textarea( get_option('myslivna_aktualne', '') ); ?></textarea>
                    <p class="description">Např. aktuální akce, upozornění, změny provozní doby.</p>
                </td></tr>
                <tr><th>Připravujeme</th><td>
                    <textarea name="myslivna_pripravujeme" rows="4" style="width:400px;font-family:monospace"><?php echo esc_textarea( get_option('myslivna_pripravujeme', '') ); ?></textarea>
                </td></tr>
            </table>

            <h2>📅 Rezervační systém <small style="font-weight:normal;color:#666">(stránka Rezervace)</small></h2>
            <table class="form-table">
                <tr><th>Embed kód rezervačního systému</th><td>
                    <textarea name="myslivna_rezervace_embed" rows="6" style="width:500px;font-family:monospace"><?php echo esc_textarea( get_option('myslivna_rezervace_embed', '') ); ?></textarea>
                    <p class="description">
                        Sem vložte embed kód z <strong>Resova.cz</strong> nebo <strong>SimplyBook.me</strong>.<br>
                        Dokud je prázdné, zobrazí se záložní formulář který posílá email.<br>
                        <strong>Jak na to:</strong> Vytvořte účet na <a href="https://resova.cz" target="_blank">resova.cz</a>,
                        nastavte restauraci a zkopírujte embed kód sem.
                    </p>
                </td></tr>
            </table>

            <h2>🖼️ Slideshow – Zajímavosti <small style="font-weight:normal;color:#666">(levý sidebar)</small></h2>
            <p class="description" style="margin-left:200px;">Vyberte fotky ze sekce Média. Každé pole = jedna snímek ve slideshow.</p>
            <table class="form-table">
                <?php for ($i = 1; $i <= 6; $i++) :
                    $val = get_option("myslivna_slide_zajimavosti_{$i}", '');
                    $preview = $val ? wp_get_attachment_image($val, 'thumbnail') : '';
                ?>
                <tr><th>Snímek <?php echo $i; ?></th><td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div id="zajimavosti-preview-<?php echo $i; ?>" style="width:60px;height:60px;border:1px solid #ddd;overflow:hidden;"><?php echo $preview; ?></div>
                        <input type="hidden" name="myslivna_slide_zajimavosti_<?php echo $i; ?>"
                               id="zajimavosti-id-<?php echo $i; ?>"
                               value="<?php echo esc_attr($val); ?>">
                        <button type="button" class="button myslivna-media-pick"
                                data-target="zajimavosti-id-<?php echo $i; ?>"
                                data-preview="zajimavosti-preview-<?php echo $i; ?>">
                            <?php echo $val ? 'Změnit' : 'Vybrat'; ?>
                        </button>
                        <?php if ($val) : ?>
                        <button type="button" class="button myslivna-media-clear"
                                data-target="zajimavosti-id-<?php echo $i; ?>"
                                data-preview="zajimavosti-preview-<?php echo $i; ?>">Odebrat</button>
                        <?php endif; ?>
                    </div>
                </td></tr>
                <?php endfor; ?>
            </table>

            <h2>🖼️ Slideshow – Pokrmy <small style="font-weight:normal;color:#666">(levý sidebar)</small></h2>
            <table class="form-table">
                <?php for ($i = 1; $i <= 6; $i++) :
                    $val = get_option("myslivna_slide_pokrmy_{$i}", '');
                    $preview = $val ? wp_get_attachment_image($val, 'thumbnail') : '';
                ?>
                <tr><th>Snímek <?php echo $i; ?></th><td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div id="pokrmy-preview-<?php echo $i; ?>" style="width:60px;height:60px;border:1px solid #ddd;overflow:hidden;"><?php echo $preview; ?></div>
                        <input type="hidden" name="myslivna_slide_pokrmy_<?php echo $i; ?>"
                               id="pokrmy-id-<?php echo $i; ?>"
                               value="<?php echo esc_attr($val); ?>">
                        <button type="button" class="button myslivna-media-pick"
                                data-target="pokrmy-id-<?php echo $i; ?>"
                                data-preview="pokrmy-preview-<?php echo $i; ?>">
                            <?php echo $val ? 'Změnit' : 'Vybrat'; ?>
                        </button>
                        <?php if ($val) : ?>
                        <button type="button" class="button myslivna-media-clear"
                                data-target="pokrmy-id-<?php echo $i; ?>"
                                data-preview="pokrmy-preview-<?php echo $i; ?>">Odebrat</button>
                        <?php endif; ?>
                    </div>
                </td></tr>
                <?php endfor; ?>
            </table>

            <p><input type="submit" class="button button-primary button-large" value="💾 Uložit nastavení"></p>
        </form>
    </div>
    <script>
    jQuery(function($) {
        var frame;
        $(document).on('click', '.myslivna-media-pick', function(e) {
            e.preventDefault();
            var btn = $(this);
            var targetId  = btn.data('target');
            var previewId = btn.data('preview');
            frame = wp.media({ title: 'Vybrat obrázek', button: { text: 'Použít' }, multiple: false });
            frame.on('select', function() {
                var att = frame.state().get('selection').first().toJSON();
                $('#' + targetId).val(att.id);
                var thumb = att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url;
                $('#' + previewId).html('<img src="' + thumb + '" style="width:60px;height:60px;object-fit:cover;">');
                btn.text('Změnit');
            });
            frame.open();
        });
        $(document).on('click', '.myslivna-media-clear', function(e) {
            e.preventDefault();
            var targetId  = $(this).data('target');
            var previewId = $(this).data('preview');
            $('#' + targetId).val('');
            $('#' + previewId).html('');
        });
    });
    </script>
    <?php
}

function myslivna_options_enqueue($hook) {
    if ($hook !== 'toplevel_page_myslivna-options') return;
    wp_enqueue_media();
    wp_enqueue_script('jquery');
}
add_action('admin_enqueue_scripts', 'myslivna_options_enqueue');

function myslivna_register_settings() {
    $opts = [ 'myslivna_telefon', 'myslivna_email', 'myslivna_adresa', 'myslivna_facebook',
              'myslivna_instagram', 'myslivna_provozni_doba', 'myslivna_aktualne', 'myslivna_pripravujeme',
              'myslivna_rezervace_embed' ];
    for ($i = 1; $i <= 6; $i++) {
        $opts[] = "myslivna_slide_zajimavosti_{$i}";
        $opts[] = "myslivna_slide_pokrmy_{$i}";
    }
    foreach ( $opts as $o ) {
        register_setting( 'myslivna_options_group', $o );
    }
}
add_action( 'admin_init', 'myslivna_register_settings' );

/* =============================================================
   HELPER: získej nastavení tématu
   ============================================================= */
function myslivna_opt( $key, $default = '' ) {
    return get_option( $key, $default );
}

/* =============================================================
   HANDLER: formulář Rezervace
   ============================================================= */
add_action( 'admin_post_myslivna_rezervace',        'myslivna_handle_rezervace' );
add_action( 'admin_post_nopriv_myslivna_rezervace', 'myslivna_handle_rezervace' );

function myslivna_handle_rezervace() {
    if ( ! isset( $_POST['rezervace_nonce'] ) || ! wp_verify_nonce( $_POST['rezervace_nonce'], 'myslivna_rezervace' ) ) {
        wp_die( 'Neplatný požadavek.' );
    }
    $jmeno    = sanitize_text_field( $_POST['jmeno']    ?? '' );
    $telefon  = sanitize_text_field( $_POST['telefon']  ?? '' );
    $email    = sanitize_email(      $_POST['email']    ?? '' );
    $pocet    = sanitize_text_field( $_POST['pocet']    ?? '' );
    $datum    = sanitize_text_field( $_POST['datum']    ?? '' );
    $cas      = sanitize_text_field( $_POST['cas']      ?? '' );
    $poznamka = sanitize_textarea_field( $_POST['poznamka'] ?? '' );

    $to      = myslivna_opt( 'myslivna_email', 'myslivna@igcpraha.cz' );
    $subject = "Nová rezervace – {$datum} {$cas} ({$pocet} os.)";
    $body    = "Jméno: {$jmeno}\nTelefon: {$telefon}\nEmail: {$email}\nPočet osob: {$pocet}\nDatum: {$datum}\nČas: {$cas}\nPoznámka: {$poznamka}";
    $headers = $email ? [ "Reply-To: {$email}" ] : [];

    wp_mail( $to, $subject, $body, $headers );

    wp_redirect( add_query_arg( 'rezervace', 'ok', get_permalink( get_page_by_path( 'rezervace-on-line' ) ) ) );
    exit;
}

/* =============================================================
   HANDLER: formulář Dárkové poukazy
   ============================================================= */
add_action( 'admin_post_myslivna_poukaz',        'myslivna_handle_poukaz' );
add_action( 'admin_post_nopriv_myslivna_poukaz', 'myslivna_handle_poukaz' );

function myslivna_handle_poukaz() {
    if ( ! isset( $_POST['poukaz_nonce'] ) || ! wp_verify_nonce( $_POST['poukaz_nonce'], 'myslivna_poukazobjednavka' ) ) {
        wp_die( 'Neplatný požadavek.' );
    }
    $jmeno    = sanitize_text_field( $_POST['jmeno']    ?? '' );
    $telefon  = sanitize_text_field( $_POST['telefon']  ?? '' );
    $email    = sanitize_email(      $_POST['email']    ?? '' );
    $castka   = sanitize_text_field( $_POST['castka']   ?? '' );
    $poznamka = sanitize_textarea_field( $_POST['poznamka'] ?? '' );

    $to      = myslivna_opt( 'myslivna_email', 'myslivna@igcpraha.cz' );
    $subject = "Objednávka dárkového poukazu – {$castka} Kč – {$jmeno}";
    $body    = "Jméno: {$jmeno}\nTelefon: {$telefon}\nEmail: {$email}\nHodnota poukazu: {$castka} Kč\nPoznámka: {$poznamka}";
    $headers = $email ? [ "Reply-To: {$email}" ] : [];

    wp_mail( $to, $subject, $body, $headers );

    wp_redirect( add_query_arg( 'poukazok', '1', get_permalink( get_page_by_path( 'darkove-poukazy' ) ) ) );
    exit;
}
