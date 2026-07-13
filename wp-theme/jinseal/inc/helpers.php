<?php
if (!defined('ABSPATH')) {
    exit;
}

function jinseal_acf_value(string $key, $post_id = null, $default = '') {
    if (function_exists('get_field')) {
        $value = get_field($key, $post_id);
        if ($value !== null && $value !== false && $value !== '') {
            return $value;
        }
    }
    return $default;
}

function jinseal_option(string $key, $default = '') {
    return jinseal_acf_value($key, 'option', $default);
}

function jinseal_image($image, string $size = 'large', array $attr = []): string {
    if (is_array($image) && isset($image['ID'])) {
        return wp_get_attachment_image((int) $image['ID'], $size, false, $attr);
    }

    if (is_numeric($image)) {
        return wp_get_attachment_image((int) $image, $size, false, $attr);
    }

    return '';
}

function jinseal_image_url($image, string $size = 'full'): string {
    if (is_array($image) && isset($image['ID'])) {
        $image = (int) $image['ID'];
    }

    if (!is_numeric($image)) {
        return '';
    }

    return (string) wp_get_attachment_image_url((int) $image, $size);
}

function jinseal_field_rows(string $key, $post_id = null, array $default = []): array {
    $rows = jinseal_acf_value($key, $post_id, $default);
    return is_array($rows) ? $rows : $default;
}

function jinseal_term_image(string $field, WP_Term $term, string $size = 'large', array $attr = []): string {
    return jinseal_image(jinseal_acf_value($field, $term), $size, $attr);
}

function jinseal_page_url(string $slug, string $fallback = '#'): string {
    $page = get_page_by_path($slug);
    return $page ? get_permalink($page) : $fallback;
}

function jinseal_products_url(): string {
    return get_post_type_archive_link('jinseal_product') ?: jinseal_page_url('products', '#');
}

function jinseal_product_card(WP_Post $post): void {
    ?>
    <article class="products-card" data-keywords="<?php echo esc_attr($post->post_title . ' ' . wp_strip_all_tags($post->post_excerpt)); ?>">
        <div class="products-card__media">
            <a href="<?php echo esc_url(get_permalink($post)); ?>">
                <?php echo get_the_post_thumbnail($post, 'medium_large', ['loading' => 'lazy']); ?>
            </a>
        </div>
        <div class="products-card__body">
            <?php
            $terms = get_the_terms($post, 'jinseal_product_category');
            if ($terms && !is_wp_error($terms)) : ?>
                <p class="products-card__label"><?php echo esc_html($terms[0]->name); ?></p>
            <?php endif; ?>
            <h3><?php echo esc_html(get_the_title($post)); ?></h3>
            <?php $features = jinseal_field_rows('product_features', $post->ID); ?>
            <?php if ($features) : ?>
                <ul>
                    <?php foreach (array_slice($features, 0, 3) as $feature) : ?>
                        <li><?php echo esc_html($feature['feature'] ?? ''); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php elseif ($post->post_excerpt) : ?>
                <p><?php echo esc_html(wp_trim_words($post->post_excerpt, 18)); ?></p>
            <?php endif; ?>
            <a href="<?php echo esc_url(get_permalink($post)); ?>"><?php esc_html_e('View Details', 'jinseal'); ?> <span class="material-symbols-outlined">arrow_forward</span></a>
        </div>
    </article>
    <?php
}
