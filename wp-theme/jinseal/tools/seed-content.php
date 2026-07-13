<?php
if (!defined('ABSPATH')) {
    exit;
}

function jinseal_seed_page(string $title, string $slug, array $fields = []): int {
    $page = get_page_by_path($slug);
    if ($page) {
        $post_id = (int) $page->ID;
        wp_update_post([
            'ID' => $post_id,
            'post_title' => $title,
            'post_status' => 'publish',
        ]);
    } else {
        $post_id = wp_insert_post([
            'post_type' => 'page',
            'post_title' => $title,
            'post_name' => $slug,
            'post_status' => 'publish',
        ]);
    }

    foreach ($fields as $key => $value) {
        update_field($key, $value, $post_id);
    }

    return $post_id;
}

function jinseal_seed_term(string $taxonomy, string $name, string $slug, string $description = ''): int {
    $term = term_exists($slug, $taxonomy);
    if ($term) {
        $term_id = (int) $term['term_id'];
        wp_update_term($term_id, $taxonomy, [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
        ]);
    } else {
        $result = wp_insert_term($name, $taxonomy, [
            'slug' => $slug,
            'description' => $description,
        ]);
        if (is_wp_error($result)) {
            WP_CLI::warning($result->get_error_message());
            return 0;
        }
        $term_id = (int) $result['term_id'];
    }

    return $term_id;
}

function jinseal_seed_product(array $data): int {
    $existing = get_page_by_path($data['slug'], OBJECT, 'jinseal_product');
    $postarr = [
        'post_type' => 'jinseal_product',
        'post_title' => $data['title'],
        'post_name' => $data['slug'],
        'post_excerpt' => $data['excerpt'],
        'post_content' => $data['content'],
        'post_status' => 'publish',
    ];

    if ($existing) {
        $postarr['ID'] = (int) $existing->ID;
        $post_id = wp_update_post($postarr);
    } else {
        $post_id = wp_insert_post($postarr);
    }

    if (!is_wp_error($post_id) && $post_id) {
        wp_set_object_terms($post_id, $data['category'], 'jinseal_product_category', false);
        wp_set_object_terms($post_id, $data['industries'], 'jinseal_industry', false);
        update_field('product_label', $data['category_label'], $post_id);
        update_field('product_summary', $data['excerpt'], $post_id);
        update_field('product_features', array_map(fn($item) => ['feature' => $item], $data['features']), $post_id);
        update_field('description_sections', [
            [
                'title' => $data['title'] . ' For Industrial Sealing.',
                'text' => wpautop($data['content']),
                'image' => '',
            ],
        ], $post_id);
    }

    return (int) $post_id;
}

update_field('site_email', 'info@ginseal.com', 'option');
update_field('site_phone', '+86 (0) 574 - 2370 6900', 'option');
update_field('site_fax', '+86 (0) 574 - 6326 1299', 'option');
update_field('site_address', '31 Pengmin Road, Baisha Street, Cixi, Zhejiang 315302 P.R. China', 'option');
update_field('footer_intro', 'JinSeal is a sealing and gasket material manufacturer providing metallic and non-metallic sealing products for global industrial customers since 1997.', 'option');
update_field('fluent_form_shortcode', '[fluentform id="1"]', 'option');

$home_id = jinseal_seed_page('Home', 'home', [
    'hero_eyebrow' => 'Sealing Products Since 1997',
    'hero_title' => 'Your Reliable Sealing & Gasket Material China Manufacturer.',
    'hero_text' => 'One-stop metallic and non-metallic sealing, gasket and material manufacture and solution provider.',
]);

jinseal_seed_page('About', 'about', [
    'hero_eyebrow' => 'About JinSeal',
    'hero_title' => 'High-performance sealing products manufacturer since 1997.',
    'hero_text' => 'From Cixi, China to demanding industrial sites worldwide, JinSeal provides metallic and non-metallic gaskets, gland packing, gasket sheets, sealing materials and tailored sealing solutions.',
]);

jinseal_seed_page('Contact', 'contact', [
    'hero_eyebrow' => 'Contact JinSeal',
    'hero_title' => 'Tell us what you need.',
    'hero_text' => 'Send working medium, temperature, pressure, standard, drawing or quantity. JinSeal can respond with suitable sealing product options.',
]);

update_option('show_on_front', 'page');
update_option('page_on_front', $home_id);

$product_categories = [
    ['Metallic Gasket', 'metallic-gasket'],
    ['Non Metallic Gasket', 'non-metallic-gasket'],
    ['Gasket Sheet', 'gasket-sheet'],
    ['Gland Packing', 'gland-packing'],
    ['Gasket Materials', 'gasket-materials'],
];

foreach ($product_categories as [$name, $slug]) {
    jinseal_seed_term('jinseal_product_category', $name, $slug);
}

$industries = [
    ['Chemical & Petrochemical', 'chemical-petrochemical'],
    ['Food & Beverage', 'food-beverage'],
    ['Mining', 'mining'],
    ['Nuclear', 'nuclear'],
    ['Oil & Gas', 'oil-gas'],
    ['Power Generation', 'power-generation'],
    ['Pulp & Paper', 'pulp-paper'],
    ['Ship Industry', 'ship-industry'],
];

foreach ($industries as [$name, $slug]) {
    jinseal_seed_term('jinseal_industry', $name, $slug, 'JinSeal sealing products for ' . $name . ' applications.');
}

$products = [
    [
        'title' => 'Spiral Wound Gasket',
        'slug' => 'spiral-wound-gasket',
        'category' => 'metallic-gasket',
        'category_label' => 'Metallic Gasket',
        'industries' => ['chemical-petrochemical', 'oil-gas', 'power-generation'],
        'excerpt' => 'A core metallic sealing product for flanges, pressure vessels and high-demand process equipment.',
        'content' => 'Spiral wound gasket is commonly selected for pipelines, heat exchangers, pressure vessels, valves and other industrial flange connections.',
        'features' => ['Stable sealing for flange systems', 'Metal and filler construction', 'Inner and outer ring options', 'Custom size and material support'],
    ],
    [
        'title' => 'Ring Joint Gasket',
        'slug' => 'ring-joint-gasket',
        'category' => 'metallic-gasket',
        'category_label' => 'Metallic Gasket',
        'industries' => ['oil-gas', 'chemical-petrochemical'],
        'excerpt' => 'Metallic gasket option for high-pressure and high-temperature sealing environments.',
        'content' => 'Ring joint gasket supports demanding flange sealing requirements in oil, gas and process applications.',
        'features' => ['High-pressure flange sealing', 'Metallic ring joint design', 'For demanding industrial service'],
    ],
    [
        'title' => 'Kammprofile Gasket',
        'slug' => 'kammprofile-gasket',
        'category' => 'metallic-gasket',
        'category_label' => 'Metallic Gasket',
        'industries' => ['chemical-petrochemical', 'power-generation'],
        'excerpt' => 'Engineered profile gasket for reliable compression and recovery in critical flange applications.',
        'content' => 'Kammprofile gaskets combine a profiled metal core with sealing layers for stable flange performance.',
        'features' => ['Profiled metal core gasket', 'Good compression and recovery', 'For critical flange applications'],
    ],
    [
        'title' => 'PTFE Packing',
        'slug' => 'ptfe-packing',
        'category' => 'gland-packing',
        'category_label' => 'Gland Packing',
        'industries' => ['food-beverage', 'chemical-petrochemical', 'ship-industry'],
        'excerpt' => 'Compression packing for pumps, valves and equipment requiring low-friction chemical resistance.',
        'content' => 'PTFE packing is used for pumps, valves and rotating equipment where chemical resistance and low friction are important.',
        'features' => ['Low-friction packing option', 'For pumps, valves and equipment', 'Good chemical resistance'],
    ],
    [
        'title' => 'Aramid Packing',
        'slug' => 'aramid-packing',
        'category' => 'gland-packing',
        'category_label' => 'Gland Packing',
        'industries' => ['mining', 'ship-industry'],
        'excerpt' => 'Durable gland packing for abrasive service conditions and longer sealing life support.',
        'content' => 'Aramid packing is suitable for abrasive media and demanding industrial maintenance conditions.',
        'features' => ['Durable braided packing', 'For abrasive service conditions', 'Longer sealing life support'],
    ],
    [
        'title' => 'Non-Asbestos Sheet',
        'slug' => 'non-asbestos-sheet',
        'category' => 'gasket-sheet',
        'category_label' => 'Gasket Sheet',
        'industries' => ['chemical-petrochemical', 'food-beverage', 'pulp-paper'],
        'excerpt' => 'Sheet material for cutting industrial sealing gaskets without asbestos content.',
        'content' => 'Non-asbestos sheet material supports gasket cutting for broad industrial flange and equipment applications.',
        'features' => ['Sheet for gasket cutting', 'Non-asbestos sealing material', 'For broad industrial applications'],
    ],
    [
        'title' => 'Graphite Sheet',
        'slug' => 'graphite-sheet',
        'category' => 'gasket-materials',
        'category_label' => 'Gasket Materials',
        'industries' => ['power-generation', 'chemical-petrochemical'],
        'excerpt' => 'Flexible graphite sheet material for high-temperature sealing and gasket fabrication.',
        'content' => 'Graphite sheet is used for high-temperature sealing support and gasket fabrication.',
        'features' => ['Flexible graphite sheet material', 'High-temperature sealing support', 'For gasket fabrication'],
    ],
    [
        'title' => 'Gasket Hoop',
        'slug' => 'gasket-hoop',
        'category' => 'gasket-materials',
        'category_label' => 'Gasket Materials',
        'industries' => ['chemical-petrochemical', 'oil-gas'],
        'excerpt' => 'Semi-finished gasket material for spiral wound gasket production and sealing manufacturers.',
        'content' => 'Gasket hoop is supplied as semi-finished material for spiral wound gasket production.',
        'features' => ['Semi-finished gasket material', 'For spiral wound gasket production', 'Stable supply for manufacturers'],
    ],
];

foreach ($products as $product) {
    jinseal_seed_product($product);
}

flush_rewrite_rules();
WP_CLI::success('JinSeal content seeded.');

