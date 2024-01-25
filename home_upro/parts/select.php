<?php $terms = get_field('cities_header', 'option') ?>

<?php if ($terms): ?>
    <div class="nice-select">
        <span class="current"><?= $_GET['region_id'] ? get_field('title_add', 'term_' . $_GET['region_id']) : get_field('title_add', 'term_' . $terms[0]->term_id) ?></span>
        <div class="list">
            <ul class="new">

                <?php foreach ($terms as $index => $term): ?>
                    <li class="option region<?php if($_GET['region_id'] == $term->term_id) echo ' selected focus' ?>" region_id="<?= $term->term_id ?>">
                        <a href="#"><?= get_field('title_add', 'term_' . $term->term_id) ?: mb_convert_case(mb_strtolower($term->name), MB_CASE_TITLE) ?></a>
                    </li>
                <?php endforeach ?>

            </ul>
        </div>
    </div>
    <?php endif ?>