<?php
/**
 * Template Name: Rezervace online
 * Šablona pro stránku rezervací – kompatibilní s pluginem Contact Form 7
 * nebo s pluginem Restaurant Reservations (thefoodiepro).
 */
get_header(); ?>

        <?php get_sidebar( 'left' ); ?>

        <main id="main-content" role="main">

            <?php myslivna_breadcrumbs(); ?>

            <div class="reservation-box">
                <h2>Rezervace stolu online</h2>

                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>

                <?php
                // Zobraz success message
                if ( isset($_GET['rezervace']) && $_GET['rezervace'] === 'ok' ) : ?>
                <div class="rezervace-success">
                    ✅ Děkujeme za rezervaci! Brzy vás budeme kontaktovat s potvrzením.
                </div>
                <?php endif; ?>

                <?php
                // Pokud je nastaven embed kód rezervačního systému (Bookio, Resova, atd.), zobraz ho
                // Embed je vkládán adminem, povolujeme iframe + script tagy
                $embed_kod = get_option('myslivna_rezervace_embed', '');
                if ( $embed_kod ) :
                    echo $embed_kod;
                else :
                // Fallback: vlastní formulář
                ?>

                <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="rezervace-form">
                    <?php wp_nonce_field( 'myslivna_rezervace', 'rezervace_nonce' ); ?>
                    <input type="hidden" name="action" value="myslivna_rezervace">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="rez-jmeno">Jméno a příjmení *</label>
                            <input type="text" id="rez-jmeno" name="jmeno" required>
                        </div>
                        <div class="form-group">
                            <label for="rez-telefon">Telefon *</label>
                            <input type="tel" id="rez-telefon" name="telefon" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="rez-email">E-mail</label>
                            <input type="email" id="rez-email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="rez-pocet">Počet osob *</label>
                            <select id="rez-pocet" name="pocet" required>
                                <?php for ( $i = 1; $i <= 30; $i++ ) : ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?> <?php echo $i === 1 ? 'osoba' : ( $i < 5 ? 'osoby' : 'osob' ); ?></option>
                                <?php endfor; ?>
                                <option value="30+">30+ (skupinová akce)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="rez-datum">Datum *</label>
                            <input type="date" id="rez-datum" name="datum" required min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="rez-cas">Čas *</label>
                            <select id="rez-cas" name="cas" required>
                                <?php
                                $times = ['11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00'];
                                foreach ( $times as $t ) echo '<option value="' . $t . '">' . $t . '</option>';
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label for="rez-poznamka">Poznámka / speciální požadavky</label>
                            <textarea id="rez-poznamka" name="poznamka" rows="3"></textarea>
                        </div>
                    </div>

                    <p style="font-size:0.78rem;color:#5a4a3a;margin-bottom:12px;">
                        * Povinné pole. Rezervace je platná po potvrzení od restaurace.
                    </p>

                    <button type="submit" class="btn">Odeslat rezervaci</button>
                </form>

                <?php endif; // konec embed/fallback podmínky ?>

                <p style="margin-top:16px;">Rezervaci můžete provézt také telefonicky nebo e-mailem:</p>
                <div class="contact-card">
                    <div class="contact-row">
                        <span class="label">Telefon:</span>
                        <span><a href="tel:<?php echo esc_attr( str_replace(' ','', myslivna_opt('myslivna_telefon','+420317700280') ) ); ?>">
                            <?php echo esc_html( myslivna_opt('myslivna_telefon', '+420 317 700 280') ); ?>
                        </a></span>
                    </div>
                    <div class="contact-row">
                        <span class="label">E-mail:</span>
                        <span><a href="mailto:<?php echo esc_attr( myslivna_opt('myslivna_email','myslivna@igcpraha.cz') ); ?>">
                            <?php echo esc_html( myslivna_opt('myslivna_email', 'myslivna@igcpraha.cz') ); ?>
                        </a></span>
                    </div>
                </div>

            </div><!-- .reservation-box -->

        </main>

        <?php get_sidebar( 'right' ); ?>

<?php get_footer(); ?>

