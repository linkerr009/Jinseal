<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    jinseal_register_acf_field_group([
        'key' => 'group_jinseal_home_fields',
        'title' => 'Home Page Modules',
        'fields' => [
            [
                'key' => 'field_home_hero_badges',
                'label' => 'Hero Badges',
                'name' => 'home_hero_badges',
                'type' => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    ['key' => 'field_home_hero_badge_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_home_hero_secondary_text', 'label' => 'Hero Secondary Text', 'name' => 'home_hero_secondary_text', 'type' => 'textarea', 'rows' => 3],
            [
                'key' => 'field_home_trust_items',
                'label' => 'Trust Bar Items',
                'name' => 'home_trust_items',
                'type' => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    ['key' => 'field_home_trust_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'text'],
                    ['key' => 'field_home_trust_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text'],
                    ['key' => 'field_home_trust_primary', 'label' => 'Primary Item', 'name' => 'primary', 'type' => 'true_false'],
                ],
            ],
            ['key' => 'field_home_about_eyebrow', 'label' => 'About Eyebrow', 'name' => 'home_about_eyebrow', 'type' => 'text'],
            ['key' => 'field_home_about_title', 'label' => 'About Title', 'name' => 'home_about_title', 'type' => 'text'],
            ['key' => 'field_home_about_text', 'label' => 'About Text', 'name' => 'home_about_text', 'type' => 'textarea', 'rows' => 4],
            [
                'key' => 'field_home_about_points',
                'label' => 'About Points',
                'name' => 'home_about_points',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_home_about_point_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_home_about_point_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 2],
                ],
            ],
            ['key' => 'field_home_about_image', 'label' => 'About Image', 'name' => 'home_about_image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium'],
            ['key' => 'field_home_about_badge_label', 'label' => 'About Image Badge Label', 'name' => 'home_about_badge_label', 'type' => 'text'],
            ['key' => 'field_home_about_badge_value', 'label' => 'About Image Badge Value', 'name' => 'home_about_badge_value', 'type' => 'text'],
            ['key' => 'field_home_products_eyebrow', 'label' => 'Products Eyebrow', 'name' => 'home_products_eyebrow', 'type' => 'text'],
            ['key' => 'field_home_products_title', 'label' => 'Products Title', 'name' => 'home_products_title', 'type' => 'text'],
            ['key' => 'field_home_products_text', 'label' => 'Products Text', 'name' => 'home_products_text', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_home_quality_eyebrow', 'label' => 'Quality Eyebrow', 'name' => 'home_quality_eyebrow', 'type' => 'text'],
            ['key' => 'field_home_quality_title', 'label' => 'Quality Title', 'name' => 'home_quality_title', 'type' => 'text'],
            ['key' => 'field_home_quality_text', 'label' => 'Quality Text', 'name' => 'home_quality_text', 'type' => 'textarea', 'rows' => 3],
            [
                'key' => 'field_home_quality_items',
                'label' => 'Quality Items',
                'name' => 'home_quality_items',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_home_quality_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'text'],
                    ['key' => 'field_home_quality_item_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_home_quality_item_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 3],
                ],
            ],
            ['key' => 'field_home_industries_eyebrow', 'label' => 'Industries Eyebrow', 'name' => 'home_industries_eyebrow', 'type' => 'text'],
            ['key' => 'field_home_industries_title', 'label' => 'Industries Title', 'name' => 'home_industries_title', 'type' => 'text'],
            ['key' => 'field_home_industries_text', 'label' => 'Industries Text', 'name' => 'home_industries_text', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_home_stories_eyebrow', 'label' => 'Stories Eyebrow', 'name' => 'home_stories_eyebrow', 'type' => 'text'],
            ['key' => 'field_home_stories_title', 'label' => 'Stories Title', 'name' => 'home_stories_title', 'type' => 'text'],
            ['key' => 'field_home_stories_text', 'label' => 'Stories Text', 'name' => 'home_stories_text', 'type' => 'textarea', 'rows' => 3],
            ['key' => 'field_home_stories_button', 'label' => 'Stories Button Text', 'name' => 'home_stories_button', 'type' => 'text'],
            [
                'key' => 'field_home_testimonials',
                'label' => 'Customer Stories',
                'name' => 'home_testimonials',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_home_testimonial_initial', 'label' => 'Initial', 'name' => 'initial', 'type' => 'text'],
                    ['key' => 'field_home_testimonial_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                    ['key' => 'field_home_testimonial_role', 'label' => 'Role', 'name' => 'role', 'type' => 'text'],
                    ['key' => 'field_home_testimonial_quote', 'label' => 'Quote', 'name' => 'quote', 'type' => 'textarea', 'rows' => 3],
                    ['key' => 'field_home_testimonial_featured', 'label' => 'Featured', 'name' => 'featured', 'type' => 'true_false'],
                ],
            ],
        ],
        'location' => [[['param' => 'page_type', 'operator' => '==', 'value' => 'front_page']]],
    ]);
});
