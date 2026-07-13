<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACF fields from PHP and mirror them into the ACF admin database.
 * PHP remains the source of truth while editors can see the groups in wp-admin.
 */
function jinseal_register_acf_field_group(array $field_group): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group($field_group);

    if (
        empty($field_group['key']) ||
        !function_exists('acf_import_field_group') ||
        !function_exists('acf_get_raw_field_group')
    ) {
        return;
    }

    $schema_hash = md5(wp_json_encode($field_group));
    $option_name = 'jinseal_acf_schema_' . md5($field_group['key']);
    $stored_hash = (string) get_option($option_name, '');
    $database_group = acf_get_raw_field_group($field_group['key']);

    if ($database_group && $stored_hash === $schema_hash) {
        return;
    }

    if ($database_group && !empty($database_group['ID'])) {
        $field_group['ID'] = (int) $database_group['ID'];
    }

    $saved_group = acf_import_field_group($field_group);
    if (is_array($saved_group) && !empty($saved_group['ID'])) {
        update_option($option_name, $schema_hash, false);
    }
}
