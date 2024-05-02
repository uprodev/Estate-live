<?php 
$region = ($_GET['region_filter']) ?
	array(
		'taxonomy' => 'city',
		'field' => 'id',
		'terms' => $_GET['region_filter'],
	) :
	'';

	$city = ($_GET['city']) ?
	array(
		'taxonomy' => 'city',
		'field' => 'name',
		'terms' => $_GET['city'],
	) :
	'';

	$object_type = $_GET['object_type'] ? array(
		'taxonomy' => 'object_type',
		'field' => 'id',
		'terms' => $_GET['object_type'],
	) : '';

	$street = $_GET['street'] ? array(
		'key' => 'street',
		'value' => $_GET['street'],
		'compare' => 'LIKE'
	) : '';

	$number_of_living_rooms = ($_GET['number_of_living_rooms'] && (int)$_GET['number_of_living_rooms'] > 0) ? array(
		'key' => 'number_of_living_rooms',
		'value' => $_GET['number_of_living_rooms'],
	) : '';

	$total_area = ($_GET['total_area_min'] || $_GET['total_area_max']) ? array(
		'key' => 'total_area',
		'value' => array($_GET['total_area_min'], $_GET['total_area_max'] > 0 ? ($_GET['total_area_max'] > $_GET['total_area_min'] ? $_GET['total_area_max'] : $_GET['total_area_min']) : 1000000000000),
		'type'    => 'numeric',
		'compare' => 'BETWEEN'
	) : '';

	$plot_area = ($_GET['plot_area_min'] || $_GET['plot_area_max']) ? array(
		'key' => 'total_area',
		'value' => array($_GET['plot_area_min'], $_GET['plot_area_max'] > 0 ? ($_GET['plot_area_max'] > $_GET['plot_area_min'] ? $_GET['plot_area_max'] : $_GET['plot_area_min']) : 1000000000000),
		'type'    => 'numeric',
		'compare' => 'BETWEEN'
	) : '';

	$superficiality = ($_GET['superficiality'] && (int)$_GET['superficiality'] > 0) ? array(
		'key' => 'superficiality',
		'value' => $_GET['superficiality'],
	) : '';

	$over = ($_GET['over'] && (int)$_GET['over'] > 0) ? array(
		'key' => 'over',
		'value' => $_GET['over'],
	) : '';

	$type_area = $_GET['type_area'] ? array(
		'taxonomy' => 'area',
		'field' => 'id',
		'terms' => $_GET['type_area'],
	) : '';

	$not_first = ($_GET['not_first']) ? array(
		'key' => 'over',
		'value' => 1,
		'type'    => 'numeric',
		'compare' => '!='
	) : '';

	$not_last = ($_GET['not_last']) ? array(
		'relation' => 'AND',
		'over.value' => [
			'key'     => 'over',
			'value'   => 0,
			'compare' => '!=',
			'type'    => 'NUMERIC',
		],
		[
			'key'     => 'superficiality',
			'compare' => '!=',
			'value'   => 'over.value',
			'type'    => 'NUMERIC',
		],
	) : '';

	$condition = $_GET['condition'] ? array(
		'taxonomy' => 'condition',
		'field' => 'id',
		'terms' => $_GET['condition'],
	) : '';

	$price = ($_GET['price_min'] || $_GET['price_max']) ? array(
		'key' => 'price',
		'value' => array($_GET['price_min'], $_GET['price_max'] > 0 ? ($_GET['price_max'] > $_GET['price_min'] ? $_GET['price_max'] : $_GET['price_min']) : 1000000000000),
		'type'    => 'numeric',
		'compare' => 'BETWEEN'
	) : '';

	$mortgage = ($_GET['mortgage']) ? array(
		'key' => 'mortgage',
		'value' => $_GET['mortgage'],
	) : '';

	$builder = $_GET['meta_builder'] ? array(
		'key' => 'builder',
		'value' => $_GET['meta_builder'],
	) : '';

	$residential_complex = $_GET['meta_complex'] ? array(
		'key' => 'complex',
		'value' => $_GET['meta_complex'],
	) : '';

	$turn = $_GET['tax_turn'] ? array(
		'taxonomy' => 'turn',
		'field' => 'id',
		'terms' => $_GET['tax_turn'],
	) : '';

	$section = $_GET['tax_section'] ? array(
		'taxonomy' => 'section',
		'field' => 'id',
		'terms' => $_GET['tax_section'],
	) : '';

	$features = $_GET['features'] ? array(
		'taxonomy' => 'features',
		'field' => 'id',
		'terms' => $_GET['features'],
	) : '';

	$args['tax_query'] = array(
		'relation' => 'AND',
		array('taxonomy' => 'sold', 'field' => 'id', 'terms' => '73', 'operator' => 'NOT IN'),
		$region,
		$city,
		$object_type,
		$type_area,
		$condition,
		$turn,
		$section,
		$features,
	);

	$args['meta_query'] = array(
		$street,
		$total_area,
		$plot_area,
		$number_of_living_rooms,
		$superficiality,
		$builder,
		$residential_complex,
		$over,
		$not_first,
		$not_last,
		$price,
		$mortgage,
	);

	$args['author'] = $_GET['author'] ?: '';