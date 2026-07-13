<?php
if (!defined('ABSPATH')) {
    exit;
}

define('JINSEAL_THEME_VERSION', '1.2.0');
define('JINSEAL_THEME_DIR', get_template_directory());
define('JINSEAL_THEME_URI', get_template_directory_uri());

require_once JINSEAL_THEME_DIR . '/inc/helpers.php';
require_once JINSEAL_THEME_DIR . '/assets/acf/register-content.php';
require_once JINSEAL_THEME_DIR . '/assets/acf/sync-field-groups.php';
require_once JINSEAL_THEME_DIR . '/assets/acf/fields-site.php';
require_once JINSEAL_THEME_DIR . '/assets/acf/fields-pages.php';
require_once JINSEAL_THEME_DIR . '/assets/acf/fields-home.php';
require_once JINSEAL_THEME_DIR . '/assets/acf/fields-about.php';
require_once JINSEAL_THEME_DIR . '/assets/acf/fields-contact.php';
require_once JINSEAL_THEME_DIR . '/assets/acf/fields-product.php';
require_once JINSEAL_THEME_DIR . '/assets/acf/fields-industry.php';

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
    register_nav_menus([
        'primary' => __('Primary Menu', 'jinseal'),
    ]);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('tailwind', 'https://cdn.tailwindcss.com?plugins=forms,container-queries', [], null, false);
    wp_enqueue_script('jinseal-global', JINSEAL_THEME_URI . '/assets/js/global.js', ['tailwind'], JINSEAL_THEME_VERSION, false);
    wp_enqueue_style('jinseal-fonts', 'https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@700;800&family=Inter:wght@400;500;600&display=swap', [], null);
    wp_enqueue_style('jinseal-icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', [], null);
    wp_enqueue_style('jinseal-global', JINSEAL_THEME_URI . '/assets/css/global.css', [], JINSEAL_THEME_VERSION);

    if (is_front_page()) {
        wp_enqueue_style('jinseal-index', JINSEAL_THEME_URI . '/assets/css/index.css', ['jinseal-global'], JINSEAL_THEME_VERSION);
        wp_enqueue_style('jinseal-contact', JINSEAL_THEME_URI . '/assets/css/contact.css', ['jinseal-global', 'jinseal-index'], JINSEAL_THEME_VERSION);
        wp_enqueue_style('jinseal-products', JINSEAL_THEME_URI . '/assets/css/products.css', ['jinseal-global', 'jinseal-contact'], JINSEAL_THEME_VERSION);
        wp_enqueue_script('jinseal-index', JINSEAL_THEME_URI . '/assets/js/index.js', [], JINSEAL_THEME_VERSION, true);
        wp_enqueue_script('jinseal-contact', JINSEAL_THEME_URI . '/assets/js/contact.js', [], JINSEAL_THEME_VERSION, true);
    }

    if (is_page_template('page-about.php') || is_page('about')) {
        wp_enqueue_style('jinseal-about', JINSEAL_THEME_URI . '/assets/css/about.css', ['jinseal-global'], JINSEAL_THEME_VERSION);
        wp_enqueue_script('jinseal-about', JINSEAL_THEME_URI . '/assets/js/about.js', [], JINSEAL_THEME_VERSION, true);
    }

    if (is_page_template('page-contact.php') || is_page('contact')) {
        wp_enqueue_style('jinseal-contact', JINSEAL_THEME_URI . '/assets/css/contact.css', ['jinseal-global'], JINSEAL_THEME_VERSION);
        wp_enqueue_script('jinseal-contact', JINSEAL_THEME_URI . '/assets/js/contact.js', [], JINSEAL_THEME_VERSION, true);
    }

    if (is_page() && !is_front_page()) {
        wp_enqueue_style('jinseal-contact', JINSEAL_THEME_URI . '/assets/css/contact.css', ['jinseal-global'], JINSEAL_THEME_VERSION);
        wp_enqueue_script('jinseal-contact', JINSEAL_THEME_URI . '/assets/js/contact.js', [], JINSEAL_THEME_VERSION, true);
    }

    if (is_post_type_archive('jinseal_product') || is_tax('jinseal_product_category') || is_tax('jinseal_industry')) {
        wp_enqueue_style('jinseal-contact', JINSEAL_THEME_URI . '/assets/css/contact.css', ['jinseal-global'], JINSEAL_THEME_VERSION);
        wp_enqueue_style('jinseal-products', JINSEAL_THEME_URI . '/assets/css/products.css', ['jinseal-global', 'jinseal-contact'], JINSEAL_THEME_VERSION);
        wp_enqueue_script('jinseal-products', JINSEAL_THEME_URI . '/assets/js/products.js', [], JINSEAL_THEME_VERSION, true);
        wp_enqueue_script('jinseal-contact', JINSEAL_THEME_URI . '/assets/js/contact.js', [], JINSEAL_THEME_VERSION, true);
    }

    if (is_singular('jinseal_product')) {
        wp_enqueue_style('jinseal-contact', JINSEAL_THEME_URI . '/assets/css/contact.css', ['jinseal-global'], JINSEAL_THEME_VERSION);
        wp_enqueue_style('jinseal-products', JINSEAL_THEME_URI . '/assets/css/products.css', ['jinseal-global', 'jinseal-contact'], JINSEAL_THEME_VERSION);
        wp_enqueue_style('jinseal-product-detail', JINSEAL_THEME_URI . '/assets/css/product-detail.css', ['jinseal-global', 'jinseal-contact', 'jinseal-products'], JINSEAL_THEME_VERSION);
        wp_enqueue_script('jinseal-product-detail', JINSEAL_THEME_URI . '/assets/js/product-detail.js', [], JINSEAL_THEME_VERSION, true);
        wp_enqueue_script('jinseal-contact', JINSEAL_THEME_URI . '/assets/js/contact.js', [], JINSEAL_THEME_VERSION, true);
    }
});
