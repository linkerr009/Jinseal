<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('init', function () {
    register_post_type('jinseal_product', [
        'labels' => [
            'name' => __('Products', 'jinseal'),
            'singular_name' => __('Product', 'jinseal'),
            'add_new_item' => __('Add Product', 'jinseal'),
            'edit_item' => __('Edit Product', 'jinseal'),
        ],
        'public' => true,
        'has_archive' => 'products',
        'rewrite' => ['slug' => 'products'],
        'menu_icon' => 'dashicons-products',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail'],
        'show_in_rest' => true,
    ]);

    register_taxonomy('jinseal_product_category', ['jinseal_product'], [
        'labels' => [
            'name' => __('Product Categories', 'jinseal'),
            'singular_name' => __('Product Category', 'jinseal'),
        ],
        'public' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'product-category'],
        'show_in_rest' => true,
    ]);

    register_taxonomy('jinseal_industry', ['jinseal_product'], [
        'labels' => [
            'name' => __('Industries', 'jinseal'),
            'singular_name' => __('Industry', 'jinseal'),
        ],
        'public' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'industry'],
        'show_in_rest' => true,
    ]);
});

