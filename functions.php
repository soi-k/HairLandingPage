<?php
function hair_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Menu chính', 'hair-landing'),
    ]);
}
add_action('after_setup_theme', 'hair_theme_setup');

function hair_enqueue_assets() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Open+Sans:wght@300;400;600&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'hair-main',
        get_template_directory_uri() . '/assets/css/main.css',
        ['google-fonts'],
        '1.0.0'
    );

    wp_enqueue_script(
        'hair-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'hair_enqueue_assets');

// Allow SVG uploads
function hair_allow_svg($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'hair_allow_svg');

// Clean up wp_head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
