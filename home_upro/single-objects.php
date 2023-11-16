<?php get_header(); ?>

<?php
$object_type = wp_get_object_terms(get_the_ID(), 'object_type')[0];
$is_sold = wp_get_object_terms(get_the_ID(), 'sold') ?: '';
?>

    <section class="home-block inner-home-block">
        <div class="content-width">

            <?php get_template_part('parts/prev_page') ?>

            <div class="content">
                <div class="item-home<?php if($is_sold) echo ' item-sale' ?>">

                    <div class="sliders-wrap">
                        <figure class="wrap-item">

                            <?php
                            $author_id = $post->post_author;
                            $current_user_id = get_current_user_id();
                            ?>

                            <?php if ($author_id && is_user_logged_in()): ?>
                                <div class="author">
                                    <a href="<?= get_author_posts_url($author_id) ?>"><?= get_the_author_meta('last_name', $author_id) ?></a>
                                </div>
                            <?php endif ?>

                            <?php if (is_user_logged_in()): ?>
                                <div class="like-item">
                                    <a href="#">
                                        <img src="<?= get_stylesheet_directory_uri() ?>/img/no-like.svg" alt="">
                                        <img src="<?= get_stylesheet_directory_uri() ?>/img/like.svg" alt="" class="img-like">
                                    </a>
                                </div>
                            <?php endif ?>

                            <ul class="tag">

                                <?php $terms = wp_get_object_terms(get_the_ID(), 'object_type') ?>

                                <?php if ($terms): ?>
                                    <?php foreach ($terms as $term): ?>
                                        <li>
                                            <a href="<?= get_term_link($term->term_id) ?>"><?= $term->name ?></a>
                                        </li>
                                    <?php endforeach ?>
                                <?php endif ?>

                                <?php $terms = wp_get_object_terms(get_the_ID(), 'residential_complex') ?>

                                <?php if ($terms): ?>
                                    <?php foreach ($terms as $term): ?>
                                        <li>
                                            <a href="<?= get_term_link($term->term_id) ?>"><?= $term->name ?></a>
                                        </li>
                                    <?php endforeach ?>
                                <?php endif ?>

                                <?php $terms = wp_get_object_terms(get_the_ID(), 'builder') ?>

                                <?php if ($terms): ?>
                                    <?php foreach ($terms as $term): ?>
                                        <li class="bg-black">
                                            <a href="<?= get_term_link($term->term_id) ?>"><?= $term->name ?></a>
                                        </li>
                                    <?php endforeach ?>
                                <?php endif ?>

                            </ul>
                        </figure>

                        <?php $images = get_field('gallery');
                        if($images): ?>

                            <div class="swiper big-slider">
                                <div class="swiper-wrapper">

                                    <?php foreach($images as $image): ?>

                                        <div class="swiper-slide">
                                            <a href="<?= $image['url'] ?>" data-fancybox="gallery">
                                                <?= wp_get_attachment_image($image['ID'], 'full') ?>
                                            </a>
                                        </div>

                                    <?php endforeach; ?>

                                    <?php if ($field = get_field('youtube_url')): ?>

                                        <?php

                                        preg_match('/src="(.+?)"/', $field, $matches_url );
                                        $src = $matches_url[1];

                                        preg_match('/embed(.*?)?feature/', $src, $matches_id );
                                        $id = $matches_id[1];
                                        $id = str_replace( str_split( '?/' ), '', $id );

                                        ?>
                                        <div class="swiper-slide">
                                            <a href="<?= $src ?>" data-fancybox="gallery">
                                                <img class="card-img-top img-fluid" src="http://img.youtube.com/vi/<?= $id ?>/mqdefault.jpg" />
                                            </a>
                                        </div>
                                    <?php endif ?>

                                </div>
                            </div>
                            <div thumbsSlider="" class="swiper mini-slider">
                                <div class="swiper-wrapper">

                                    <?php foreach($images as $image): ?>

                                        <div class="swiper-slide">
                                            <?= wp_get_attachment_image($image['ID'], 'full') ?>
                                        </div>

                                    <?php endforeach; ?>

                                    <?php if ($field = get_field('youtube_url')): ?>

                                        <div class="swiper-slide">
                                            <img src="http://img.youtube.com/vi/<?= $id ?>/mqdefault.jpg">
                                        </div>

                                    <?php endif ?>

                                </div>
                            </div>

                        <?php endif; ?>

                    </div>
                    <div class="text-wrap">

                        <?php get_template_part('parts/block', 'buttons', ['object_id' => get_the_ID(), 'current_user_id' => $current_user_id, 'is_sold' => $is_sold]) ?>

                        <div class="cost">

                            <?php if (get_field('price')): ?>
                                <h6><?= number_format(get_field('price'), 0, '.', ' ') . ' $' ?></h6>
                            <?php endif ?>

                            <?php if (get_field('price') && get_field('total_area')): ?>
                                <p><?= round(get_field('price') / get_field('total_area')) . ' $ ' . __('за м²', 'Home') ?></p>
                            <?php endif ?>

                            <div class="link-map-wrap">

                                <?php $regions = wp_get_object_terms(get_the_ID(), 'city') ?>

                                <?php foreach ($regions as $region): ?>
                                    <?php if ($region->parent !==0): ?>
                                        <p class="object_region"><?= mb_convert_case(mb_strtolower($region->name), MB_CASE_TITLE) ?></p>
                                    <?php endif ?>
                                <?php endforeach ?>

                                <?php if ($field = get_field('map_url')): ?>
                                    <a href="<?= $field ?>" class="link-map" target="_blank">
                                        <img src="<?= get_stylesheet_directory_uri() ?>/img/map.svg" alt="">Google Maps
                                    </a>
                                <?php endif ?>

                            </div>
                            <div class="btn-dot">
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

                        <?php if ($field = get_the_content()): ?>
                            <div class="text-info-full"><?= $field ?></div>
                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
