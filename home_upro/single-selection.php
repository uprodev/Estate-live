<?php get_header(); ?>

<?php

$now = new DateTime();
$now = $now->getTimestamp();

$date = DateTime::createFromFormat("Y-m-d H:i", get_the_date('Y-m-d H:i'));
$date = $date->getTimestamp();

$seconds = abs($now - $date);

$hours = floor($seconds / 3600);

?>

<?php $selection_id = get_the_ID() ?>

<?php if ($hours > 72 && !is_user_logged_in()): ?>
    <h2><?php _e('Підбір створений понад 72 години тому', 'Home') ?></h2>
<?php else: ?>
    <section class="home-block selection-inner sales-block selection-inner-2">
        <div class="content-width">
            <?php get_template_part('parts/prev_page') ?>
            <div class="flex">
                <div class="top-text">

                    <?php if ($field = get_field('buyer_name')): ?>
                        <h1><?= $field ?></h1>
                    <?php endif ?>

                    <?php if ($field = get_field('buyer_phone')): ?>
                        <p><a href="tel:+<?= preg_replace('/[^0-9]/', '', $field) ?>"><?= $field ?></a></p>
                    <?php endif ?>

                    <div class="share-wrap">
                        <a href="<?php the_permalink() ?>" class="share-link"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-13.svg" alt=""></a>
                    </div>
                </div>
                <div class="share-info">
                </div>
            </div>

            <?php
            $featured_posts = get_field('objects');
            if($featured_posts): ?>

                <div class="content">

                    <?php foreach($featured_posts as $post):

                        global $post;
                        setup_postdata($post); ?>
                        <?php get_template_part('parts/content', 'objects_small_edit', ['object_id' => get_the_ID(), 'selection_id' => $selection_id]) ?>
                    <?php endforeach; ?>

                    <?php wp_reset_postdata(); ?>

                </div>

            <?php endif; ?>

        </div>
    </section>
<?php endif ?>

<?php get_footer(); ?>
