<nav class="top-menu-lading">

    <?php wp_nav_menu( array(
        'theme_location'  => 'header',
        'container'       => '',
        'items_wrap'      => '<ul>%3$s</ul>'
    ) ); ?>

    <div class="btn-wrap">

        <?php if (is_front_page()): ?>
            <?php custom_language_switcher() ?>
        <?php endif ?>
        
        <div class="wrap">

            <?php if (($field = get_field('link_header', 'option')) && is_front_page()): ?>
            <a href="<?= $field['url'] . '?region_id=166' ?>" class="btn-default to_catalog"<?php if($field['target']) echo ' target="_blank"' ?>><?= $field['title'] ?></a>
        <?php endif ?>

        <?php require 'select.php' ?>

    </div>

    <?php if ($field = get_field('button_header', 'option')): ?>
        <a href="<?= $field['url'] ?>" class="btn-default btn-border"<?php if($field['target']) echo ' target="_blank"' ?>><?= $field['title'] ?></a>
    <?php endif ?>

</div>
<div class="open-menu-land">
    <a href="#">
        <span></span>
        <span></span>
        <span></span>
    </a>
</div>
</nav>