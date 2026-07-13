<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_jinseal_taxonomy_fields',
        'title' => 'Archive Template Fields',
        'fields' => [
            ['key' => 'field_tax_hero_image', 'label' => 'Hero Image', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium'],
            ['key' => 'field_tax_hero_text', 'label' => 'Hero Text', 'name' => 'hero_text', 'type' => 'textarea', 'rows' => 4],
            ['key' => 'field_tax_intro_title', 'label' => 'Intro Title', 'name' => 'intro_title', 'type' => 'text'],
            ['key' => 'field_tax_intro_text', 'label' => 'Intro Text', 'name' => 'intro_text', 'type' => 'textarea', 'rows' => 5],
            ['key' => 'field_tax_seo_content', 'label' => 'Long Content Area', 'name' => 'long_content', 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic'],
        ],
        'location' => [
            [['param' => 'taxonomy', 'operator' => '==', 'value' => 'jinseal_product_category']],
            [['param' => 'taxonomy', 'operator' => '==', 'value' => 'jinseal_industry']],
        ],
    ]);
});

