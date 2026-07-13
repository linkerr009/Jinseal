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
            ['key' => 'field_jinseal_form_shortcode', 'label' => 'FluentForm Shortcode', 'name' => 'fluent_form_shortcode', 'type' => 'text', 'default_value' => '[fluentform id="1"]'],
        ],
        'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'jinseal-settings']]],
    ]);
});
