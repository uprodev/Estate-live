<?php
/*
Template Name: Account
*/
?>

<?php
if (!is_user_logged_in()) {
    wp_redirect(get_permalink(90));
    exit;
}
?>

<?php get_header(); ?>

<?php $current_user_id = get_current_user_id() ?>

<section class="home-block sales-block account-block">
    <div class="content-width">
        <div class="top-info">
            <h1 class="title"><?php the_title() ?></h1>
            <div class="login-wrap">
                <a href="<?= wp_logout_url(home_url()) ?>">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-8.svg" alt="">
                    <span>log out</span>
                </a>
            </div>
        </div>
        <form action="#">
            <div class="account">
                <div class="img-wrap">

                    <?php if ($field = get_field('avatar', 'user_' . $current_user_id)): ?>
                        <figure class="user-photo">
                            <?= wp_get_attachment_image($field['ID'], 'full') ?>
                        </figure>
                    <?php endif ?>

                    <div class="dropzone"<?php if(!get_field('avatar', 'user_' . $current_user_id)) echo ' style="display: block"' ?>>
                        <div id="dZUpload" class="">
                            <div class="dz-default dz-message">
                                <div class="wrap-dropzone">
                                    <figure>
                                        <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-10.svg" alt="">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-edit-img btn-edit" id="upload_user_avatar">
                        <a href="#"<?php if(!get_field('avatar', 'user_' . $current_user_id)) echo ' class="is-active"' ?>><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-16.svg" alt=""></a>
                    </div>
                </div>
                <div class="text-wrap">
                    <p class="name"><?= get_the_author_meta('display_name', $current_user_id) ?></p>

                    <?php if ($field = get_field('phone', 'user_' . $current_user_id)): ?>
                        <div class="input-wrap">
                            <label for="user-tel"></label>
                            <input type="text" name="user-tel" id="user-tel" class="tel" disabled value="<?= $field ?>">
                            <a href="#" class="btn-edit-tel edit_user_phone" current_user_id="<?= $current_user_id ?>"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-16.svg" alt=""></a>
                        </div>
                    <?php endif ?>

                </div>
            </div>
        </form>
        <div class="tabs">
            <ul class="tabs-menu">
                <li><?php _e('Мої об’єкти', 'Home') ?></li>
                <li><?php _e('Чернетки', 'Home') ?></li>
                <!-- <li><?php _e('Продані', 'Home') ?></li> -->
            </ul>
            <div class="tab-content">

                <div class="content content-account">

                    <?php
                    $wp_query = new WP_Query(array('post_type' => 'objects', 'posts_per_page' => -1, 'author' => $current_user_id, 'tax_query' => array(array('taxonomy' => 'sold', 'field' => 'id', 'terms' => 73, 'operator' => 'NOT IN')), 'paged' => get_query_var('paged')));
                    if($wp_query->have_posts()):
                        ?>

                        <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

                        <?php get_template_part('parts/content', 'objects_small_edit', ['object_id' => get_the_ID(), 'current_user_id' => get_post_field('post_author', get_the_ID()), 'is_owner' => true]) ?>

                    <?php endwhile; ?>

                    <?php
                    endif;
                    wp_reset_query();
                    ?>

                </div>

                <div class="content">

                    <?php
                    $wp_query = new WP_Query(array('post_type' => 'objects', 'post_status' => 'draft', 'posts_per_page' => -1, 'author' => $current_user_id, 'tax_query' => array(array('taxonomy' => 'sold', 'field' => 'id', 'terms' => 73, 'operator' => 'NOT IN')), 'paged' => get_query_var('paged')));
                    if($wp_query->have_posts()):
                        ?>

                        <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

                        <?php get_template_part('parts/content', 'objects_small_edit', ['object_id' => get_the_ID(), 'current_user_id' => get_post_field('post_author', get_the_ID()), 'is_draft' => true]) ?>

                    <?php endwhile; ?>

                    <?php
                    endif;
                    wp_reset_query();
                    ?>

                </div>

                <!-- <div class="content">

					<?php
                $wp_query = new WP_Query(array('post_type' => 'objects', 'posts_per_page' => -1, 'author' => $current_user_id, 'tax_query' => array(array('taxonomy' => 'sold', 'field' => 'id', 'terms' => 73)), 'paged' => get_query_var('paged')));
                if($wp_query->have_posts()):
                    ?>

						<?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

							<?php get_template_part('parts/content', 'objects_small_edit', ['object_id' => get_the_ID(), 'current_user_id' => get_post_field('post_author', get_the_ID()), 'is_sold' => true]) ?>

						<?php endwhile; ?>

						<?php
                endif;
                wp_reset_query();
                ?>

				</div> -->

            </div>
        </div>

    </div>
</section>

<script>
    var user_id = <?= get_current_user_id() ?>
</script>

<?php get_footer(); ?>
