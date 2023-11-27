<?php get_template_part('parts/head') ?>

<div class="top-line-lading">
    <div class="content-width">

        <?php if ($field = get_field('logo_header', 'option')): ?>
            <div class="logo-wrap">
                <a href="<?= get_home_url() ?>">
                    <?= wp_get_attachment_image($field['ID'], 'full') ?>
                </a>
            </div>
        <?php endif ?>

        <?php get_template_part('parts/landing', 'head') ?>

    </div>
</div>
</header>

<?php get_template_part('parts/menu', 'responsive') ?>

<main>
