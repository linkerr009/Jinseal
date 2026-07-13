<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    jinseal_register_acf_field_group([
        'key' => 'group_jinseal_contact_fields',
        'title' => 'Contact Page Modules',
        'fields' => [
            [
                'key' => 'field_contact_hero_panels',
                'label' => 'Hero Support Panels',
                'name' => 'contact_hero_panels',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_contact_hero_panel_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'text'],
                    ['key' => 'field_contact_hero_panel_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_contact_hero_panel_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 2],
                ],
            ],
            ['key' => 'field_contact_inquiry_extra_text', 'label' => 'Inquiry Extra Paragraph', 'name' => 'contact_inquiry_extra_text', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_contact_map_eyebrow', 'label' => 'Map Eyebrow', 'name' => 'contact_map_eyebrow', 'type' => 'text'],
            ['key' => 'field_contact_map_title', 'label' => 'Map Title', 'name' => 'contact_map_title', 'type' => 'text'],
            ['key' => 'field_contact_map_text', 'label' => 'Map Text', 'name' => 'contact_map_text', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_contact_map_url', 'label' => 'Map Embed URL', 'name' => 'contact_map_url', 'type' => 'url'],
        ],
        'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'page-contact.php']]],
    ]);
});
