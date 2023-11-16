<?php
/*
Template Name: Log in
*/
?>

<?php get_header(); ?>

<section class="login-block">
	<div class="content-width">
		<div class="content">

			<?php if (has_post_thumbnail()): ?>
				<div class="logo-wrap">
					<a href="<?= get_home_url() ?>">
						<?php the_post_thumbnail() ?>
					</a>
				</div>
			<?php endif ?>
			
			<form action="#" class="form-filter loginform">
				<div class="input-wrap ">
					<label for="login"><?php _e('Логін', 'Home') ?></label>
					<input type="text" name="login" id="login" value="">
				</div>
				<div class="input-wrap ">
					<label for="password"><?php _e('Пароль', 'Home') ?></label>
					<input type="password" name="password" id="password" value="">
				</div>
				<div class="btn-submit">
					<button type="submit" class="btn btn-default"><?php _e('Увійти', 'Home') ?></button>
				</div>
				<input type="hidden" name="action" value="ajax_login">
				<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
				<div class="result-login"></div>
			</form>
		</div>
	</div>
</section>

<?php get_footer(); ?>