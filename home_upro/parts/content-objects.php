<?php $object_type = wp_get_object_terms(get_the_ID(), 'object_type')[0] ?>

<div class="item-home">
	<figure>

		<?php $author_id = $post->post_author ?>

		<?php if (is_user_logged_in() && $author_id): ?>
			<div class="author">
				<a href="<?= get_author_posts_url($author_id) ?>"><?= get_the_author_meta('last_name', $author_id) ?></a>
			</div>
		<?php endif ?>

		<?php $favourite =  get_field('favourite', 'user_' . $args['current_user_id'], false) ?>

		<?php if (is_user_logged_in()): ?>
			<div class="like-item<?php if($favourite && in_array($args['object_id'], $favourite)) echo ' is-like' ?>">
				<a href="#" object_id="<?= $args['object_id'] ?>" current_user_id="<?= $args['current_user_id'] ?>">
					<img src="<?= get_stylesheet_directory_uri() ?>/img/no-like.svg" alt="">
					<img src="<?= get_stylesheet_directory_uri() ?>/img/like.svg" alt="" class="img-like">
				</a>
			</div>
		<?php endif ?>

		<a href="<?php the_permalink() ?>">
			<?php if (has_post_thumbnail()): ?>
				<?php the_post_thumbnail('full') ?>
			<?php else: ?>
				<img src="<?= get_stylesheet_directory_uri() ?>/img/icon-10.svg" alt="">
			<?php endif ?>
		</a>

		<ul class="tag">

			<?php $terms = wp_get_object_terms(get_the_ID(), 'object_type') ?>

			<?php if ($terms): ?>
				<?php foreach ($terms as $term): ?>
					<li>
						<a href="<?= get_term_link($term->term_id) ?>"><?= $term->name ?></a>
					</li>
				<?php endforeach ?>
			<?php endif ?>

			<?php
			/*$terms = wp_get_object_terms(get_the_ID(), 'residential_complex');*/
			$complex = get_field('complex');
			?>

			<?php if ($complex): ?>
				<li>
					<a href="#<?php /*echo get_term_link($term->term_id)*/ ?>"><?= $complex->post_title ?></a>
				</li>
			<?php endif ?>

			<?php
			/*$terms = wp_get_object_terms(get_the_ID(), 'builder');*/
			$builder = get_field('builder');
			?>

			<?php if ($builder): ?>
 
				<li class="bg-black">
					<a href="#<?php /*echo get_term_link($term->term_id)*/ ?>"><?= $builder->post_title ?></a>
				</li>

					<li class="bg-black">
						<a href="#<?php /*echo get_term_link($term->term_id)*/ ?>"><?= $builder->post_title ?></a>
					</li>

			<?php endif ?>

		</ul>
	</figure>
	<div class="text-wrap">

		<?php get_template_part('parts/block', 'buttons', ['object_id' => $args['object_id'], 'current_user_id' => $args['current_user_id']]) ?>

		<div class="cost">

			<?php if (get_field('price')): ?>
				<h6><?= number_format(get_field('price'), 0, '.', ' ') . ' $' ?></h6>
			<?php endif ?>

			<?php if (get_field('price') && get_field('total_area')): ?>
			<p><?= round(get_field('price') / get_field('total_area')) . ' $ ' . __('за м²', 'Home') ?></p>
		<?php endif ?>

		<div class="btn-dot">

			<?php $regions = wp_get_object_terms($args['object_id'], 'city') ?>

			<?php foreach ($regions as $region): ?>
				<?php if ($region->parent !==0): ?>
					<p class="object_region"><?= mb_convert_case(mb_strtolower($region->name), MB_CASE_TITLE) ?></p>
				<?php endif ?>
			<?php endforeach ?>

			<a href="" class="btn-send">
				<img src="<?= get_stylesheet_directory_uri() ?>/img/icon-6.svg" alt="">
			</a>
		</div>
	</div>
	<div class="info">
		<ul>

			<?php if (($field = get_field('number_of_living_rooms')) && $object_type->term_id != 13): ?>
				<li>
					<div class="img-wrap">
						<img src="<?= get_stylesheet_directory_uri() ?>/img/icon-7-1.svg" alt="">
					</div>
					<p><?= $field . ' ' . __('кімнат(и)', 'Home') ?></p>
				</li>
			<?php endif ?>

			<?php if ($object_type->term_id == 13): ?>

				<?php if ($field = get_field('unit_plot_area') == 'га' ? get_field('plot_area_hectare') : get_field('plot_area')): ?>
				<li>
					<div class="img-wrap">
						<img src="<?= get_stylesheet_directory_uri() ?>/img/icon-7-2.svg" alt="">
					</div>
					<p><?= $field ?> <?= get_field('unit_plot_area') == 'га' ? 'га' : 'соток' ?></p>
				</li>
			<?php endif ?>

		<?php else: ?>

			<?php if ($object_type->term_id == 8 || $object_type->term_id == 9 || $object_type->term_id == 11): ?>

				<?php if (get_field('residential_area') || get_field('house_area') || get_field('plot_area_hectare') || get_field('plot_area')): ?>
				<li>
					<div class="img-wrap">
						<img src="<?= get_stylesheet_directory_uri() ?>/img/icon-7-2.svg" alt="">
					</div>
					<p><?= get_field('residential_area') ?: '' ?>
					<?= get_field('house_area') ? ' / ' . get_field('house_area') . __(' м²', 'Home') : '' ?>
					<?= get_field('plot_area_hectare') || get_field('plot_area') ? ' / ' .  (get_field('unit_plot_area') == 'га' ? get_field('plot_area_hectare') . ' га' : get_field('plot_area') . ' соток') : '' ?></p>
				</li>
			<?php endif ?>

		<?php else: ?>

			<?php if (get_field('total_area') || get_field('living_area') || get_field('kitchen_area')): ?>
			<li>
				<div class="img-wrap">
					<img src="<?= get_stylesheet_directory_uri() ?>/img/icon-7-2.svg" alt="">
				</div>
				<p><?= get_field('total_area') ?: '' ?><?= get_field('living_area') ? ' / ' . get_field('living_area') : '' ?><?= get_field('kitchen_area') ? ' / ' . get_field('kitchen_area') : '' ?> <?= __(' м²', 'Home') ?></p>
			</li>
		<?php endif ?>

	<?php endif ?>

<?php endif ?>

<?php if (get_field('superficiality') && get_field('over') && $object_type->term_id != 13): ?>
<li>
	<div class="img-wrap">
		<img src="<?= get_stylesheet_directory_uri() ?>/img/icon-7-3.svg" alt="">
	</div>
	<p><?= get_field('over') . ' ' .  __('з', 'Home') . ' ' . get_field('superficiality') ?></p>
</li>
<?php endif ?>

</ul>
</div>

<?php if (get_field('street') && get_field('house_number')): ?>
<div class="address">
	<p><?= get_field('street') . ', ' .  get_field('house_number') ?></p>
</div>
<?php endif ?>

<?php $terms = wp_get_object_terms(get_the_ID(), 'tags_objects') ?>

<?php if ($terms): ?>

	<div class="tag-wrap">
		<ul class="tag-list">

			<?php foreach ($terms as $term): ?>
				<li>
					<a href="<?= get_term_link($term->term_id) ?>"><?= $term->name ?></a>
				</li>
			<?php endforeach ?>

		</ul>
	</div>

<?php endif ?>

<?php if ($content = get_the_content()): ?>
	<div class="text-info"><?= $content ?></div>
<?php endif ?>

</div>
</div>
