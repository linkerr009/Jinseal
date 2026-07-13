<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'JinSeal Site Settings',
            'menu_title' => 'JinSeal Settings',
            'menu_slug' => 'jinseal-settings',
            'capability' => 'edit_posts',
            'redirect' => false,
        ]);
    }

    jinseal_register_acf_field_group([
        'key' => 'group_jinseal_site_settings',
        'title' => 'JinSeal Site Settings',
        'fields' => [
            ['key' => 'field_jinseal_logo', 'label' => 'Logo', 'name' => 'site_logo', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium', 'library' => 'all'],
            ['key' => 'field_jinseal_email', 'label' => 'Email', 'name' => 'site_email', 'type' => 'email', 'default_value' => 'info@ginseal.com'],
            ['key' => 'field_jinseal_phone', 'label' => 'Phone', 'name' => 'site_phone', 'type' => 'text', 'default_value' => '+86 (0) 574 - 2370 6900'],
            ['key' => 'field_jinseal_fax', 'label' => 'Fax', 'name' => 'site_fax', 'type' => 'text', 'default_value' => '+86 (0) 574 - 6326 1299'],
            ['key' => 'field_jinseal_address', 'label' => 'Address', 'name' => 'site_address', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_jinseal_footer_intro', 'label' => 'Footer Intro', 'name' => 'footer_intro', 'type' => 'textarea', 'rows' => 3],
            [
                'key' => 'field_jinseal_footer_badges',
                'label' => 'Footer Badges',
                'name' => 'footer_badges',
                'type' => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    ['key' => 'field_jinseal_footer_badge_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_jinseal_inquiry_background', 'label' => 'Inquiry Background', 'name' => 'inquiry_background', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium'],
            ['key' => 'field_jinseal_inquiry_eyebrow', 'label' => 'Inquiry Eyebrow', 'name' => 'inquiry_eyebrow', 'type' => 'text', 'default_value' => 'Send Inquiry'],
            ['key' => 'field_jinseal_inquiry_title', 'label' => 'Inquiry Title', 'name' => 'inquiry_title', 'type' => 'text', 'default_value' => 'Need help choosing a sealing product?'],
            ['key' => 'field_jinseal_inquiry_text', 'label' => 'Inquiry Text', 'name' => 'inquiry_text', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_jinseal_inquiry_extra_text', 'label' => 'Inquiry Extra Text', 'name' => 'inquiry_extra_text', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_jinseal_products_archive_hero_image', 'label' => 'Products Archive Hero Image', 'name' => 'products_archive_hero_image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium'],
            ['key' => 'field_jinseal_products_archive_title', 'label' => 'Products Archive Title', 'name' => 'products_archive_title', 'type' => 'text'],
            ['key' => 'field_jinseal_products_archive_text', 'label' => 'Products Archive Text', 'name' => 'products_archive_text', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_jinseal_products_intro_title', 'label' => 'Products Intro Title', 'name' => 'products_intro_title', 'type' => 'text'],
            ['key' => 'field_jinseal_products_intro_text', 'label' => 'Products Intro Text', 'name' => 'products_intro_text', 'type' => 'textarea', 'rows' => 4],
            ['key' => 'field_jinseal_products_seo_title', 'label' => 'Products SEO Title', 'name' => 'products_seo_title', 'type' => 'text'],
            ['key' => 'field_jinseal_products_seo_content', 'label' => 'Products SEO Content', 'name' => 'products_seo_content', 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic'],
            [
                'key' => 'field_jinseal_inquiry_stats',
                'label' => 'Inquiry Stats',
                'name' => 'inquiry_stats',
                'type' => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    ['key' => 'field_jinseal_inquiry_stat_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text'],
                    ['key' => 'field_jinseal_inquiry_stat_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text'],
                ],
            ],
            [
                'key' => 'field_jinseal_inquiry_checklist',
                'label' => 'Inquiry Checklist',
                'name' => 'inquiry_checklist',
                'type' => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    ['key' => 'field_jinseal_inquiry_check_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'text'],
                    ['key' => 'field_jinseal_inquiry_check_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_jinseal_form_shortcode', 'label' => 'FluentForm Shortcode', 'name' => 'fluent_form_shortcode', 'type' => 'text', 'default_value' => '[fluentform id="1"]'],
        ],
        'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'jinseal-settings']]],
    ]);
});
