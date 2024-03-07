<?php
/*
Template Name: Objects by builder
*/
?>

<?php get_header(); ?>

<?php if ($_GET['builder_id']): ?>
	
	<?php 
	global $query_string;
	parse_str( $query_string, $my_query_array );
	$paged = ( isset( $my_query_array['paged'] ) && !empty( $my_query_array['paged'] ) ) ? $my_query_array['paged'] : 1;

	$wp_query = new WP_Query(array(
		'post_type' => 'objects', 
		'posts_per_page' => 8, 	
		'meta_query' => [
			[
				'meta_key'     => 'builder',
				'meta_value_num'   => (int)$_GET['builder_id'],
			]
		], 
		'paged' => $paged)); ?>

		<div class="loading-dz"></div>
		<div class="content" id="response_objects">

			<?php if($wp_query->have_posts()): 
				?>

				<?php $current_user_id = get_current_user_id() ?>

				<?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

					<?php get_template_part('parts/content', 'objects', ['object_id' => get_the_ID(), 'current_user_id' => $current_user_id]) ?>

				<?php endwhile; ?>

			<?php else: ?>
				<?php _e("Об'єктів не знайдено", 'Estate') ?>
			<?php endif ?>

		</div>

		<?php get_template_part('parts/pagination') ?>

		<?php wp_reset_query() ?>

	<?php endif ?>

	<?php get_footer(); ?>