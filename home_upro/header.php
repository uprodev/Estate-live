<?php get_template_part('parts/head') ?>

<div class="top-line">
    <div class="content-width">

        <?php if ($field = get_field('logo_header', 'option')): ?>
            <div class="logo-wrap">
                <a href="<?= get_home_url() ?>">
                    <?= wp_get_attachment_image($field['ID'], 'full') ?>
                </a>
            </div>
        <?php endif ?>

        <?php if (is_user_logged_in()): ?>
            <nav class="top-menu">
                <ul>
                    <li<?php if(get_the_ID() == 55) echo ' class="current-page"' ?>>
                        <a href="<?php the_permalink(55) ?>">
                            <figure>
                                <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-2-1.svg" alt="">
                            </figure>
                            <p><?php _e('Об’єкти', 'Home') ?></p>
                        </a>
                    </li>
                    <li<?php if(get_the_ID() == 104) echo ' class="current-page"' ?>>
                        <a href="<?php the_permalink(104) ?>">
                            <figure>
                                <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-2-2.svg" alt="">
                            </figure>
                            <p><?php _e('Продано', 'Home') ?></p>
                        </a>
                    </li>
                    <li class="center<?php if(get_the_ID() == 88) echo ' current-page' ?>">
                        <a href="<?php the_permalink(88) ?>">
                            <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-1.svg" alt="">
                        </a>
                    </li>
                    <li<?php if(get_the_ID() == 144) echo ' class="current-page"' ?>>
                        <a href="<?php the_permalink(144) ?>">
                            <figure>
                                <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-2-3.svg" alt="">
                            </figure>
                            <p><?php _e('Обране', 'Home') ?></p>
                        </a>
                    </li>

                    <?php $author_id = get_current_user_id() ?>

                    <li>
                        <a href="<?php the_permalink(94) ?>">
                          <span class="img-wrap">

                            <?php if ($field = get_field('avatar', 'user_' . $author_id)): ?>
                                <?= wp_get_attachment_image($field['ID'], 'full') ?>
                            <?php else: ?>
                                <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-10.svg" alt="">
                            <?php endif ?>

                        </span>
                        <p><?= get_the_author_meta('first_name', $author_id) ?></p>
                    </a>
                </li>
            </ul>
        </nav>
    <?php else: ?>

        <?php get_template_part('parts/landing', 'head') ?>

    <?php endif ?>

    <div class="login-wrap">

        <?php if (is_user_logged_in()): ?>
            <a href="<?= wp_logout_url(home_url()) ?>">
                <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-8.svg" alt="">
                <span>log out</span>
            </a>
        <?php endif ?>

    </div>
</div>
</div>
</header>

<?php if (!is_user_logged_in()): ?>
    <?php get_template_part('parts/menu', 'responsive') ?>
<?php endif ?>

<main>

    <?php if (is_page_template('page-templates/catalog.php') || is_search() || is_tax() || is_page_template('page-templates/objects_by_builder.php') || is_page_template('page-templates/objects_by_complex.php')): ?>

    <?php
    /*$section_class = '';
    if (is_singular('objects')) $section_class = 'inner-home-block';
    if (is_front_page() || is_tax()) $section_class = 'home-block-default';
    if(is_page_template('page-templates/add_object.php')) $section_class = 'add-form';
    if(is_page_template('page-templates/create_selection.php')) $section_class = 'create-selection';*/
    ?>

    <section class="home-block home-block-default">
        <div class="content-width">

            <div class="filter-block">
                <div class="form-wrap">

                    <?php get_search_form() ?>

                    <div class="wrap-filter">
                        <a href="#" class="filter-btn btn-default "><img src="<?= get_stylesheet_directory_uri() ?>/img/filter.svg" alt=""></a>
                    </div>
                </div>
                <div class="sort-wrap">
                    <a href="#sort" class="btn-sort btn-default fancybox"><img src="<?= get_stylesheet_directory_uri() ?>/img/sort.svg" alt=""></a>
                </div>
            </div>

            <?php get_template_part('parts/filter', 'objects') ?>

            <?php if (is_singular('objects') || is_page_template('page-templates/create_selection.php')): ?>
            <?php get_template_part('parts/prev_page') ?>
        <?php endif ?>

    <?php endif ?>
