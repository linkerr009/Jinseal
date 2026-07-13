<?php
/**
 * Populate new editable product fields without replacing existing editor data.
 *
 * Run with:
 * wp eval-file wp-content/themes/jinseal/tools/migrate-product-fields.php
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('get_field') || !function_exists('update_field')) {
    WP_CLI::error('ACF must be active.');
}

$products = get_posts([
    'post_type' => 'jinseal_product',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'menu_order title',
    'order' => 'ASC',
]);

foreach ($products as $product) {
    if (!get_field('product_applications', $product->ID)) {
        $terms = get_the_terms($product, 'jinseal_industry');
        $rows = [];

        if ($terms && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $rows[] = [
                    'icon' => 'factory',
                    'title' => $term->name,
                    'text' => 'Industrial sealing applications for ' . $term->name . '.',
                ];
            }
        }

        if ($rows) {
            update_field('product_applications', $rows, $product->ID);
        }
    }
}

$featured = get_page_by_path('spiral-wound-gasket', OBJECT, 'jinseal_product');
if ($featured) {
    $related = get_field('related_products', $featured->ID) ?: [];
    if (count($related) < 5) {
        $related_ids = get_posts([
            'post_type' => 'jinseal_product',
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'post__not_in' => [$featured->ID],
            'orderby' => 'menu_order title',
            'order' => 'ASC',
            'fields' => 'ids',
        ]);
        update_field('related_products', $related_ids, $featured->ID);
    }
}

WP_CLI::success('Product application fields populated and related-product carousel sample prepared.');
