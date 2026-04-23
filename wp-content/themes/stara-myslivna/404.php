<?php get_header(); ?>

        <?php get_sidebar( 'left' ); ?>

        <main id="main-content" role="main">
            <header class="page-header">
                <h1>Stránka nenalezena (404)</h1>
            </header>
            <div class="entry-content">
                <p>Požadovaná stránka neexistuje nebo byla přesunuta.</p>
                <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">Zpět na úvod</a></p>
            </div>
        </main>

        <?php get_sidebar( 'right' ); ?>

<?php get_footer(); ?>
