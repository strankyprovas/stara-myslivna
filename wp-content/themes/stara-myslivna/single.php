<?php get_header(); ?>

        <?php get_sidebar( 'left' ); ?>

        <main id="main-content" role="main">

            <?php myslivna_breadcrumbs(); ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header class="page-header">
                        <h1><?php the_title(); ?></h1>
                        <p style="font-size:0.8rem;color:#7a6a5a;margin-top:4px;">
                            <?php echo get_the_date( 'd. m. Y' ); ?>
                        </p>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div style="margin-bottom:16px;">
                        <?php the_post_thumbnail( 'myslivna-slide', [ 'style' => 'width:100%;height:auto;border:2px solid #c9a84c;' ] ); ?>
                    </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                </article>

                <nav class="post-navigation" style="margin-top:20px;display:flex;justify-content:space-between;font-size:0.82rem;">
                    <div><?php previous_post_link( '&larr; %link' ); ?></div>
                    <div><?php next_post_link( '%link &rarr;' ); ?></div>
                </nav>

            <?php endwhile; ?>

        </main>

        <?php get_sidebar( 'right' ); ?>

<?php get_footer(); ?>
