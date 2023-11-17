<?php
/*
Template Name: Create Selection For Client
*/
?>

<?php 
if (!is_user_logged_in()) {
	wp_redirect(get_permalink(90));
	exit;
}
?>

<?php get_header(); ?>

<?php if ($_GET['client_name']): ?>

	<section class="home-block add-form">
		<div class="content-width">
			
			<?php get_template_part('parts/prev_page') ?>
			
			<div class="content-add">
				<h1><?php _e('Новий підбір', 'Home') ?></h1>
				<div class="full-filter full-filter-page">
					<div class="full-filter-wrap">
						<form action="#" class="form-filter" id="create_selection_for_client">
							<div class="input-wrap">
								<label for="selection_title"><?php _e('Назва підбору', 'Home') ?><span>*</span></label>
								<input type="text" name="selection_title" id="selection_title" required>
							</div>
							<div class="input-submit flex">
								<button type="submit" class="btn-default btn"><?php _e('Зберегти', 'Home') ?></button>
								<button type="reset" class="btn-default btn-border btn"><?php _e('Скасувати', 'Home') ?></button>
							</div>
							<input type="hidden" name="client_name" value="<?= $_GET['object_id'] ?>">
							<input type="hidden" name="action" value="create_selection_for_client">
						</form>

						<script>
							jQuery(document).ready(function($) { 
								$("#create_selection_for_client").validate();
							})
						</script>

					</div>
				</div>
			</div>
		</div>
	</section>

<?php endif ?>

<?php get_footer(); ?>