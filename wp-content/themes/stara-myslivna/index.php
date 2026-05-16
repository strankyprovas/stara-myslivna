<?php get_header(); ?>

        <?php get_sidebar( 'left' ); ?>

        <main id="main-content" role="main">

            <?php myslivna_breadcrumbs(); ?>

            <?php if ( have_posts() ) : ?>

                <?php if ( is_home() && ! is_front_page() ) : ?>
                <header class="page-header">
                    <h1>Aktuality</h1>
                </header>
                <?php endif; ?>

                <?php if ( is_category() ) : ?>
                <header class="page-header">
                    <h1>Kategorie: <?php single_cat_title(); ?></h1>
                </header>
                <?php endif; ?>

                <?php if ( is_search() ) : ?>
                <header class="page-header">
                    <h1>Výsledky hledání: „<?php echo get_search_query(); ?>"</h1>
                </header>
                <?php endif; ?>

                <div class="news-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="news-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'myslivna-thumb' ); ?>
                        </a>
                        <?php endif; ?>
                        <div class="news-card-body">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>

                <?php the_posts_pagination( [ 'mid_size' => 2 ] ); ?>

            <?php else : ?>

                <p>Žádné příspěvky nebyly nalezeny.</p>

                <?php get_search_form(); ?>

            <?php endif; ?>

        </main>

        <?php get_sidebar( 'right' ); ?>

<?php get_footer(); ?>
