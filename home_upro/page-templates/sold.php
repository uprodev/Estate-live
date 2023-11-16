<?php
/*
Template Name: Sold
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
$current_page_id = get_queried_object_id();
$posts = get_posts(array('post_type' => 'objects', 'posts_per_page' => -1, 'author' => get_current_user_id(), 'tax_query' => array(array('taxonomy' => 'sold', 'field' => 'id', 'terms' => '73'))));
if ($posts) {
	$sum = 0;
	foreach ($posts as $post) $sum += get_field('price', $post->ID);
}
?>

<?php 
$wp_query = new WP_Query(array('post_type' => 'objects', 'posts_per_page' => 8, 'author' => get_current_user_id(), 'tax_query' => array(array('taxonomy' => 'sold', 'field' => 'id', 'terms' => '73')), 'paged' => get_query_var('paged')));
if($wp_query->have_posts()): 
	?>

	<section class="home-block sales-block">
		<div class="content-width">
			<div class="top-text">
				<h1><?= get_the_title($current_page_id) ?></h1>
				<p><?php _e('на загальну суму', 'Home') ?> <b><?= number_format($sum, 0, '.', ' ') ?>$</b></p>
			</div>
			<div class="content">

				<?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
					<?php get_template_part('parts/content', 'objects_small') ?>
				<?php endwhile; ?>

			</div>
		</div>
	</section>

	<?php 
endif;
get_template_part('parts/pagination');
wp_reset_query(); 
?>

<?php get_footer(); ?>