<?php
if (!defined('ABSPATH')) {
    exit;
}

function jinseal_media_map(): array {
    $map = [];
    $attachments = get_posts([
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'post_mime_type' => 'image/webp',
        'posts_per_page' => -1,
    ]);

    foreach ($attachments as $attachment) {
        $file = get_attached_file($attachment->ID);
        if (!$file) {
            continue;
        }
        $map[pathinfo($file, PATHINFO_FILENAME)] = (int) $attachment->ID;
    }

    return $map;
}

function jinseal_media_id(array $map, string $name): int {
    return (int) ($map[$name] ?? 0);
}

$media = jinseal_media_map();
if (!$media) {
    WP_CLI::error('No WebP attachments found. Import media before running assign-media.php.');
}

update_field('site_logo', jinseal_media_id($media, 'jinseal-logo'), 'option');
update_field('inquiry_background', jinseal_media_id($media, 'jinseal-cta'), 'option');
update_field('products_archive_hero_image', jinseal_media_id($media, 'jinseal-hero'), 'option');

$home = get_page_by_path('home');
if ($home) {
    update_field('hero_image', jinseal_media_id($media, 'jinseal-hero'), $home->ID);
    update_field('home_about_image', jinseal_media_id($media, 'jinseal-cta'), $home->ID);
}

$about = get_page_by_path('about');
if ($about) {
    update_field('hero_image', jinseal_media_id($media, 'jinseal-hero'), $about->ID);
    update_field('about_story_image', jinseal_media_id($media, 'factory-1'), $about->ID);
    $gallery = [];
    foreach (range(1, 6) as $index) {
        $image_id = jinseal_media_id($media, 'factory-' . $index);
        if ($image_id) {
            $gallery[] = $image_id;
        }
    }
    update_field('about_facility_gallery', $gallery, $about->ID);
}

$contact = get_page_by_path('contact');
if ($contact) {
    update_field('hero_image', jinseal_media_id($media, 'jinseal-cta'), $contact->ID);
}

$industry_images = [
    'chemical-petrochemical' => 'industry-chemical-petrochemical',
    'food-beverage' => 'industry-food-beverage',
    'mining' => 'industry-mining',
    'nuclear' => 'industry-power-generation',
    'oil-gas' => 'industry-oil-gas',
    'power-generation' => 'industry-power-generation',
    'pulp-paper' => 'industry-pulp-paper',
    'ship-industry' => 'industry-ship',
];
foreach ($industry_images as $slug => $image_name) {
    $term = get_term_by('slug', $slug, 'jinseal_industry');
    if ($term) {
        update_field('hero_image', jinseal_media_id($media, $image_name), 'jinseal_industry_' . $term->term_id);
    }
}

$category_images = [
    'metallic-gasket' => 'product-spiral-wound-gasket',
    'non-metallic-gasket' => 'product-non-asbestos-sheet',
    'gasket-sheet' => 'product-non-asbestos-sheet',
    'gland-packing' => 'product-ptfe-packing',
    'gasket-materials' => 'product-gasket-hoop',
];
foreach ($category_images as $slug => $image_name) {
    $term = get_term_by('slug', $slug, 'jinseal_product_category');
    if ($term) {
        update_field('hero_image', jinseal_media_id($media, $image_name), 'jinseal_product_category_' . $term->term_id);
    }
}

$product_images = [
    'spiral-wound-gasket' => ['product-spiral-wound-gasket', 'product-ring-joint-gasket', 'product-kammprofile-gasket'],
    'ring-joint-gasket' => ['product-ring-joint-gasket', 'product-spiral-wound-gasket', 'product-kammprofile-gasket'],
    'kammprofile-gasket' => ['product-kammprofile-gasket', 'product-spiral-wound-gasket', 'product-ring-joint-gasket'],
    'ptfe-packing' => ['product-ptfe-packing', 'product-aramid-packing', 'product-non-asbestos-sheet'],
    'aramid-packing' => ['product-aramid-packing', 'product-ptfe-packing', 'product-gasket-hoop'],
    'non-asbestos-sheet' => ['product-non-asbestos-sheet', 'product-graphite-sheet', 'product-ptfe-packing'],
    'graphite-sheet' => ['product-graphite-sheet', 'product-non-asbestos-sheet', 'product-gasket-hoop'],
    'gasket-hoop' => ['product-gasket-hoop', 'product-spiral-wound-gasket', 'product-graphite-sheet'],
];

foreach ($product_images as $slug => $image_names) {
    $product = get_page_by_path($slug, OBJECT, 'jinseal_product');
    if (!$product) {
        continue;
    }

    $gallery = array_values(array_filter(array_map(fn($name) => jinseal_media_id($media, $name), $image_names)));
    if ($gallery) {
        set_post_thumbnail($product->ID, $gallery[0]);
        update_field('product_gallery', $gallery, $product->ID);
    }

    $sections = get_field('description_sections', $product->ID);
    if ($gallery && is_array($sections) && $sections) {
        foreach ($sections as $index => &$section) {
            $section['image'] = $gallery[$index % count($gallery)] ?? 0;
        }
        unset($section);
        update_field('description_sections', $sections, $product->ID);
    }

    $categories = wp_get_post_terms($product->ID, 'jinseal_product_category', ['fields' => 'ids']);
    $related = get_posts([
        'post_type' => 'jinseal_product',
        'posts_per_page' => 3,
        'post__not_in' => [$product->ID],
        'tax_query' => $categories ? [[
            'taxonomy' => 'jinseal_product_category',
            'field' => 'term_id',
            'terms' => $categories,
        ]] : [],
    ]);
    update_field('related_products', array_map(fn($post) => $post->ID, $related), $product->ID);
}

WP_CLI::success('JinSeal media assigned to options, pages, terms and products.');
