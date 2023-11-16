<?php
require 'inc/WP_Query_Allow_Postmeta_Compare.php';
require 'inc/ajax.php';


// show_admin_bar( false );
if(!current_user_can('administrator')) add_filter('show_admin_bar', '__return_false');;

add_action('wp_enqueue_scripts', 'load_style_script');
function load_style_script(){
    wp_enqueue_style('my-normalize', get_template_directory_uri() . '/css/normalize.css');
    wp_enqueue_style('my-font', get_template_directory_uri() . '/css/font.css');
    wp_enqueue_style('my-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.min.css');
    wp_enqueue_style('my-nice-select', get_template_directory_uri() . '/css/nice-select.css');
    wp_enqueue_style('my-ui', get_template_directory_uri() . '/css/jquery-ui.min.css');
    wp_enqueue_style('my-swiper', get_template_directory_uri() . '/css/swiper.min.css');
    wp_enqueue_style('my-dropzone', get_template_directory_uri() . '/css/dropzone.css');
    wp_enqueue_style('my-intlTelInput', get_template_directory_uri() . '/css/intlTelInput.min.css');
    wp_enqueue_style('my-sweetalert2', get_template_directory_uri() . '/css/sweetalert2.min.css');
    wp_enqueue_style('my-styles-lading', get_template_directory_uri() . '/css/styles-lading.css');
    wp_enqueue_style('my-styles', get_template_directory_uri() . '/css/styles.css');
    wp_enqueue_style('my-style-main', get_template_directory_uri() . '/style.css');


    wp_enqueue_script('jquery');
    wp_enqueue_script('my-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array(), false, true);
    wp_enqueue_script('my-swiper', get_template_directory_uri() . '/js/swiper.js', array(), false, true);
    wp_enqueue_script('my-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array(), false, true);
    wp_enqueue_script('my-nice-select', get_template_directory_uri() . '/js/jquery.nice-select.min.js', array(), false, true);
    wp_enqueue_script('my-nicescroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array(), false, true);
    wp_enqueue_script('my-cuttr', get_template_directory_uri() . '/js/cuttr.js', array(), false, true);
    wp_enqueue_script('my-dropzone', get_template_directory_uri() . '/js/dropzone.js', array(), false, true);
    wp_enqueue_script('my-rellax', get_template_directory_uri() . '/js/rellax.min.js', array(), false, true);
    wp_enqueue_script('my-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array(), false, true);
    wp_enqueue_script('my-sweetalert2', get_template_directory_uri() . '/js/sweetalert2.all.min.js', array(), false, true);

    if (is_page_template('page-templates/landing.php')) {
        wp_enqueue_script('my-intlTelInput', get_template_directory_uri() . '/js/intlTelInput.min.js', array(), false, true);
    }

    wp_enqueue_script('my-validate', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js', array(), false, true);
    wp_enqueue_script('my-messages_uk', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/localization/messages_uk.js', array(), false, true);
    wp_enqueue_script('my-script', get_template_directory_uri() . '/js/script.js', array(), false, true);
    wp_enqueue_script('my-add', get_template_directory_uri() . '/js/add.js', array(), false, true);

    $cities = get_terms(['taxonomy' => 'city', 'hide_empty' => false,]);

    $dataToBePassed = array(
        'cities' => $cities,
    );
    wp_localize_script('my-add', 'php_vars', $dataToBePassed);
}


add_action('after_setup_theme', function(){
    register_nav_menus( array(
        'header' => 'Header menu',
        'footer' => 'Footer menu'
    ) );
});


add_theme_support( 'title-tag' );
add_theme_support('html5');
add_theme_support( 'post-thumbnails' );


if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Main settings',
        'menu_title'	=> 'Theme options',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
}


add_filter('wpcf7_autop_or_not', '__return_false');


function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyDiyT05YehIdz2LrV-QOeRa5M18WfKtlnY');
}
add_action('acf/init', 'my_acf_init');


add_filter('tiny_mce_before_init', 'override_mce_options');
function override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}


WP_Query_Allow_Postmeta_Compare::init();
