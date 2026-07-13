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
            <?php if ($post->post_excerpt) : ?>
                <p><?php echo esc_html(wp_trim_words($post->post_excerpt, 18)); ?></p>
            <?php endif; ?>
            <a href="<?php echo esc_url(get_permalink($post)); ?>"><?php esc_html_e('View Details', 'jinseal'); ?> <span class="material-symbols-outlined">arrow_forward</span></a>
        </div>
    </article>
    <?php
}

