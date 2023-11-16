<!doctype html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class('lading'); ?>>
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

    <div class="menu-responsive-land" id="menu-responsive-land" style="display: none">
        <div class="top">
            <div class="close-menu-land">
                <a href="#"><img src="<?= get_stylesheet_directory_uri() ?>/img/lading/close.svg" alt=""></a>
            </div>
        </div>
        <div class="wrap">

            <?php if ($field = get_field('logo_header', 'option')): ?>
                <div class="logo-wrap">
                    <a href="<?= get_home_url() ?>">
                        <?= wp_get_attachment_image($field['ID'], 'full') ?>
                    </a>
                </div>
            <?php endif ?>

            <?php get_template_part('parts/landing', 'head_mob') ?>
            
        </div>
    </div>

    <main>
