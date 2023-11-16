<?php
/*
Template Name: Edit Object
*/
?>

<?php
if (!is_user_logged_in()) {
    wp_redirect(get_permalink(90));
    exit;
}
?>

<?php get_header(); ?>

<?php if ($_GET['object_id']): ?>

    <?php
    $object_id = $_GET['object_id'];
    wp_update_post(['ID' => (int)$object_id]);
    ?>

    <section class="home-block add-form">
        <div class="content-width">

            <?php get_template_part('parts/prev_page') ?>

            <div class="content-add">
                <h1><?php the_title() ?></h1>

                <?php
                $current_object_type = wp_get_object_terms($object_id, 'object_type')[0];

                switch ($current_object_type->term_id) {
                    case 7:
                        $add_class = '2';
                        break;
                    case 8:
                        $add_class = '3';
                        break;
                    case 9:
                    case 11:
                        $add_class = '4';
                        break;
                    case 13:
                        $add_class = '5';
                        break;

                    default:
                        $add_class = '1';
                        break;
                }
                ?>

                <div class="full-filter full-filter-page page-add-form add-select-<?= $add_class ?>">
                    <div class="full-filter-wrap">
                        <form action="#" class="form-filter" id="edit_object">

                            <?php
                            $terms = get_terms( [
                                'taxonomy' => 'object_type',
                                'hide_empty' => false,
                            ] )
                            ?>

                            <?php if ($terms): ?>
                                <div class="input-wrap input-wrap-popup input-wrap-img input-wrap-all select-input-block-add">
                                    <p class="label-info"><?php _e('Оберіть тип об’єкта', 'Home') ?><span>*</span></p>
                                    <div class="nice-select">
                                        <span class="current"><?= $current_object_type->name ?></span>
                                        <div class="list">
                                            <ul class="new">

                                                <?php foreach ($terms as $index => $term): ?>
                                                    <li class="option<?php if($term->term_id == $current_object_type->term_id) echo ' selected focus' ?>">
                                                        <label for="object_type-<?= $index + 1 ?>"></label>
                                                        <input type="radio" id="object_type-<?= $index + 1 ?>" name="tax_object_type" value="<?= $term->term_id ?>" data-value="<?= $term->term_id - 5 ?>"<?php if($term->term_id == $current_object_type->term_id) echo ' checked' ?>>

                                                        <?php if ($field = get_field('icon', 'term_' . $term->term_id)): ?>
                                                            <?= wp_get_attachment_image($field['ID'], 'full') ?>
                                                        <?php endif ?>

                                                        <?= $term->name ?>
                                                    </li>
                                                <?php endforeach ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="input-wrap input-wrap-text input-wrap-all">
                                <label for="internal_description"><?php _e('Внутрішній опис', 'Home') ?><span>*</span></label>
                                <textarea name="meta_internal_description" id="internal_description" required><?php the_field('internal_description', $object_id) ?></textarea>
                                <p><?php _e('Для внутрішнього використання', 'Home') ?></p>
                            </div>

                            <div class="input-wrap input-wrap-text input-wrap-all">
                                <label for="short_description"><?php _e('Короткий опис для сайту', 'Home') ?><span>*</span></label>
                                <?php wp_editor( get_the_content(null, null, $object_id), 'short_description', array('textarea_name' => 'short_description') ); ?>
                                <!-- <textarea name="short_description" id="short_description" required><?= strip_tags(get_the_content(null, null, $object_id)) ?></textarea> -->
                                <p><?php _e('Мінімум 250 символів', 'Home') ?></p>
                            </div>
                            <div class="input-wrap input-wrap-all">
                                <label for="our_price"><?php _e('Ціна від власника', 'Home') ?><span>*</span></label>
                                <input type="text" name="meta_our_price" id="our_price" value="<?php the_field('our_price', $object_id) ?>" required>
                            </div>
                            <div class="input-wrap input-wrap-all">
                                <label for="price"><?php _e('Ціна на продаж', 'Home') ?><span>*</span></label>
                                <input type="text" name="meta_price" id="price" value="<?php the_field('price', $object_id) ?>" required>
                            </div>

                            <?php
                            $terms = get_terms( [
                                'taxonomy' => 'features',
                                'hide_empty' => false,
                            ] );
                            $current_terms = wp_get_object_terms($object_id, 'features');
                            $current_terms_ids = [];
                            foreach ($current_terms as $term) $current_terms_ids[] = $term->term_id;
                            ?>

                            <?php if ($terms): ?>
                                <div class="input-wrap-check input-wrap-check-more input-wrap-all">
                                    <h6><?php _e('Особливості', 'Home') ?></h6>
                                    <div class="wrap flex">

                                        <?php foreach ($terms as $index => $term): ?>
                                            <div class="item">
                                                <input type="checkbox" name="multi_features[]" id="features-<?= $index + 1 ?>" value="<?= $term->term_id ?>"<?php if(in_array($term->term_id, $current_terms_ids)) echo ' checked' ?>>
                                                <label for="features-<?= $index + 1 ?>"><?= $term->name ?></label>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                </div>
                            <?php endif ?>

                            <?php
                            $terms = get_terms( [
                                'taxonomy' => 'tags_objects',
                                'hide_empty' => false,
                            ] );
                            $current_terms = wp_get_object_terms($object_id, 'tags_objects');
                            $current_terms_ids = [];
                            foreach ($current_terms as $term) $current_terms_ids[] = $term->term_id;
                            ?>

                            <?php if ($terms): ?>
                                <div class="input-wrap-check input-wrap-check-more input-wrap-all">
                                    <h6><?php _e('Теги', 'Home') ?></h6>
                                    <div class="wrap flex">

                                        <?php foreach ($terms as $index => $term): ?>
                                            <div class="item">
                                                <input type="checkbox" name="multi_tags_objects[]" id="tags_objects-<?= $index + 1 ?>" value="<?= $term->term_id ?>"<?php if(in_array($term->term_id, $current_terms_ids)) echo ' checked' ?>>
                                                <label for="tags_objects-<?= $index + 1 ?>"><?= $term->name ?></label>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                </div>
                            <?php endif ?>

                            <?php
                            $terms = get_terms( [
                                'taxonomy' => 'area',
                                'hide_empty' => false,
                            ] );
                            $current_terms = wp_get_object_terms($object_id, 'area');
                            $current_terms_ids = [];
                            foreach ($current_terms as $term) $current_terms_ids[] = $term->term_id;
                            ?>

                            <?php if ($terms): ?>
                                <div class="input-wrap-check input-wrap-check-more input-wrap-var-1 input-wrap-var-2">
                                    <div class="wrap flex">

                                        <?php foreach ($terms as $index => $term): ?>
                                            <div class="item">
                                                <input type="checkbox" name="multi_area[]" id="area-<?= $index + 1 ?>" value="<?= $term->term_id ?>"<?php if(in_array($term->term_id, $current_terms_ids)) echo ' checked' ?>>
                                                <label for="area-<?= $index + 1 ?>"><?= $term->name ?></label>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                </div>
                            <?php endif ?>

                            <?php
                            global $wpdb;
                            $regions = $wpdb->get_results("SELECT id, name FROM level1");

                            foreach (wp_get_object_terms($object_id, 'city') as $term) {
                                if($term->parent == 0) $current_region = $term;
                                else $current_city = $term;
                            }

                            ?>

                            <?php if ($regions): ?>
                                <div class="input-wrap input-wrap-popup input-wrap-all">
                                    <p class="label-info"><?php _e('Регіон', 'Home') ?><span>*</span></p>
                                    <div class="nice-select">
                                        <span class="current"><?= $current_region->name ?></span>
                                        <div class="list">
                                            <ul class="new">

                                                <?php foreach ($regions as $index => $region): ?>

                                                    <?php if ($region->id != '01'&& $region->id != '85'): ?>
                                                        <li class="option<?php if(mb_strtoupper($region->name) == $current_region->name) echo ' selected focus' ?>">
                                                            <label for="region-<?= $region->id ?>"></label>
                                                            <input type="radio" id="region-<?= $region->id ?>" name="region" value="<?= mb_strtoupper($region->name) ?>" region_id="<?= $region->id ?>"<?php if(mb_strtoupper($region->name) == $current_region->name) echo ' checked' ?>>
                                                            <?= mb_strtoupper($region->name) ?>
                                                        </li>
                                                    <?php endif ?>

                                                <?php endforeach ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="input-wrap input-wrap-popup input-wrap-all">
                                <label for="city"><?php _e('Місто/село', 'Home') ?><span>*</span></label>
                                <input type="text" name="city" id="city" value="<?= $current_city->name ?: '' ?>" required>
                            </div>


                            <?php
                            $cities = get_terms( [
                                'taxonomy' => 'city',
                                'parent'  => $current_term->term_id,
                                'hide_empty' => false,
                            ] );
                            $current_term = wp_get_object_terms($object_id, 'city')[1];
                            ?>

                            <?php if ($regions && $cities): ?>
                                <!-- <div class="input-wrap input-wrap-popup input-wrap-all">
									<p class="label-info"><?php _e('Район', 'Home') ?><span>*</span></p>
									<div class="nice-select">
										<span class="current" id="current_district"><?= $current_term ? $current_term->name : __('Район', 'Home') ?></span>
										<div class="list">
											<ul class="new not_all" id="districts">

												<?php foreach ($districts as $index => $term): ?>
													<li class="option<?php if($current_term && $term->term_id == $current_term->term_id) echo ' selected focus' ?>">
														<label for="select-3-<?= $index + 1 ?>"></label>
														<input type="radio" id="select-3-<?= $index + 1 ?>" name="district" value="<?= $term->term_id ?>"<?php if($current_term && $term->term_id == $current_term->term_id) echo ' checked' ?>>
														<?= $term->name ?>
													</li>
												<?php endforeach ?>

											</ul>
										</div>
									</div>
								</div> -->
                            <?php endif ?>

                            <div class="input-wrap input-wrap-search input-wrap-popup input-wrap-all">
                                <label for="street"><?php _e('Вулиця', 'Home') ?><span>*</span></label>
                                <input type="text" name="meta_street" id="street" class="street" value="<?php the_field('street', $object_id) ?>" required>
                                <p><img src="<?= get_stylesheet_directory_uri() ?>/img/search.svg" alt=""></p>

                            </div>
                            <div class="input-wrap input-wrap-all">
                                <label for="house_number"><?php _e('Номер будинку', 'Home') ?></label>
                                <input type="text" name="meta_house_number" id="house_number" value="<?php the_field('house_number', $object_id) ?>">
                            </div>


                            <!--тут буде розділ на 5 веток-->

                            <div class="input-wrap input-wrap-var-1 input-wrap-var-2 ">
                                <label for="apartment_number"><?php _e('Номер квартири', 'Home') ?></label>
                                <input type="text" name="meta_apartment_number" id="apartment_number" value="<?php the_field('apartment_number', $object_id) ?>">
                            </div>

                            <?php $entrances = get_field_object('field_64e37150994d6')['choices'] ?>

                            <?php if ($entrances): ?>
                                <div class="input-wrap input-wrap-popup input-wrap-var-1 input-wrap-var-2">
                                    <p class="label-info"><?php _e('Під’їзд', 'Home') ?></p>
                                    <div class="nice-select">
                                        <span class="current"><?php the_field('entrance', $object_id) ?></span>
                                        <div class="list">
                                            <ul class="new">

                                                <?php foreach ($entrances as $index => $entrance): ?>
                                                    <li class="option<?php if(get_field('entrance', $object_id) == $entrance) echo ' selected focus' ?>">
                                                        <label for="entrance-<?= $index ?>"></label>
                                                        <input type="radio" id="entrance-<?= $index ?>" name="meta_entrance" value="<?= $index ?>"<?php if(get_field('entrance', $object_id) == $entrance) echo ' checked' ?>>
                                                        <?= $entrance ?>
                                                    </li>
                                                <?php endforeach ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php
                            /*$terms = get_terms( [
                                'taxonomy' => 'builder',
                                'hide_empty' => false,
                            ] );
                            $current_term = wp_get_object_terms($object_id, 'builder')[0];*/
                            $builders = get_posts(array(
                                'post_type' => 'builder',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'city',
                                        'field'    => 'id',
                                        'terms'    => $current_region->term_id
                                    )
                                )
                            ));
                            $current_builder = get_field('builder', $object_id);
                            ?>

                            <?php if ($terms): ?>
                                <div class="input-wrap input-wrap-popup input-wrap-var-1 input-wrap-var-4 ">
                                    <p class="label-info"><?php _e('Забудовник', 'Home') ?></p>
                                    <div class="nice-select">
                                        <span class="current"><?= $current_builder->post_title ?></span>
                                        <div class="list">
                                            <ul class="new" id="get_builders">

                                                <?php foreach ($terms as $index => $term): ?>
                                                    <!-- <li class="option<?php if($term->term_id == $current_term->term_id) echo ' selected focus' ?>">
														<label for="builder-<?= $index + 1 ?>"></label>
														<input type="radio" id="builder-<?= $index + 1 ?>" name="tax_builder" value="<?= $term->term_id ?>"<?php if($term->term_id == $current_term->term_id) echo ' checked' ?>>
														<?= $term->name ?>
													</li> -->
                                                <?php endforeach ?>

                                                <?php if ($builders): ?>

                                                    <?php foreach ($builders as $index => $builder): ?>
                                                        <li class="option<?php if($builder->ID == $current_builder->ID) echo ' selected focus' ?>">
                                                            <label for="builder-<?= $index + 1 ?>"></label>
                                                            <input type="radio" id="builder-<?= $index + 1 ?>" name="meta_builder" value="<?= $builder->ID ?>"<?php if($builder->ID == $current_builder->ID) echo ' checked' ?>>
                                                            <?= $builder->post_title ?>
                                                        </li>
                                                    <?php endforeach ?>

                                                <?php endif ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php
                            /*$terms = get_terms( [
                                'taxonomy' => 'residential_complex',
                                'hide_empty' => false,
                            ] );
                            $current_term = wp_get_object_terms($object_id, 'residential_complex')[0];*/
                            $complexes = get_posts(array(
                                'post_type' => 'builder',
                                'posts_per_page' => -1,
                                'post_parent' => $current_builder->ID
                            ));
                            $current_complex = get_field('complex', $object_id);
                            ?>

                            <?php if ($terms): ?>
                                <div class="input-wrap input-wrap-popup input-wrap-var-1 input-wrap-var-4">
                                    <p class="label-info"><?php _e('Житловий комплекс', 'Home') ?></p>
                                    <div class="nice-select">
                                        <span class="current"><?= $current_complex->post_title ?></span>
                                        <div class="list">
                                            <ul class="new" id="get_complexes">

                                                <?php foreach ($terms as $index => $term): ?>
                                                    <!-- <li class="option<?php if($term->term_id == $current_term->term_id) echo ' selected focus' ?>">
														<label for="residential_complex-<?= $index + 1 ?>"></label>
														<input type="radio" id="residential_complex-<?= $index + 1 ?>" name="tax_residential_complex" value="<?= $term->term_id ?>"<?php if($term->term_id == $current_term->term_id) echo ' checked' ?>>
														<?= $term->name ?>
													</li> -->
                                                <?php endforeach ?>

                                                <?php if ($complexes): ?>

                                                    <?php foreach ($complexes as $index => $complex): ?>
                                                        <li class="option<?php if($complex->ID == $current_complex->ID) echo ' selected focus' ?>">
                                                            <label for="complex-<?= $index + 1 ?>"></label>
                                                            <input type="radio" id="complex-<?= $index + 1 ?>" name="meta_complex" value="<?= $complex->ID ?>"<?php if($complex->ID == $current_complex->ID) echo ' checked' ?>>
                                                            <?= $complex->post_title ?>
                                                        </li>
                                                    <?php endforeach ?>

                                                <?php endif ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php
                            /*$terms = get_terms( [
                                'taxonomy' => 'turn',
                                'hide_empty' => false,
                            ] );*/
                            $turns = get_field('turns', (int)$current_complex->ID);
                            $terms = get_terms( [
                                'taxonomy' => 'turn',
                                'hide_empty' => false,
                            ] );

                            $current_term = wp_get_object_terms($object_id, 'turn')[0];
                            ?>

                            <?php if ($terms): ?>
                                <div class="input-wrap input-wrap-popup input-wrap-var-1 input-wrap-var-4">
                                    <p class="label-info"><?php _e('Черга', 'Home') ?></p>
                                    <div class="nice-select">
                                        <span class="current"><?= $current_term->name ?></span>
                                        <div class="list">
                                            <ul class="new">

                                                <?php foreach ($terms as $index => $term): ?>
                                                    <!-- <li class="option<?php if($term->term_id == $current_term->term_id) echo ' selected focus' ?>">
														<label for="turn-<?= $index + 1 ?>"></label>
														<input type="radio" id="turn-<?= $index + 1 ?>" name="tax_turn" value="<?= $term->term_id ?>"<?php if($term->term_id == $current_term->term_id) echo ' checked' ?>>
														<?= $term->name ?>
													</li> -->
                                                <?php endforeach ?>

                                                <?php if ($turns): ?>

                                                    <?php foreach ($terms as $index => $term): ?>
                                                        <?php if (in_array($term->name, range(1, $turns))): ?>
                                                            <li class="option<?php if($term->term_id == $current_term->term_id) echo ' selected focus' ?>">
                                                                <label for="turn-<?= $index + 1 ?>"></label>
                                                                <input type="radio" id="turn-<?= $index + 1 ?>" name="tax_turn" value="<?= $term->term_id ?>"<?php if($term->term_id == $current_term->term_id) echo ' checked' ?>>
                                                                <?= $term->name ?>
                                                            </li>
                                                        <?php endif ?>
                                                    <?php endforeach ?>

                                                <?php endif ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <?php
                            /*$terms = get_terms( [
                                'taxonomy' => 'section',
                                'hide_empty' => false,
                            ] );*/
                            $sections = get_field('sections', (int)$current_complex->ID);
                            $terms = get_terms( [
                                'taxonomy' => 'section',
                                'hide_empty' => false,
                            ] );

                            $current_term = wp_get_object_terms($object_id, 'section')[0];
                            ?>

                            <div class="input-wrap input-wrap-popup input-wrap-var-1 input-wrap-var-4">
                                <p class="label-info"><?php _e('Секція', 'Home') ?></p>
                                <div class="nice-select">
                                    <span class="current"><?= $current_term->name ?></span>
                                    <div class="list">
                                        <ul class="new">

                                            <?php foreach ($terms as $index => $term): ?>
                                                <!-- <li class="option<?php if($term->term_id == $current_term->term_id) echo ' selected focus' ?>">
													<label for="section<?= $index + 1 ?>"></label>
													<input type="radio" id="section<?= $index + 1 ?>" name="tax_section" value="<?= $term->term_id ?>"<?php if($term->term_id == $current_term->term_id) echo ' checked' ?>>
													<?= $term->name ?>
												</li> -->
                                            <?php endforeach ?>

                                            <?php if ($sections): ?>

                                                <?php foreach ($terms as $index => $term): ?>
                                                    <?php if (in_array($term->name, range(1, $sections))): ?>
                                                        <li class="option<?php if($term->term_id == $current_term->term_id) echo ' selected focus' ?>">
                                                            <label for="section-<?= $index + 1 ?>"></label>
                                                            <input type="radio" id="section-<?= $index + 1 ?>" name="tax_section" value="<?= $term->term_id ?>"<?php if($term->term_id == $current_term->term_id) echo ' checked' ?>>
                                                            <?= $term->name ?>
                                                        </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>

                                            <?php endif ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--3-->

                            <div class="input-wrap input-wrap-number input-wrap-var-1 input-wrap-var-2 input-wrap-var-3 input-wrap-var-4">
                                <label for="number_of_living_rooms"><?php _e('Кількість житлових кімнат', 'Home') ?></label>
                                <div class="flex">
                                    <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/minus.svg" alt=""></div>
                                    <input type="number" name="meta_number_of_living_rooms" id="number_of_living_rooms" value="<?php the_field('number_of_living_rooms', $object_id) ?>" class="form-control"/>
                                    <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/plus.svg" alt=""></div>
                                </div>
                            </div>
                            <div class="input-wrap input-wrap-number input-wrap-var-3 input-wrap-var-4">
                                <label for="number_of_floors"><?php _e('Кількість поверхів', 'Home') ?></label>
                                <div class="flex">
                                    <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/minus.svg" alt=""></div>
                                    <input type="number" name="meta_number_of_floors" id="number_of_floors" value="<?php the_field('number_of_floors', $object_id) ?>" class="form-control"/>
                                    <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/plus.svg" alt=""></div>
                                </div>
                            </div>

                            <div class="input-wrap  input-wrap-var-3 input-wrap-var-4">
                                <label for="residential_area"><?php _e('Площа житлова', 'Home') ?> , <?php _e('м²', 'Home') ?></label>
                                <input type="number" name="meta_residential_area" id="residential_area" value="<?php the_field('residential_area', $object_id) ?>">
                            </div>

                            <div class="input-wrap i input-wrap-var-3 input-wrap-var-4">
                                <label for="house_area"><?php _e('Площа будинку', 'Home') ?> , <?php _e('м²', 'Home') ?></label>
                                <input type="number" name="meta_house_area" id="house_area" value="<?php the_field('house_area', $object_id) ?>">
                            </div>

                            <!--5-->
                            <div class="input-wrap i input-wrap-var-5">
                                <label for="cadastral_number"><?php _e('Кадастровий номер', 'Home') ?></label>
                                <input type="text" name="meta_cadastral_number" id="cadastral_number" value="<?php the_field('cadastral_number', $object_id) ?>">
                            </div>

                            <div class="input-wrap  input-wrap-var-3 mini-radio-input input-wrap-var-4 input-wrap-var-5">
                                <div class="mini-radio">
                                    <input type="checkbox" name="unit_plot_area" id="unit_plot_area"<?php if(get_field('unit_plot_area', $object_id) == 'га') echo 'checked' ?>>
                                    <label for="unit_plot_area"><?php _e('га', 'Home') ?></label>
                                </div>
                                <label for="plot_area"><?php _e('Площа ділянки', 'Home') ?>, <?php _e('сотки', 'Home') ?></label>
                                <input type="number" name="plot_area" id="plot_area" value="<?= get_field('unit_plot_area', $object_id) == 'га' ? get_field('plot_area_hectare', $object_id) : get_field('plot_area', $object_id) ?>">
                            </div>

                            <!--3 кінец-->

                            <div class="input-wrap input-wrap-number input-wrap-var-1 input-wrap-var-2">
                                <label for="superficiality"><?php _e('Поверховість', 'Home') ?></label>
                                <div class="flex">
                                    <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/minus.svg" alt=""></div>
                                    <input type="number" name="meta_superficiality" id="superficiality" value="<?php the_field('superficiality', $object_id) ?>" class="form-control"/>
                                    <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/plus.svg" alt=""></div>
                                </div>
                            </div>
                            <div class="input-wrap input-wrap-number input-wrap-var-1 input-wrap-var-2">
                                <label for="over"><?php _e('Поверх', 'Home') ?></label>
                                <div class="flex">
                                    <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/minus.svg" alt=""></div>
                                    <input type="number" name="meta_over" id="over" value="<?php the_field('over', $object_id) ?>" class="form-control"/>
                                    <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/plus.svg" alt=""></div>
                                </div>
                            </div>

                            <?php
                            $terms = get_terms( [
                                'taxonomy' => 'condition',
                                'hide_empty' => false,
                            ] );
                            $current_term = wp_get_object_terms($object_id, 'condition')[0];
                            ?>

                            <?php if ($terms): ?>
                                <div class="input-wrap input-wrap-popup input-wrap-var-1 input-wrap-var-2 input-wrap-var-3 input-wrap-var-4">
                                    <p class="label-info"><?php _e('Стан', 'Home') ?></p>
                                    <div class="nice-select">
                                        <span class="current"><?php _e('Стан', 'Home') ?></span>
                                        <div class="list">
                                            <ul class="new">

                                                <?php foreach ($terms as $index => $term): ?>
                                                    <li class="option<?php if($term->term_id == $current_term->term_id) echo ' selected focus' ?>">
                                                        <label for="condition-<?= $index + 1 ?>"></label>
                                                        <input type="radio" id="condition-<?= $index + 1 ?>" name="tax_condition" value="<?= $term->term_id ?>"<?php if($term->term_id == $current_term->term_id) echo ' checked' ?>>
                                                        <?= $term->name ?>
                                                    </li>
                                                <?php endforeach ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="input-wrap input-wrap-var-1 input-wrap-var-2">
                                <label for="total_area"><?php _e('Загальна площа', 'Home') ?>, <?php _e('м²', 'Home') ?></label>
                                <input type="number" name="meta_total_area" id="total_area" value="<?php the_field('total_area', $object_id) ?>">
                            </div>
                            <div class="input-wrap input-wrap-var-1 input-wrap-var-2">
                                <label for="living_area"><?php _e('Житлова площа', 'Home') ?>, <?php _e('м²', 'Home') ?></label>
                                <input type="number" name="meta_living_area" id="living_area" value="<?php the_field('living_area', $object_id) ?>">
                            </div>
                            <div class="input-wrap input-wrap-var-1 input-wrap-var-2">
                                <label for="kitchen_area"><?php _e('Площа кухні', 'Home') ?>, <?php _e('м²', 'Home') ?></label>
                                <input type="number" name="meta_kitchen_area" id="kitchen_area" value="<?php the_field('kitchen_area', $object_id) ?>">
                            </div>
                            <div class="input-wrap-check flex input-wrap-var-1 input-wrap-var-2 input-wrap-var-3">
                                <div class="wrap">
                                    <input type="checkbox" name="mortgage" id="mortgage"<?php if(get_field('mortgage', $object_id)) echo ' checked' ?>>
                                    <label for="mortgage"><?php _e('Іпотека', 'Home') ?></label>
                                </div>
                            </div>

                            <!--2 - все шо в 1 тільки меньше полей-->

                            <div class="input-wrap input-wrap-all">
                                <label for="map_url"><?php _e('Посилання на Google Maps', 'Home') ?></label>
                                <input type="text" name="meta_map_url" id="map_url" value="<?php the_field('map_url', $object_id) ?>">
                            </div>
                            <div class="input-wrap input-wrap-all">
                                <label for="youtube_url"><?php _e('Посилання на відео в YouTube', 'Home') ?></label>
                                <input type="text" name="meta_youtube_url" id="youtube_url" value="<?php the_field('youtube_url', $object_id) ?>">
                            </div>
                            <div class="input-wrap input-wrap-all">
                                <label for="owner_name"><?php _e('Ім’я власника', 'Home') ?><span>*</span></label>
                                <input type="text" name="meta_owner_name" id="owner_name" value="<?php the_field('owner_name', $object_id) ?>" required>
                            </div>
                            <div class="input-wrap input-wrap-all">
                                <label for="owner_phone"><?php _e('Номер телефону власника', 'Home') ?><span>*</span></label>
                                <input type="text" name="meta_owner_phone" id="owner_phone" class="tel" value="<?php the_field('owner_phone', $object_id) ?>" required>
                            </div>
                            <div class="input-wrap input-wrap-all">
                                <label for="owner_phone_add"><?php _e('Додатковий номер телефону власника', 'Home') ?></label>
                                <input type="text" name="meta_owner_phone_add" id="owner_phone_add" class="tel" value="<?php the_field('owner_phone', $object_id) ?>">
                            </div>

                            <div class="input-wrap-dropzone dropzone">
                                <div id="dZUpload" class="">
                                    <div class="dz-default dz-message">
                                        <div class="wrap-dropzone">
                                            <figure>
                                                <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-10.svg" alt="">
                                            </figure>
                                        </div>
                                    </div>

                                    <?php $images = get_field('gallery', $object_id);
                                    if($images): ?>
                                        <?php foreach($images as $image): ?>

                                            <figure class="dz-processing dz-image-preview dz-success dz-complete">
                                                <?= wp_get_attachment_image($image['ID'], 'full', false, array('data-dz-thumbnail' => '')) ?>
                                                <a data-id="<?= $image['ID'] ?>" href="#">x</a>
                                            </figure>

                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="loading-dz"></div>
                            <div class="input-submit flex">
                                <button type="submit" class="btn-default btn"><?php _e('Зберегти', 'Home') ?></button>
                                <a href="#" class="btn-default btn-border btn" id="edit_object_draft"><?php _e('В чернетки', 'Home') ?></a>
                            </div>
                            <input type="hidden" name="images" value="<?= get_field('gallery', $object_id, false) ? implode(',', get_field('gallery', $object_id, false)) : '' ?>">
                            <input type="hidden" name="object_id" value="<?= $object_id ?>">
                            <input type="hidden" name="draft">
                            <input type="hidden" name="action" value="edit_object">
                        </form>

                        <script>
                            jQuery(document).ready(function($) {
                                $("#edit_object").validate();
                            })
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?php get_footer(); ?>
