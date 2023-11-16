</main>

<footer id="footer">
    <div class="content-width">

        <?php if ($field = get_field('logo_footer', 'option')): ?>
            <div class="logo-wrap">
                <a href="<?= get_home_url() ?>">
                    <?= wp_get_attachment_image($field['ID'], 'full') ?>
                </a>
            </div>
        <?php endif ?>

        <nav class="footer-menu">

            <?php wp_nav_menu( array(
                'theme_location'  => 'footer',
                'container'       => '',
                'items_wrap'      => '<ul class="menu">%3$s</ul>'
            ) ); ?>

            <?php if(have_rows('socials_footer', 'option')): ?>

                <ul class="soc">

                    <?php while(have_rows('socials_footer', 'option')): the_row() ?>

                        <?php if ($field = get_sub_field('icon')): ?>
                            <li>
                                <a href="<?php the_sub_field('url') ?>" target="_blank">
                                    <?= wp_get_attachment_image($field['ID'], 'full') ?>
                                </a>
                            </li>
                        <?php endif ?>

                    <?php endwhile ?>

                </ul>

            <?php endif ?>

        </nav>

        <?php if(have_rows('contact_footer', 'option')): ?>

            <div class="bottom">
                <ul>

                    <?php while(have_rows('contact_footer', 'option')): the_row() ?>

                        <li>

                            <?php if ($field = get_sub_field('city')): ?>
                                <h6><?= $field ?></h6>
                            <?php endif ?>

                            <?php if ($field = get_sub_field('phone')): ?>
                                <p class="tel">
                                    <a href="tel:+<?= preg_replace('/[^0-9]/', '', $field) ?>">
                                        <img src="<?= get_stylesheet_directory_uri() ?>/img/lading/icon-l-6-1.svg" alt="">
                                        <?= $field ?>
                                    </a>
                                </p>
                            <?php endif ?>

                            <?php if ($field = get_sub_field('address')): ?>
                                <p>
                                    <img src="<?= get_stylesheet_directory_uri() ?>/img/lading/icon-l-6-2.svg" alt="">
                                    <?= $field ?>
                                </p>
                            <?php endif ?>

                        </li>

                    <?php endwhile ?>

                </ul>
            </div>

        <?php endif ?>

        <?php if(have_rows('socials_footer', 'option')): ?>

            <ul class="soc soc-mob">

                <?php while(have_rows('socials_footer', 'option')): the_row() ?>

                    <?php if ($field = get_sub_field('icon')): ?>
                        <li>
                            <a href="<?php the_sub_field('url') ?>" target="_blank">
                                <?= wp_get_attachment_image($field['ID'], 'full') ?>
                            </a>
                        </li>
                    <?php endif ?>

                <?php endwhile ?>

            </ul>

        <?php endif ?>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
