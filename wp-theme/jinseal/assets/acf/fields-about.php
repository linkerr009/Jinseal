<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    jinseal_register_acf_field_group([
        'key' => 'group_jinseal_about_fields',
        'title' => 'About Page Modules',
        'fields' => [
            [
                'key' => 'field_about_hero_facts',
                'label' => 'Hero Facts',
                'name' => 'about_hero_facts',
                'type' => 'repeater',
                'layout' => 'table',
                'sub_fields' => [
                    ['key' => 'field_about_hero_fact_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text'],
                    ['key' => 'field_about_hero_fact_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text'],
                ],
            ],
            ['key' => 'field_about_story_eyebrow', 'label' => 'Story Eyebrow', 'name' => 'about_story_eyebrow', 'type' => 'text'],
            ['key' => 'field_about_story_title', 'label' => 'Story Title', 'name' => 'about_story_title', 'type' => 'text'],
            ['key' => 'field_about_story_text_one', 'label' => 'Story Paragraph One', 'name' => 'about_story_text_one', 'type' => 'textarea', 'rows' => 4],
            ['key' => 'field_about_story_text_two', 'label' => 'Story Paragraph Two', 'name' => 'about_story_text_two', 'type' => 'textarea', 'rows' => 4],
            ['key' => 'field_about_story_image', 'label' => 'Story Image', 'name' => 'about_story_image', 'type' => 'image', 'return_format' => 'id', 'preview_size' => 'medium'],
            ['key' => 'field_about_story_card_label', 'label' => 'Story Card Label', 'name' => 'about_story_card_label', 'type' => 'text'],
            ['key' => 'field_about_story_card_value', 'label' => 'Story Card Value', 'name' => 'about_story_card_value', 'type' => 'text'],
            ['key' => 'field_about_process_eyebrow', 'label' => 'Process Eyebrow', 'name' => 'about_process_eyebrow', 'type' => 'text'],
            ['key' => 'field_about_process_title', 'label' => 'Process Title', 'name' => 'about_process_title', 'type' => 'text'],
            ['key' => 'field_about_process_text', 'label' => 'Process Text', 'name' => 'about_process_text', 'type' => 'textarea', 'rows' => 3],
            [
                'key' => 'field_about_process_items',
                'label' => 'Process Items',
                'name' => 'about_process_items',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_about_process_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'text'],
                    ['key' => 'field_about_process_item_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_about_process_item_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 3],
                ],
            ],
            ['key' => 'field_about_facility_gallery', 'label' => 'Facility Gallery', 'name' => 'about_facility_gallery', 'type' => 'gallery', 'return_format' => 'id', 'preview_size' => 'medium'],
            ['key' => 'field_about_facility_eyebrow', 'label' => 'Facility Eyebrow', 'name' => 'about_facility_eyebrow', 'type' => 'text'],
            ['key' => 'field_about_facility_title', 'label' => 'Facility Title', 'name' => 'about_facility_title', 'type' => 'text'],
            ['key' => 'field_about_facility_text', 'label' => 'Facility Text', 'name' => 'about_facility_text', 'type' => 'textarea', 'rows' => 4],
            [
                'key' => 'field_about_facility_features',
                'label' => 'Facility Features',
                'name' => 'about_facility_features',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_about_facility_feature_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'text'],
                    ['key' => 'field_about_facility_feature_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_about_facility_feature_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 2],
                ],
            ],
            ['key' => 'field_about_values_eyebrow', 'label' => 'Values Eyebrow', 'name' => 'about_values_eyebrow', 'type' => 'text'],
            ['key' => 'field_about_values_title', 'label' => 'Values Title', 'name' => 'about_values_title', 'type' => 'text'],
            ['key' => 'field_about_values_text', 'label' => 'Values Text', 'name' => 'about_values_text', 'type' => 'textarea', 'rows' => 3],
            [
                'key' => 'field_about_values_items',
                'label' => 'Value Items',
                'name' => 'about_values_items',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_about_value_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'text'],
                    ['key' => 'field_about_value_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_about_value_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 3],
                ],
            ],
            ['key' => 'field_about_quality_eyebrow', 'label' => 'Quality Eyebrow', 'name' => 'about_quality_eyebrow', 'type' => 'text'],
            ['key' => 'field_about_quality_title', 'label' => 'Quality Title', 'name' => 'about_quality_title', 'type' => 'text'],
            ['key' => 'field_about_quality_text', 'label' => 'Quality Text', 'name' => 'about_quality_text', 'type' => 'textarea', 'rows' => 4],
            ['key' => 'field_about_recognition_title', 'label' => 'Recognition Title', 'name' => 'about_recognition_title', 'type' => 'text'],
            [
                'key' => 'field_about_recognition_items',
                'label' => 'Recognition Items',
                'name' => 'about_recognition_items',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_about_recognition_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 2],
                ],
            ],
            ['key' => 'field_about_milestones_eyebrow', 'label' => 'Milestones Eyebrow', 'name' => 'about_milestones_eyebrow', 'type' => 'text'],
            ['key' => 'field_about_milestones_title', 'label' => 'Milestones Title', 'name' => 'about_milestones_title', 'type' => 'text'],
            ['key' => 'field_about_milestones_text', 'label' => 'Milestones Text', 'name' => 'about_milestones_text', 'type' => 'textarea', 'rows' => 3],
            [
                'key' => 'field_about_milestones',
                'label' => 'Milestones',
                'name' => 'about_milestones',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    ['key' => 'field_about_milestone_month', 'label' => 'Month', 'name' => 'month', 'type' => 'text'],
                    ['key' => 'field_about_milestone_year', 'label' => 'Year', 'name' => 'year', 'type' => 'text'],
                    ['key' => 'field_about_milestone_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 3],
                ],
            ],
            ['key' => 'field_about_industries_eyebrow', 'label' => 'Industries Eyebrow', 'name' => 'about_industries_eyebrow', 'type' => 'text'],
            ['key' => 'field_about_industries_title', 'label' => 'Industries Title', 'name' => 'about_industries_title', 'type' => 'text'],
            ['key' => 'field_about_industries_text', 'label' => 'Industries Text', 'name' => 'about_industries_text', 'type' => 'textarea', 'rows' => 3],
        ],
        'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php']]],
    ]);
});
