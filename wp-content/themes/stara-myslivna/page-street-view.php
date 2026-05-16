<?php
/**
 * Template Name: Street View
 * Stránka s embeddovaným Google Street View interiéru restaurace
 */
get_header(); ?>

        <?php get_sidebar('left'); ?>

        <main id="main-content" role="main">

            <?php myslivna_breadcrumbs(); ?>

            <div class="page-header">
                <h1>Street View – interiér restaurace</h1>
            </div>

            <div class="entry-content">
                <p>Projděte si virtuálně interiér Restaurace Stará Myslivna prostřednictvím Google Street View. Kliknutím a tažením myší si prohlédněte unikátní loveckou výzdobu, historické trofeje a autentickou atmosféru restaurace.</p>
            </div>

            <div class="streetview-wrap">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1680000000000!6m8!1m7!1sCIHM0ogKEICAgIDtvJuP1AE!2m2!1d49.7812630!2d14.6569371!3f309.3!4f4.47!5f0.7820865974627469"
                    width="100%"
                    height="420"
                    style="border:1px solid #c9b88a;display:block;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Street View – interiér Restaurace Stará Myslivna Konopiště">
                </iframe>
            </div>

            <div class="entry-content" style="margin-top:14px;">
                <p>Restaurace Stará Myslivna je unikátní myslivecká restaurace v areálu Zámku Konopiště. Interiér zdobí autentické lovecké trofeje, historické obrazy a vzácný mechanický orchestrion z 19. století.</p>
                <p><a href="<?php echo esc_url(home_url('/o-restauraci/zajimavosti/')); ?>">› Více o zajímavostech restaurace</a></p>
                <p><a href="<?php echo esc_url(home_url('/o-restauraci/interier/')); ?>">› Fotogalerie interiéru</a></p>
            </div>

            <div class="ornament" style="margin-top:16px;">✦</div>

        </main>

        <?php get_sidebar('right'); ?>

<?php get_footer(); ?>
