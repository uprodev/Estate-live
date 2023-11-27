<!doctype html>
<html <?php language_attributes() ?>>
<head>

    <?php if ($field = get_field('code_after_head_header', 'option')): ?>
        <?= $field ?>
    <?php endif ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<?php $body_class = is_page_template('page-templates/landing.php') ? 'lading lang-' . get_locale() : 'lang-' . get_locale() ?>

<body <?php body_class($body_class); ?>>
    <?php wp_body_open(); ?>
    
    <?php if ($field = get_field('code_after_body_header', 'option')): ?>
        <?= $field ?>
    <?php endif ?>

    <header>