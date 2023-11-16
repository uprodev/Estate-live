    <?php if (!is_page_template('page-templates/login.php')): ?>
    </div>
  </section>  
<?php endif ?>

</main>

<footer>
  <div class="content-width">

  </div>
</footer>

<div id="sort" class="popup-select popup-scroll" style="display:none;">
  <div class="wrap">
    <div class="popup-main">
      <div class="form-select">
        <ul>
          <li>
            <input type="radio" name="sort_name" id="sort-1-1" value="date">
            <label for="sort-1-1"><?php _e('Найновіші', 'Home') ?></label>
          </li>
          <li>
            <input type="radio" name="sort_name" id="sort-1-2" value="price_min">
            <label for="sort-1-2"><?php _e('Найдешевші', 'Home') ?></label>
          </li>
          <li>
            <input type="radio" name="sort_name" id="sort-1-3" value="price_max">
            <label for="sort-1-3"><?php _e('Найдорожчі', 'Home') ?></label>
          </li>
          <li>
            <input type="radio" name="sort_name" id="sort-1-4" value="area_min">
            <label for="sort-1-4"><?php _e('Найменша площа', 'Home') ?></label>
          </li>
          <li>
            <input type="radio" name="sort_name" id="sort-1-5" value="area_max">
            <label for="sort-1-5"><?php _e('Найбільша площа', 'Home') ?></label>
          </li>
        </ul>
      </div>
    </div>
    <div class="btn-wrap">
      <button class="close-popup" data-fancybox-close type="submit"><img src="<?= get_stylesheet_directory_uri() ?>/img/close-popup.svg" alt=""></button>
    </div>
  </div>
</div>

<?php if (is_user_logged_in()): ?>
  <div class="fix-menu">
    <div class="content-width">
      <nav class="mob-menu">
        <ul>
          <li<?php if(get_the_ID() == 55) echo ' class="current-page"' ?>>
            <a href="<?php the_permalink(55) ?>">
              <figure>
                <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-2-1.svg" alt="">
              </figure>
              <p><?php _e('Об’єкти', 'Home') ?></p>
            </a>
          </li>
          <li<?php if(get_the_ID() == 104) echo ' class="current-page"' ?>>
            <a href="<?php the_permalink(104) ?>">
              <figure>
                <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-2-2.svg" alt="">
              </figure>
              <p><?php _e('Продано', 'Home') ?></p>
            </a>
          </li>
          <li class="center<?php if(get_the_ID() == 88) echo ' current-page' ?>">
            <a href="<?php the_permalink(88) ?>">
              <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-1.svg" alt="">
            </a>
          </li>
          <li<?php if(get_the_ID() == 144) echo ' class="current-page"' ?>>
            <a href="<?php the_permalink(144) ?>">
              <figure>
                <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-2-3.svg" alt="">
              </figure>
              <p><?php _e('Обране', 'Home') ?></p>
            </a>
          </li>
          <li>
            <a href="<?php the_permalink(94) ?>">
              <span class="img-wrap">

                <?php if ($field = get_field('avatar', 'user_' . $author_id)): ?>
                  <?= wp_get_attachment_image($field['ID'], 'full') ?>
                <?php else: ?>
                  <img src="<?= get_stylesheet_directory_uri() ?>/img/icon-10.svg" alt="">
                <?php endif ?>

              </span>
              <p><?= get_the_author_meta('first_name', $author_id) ?></p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
<?php endif ?>

<?php wp_footer(); ?>
</body>
</html>