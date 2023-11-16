<?php get_header(); ?>

<h2><?php _e('Ви шукали', 'Home') ?>: <?= get_search_query() ?></h2>
<div class="content" id="response_objects">

	<?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>

		<?php $current_user_id = get_current_user_id() ?>

		<?php get_template_part('parts/content', 'objects', ['object_id' => get_the_ID(), 'current_user_id' => $current_user_id]) ?>

	<?php endwhile; ?>

</div>

<?php get_template_part('parts/pagination') ?>

<?php get_footer(); ?>