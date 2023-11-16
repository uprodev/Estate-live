<?php 
if($_POST['unit_plot_area']) update_field('unit_plot_area', 'га', $args['post_id']);
if($_POST['plot_area']) update_field($_POST['unit_plot_area'] ? 'plot_area_hectare' : 'plot_area', $_POST['plot_area'], $args['post_id']);
if($_POST['mortgage']) update_field('mortgage', true, $args['post_id']);

foreach ($_POST as $key => $value) {
	if(str_contains($key, 'meta_')) update_field(mb_substr($key, 5), $_POST[$key], $args['post_id']);
	if(str_contains($key, 'tax_')) wp_set_object_terms($args['post_id'], (int)($_POST[$key]), mb_substr($key, 4));
	if(str_contains($key, 'multi_')){
		if($_POST[$key]){
			$terms = [];
			$terms = array_map('intval', $_POST[$key]);
			wp_set_object_terms($args['post_id'], $terms, mb_substr($key, 6));
		}
	}
}

if($_POST['district']) wp_set_object_terms($args['post_id'], (int)($_POST['district']), 'city', true);

if($_POST['region']) $regions = wp_set_object_terms($args['post_id'], $_POST['region'], 'city');

if($_POST['region'] && $_POST['city']){
	if (!term_exists(mb_strtoupper($_POST['city']))) {
		wp_insert_term(mb_strtoupper($_POST['city']), 'city', array(
			'parent'      => $regions[0],
		));
	}
	wp_set_object_terms($args['post_id'], mb_strtoupper($_POST['city']), 'city', true);
}

if($_POST['images']){
	update_field('gallery', explode(',', $_POST['images']), $args['post_id']);
	update_post_meta($args['post_id'], '_thumbnail_id', explode(',', $_POST['images'])[0]);
}

if($_POST['short_description']) wp_update_post(['ID' => $args['post_id'], 'post_content' => $_POST['short_description']]);
if($_POST['draft']) wp_update_post(['ID' => $args['post_id'], 'post_status' => 'draft']);