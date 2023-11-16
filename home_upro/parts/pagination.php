<div class="pagination-wrap">

	<?php $args = array(
		'show_all'     => false,
		'end_size'     => 1,
		'mid_size'     => 1,
		'prev_next'    => true,
		'prev_text'    => '<img src="' . get_stylesheet_directory_uri() . '/img/icon-19-1.svg" alt="">',
		'next_text'    => '<img src="' . get_stylesheet_directory_uri() . '/img/icon-19-2.svg" alt="">',
		'add_args'     => false,
		'add_fragment' => '',
		'screen_reader_text' => __( 'Posts navigation' ),
		'type' => 'list',
	);
	the_posts_pagination($args); 
	?>

</div>