<?php
/**
 * Configure the shared inquiry form through FluentForm's own model and updater.
 *
 * Run with:
 * wp eval-file wp-content/themes/jinseal/tools/configure-fluentform.php
 */

if (!defined('ABSPATH')) {
    exit;
}

if (
    !class_exists('FluentForm\\App\\Models\\Form') ||
    !class_exists('FluentForm\\App\\Services\\Form\\Updater') ||
    !class_exists('FluentFormPro\\Components\\PhoneField')
) {
    WP_CLI::error('FluentForm and FluentForm Pro must be active.');
}

$form_id = 1;
$form = FluentForm\App\Models\Form::find($form_id);

if (!$form) {
    WP_CLI::error(sprintf('FluentForm %d was not found.', $form_id));
}

$form_fields = json_decode($form->form_fields, true);

if (!is_array($form_fields) || empty($form_fields['fields']) || !is_array($form_fields['fields'])) {
    WP_CLI::error('The FluentForm field definition is invalid.');
}

$remove_fields = static function (array $fields, array $names) use (&$remove_fields): array {
    $filtered = [];

    foreach ($fields as $field) {
        if (($field['element'] ?? '') === 'container' && !empty($field['columns'])) {
            foreach ($field['columns'] as $column_index => $column) {
                $field['columns'][$column_index]['fields'] = $remove_fields(
                    $column['fields'] ?? [],
                    $names
                );
            }
        }

        $name = $field['attributes']['name'] ?? '';
        if ($name && in_array($name, $names, true)) {
            continue;
        }

        $filtered[] = $field;
    }

    return array_values($filtered);
};

$required_message = FluentForm\App\Helpers\Helper::getGlobalDefaultMessage('required');

$phone = (new FluentFormPro\Components\PhoneField())->getComponent();
$phone['attributes']['name'] = 'phone';
$phone['attributes']['placeholder'] = 'Phone Number *';
$phone['settings']['label'] = 'Phone Number';
$phone['settings']['admin_field_label'] = 'Phone Number';
$phone['settings']['validation_rules']['required'] = [
    'value'          => true,
    'message'        => $required_message,
    'global_message' => $required_message,
    'global'         => true,
];

$industry = [
    'index'      => 2,
    'element'    => 'input_text',
    'attributes' => [
        'type'        => 'text',
        'name'        => 'industry',
        'value'       => '',
        'class'       => '',
        'placeholder' => 'Industry (Optional)',
        'maxlength'   => '',
    ],
    'settings'   => [
        'container_class'   => '',
        'label'             => 'Industry',
        'label_placement'   => '',
        'admin_field_label' => 'Industry',
        'help_message'      => '',
        'prefix_label'      => '',
        'suffix_label'      => '',
        'validation_rules'  => [
            'required' => [
                'value'          => false,
                'message'        => $required_message,
                'global_message' => $required_message,
                'global'         => true,
            ],
        ],
        'conditional_logics'        => [],
        'is_unique'                 => 'no',
        'unique_validation_message' => 'This value needs to be unique.',
    ],
    'editor_options' => [
        'title'      => 'Simple Text',
        'icon_class' => 'ff-edit-text',
        'template'   => 'inputText',
    ],
];

$fields = $remove_fields($form_fields['fields'], ['phone', 'industry']);
$insert_at = count($fields);

foreach ($fields as $index => $field) {
    if (($field['element'] ?? '') === 'textarea') {
        $insert_at = $index;
        break;
    }
}

array_splice($fields, $insert_at, 0, [$phone, $industry]);
$form_fields['fields'] = $fields;

(new FluentForm\App\Services\Form\Updater())->update([
    'form_id'    => $form_id,
    'formFields' => wp_json_encode($form_fields),
    'status'     => $form->status ?: 'published',
    'title'      => $form->title,
]);

WP_CLI::success('FluentForm inquiry fields configured: phone required, industry optional.');
