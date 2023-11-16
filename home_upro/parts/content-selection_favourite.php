<div class="item-user item-share" selection_id="<?= $args['selection_id'] ?>">
    <div class="text">

        <?php if ($field = get_field('buyer_name')): ?>
            <h6><a href="<?= get_permalink(123) . '?object_id=' . $_GET['object_id'] . '&selection_id=' . $args['selection_id'] ?>"><?= $field ?></a></h6>
        <?php endif ?>

        <?php if ($field = get_field('buyer_phone')): ?>
            <p><a href="tel:+<?= preg_replace('/[^0-9]/', '', $field) ?>"><?= $field ?></a></p>
        <?php endif ?>

        <div class="btn-wrap">
            <a href="#" class="btn-user"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-6.svg" alt=""></a>
        </div>
    </div>
    <div class="btn-active">
        <div class="send-block block-active">
            <div class="flex flex-center item-center">
                <a href="#" class="btn btn-default btn-red btn-del delete_selection"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-15.svg" alt=""><?php _e('Видалити', 'Home') ?></a>
                <a href="<?php the_permalink() ?>" class="btn btn-default btn-share"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4.svg" alt=""><?php _e('Надіслати', 'Home') ?></a>
            </div>
            <div class="close-wrap">
                <a href="#"><img src="<?= get_stylesheet_directory_uri() ?>/img/close-black.svg" alt=""></a>
            </div>
        </div>
    </div>
</div>
