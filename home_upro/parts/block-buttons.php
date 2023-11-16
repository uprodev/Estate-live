<div class="btn-active">
    <div class="send-block block-active" object_id="<?= $args['object_id'] ?>" current_user_id="<?= $args['current_user_id'] ?>">
        <div class="flex item-more">

            <?php if (get_post_field('post_author', $args['object_id']) == $args['current_user_id']): ?>

                <?php if (!$args['is_sold']): ?>
                    <a href="<?= get_permalink(116) . '?object_id=' . $args['object_id'] ?>" class="btn btn-default"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-17-1.svg" alt=""><?php _e('Продано', 'Home') ?></a>
                <?php endif ?>

                <?php if ($args['is_draft']): ?>
                    <a href="#" class="btn btn-default object_to_publish"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-5.svg" alt=""><?php _e('Опублікувати', 'Home') ?></a>
                <?php endif ?>

                <?php if (!$args['is_sold'] && !$args['is_draft']): ?>
                    <a href="#" class="btn btn-default object_to_draft"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-17-2.svg" alt=""><?php _e('Приховати', 'Home') ?></a>
                <?php endif ?>

                <?php if (!$args['is_sold']): ?>
                    <a href="<?= get_permalink(107) . '?object_id=' . $args['object_id'] ?>" class="btn btn-default"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-17-3.svg" alt=""><?php _e('Редагувати', 'Home') ?></a>
                <?php endif ?>

            <?php endif ?>

            <?php if (get_post_field('post_author', $args['object_id']) == $args['current_user_id'] || $args['is_favourite']): ?>
                <a href="#" class="btn btn-default btn-red btn-del <?= $args['is_favourite'] ? 'delete_object_from_favourite' : 'delete_object' ?>"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-15.svg" alt=""><?php _e('Видалити', 'Home') ?></a>
            <?php endif ?>

            <a href="<?php the_permalink() ?>" class="btn btn-default account-share"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-4.svg" alt=""><?php _e('Надіслати', 'Home') ?></a>

            <?php if (is_user_logged_in() && !$args['is_sold'] && !$args['is_draft']): ?>
                <a href="#" class="btn btn-default btn-create"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-5.svg" alt=""><?php _e('В підбір', 'Home') ?></a>
            <?php endif ?>

            <?php if (is_user_logged_in() && $args['is_owner']): ?>
                <a href="#owner-<?= $args['object_id'] ?>" class="btn btn-default btn-white fancybox btn-owner">
                    <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-100-1.svg" alt="">
                    <?php _e('Власник', 'Home') ?>
                </a>
                <div id="owner-<?= $args['object_id'] ?>" class="popup-select popup-scroll popup-owner" style="display:none;">
                    <div class="wrap">
                        <div class="popup-main">
                            <a href="#" class="close-popup-desc" data-fancybox-close ><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-100-2.svg" alt=""></a>
                            <p class="h6"><?php _e('Про власника', 'Home') ?></p>

                            <?php if ($field = get_field('owner_name', $args['object_id'])): ?>
                                <p class="name"><?= $field ?></p>
                            <?php endif ?>

                            <ul class="tel-list">

                                <?php if ($field = get_field('owner_phone', $args['object_id'])): ?>
                                    <li><a href="tel:+<?= preg_replace('/[^0-9]/', '', $field) ?>"><?= $field ?></a></li>
                                <?php endif ?>

                                <?php if ($field = get_field('owner_phone_add', $args['object_id'])): ?>
                                    <li><a href="tel:+<?= preg_replace('/[^0-9]/', '', $field) ?>"><?= $field ?></a></li>
                                <?php endif ?>

                            </ul>

                            <?php if ($field = get_field('our_price', $args['object_id'])): ?>
                                <div class="item-right">
                                    <p class="label"><?php _e('Ціна від власника', 'Home') ?></p>
                                    <span class="name"><?= number_format($field, 0, '.', ' ') . ' $' ?></span>
                                </div>
                            <?php endif ?>

                            <?php if ($field = get_field('price', $args['object_id'])): ?>
                                <div class="item-right">
                                    <p class="label"><?php _e('Ціна на продаж', 'Home') ?></p>
                                    <span class="name"><?= number_format($field, 0, '.', ' ') . ' $' ?></span>
                                </div>
                            <?php endif ?>

                            <?php if ($field = get_field('internal_description', $args['object_id'])): ?>
                                <div class="text">
                                    <p><?= $field ?></p>
                                </div>
                            <?php endif ?>

                        </div>
                        <div class="btn-wrap">
                            <button class="close-popup" data-fancybox-close type="submit"><img src="<?= get_stylesheet_directory_uri() ?>/img/close-popup.svg" alt=""></button>
                        </div>
                    </div>
                </div>
            <?php endif ?>

        </div>
        <div class="close-wrap">
            <a href="#"><img src="<?= get_stylesheet_directory_uri() ?>/img/close-black.svg" alt=""></a>
        </div>
    </div>

    <?php $selections = get_posts(array('post_type' => 'selection', 'posts_per_page' => -1, 'author' => $args['current_user_id'])) ?>

    <div class="like-block block-active">
        <div class="flex flex-center item-center">
            <a href="<?= get_permalink(125) . '?object_id=' . $args['object_id'] ?>" class="btn btn-default"><?php _e('Створити новий', 'Home') ?></a>
            <a href="<?= get_permalink(144) . '?object_id=' . $args['object_id'] ?>" class="btn btn-default<?php if(!$selections) echo ' disabled' ?>"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-5.svg" alt=""><?php _e('В існуючий', 'Home') ?></a>
        </div>
        <div class="close-wrap">
            <a href="#"><img src="<?= get_stylesheet_directory_uri() ?>/img/close-black.svg" alt=""></a>
        </div>
    </div>
</div>
