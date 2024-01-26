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

        <?php if (is_singular('selection') && get_current_user_id() == get_post_field('post_author', $args['selection_id'])): ?>
            <div class="del-item">
                <a href="#" class="del-item-small delete_object_from_selection" selection_id="<?= $args['selection_id'] ?>" object_id="<?= $args['object_id'] ?>"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-11.svg" alt=""></a>
            </div>
        <?php endif ?>

        <div class="cost">

            <?php if (get_field('price')): ?>
                <h6><?= number_format(get_field('price'), 0, '.', ' ') . ' $' ?></h6>
            <?php endif ?>

            <?php if (!is_singular('selection')): ?>
                <div class="btn">
                    <a href="#" class="btn-info"><img src="<?= get_stylesheet_directory_uri() ?>/img/icon-6.svg" alt=""></a>
                </div>
            <?php endif ?>

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
    <?php if (!is_singular('selection')): ?>
        <?php get_template_part('parts/block', 'buttons', ['object_id' => $args['object_id'], 'current_user_id' => $args['current_user_id'], 'is_favourite' => $args['is_favourite'], 'is_draft' => $args['is_draft'], 'is_sold' => $args['is_sold'], 'is_owner' => $args['is_owner']]) ?>
    <?php endif ?>

</div>
