<?php get_header(); ?>

<?php 
global $query_string;
parse_str( $query_string, $my_query_array );
$paged = ( isset( $my_query_array['paged'] ) && !empty( $my_query_array['paged'] ) ) ? $my_query_array['paged'] : 1;

$queried_object = get_queried_object();
$this_tax = get_taxonomy($queried_object->taxonomy);

$wp_query = new WP_Query(array('post_type' => 'objects', 'posts_per_page' => 8, 'tax_query' => array('relation' => 'AND', array('taxonomy' => 'sold', 'field' => 'id', 'terms' => 73, 'operator' => 'NOT IN'), array('taxonomy' => $this_tax->name, 'field' => 'id', 'terms' => get_queried_object_id())), 'paged' => $paged));
if($wp_query->have_posts()): 
	?>

	<?php if ($_GET['object_added'] || $_GET['object_edited']): ?>
		<h2><?= $_GET['object_added'] ? "Об'єкт " . get_the_title((int)$_GET['object_added']) . " додано" : "Об'єкт " . get_the_title((int)$_GET['object_edited']) . " відредаговано" ?></h2>
	<?php endif ?>


	<div class="content" id="response_objects">

		<?php $current_user_id = get_current_user_id() ?>
		
		<?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

			<?php get_template_part('parts/content', 'objects', ['object_id' => get_the_ID(), 'current_user_id' => $current_user_id]) ?>

		<?php endwhile; ?>

	</div>

<?php endif ?>

<?php get_template_part('parts/pagination') ?>

<?php wp_reset_query() ?>

<?php get_footer(); ?>