<nav class="top-menu-lading">

    <?php wp_nav_menu( array(
        'theme_location'  => 'header',
        'container'       => '',
        'items_wrap'      => '<ul>%3$s</ul>'
    ) ); ?>

    <div class="btn-wrap">
        <div class="wrap">

            <?php if (($field = get_field('link_header', 'option')) && is_front_page()): ?>
            <a href="<?= $field['url'] . '?region_id=166' ?>" class="btn-default to_catalog"<?php if($field['target']) echo ' target="_blank"' ?>><?= $field['title'] ?></a>
        <?php endif ?>

        <?php $terms = get_field('cities_header', 'option') ?>

        <?php if ($terms): ?>
            <div class="nice-select">
                <span class="current"><?= $_GET['region_id'] ? get_field('title_add', 'term_' . $_GET['region_id']) : get_field('title_add', 'term_' . $terms[0]->term_id) ?></span>
                <div class="list">
                    <ul class="new">

                        <?php foreach ($terms as $index => $term): ?>
                            <li class="option region<?php if($_GET['region_id'] == $term->term_id) echo ' selected focus' ?>" region_id="<?= $term->term_id ?>">
                                <a href="#"><?= get_field('title_add', 'term_' . $term->term_id) ?: mb_convert_case(mb_strtolower($term->name), MB_CASE_TITLE) ?></a>
                            </li>
                        <?php endforeach ?>

                    </ul>
                </div>
            </div>
        <?php endif ?>

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