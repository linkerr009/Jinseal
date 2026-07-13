<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_jinseal_page_fields',
        'title' => 'Page Content Fields',
        'fields' => [
            ['key' => 'field_page_hero_eyebrow', 'label' => 'Hero Eyebrow', 'name' => 'hero_eyebrow', 'type' => 'text'],
            ['key' => 'field_page_hero_title', 'label' => 'Hero Title', 'name' => 'hero_title', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_page_hero_text', 'label' => 'Hero Text', 'name' => 'hero_text', 'type' => 'textarea', 'rows' => 4],
            ['key' => 'field_page_hero_image', 'label' => 'Hero Image', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium'],
            [
                'key' => 'field_page_sections',
                'label' => 'Flexible Sections',
                'name' => 'page_sections',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => 'Add Section',
                'sub_fields' => [
                    ['key' => 'field_page_section_eyebrow', 'label' => 'Eyebrow', 'name' => 'eyebrow', 'type' => 'text'],
                    ['key' => 'field_page_section_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_page_section_content', 'label' => 'Content', 'name' => 'content', 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic'],
                    ['key' => 'field_page_section_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium'],
                ],
            ],
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'page']]],
    ]);
});

