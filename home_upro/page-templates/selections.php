<?php
/*
Template Name: Selections
*/
?>

<?php
if (!is_user_logged_in()) {
    wp_redirect(get_permalink(90));
    exit;
}
?>

<?php get_header(); ?>

<?php
$author_id = get_current_user_id();
$wp_query = new WP_Query(array('post_type' => 'selection', 'posts_per_page' => -1, 'author' => $author_id, 'paged' => get_query_var('paged')));
if($wp_query->have_posts()):
    ?>
    <section class="home-block selection-inner">
        <div class="content-width">
            <?php get_template_part('parts/prev_page') ?>
            <div class="top-text">

                <?php if ($field = get_field('buyer_name', $_GET['selection_id'])): ?>
                    <h1><?= $field ?></h1>
                <?php endif ?>


                <?php if ($field = get_field('buyer_phone', $_GET['selection_id'])): ?>
                    <p><a href="tel:+<?= preg_replace('/[^0-9]/', '', $field) ?>"><?= $field ?></a></p>
                <?php endif ?>

            </div>
            <div class="content">

                <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

                    <?php if (get_field('buyer_name') == get_field('buyer_name', $_GET['selection_id'])): ?>

                        <?php $selection_id = get_the_ID() ?>

                        <div class="item-photo" object_id="<?= $_GET['object_id'] ?>" selection_id="<?= $selection_id ?>">
                            <div class="wrap">
                                <h2>
                                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                </h2>
                                <p class="date"><?= get_the_date('d.m.Y') ?></p>
                                <div class="btn-wrap">
                                    <a href="#" class="delete-item-photo delete_selection"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-11.svg" alt=""></a>

                                    <?php $selection_objects = get_field('objects', $selection_id, false) ?>

                                    <?php if ($_GET['object_id']): ?>
                                        <div class="add_object_to_selection<?php if(in_array($_GET['object_id'], $selection_objects)) echo ' is_added' ?>">
                                            <a href="#">
                                                <img src="<?= get_stylesheet_directory_uri() ?>/img/add-to-selection.svg" alt="">
                                            </a>
                                        </div>
                                    <?php endif ?>

                                    <a href="<?php the_permalink() ?>" class="share"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-12.svg" alt=""></a>
                                </div>
                            </div>

                            <?php
                            $selection_objects = get_field('objects');
                            if($selection_objects): ?>

                                <div class="wrap-photo">

                                    <?php foreach($selection_objects as $post):

                                        global $post;
                                        setup_postdata($post); ?>
                                        <div class="wrap-selection">
                                            <a href="#"><?= get_the_post_thumbnail($post->ID, 'full') ?: '<img src="' . get_stylesheet_directory_uri() . '/img/icon-10.svg" alt="">' ?></a>

                                        </div>
                                    <?php endforeach; ?>

                                    <?php wp_reset_postdata(); ?>

                                </div>

                            <?php endif; ?>

                        </div>
                    <?php endif ?>


                <?php endwhile; ?>

            </div>
        </div>
    </section>

<?php
endif;
wp_reset_query();
?>

<?php get_footer(); ?>
