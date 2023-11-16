<?php
/*
Template Name: Landing
*/
?>

<?php get_header('landing'); ?>

<section class="home-banner" id="banner">
    <div class="content-width">
        <div class="content">

            <?php if ($field = get_field('title_1')): ?>
                <div class="title">
                    <h1><?= $field ?></h1>
                </div>
            <?php endif ?>

            <?php if ($field = get_field('image_1')): ?>
                <figure>
                    <?= wp_get_attachment_image($field['ID'], 'full') ?>
                </figure>
            <?php endif ?>

        </div>

        <?php if (get_field('bottom_1')): ?>
            <div class="bottom" id="about">

                <?php $images = get_field('bottom_1')['gallery'];
                if($images): ?>

                    <div class="wrap-img">

                        <?php foreach($images as $index => $image): ?>

                            <div class="par par-<?= $index + 1 ?> rellax" data-rellax-speed="<?= $index == 0 ? -2 : 2 ?>">
                                <?= wp_get_attachment_image($image['ID'], 'full') ?>
                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

                <div class="text">

                    <?php if ($field = get_field('bottom_1')['title']): ?>
                        <p class="h2"><?= $field ?></p>
                    <?php endif ?>

                    <?php if ($field = get_field('bottom_1')['text']): ?>
                        <?= $field ?>
                    <?php endif ?>

                </div>
            </div>
        <?php endif ?>

    </div>
</section>

<?php $terms = get_field('cities_header', 'option') ?>

<?php
$wp_query = new WP_Query(array(
    'post_type' => 'objects',
    'posts_per_page' => 16,
    'post_status' => 'publish',
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'sold',
            'field' => 'id',
            'terms' => 73,
            'operator' => 'NOT IN'
        ),
        array(
            'taxonomy' => 'city',
            'field' => 'id',
            'terms' => $terms[0]->term_id,
        ),
    ),
    'paged' => get_query_var('paged')
));
?>

<?php if ($terms && $wp_query->have_posts()): ?>

    <?php
    switch ($terms[0]->name) {
        case 'КИЇВ':
        $region_name = 'Києві';
        break;
        case 'ІВАНО-ФРАНКІВСЬК':
        $region_name = 'Івано-Франківську';
        break;
        case 'ДНІПРО':
        $region_name = 'Дніпрі';
        break;
        case 'ЛЬВІВ':
        $region_name = 'Львові';
        break;

        default:
        break;
    }
    ?>

    <section class="home-block home-block-default bg-white" id="objects">
        <div class="content-width">
            <div class="title">
                <h2><?= __('Об’єкти в', 'Home') . ' ' ?> <span><?= $region_name ?></span></h2>

                <?php if ($field = get_field('link_1_2')): ?>
                    <div class="btn-wrap">
                        <a href="<?= $field['url'] . '?region_id=166' ?>" class="btn-default to_catalog"<?php if($field['target']) echo ' target="_blank"' ?>><?= $field['title'] ?></a>
                    </div>
                <?php endif ?>

            </div>
            <div class="content" id="response_objects">

                <?php $current_user_id = get_current_user_id() ?>

                <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

                    <?php get_template_part('parts/content', 'objects', ['object_id' => get_the_ID(), 'current_user_id' => $current_user_id]) ?>

                    <?php
                endwhile;
                wp_reset_query();
                ?>

            </div>

            <?php if ($field = get_field('link_2_2')): ?>
                <div class="btn-wrap-full">
                    <a href="<?= $field['url'] . '?region_id=166' ?>" class="btn-default to_catalog"<?php if($field['target']) echo ' target="_blank"' ?>><?= $field['title'] ?></a>
                </div>
            <?php endif ?>

        </div>
    </section>
<?php endif ?>

<?php if(have_rows('items_3')): ?>

    <section class="item-3x2" id="care">
        <div class="content-width">
            <div class="content">

                <?php if ($field = get_field('title_3')): ?>
                    <p class="h3"><?= $field ?></p>
                <?php endif ?>

                <ul>

                    <?php while(have_rows('items_3')): the_row() ?>

                        <li>

                            <?php if ($field = get_sub_field('image')): ?>
                                <figure>
                                    <?= wp_get_attachment_image($field['ID'], 'full') ?>
                                </figure>
                            <?php endif ?>

                            <?php if ($field = get_sub_field('text')): ?>
                                <p><?= $field ?></p>
                            <?php endif ?>

                        </li>

                    <?php endwhile ?>

                </ul>
            </div>
        </div>
    </section>

<?php endif ?>

<?php if(have_rows('items_4')): ?>

    <section class="number-block" id="numbers">
        <div class="content-width">
            <div class="content">

                <?php while(have_rows('items_4')): the_row() ?>

                    <?php if (get_row_index() == 1 || (get_row_index() - 1) % 5 == 0): ?>
                    <div class="item-50">
                    <?php endif ?>

                    <?php if (get_row_index() == 1 || (get_row_index() == 4) || (get_row_index() == 6) || (get_row_index() == 8)): ?>
                    <div class="item-col">
                    <?php endif ?>

                    <div class="item<?php if(get_sub_field('is_color')) echo ' item-color'; if(get_sub_field('is_height_2x')) echo ' height-2x'; ?>">
                        <a href="#">

                            <?php if ($field = get_sub_field('title')): ?>
                                <p class="big"><?= $field ?></p>
                            <?php endif ?>

                            <?php if ($field = get_sub_field('text')): ?>
                                <p><?= $field ?></p>
                            <?php endif ?>

                        </a>
                    </div>

                    <?php if (get_row_index() == 3 || (get_row_index() == 5) || (get_row_index() == 7) || (get_row_index() == 10)): ?>
                </div>
            <?php endif ?>

            <?php if (get_row_index() % 5 == 0 || get_row_index() == count(get_field('items_4'))): ?>
        </div>
    <?php endif ?>

<?php endwhile ?>

</div>
</div>
</section>

<?php endif ?>

<?php $images = get_field('gallery_5');
if($images): ?>

    <section class="partners" id="partners">
        <div class="content-width">

            <?php if ($field = get_field('title_5')): ?>
                <p class="h2"><?= $field ?></p>
            <?php endif ?>

            <div class="swiper partners-slider">
                <div class="swiper-wrapper">

                    <?php foreach($images as $image): ?>

                        <div class="swiper-slide">
                            <?= wp_get_attachment_image($image['ID'], 'full') ?>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </section>

<?php endif; ?>

<?php if(have_rows('items_6')): ?>

    <section class="step-block" id="steps">
        <div class="content-width">

            <?php if ($field = get_field('title_6')): ?>
                <p class="h2"><?= $field ?></p>
            <?php endif ?>

            <div class="content">

                <?php while(have_rows('items_6')): the_row() ?>

                    <div class="item">
                        <p class="big">
                            <?php if(get_row_index() <= 9) echo '0'; echo get_row_index() ?>
                        </p>

                        <?php if ($field = get_sub_field('title')): ?>
                            <p class="h6"><?= $field ?></p>
                        <?php endif ?>

                        <?php if ($field = get_sub_field('text')): ?>
                            <?= $field ?>
                        <?php endif ?>

                    </div>

                <?php endwhile ?>

            </div>
        </div>
    </section>

<?php endif ?>

<?php if(have_rows('items_7')): ?>

    <section class="team" id="team">
        <div class="content-width">

            <?php if ($field = get_field('title_7')): ?>
                <p class="h2"><?= $field ?></p>
            <?php endif ?>

            <div class="content">

                <?php while(have_rows('items_7')): the_row() ?>

                    <div class="item">

                        <?php if ($field = get_sub_field('photo')): ?>
                            <figure>
                                <?= wp_get_attachment_image($field['ID'], 'full') ?>
                            </figure>
                        <?php endif ?>

                        <div class="text">

                            <?php if ($field = get_sub_field('name')): ?>
                                <p class="h5"><?= $field ?></p>
                            <?php endif ?>

                            <?php if ($field = get_sub_field('position')): ?>
                                <p class="h6"><?= $field ?></p>
                            <?php endif ?>

                            <?php if ($field = get_sub_field('text')): ?>
                                <p class="info"><?= $field ?></p>
                            <?php endif ?>

                        </div>
                    </div>

                <?php endwhile ?>

            </div>
        </div>
    </section>

<?php endif ?>

<section class="pre-footer-form">
    <div class="bg">

        <?php if ($field = get_field('image_8')): ?>
            <?= wp_get_attachment_image($field['ID'], 'full') ?>
        <?php endif ?>

        <?php if ($field = get_field('image_mob_8')): ?>
            <?= wp_get_attachment_image($field['ID'], 'full', false, array('class' => 'mob')) ?>
        <?php endif ?>

    </div>
    <div class="content-width" id="form">
        <div class="content" id="pre_footer">

            <?php if ($field = get_field('title_8')): ?>
                <div class="title">
                    <p class="h2"><?= $field ?></p>
                </div>
            <?php endif ?>

            <?php if ($field = get_field('form_8')): ?>
                <div class="form-wrap">
                    <?= do_shortcode('[contact-form-7 id="' . $field . '" html_class="form-default"]') ?>
                </div>
            <?php endif ?>

        </div>
    </div>
</section>

<?php get_footer('landing'); ?>
