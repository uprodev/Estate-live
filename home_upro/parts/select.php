<?php $terms = get_field('cities_header', 'option') ?>

<?php if ($terms): ?>

<?php 
if(is_singular('objects')){
    $object_terms = wp_get_object_terms(get_the_ID(), 'city');
    if($object_terms){
        $parent_term_id = '';
        foreach ($object_terms as $object_term) {
            if($object_term->parent == 0) $parent_term_id[] = $object_term->term_id;
        }
    }
}
else $parent_term_id = get_field('title_add', 'term_' . $terms[0]->term_id);
?>

    <div class="nice-select">
        <span class="current"><?= $_GET['region_id'] ? get_field('title_add', 'term_' . $_GET['region_id']) : $parent_term_id ?></span>
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