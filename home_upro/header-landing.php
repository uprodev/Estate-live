<!doctype html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<?php $body_class = 'lading lang-' . get_locale() ?>

<body <?php body_class($body_class); ?>>
    <?php wp_body_open(); ?>
    <header>
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
