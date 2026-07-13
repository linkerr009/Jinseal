<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    jinseal_register_acf_field_group([
        'key' => 'group_jinseal_product_fields',
        'title' => 'Product Detail Fields',
        'fields' => [
            ['key' => 'field_product_label', 'label' => 'Product Label', 'name' => 'product_label', 'type' => 'text'],
            ['key' => 'field_product_overview_title', 'label' => 'Overview Title', 'name' => 'product_overview_title', 'type' => 'text'],
            ['key' => 'field_product_summary', 'label' => 'Summary', 'name' => 'product_summary', 'type' => 'textarea', 'rows' => 4],
            ['key' => 'field_product_gallery', 'label' => 'Product Gallery', 'name' => 'product_gallery', 'type' => 'gallery', 'return_format' => 'id', 'preview_size' => 'medium'],
            [
                'key' => 'field_product_features',
                'label' => 'Feature List',
                'name' => 'product_features',
                'type' => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    ['key' => 'field_product_feature_text', 'label' => 'Feature', 'name' => 'feature', 'type' => 'text'],
                ],
            ],
            [
                'key' => 'field_product_description_sections',
                'label' => 'Description Sections',
                'name' => 'description_sections',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_product_desc_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_product_desc_text', 'label' => 'Text', 'name' => 'text', 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic'],
                    ['key' => 'field_product_desc_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium'],
                ],
            ],
            [
                'key' => 'field_product_specs',
                'label' => 'Specifications',
                'name' => 'product_specs',
                'type' => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    ['key' => 'field_product_spec_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                    ['key' => 'field_product_spec_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_product_applications_intro', 'label' => 'Applications Intro', 'name' => 'product_applications_intro', 'type' => 'textarea', 'rows' => 3],
            [
                'key' => 'field_product_faq',
                'label' => 'FAQ',
                'name' => 'product_faq',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_product_faq_question', 'label' => 'Question', 'name' => 'question', 'type' => 'text'],
                    ['key' => 'field_product_faq_answer', 'label' => 'Answer', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3],
                ],
            ],
            ['key' => 'field_product_related', 'label' => 'Related Products', 'name' => 'related_products', 'type' => 'relationship', 'post_type' => ['jinseal_product'], 'return_format' => 'object'],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'jinseal_product']]],
    ]);
});
