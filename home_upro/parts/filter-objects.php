<form action="<?php echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>" method="GET" class="full-filter sel-0 full-filter-all-page" style="display: none" id="filter_objects">
  <input type="hidden" name="sort">
  <div class="full-filter-wrap">
    <div class="form-filter">
      <div class="border">

        <?php 
        $regions = get_terms( [
          'taxonomy' => 'city',
          'parent'  => 0,
        ] ) 
        ?>

        <?php if ($regions): ?>
          <div class="input-wrap input-wrap-popup input-wrap-all">
            <p class="label-info"><?php _e('Регіон', 'Home') ?></p>
            <div class="nice-select">
              <span class="current"><?php _e('Всі', 'Home') ?></span>
              <div class="list">
                <ul class="new">
                  <li class="option selected focus">
                    <label for="region-0"></label>
                    <input type="radio" id="region-0" name="region" value="" checked>
                    <?php _e('Всі', 'Home') ?>
                  </li>

                  <?php foreach ($regions as $index => $term): ?>
                    <li class="option">
                      <label for="region-<?= $index + 1 ?>"></label>
                      <input type="radio" id="region-<?= $index + 1 ?>" name="region_filter" value="<?= $term->term_id ?>" region_name="<?= $term->name ?>">
                      <?= $term->name ?>
                    </li>
                  <?php endforeach ?>

                </ul>
              </div>
            </div>
          </div>
        <?php endif ?>

        <div class="input-wrap input-wrap-popup input-wrap-all">
          <label for="city"><?php _e('Місто', 'Home') ?></label>
          <input type="text" name="city" id="city">
        </div>

        <?php 
        $terms = get_terms( [
          'taxonomy' => 'object_type',
          'hide_empty' => false,
        ] ) 
        ?>

        <?php if ($terms): ?>
          <div class="input-wrap input-wrap-popup input-wrap-img select-input-block filter-wrap-img input-wrap-all">
            <p class="label-info"><?php _e('Тип об’єкта', 'Home') ?></p>
            <div class="nice-select">
              <span class="current"><?php _e('Всі', 'Home') ?></span>
              <div class="list">
                <ul class="new">
                  <li class="option selected focus">
                    <label for="object_type-0"></label>
                    <input type="radio" id="object_type-0" name="object_type" data-value="0" value="" checked>
                    <?php _e('Всі', 'Home') ?>
                  </li>

                  <?php foreach ($terms as $index => $term): ?>
                    <li class="option">
                      <label for="object_type-<?= $index + 1 ?>"></label>
                      <input type="radio" id="object_type-<?= $index + 1 ?>" name="object_type" data-value="<?= $term->term_id - 5 ?>" value="<?= $term->term_id ?>">

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

        <?php 
        $districts = get_terms( [
          'taxonomy' => 'city',
          'parent'  => $cities[0]->term_id,
          'hide_empty' => false,
        ] ) 
        ?>

        <?php if ($cities && $districts): ?>
          <div class="input-wrap input-wrap-popup input-wrap-all">
            <p class="label-info"><?php _e('Район', 'Home') ?></p>
            <div class="nice-select">
              <span class="current" id="current_district"><?php _e('Всі', 'Home') ?></span>
              <div class="list">
                <ul class="new" id="districts">
                  <li class="option selected focus">
                    <label for="district-0"></label>
                    <input type="radio" id="district-0" name="district" value="" checked>
                    <?php _e('Всі', 'Home') ?>
                  </li>

                  <?php foreach ($districts as $index => $term): ?>
                    <li class="option">
                      <label for="district-<?= $index + 1 ?>"></label>
                      <input type="radio" id="district-<?= $index + 1 ?>" name="district" value="<?= $term->term_id ?>">
                      <?= $term->name ?>
                    </li>
                  <?php endforeach ?>

                </ul>
              </div>
            </div>
          </div>
        <?php endif ?>

        <div class="input-wrap input-wrap-search input-wrap-popup input-wrap-all">
          <label for="street"><?php _e('Вулиця', 'Home') ?></label>
          <input type="text" name="street" id="street" class="street">
          <p><img src="<?= get_stylesheet_directory_uri() ?>/img/search.svg" alt=""></p>
        </div>

        <div class="input-wrap input-wrap-number input-wrap-var-1 input-wrap-var-2 input-wrap-var-3 input-wrap-var-4">
          <label for="count"><?php _e('Кількість кімнат', 'Home') ?></label>
          <div class="flex">
            <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/minus.svg" alt=""></div>
            <input type="number" name="number_of_living_rooms" min="0" step="1" id="count" value="0" class="form-control"/>
            <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/plus.svg" alt=""></div>
          </div>
        </div>

        <div class="input-wrap input-wrap-2 input-wrap-flex input-wrap-var-1 input-wrap-var-2 input-wrap-var-3 input-wrap-var-4 input-dis-1">
          <label for="total_area_min"><?php _e('Площа', 'Home') ?></label>
          <label for="total_area_max"></label>
          <div class="flex space-between">
            <input type="number" name="total_area_min" min="0" step="1" id="total_area_min" placeholder="<?php _e('від', 'Home') ?>">
            <input type="number" name="total_area_max" min="0" step="1" id="total_area_max" placeholder="<?php _e('до', 'Home') ?>">
          </div>
        </div>

        <div class="input-wrap input-wrap-2  input-wrap-flex mini-radio-input selected-item selected-item-3 input-wrap-var-3 input-wrap-var-4 input-wrap-var-5 input-dis-2">
          <label for="plot_area_min"><?php _e('Площа ділянки', 'Home') ?>, <?php _e('сотки', 'Home') ?></label>
          <div class="mini-radio">
            <input type="checkbox" name="unit_plot_area" id="unit_plot_area">
            <label for="unit_plot_area"><?php _e('га', 'Home') ?></label>
          </div>
          <input type="text" name="plot_area_min" id="plot_area_min" value="" placeholder="від">
          <input type="text" name="plot_area_max" id="plot_area_max" value="" placeholder="до">
        </div>

        <div class="input-wrap input-wrap-number input-wrap-var-1 input-wrap-var-2 input-wrap-var-3 input-wrap-var-4">
          <label for="superficiality"><?php _e('Поверховість', 'Home') ?></label>
          <div class="flex">
            <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/minus.svg" alt=""></div>
            <input type="number" name="superficiality" min="0" step="1" id="superficiality" value="0" class="form-control"/>
            <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/plus.svg" alt=""></div>
          </div>
        </div>

        <div class="input-wrap input-wrap-number input-wrap-var-1 input-wrap-var-2">
          <label for="over"><?php _e('Поверх', 'Home') ?></label>
          <div class="flex">
            <div class="btn-count btn-count-minus"><img src="<?= get_stylesheet_directory_uri() ?>/img/minus.svg" alt=""></div>
            <input type="number" name="over" min="0" step="1" id="over" value="0" class="form-control"/>
            <div class="btn-count btn-count-plus"><img src="<?= get_stylesheet_directory_uri() ?>/img/plus.svg" alt=""></div>
          </div>
        </div>

        <div class="input-wrap-check flex input-wrap-check-2 space-between input-wrap-var-1 input-wrap-var-2">
          <div class="wrap">
            <input type="checkbox" name="not_first" id="not_first">
            <label for="not_first"><?php _e('Не перший', 'Home') ?></label>
          </div>
          <div class="wrap">
            <input type="checkbox" name="not_last" id="not_last">
            <label for="not_last"><?php _e('Не останній', 'Home') ?></label>
          </div>
        </div>

        <?php 
        $terms = get_terms( [
          'taxonomy' => 'area',
          'hide_empty' => false,
        ] ) 
        ?>

        <?php if ($terms): ?>
          <div class="input-wrap-check flex input-wrap-check-2 space-between input-wrap-var-1 input-wrap-var-2">

            <?php foreach ($terms as $index => $term): ?>
              <div class="wrap">
                <input type="checkbox" name="type_area[]" id="type_area-<?= $index + 1 ?>">
                <label for="type_area-<?= $index + 1 ?>"><?= $term->name ?></label>
              </div>
            <?php endforeach ?>

          </div>
        <?php endif ?>

        <?php 
        $terms = get_terms( [
          'taxonomy' => 'condition',
          'hide_empty' => false,
        ] ) 
        ?>

        <?php if ($terms): ?>
          <div class="input-wrap input-wrap-popup input-wrap-var-1 input-wrap-var-2 input-wrap-var-3 input-wrap-var-4">
            <p class="label-info"><?php _e('Стан', 'Home') ?></p>
            <div class="nice-select">
              <span class="current"><?php _e('Стан', 'Home') ?></span>
              <div class="list">
                <ul class="new">
                  <li class="option selected focus">
                    <label for="condition-0"></label>
                    <input type="radio" id="condition-0" name="condition" value="" checked>
                    <?php _e('Всі', 'Home') ?>
                  </li>

                  <?php foreach ($terms as $index => $term): ?>
                    <li class="option">
                      <label for="condition-<?= $index + 1 ?>"></label>
                      <input type="radio" id="condition-<?= $index + 1 ?>" name="condition" value="<?= $term->term_id ?>">
                      <?= $term->name ?>
                    </li>
                  <?php endforeach ?>

                </ul>
              </div>
            </div>
          </div>
        <?php endif ?>

        <div class="input-wrap input-wrap-2 input-wrap-all">
          <label for="price_min"><?php _e('Ціна', 'Home') ?></label>
          <label for="price_max"></label>
          <div class="flex space-between">
            <input type="number" name="price_min" min="0" step="1" id="price_min" placeholder="<?php _e('від', 'Home') ?>">
            <input type="number" name="price_max" min="0" step="1" id="price_max" placeholder="<?php _e('до', 'Home') ?>">
          </div>
        </div>
        <div class="input-wrap-check flex input-wrap-check-full input-wrap-all">
          <div class="wrap">
            <input type="checkbox" name="mortgage" id="mortgage">
            <label for="mortgage"><?php _e('Іпотека', 'Home') ?></label>
          </div>
        </div>

        <?php 
        $terms = get_terms( [
          'taxonomy' => 'builder',
          'hide_empty' => false,
        ] ) 
        ?>

        <?php if ($terms): ?>
          <div class="input-wrap input-wrap-popup input-wrap-var-1 input-wrap-var-4">
            <p class="label-info"><?php _e('Забудовник', 'Home') ?></p>
            <div class="nice-select">
              <span class="current"><?php _e('Оберіть забудовника', 'Home') ?></span>
              <div class="list">
                <ul class="new" id="get_builders">
                  <li class="option selected focus">
                    <label for="builder-0"></label>
                    <input type="radio" id="builder-0" name="builder" value="" checked>
                    <?php _e('Всі', 'Home') ?>
                  </li>

                  <?php foreach ($terms as $index => $term): ?>
                    <!-- <li class="option">
                      <label for="builder-<?= $index + 1 ?>"></label>
                      <input type="radio" id="builder-<?= $index + 1 ?>" name="builder" value="<?= $term->term_id ?>">
                      <?= $term->name ?>
                    </li> -->
                  <?php endforeach ?>

                </ul>
              </div>
            </div>
          </div>
        <?php endif ?>

        <?php 
        $terms = get_terms( [
          'taxonomy' => 'residential_complex',
          'hide_empty' => false,
        ] ) 
        ?>

        <?php if ($terms): ?>
          <div class="input-wrap input-wrap-popup input-wrap-var-1">
            <p class="label-info"><?php _e('Житловий комплекс', 'Home') ?></p>
            <div class="nice-select">
              <span class="current"><?php _e('Оберіть ЖК', 'Home') ?></span>
              <div class="list">
                <ul class="new" id="get_complexes">
                  <li class="option selected focus">
                    <label for="residential_complex-0"></label>
                    <input type="radio" id="residential_complex-0" name="residential_complex" value="" checked>
                    <?php _e('Всі', 'Home') ?>
                  </li>

                  <?php foreach ($terms as $index => $term): ?>
                    <!-- <li class="option">
                      <label for="residential_complex-<?= $index + 1 ?>"></label>
                      <input type="radio" id="residential_complex-<?= $index + 1 ?>" name="residential_complex" value="<?= $term->term_id ?>">
                      <?= $term->name ?>
                    </li> -->
                  <?php endforeach ?>

                </ul>
              </div>
            </div>
          </div>
        <?php endif ?>

        <?php 
        $terms = get_terms( [
          'taxonomy' => 'turn',
          'hide_empty' => false,
        ] ) 
        ?>

        <?php if ($terms): ?>
          <div class="input-wrap input-wrap-popup input-wrap-var-1">
            <p class="label-info"><?php _e('Черга', 'Home') ?></p>
            <div class="nice-select">
              <span class="current"><?php _e('Черга', 'Home') ?></span>
              <div class="list">
                <ul class="new" id="get_turns">
                  <li class="option selected focus">
                    <label for="turn-0"></label>
                    <input type="radio" id="turn-0" name="turn" value="" checked>
                    <?php _e('Всі', 'Home') ?>
                  </li>

                  <?php foreach ($terms as $index => $term): ?>
                    <!-- <li class="option">
                      <label for="turn-<?= $index + 1 ?>"></label>
                      <input type="radio" id="turn-<?= $index + 1 ?>" name="turn" value="<?= $term->term_id ?>">
                      <?= $term->name ?>
                    </li> -->
                  <?php endforeach ?>

                </ul>
              </div>
            </div>
          </div>
        <?php endif ?>

        <?php 
        $terms = get_terms( [
          'taxonomy' => 'section',
          'hide_empty' => false,
        ] ) 
        ?>

        <div class="input-wrap input-wrap-popup input-wrap-var-1">
          <p class="label-info"><?php _e('Секція', 'Home') ?></p>
          <div class="nice-select">
            <span class="current"><?php _e('Секція', 'Home') ?></span>
            <div class="list">
              <ul class="new" id="get_sections">
                <li class="option selected focus">
                  <label for="section-0"></label>
                  <input type="radio" id="section-0" name="section" value="" checked>
                  <?php _e('Всі', 'Home') ?>
                </li>

                <?php foreach ($terms as $index => $term): ?>
                  <li class="option">
                    <label for="section-<?= $index + 1 ?>"></label>
                    <input type="radio" id="section-<?= $index + 1 ?>" name="section" value="<?= $term->term_id ?>">
                    <?= $term->name ?>
                  </li>
                <?php endforeach ?>

              </ul>
            </div>
          </div>
        </div>

        <?php $users = get_users() ?>

        <?php if ($users): ?>
          <div class="input-wrap input-wrap-popup input-wrap-all">
            <p class="label-info"><?php _e('Автор', 'Home') ?></p>
            <div class="nice-select">
              <span class="current"><?php _e('Автор', 'Home') ?></span>
              <div class="list">
                <ul class="new">
                  <li class="option selected focus">
                    <label for="author-0"></label>
                    <input type="radio" id="author-0" name="author" value="" checked>
                    <?php _e('Всі', 'Home') ?>
                  </li>

                  <?php foreach ($users as $index => $user): ?>

                    <li class="option">
                      <label for="author-<?= $index + 1 ?>"></label>
                      <input type="radio" id="author-<?= $index + 1 ?>" name="author" value="<?= $user->ID ?>">
                      <?= $user->data->display_name ?>
                    </li>

                  <?php endforeach ?>

                </ul>
              </div>
            </div>
          </div>
        <?php endif ?>

        <?php 
        $terms = get_terms( [
          'taxonomy' => 'features',
          'hide_empty' => false,
        ] ) 
        ?>

        <?php if ($terms): ?>
          <div class="input-wrap-check input-wrap-check-more input-wrap-all">
            <p class="label-info"><?php _e('Особливості', 'Home') ?></p>
            <div class="wrap flex">

              <?php foreach ($terms as $index => $term): ?>
                <div class="item">
                  <input type="checkbox" name="features[]" id="features-<?= $index + 1 ?>" value="<?= $term->term_id ?>">
                  <label for="features-<?= $index + 1 ?>"><?= $term->name ?></label>
                </div>
              <?php endforeach ?>

            </div>
          </div>
        <?php endif ?>

      </div>
      <div class="input-submit flex">
        <button type="submit" class="btn-default btn"><?php _e('Застосувати', 'Home') ?></button>
        <button type="reset" class="btn-default btn-border btn"><?php _e('Очистити', 'Home') ?></button>
      </div>
      <input type="hidden" name="action" value="filter_objects">
    </div>
  </div>
</form>