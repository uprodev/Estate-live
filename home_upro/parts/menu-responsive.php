<div class="menu-responsive-land" id="menu-responsive-land" style="display: none">
    <div class="top">
        <div class="close-menu-land">
            <a href="#"><img src="<?= get_stylesheet_directory_uri() ?>/img/lading/close.svg" alt=""></a>
        </div>
    </div>
    <div class="wrap">

        <?php if ($field = get_field('logo_header', 'option')): ?>
            <div class="logo-wrap">
                <a href="<?= get_home_url() ?>">
                    <?= wp_get_attachment_image($field['ID'], 'full') ?>
                </a>
            </div>
        <?php endif ?>

        <?php get_template_part('parts/landing', 'head_mob') ?>
        
    </div>
</div>