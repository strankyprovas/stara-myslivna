<?php
/**
 * Template Name: Dárkové poukazy
 * Stránka pro objednávku dárkových poukazů emailem
 */
get_header(); ?>

        <?php get_sidebar('left'); ?>

        <main id="main-content" role="main">

            <?php myslivna_breadcrumbs(); ?>

            <div class="reservation-box">
                <h2>Dárkové poukazy</h2>

                <div class="entry-content">
                    <p>Darujte svým blízkým nezapomenutelný gastronomický zážitek v Restauraci Stará Myslivna Konopiště. Dárkový poukaz lze využít na konzumaci v restauraci v libovolné hodnotě.</p>
                    <ul>
                        <li>Poukazy vydáváme v libovolné hodnotě (minimálně 500 Kč)</li>
                        <li>Platnost poukazu: 12 měsíců od vydání</li>
                        <li>Poukaz lze uplatnit na konzumaci jídla i nápojů</li>
                        <li>Poukaz není směnitelný za hotovost</li>
                    </ul>
                </div>

                <?php if ( isset($_GET['poukazok']) && $_GET['poukazok'] === '1' ) : ?>
                <div class="rezervace-success">
                    ✅ Děkujeme za zájem! Brzy vás budeme kontaktovat s podrobnostmi k uhrazení poukazu.
                </div>
                <?php endif; ?>

                <h3 style="margin-top:18px;">Objednat dárkový poukaz</h3>

                <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" id="poukazform">
                    <?php wp_nonce_field('myslivna_poukazobjednavka', 'poukaz_nonce'); ?>
                    <input type="hidden" name="action" value="myslivna_poukaz">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="pou-jmeno">Jméno a příjmení *</label>
                            <input type="text" id="pou-jmeno" name="jmeno" required>
                        </div>
                        <div class="form-group">
                            <label for="pou-telefon">Telefon *</label>
                            <input type="tel" id="pou-telefon" name="telefon" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="pou-email">E-mail *</label>
                            <input type="email" id="pou-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="pou-castka">Hodnota poukazu (Kč) *</label>
                            <select id="pou-castka" name="castka" required>
                                <option value="500">500 Kč</option>
                                <option value="1000">1 000 Kč</option>
                                <option value="1500">1 500 Kč</option>
                                <option value="2000">2 000 Kč</option>
                                <option value="3000">3 000 Kč</option>
                                <option value="5000">5 000 Kč</option>
                                <option value="jina">Jiná částka</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group">
                            <label for="pou-poznamka">Poznámka (jiná částka, věnování, atp.)</label>
                            <textarea id="pou-poznamka" name="poznamka" rows="3"></textarea>
                        </div>
                    </div>

                    <p style="font-size:0.78rem;color:#5a4a3a;margin-bottom:12px;">
                        * Povinné pole. Po odeslání vás budeme kontaktovat s platebními údaji. Poukaz vystavíme po přijetí platby.
                    </p>

                    <button type="submit" class="btn">Objednat poukaz</button>
                </form>

                <div class="ornament" style="margin-top:20px;">✦</div>

                <div class="contact-card" style="margin-top:16px;">
                    <h3>Osobní vyzvednutí / telefonická objednávka</h3>
                    <div class="contact-row">
                        <span class="label">Telefon:</span>
                        <span><a href="tel:<?php echo esc_attr( str_replace(' ','', myslivna_opt('myslivna_telefon','+420281865445') ) ); ?>">
                            <?php echo esc_html( myslivna_opt('myslivna_telefon', '+420 281 865 445') ); ?>
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

        <?php get_sidebar('right'); ?>

<?php get_footer(); ?>

