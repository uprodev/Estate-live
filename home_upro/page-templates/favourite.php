<?php
/*
Template Name: Favourite
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

<section class="home-block sales-block chosen-block">
	<div class="content-width">

		<div class="tabs">
			<ul class="tabs-menu">
				<li><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-14-1.svg" alt=""><?php _e('Обране', 'Home') ?></li>
				<li><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-14-2.svg" alt=""><?php _e('Підбір', 'Home') ?></li>
			</ul>
			<div class="tab-content">
				<div class="content">

					<?php
					$featured_posts = get_field('favourite', 'user_' . $current_user_id);
					if($featured_posts): ?>

						<?php foreach($featured_posts as $post): 

							global $post;
							setup_postdata($post); ?>
							<?php get_template_part('parts/content', 'objects_small_edit', ['object_id' => get_the_ID(), 'current_user_id' => $current_user_id, 'is_favourite' => true]) ?>
						<?php endforeach; ?>

						<?php wp_reset_postdata(); ?>

					<?php endif; ?>

				</div>

				<div class="user-content">

					<?php 
					$wp_query = new WP_Query(array('post_type' => 'selection', 'posts_per_page' => -1, 'author' => $current_user_id, 'paged' => get_query_var('paged')));
					if($wp_query->have_posts()): 
						$buyers_names = [];
						?>

						<?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

							<?php 
							if (!in_array(get_field('buyer_name'), $buyers_names)) {
								$buyers_names[] = get_field('buyer_name');
								get_template_part('parts/content', 'selection_favourite', ['selection_id' => get_the_ID()]); 
							}
							?>

						<?php endwhile; ?>

						<?php 
					endif;
					wp_reset_query(); 
					?>

				</div>

			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>