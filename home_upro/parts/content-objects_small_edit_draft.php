<?php $object_type = wp_get_object_terms(get_the_ID(), 'object_type')[0] ?>

<div class="item-home item-small">

	<?php if (has_post_thumbnail()): ?>
		<figure>
			<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail('full') ?>
			</a>
		</figure>
	<?php endif ?>

	<div class="text-wrap">
		<div class="cost">

			<?php if (get_field('price')): ?>
				<h6><?= number_format(get_field('price'), 0, '.', ' ') . ' $' ?></h6>
			<?php endif ?>

			<div class="btn">
				<a href="#" class="btn-info"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-6.svg" alt=""></a>
			</div>
		</div>
		<?php if (get_field('street') || get_field('house_number')): ?>
		<div class="address">
			<p><?= get_field('street') . ', ' .  get_field('house_number') ?></p>
		</div>
	<?php endif ?>

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

<?php if (get_field('superficiality') || get_field('over') && $object_type->term_id != 13): ?>
<li>
	<div class="img-wrap">
		<img src="<?= get_stylesheet_directory_uri() ?>/img/icon-7-3.svg" alt="">
	</div>
	<p><?= get_field('over') . ' ' .  __('з', 'Home') . ' ' . get_field('superficiality') ?></p>
</li>
<?php endif ?>

</ul>
</div>
</div>
<div class="btn-active">
	<div class="send-block block-active">
		<div class="flex flex-center item-center">
			<a href="#" class="btn btn-default btn-red btn-del"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-15.svg" alt=""><?php _e('Видалити', 'Home') ?></a>
			<a href="#" class="btn btn-default"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-17-3.svg" alt=""><?php _e('Редагувати', 'Home') ?></a>
		</div>
		<div class="close-wrap">
			<a href="#"><img src="<?= get_stylesheet_directory_uri() ?>/img/close-black.svg" alt=""></a>
		</div>
	</div>
</div>
</div>