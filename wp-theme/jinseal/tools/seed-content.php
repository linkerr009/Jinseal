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
        wp_set_object_terms($post_id, $data['categories'] ?? [$data['category']], 'jinseal_product_category', false);
        wp_set_object_terms($post_id, $data['industries'], 'jinseal_industry', false);
        update_field('product_label', $data['category_label'], $post_id);
        update_field('product_overview_title', $data['overview_title'] ?? ($data['title'] . ' For Industrial Sealing.'), $post_id);
        update_field('product_summary', $data['excerpt'], $post_id);
        update_field('product_features', array_map(fn($item) => ['feature' => $item], $data['features']), $post_id);
        update_field('description_sections', $data['description_sections'] ?? [
            [
                'title' => $data['title'] . ' For Industrial Sealing.',
                'text' => wpautop($data['content']),
                'image' => '',
            ],
        ], $post_id);
        update_field('product_specs', $data['specs'] ?? [
            ['name' => 'Product Name', 'value' => $data['title']],
            ['name' => 'Category', 'value' => $data['category_label']],
            ['name' => 'Customization', 'value' => 'Size, material, standard, packaging and OEM supply'],
        ], $post_id);
        update_field('product_applications_intro', $data['applications_intro'] ?? 'JinSeal supports product selection according to working medium, temperature, pressure, equipment and industry requirements.', $post_id);
        update_field('product_faq', $data['faq'] ?? [
            ['question' => 'Can this product be customized by drawing?', 'answer' => 'Yes. JinSeal can produce according to drawings, standards, size requirements and project working conditions.'],
            ['question' => 'What information should I provide for quotation?', 'answer' => 'Please share product size, standard, material preference, working medium, temperature, pressure, order quantity and available drawings or photos.'],
            ['question' => 'Is OEM or long-term supply available?', 'answer' => 'Yes. JinSeal supports industrial buyers, OEM customers and distributors with regular sealing product supply.'],
        ], $post_id);
    }

    return (int) $post_id;
}

update_field('site_email', 'info@ginseal.com', 'option');
update_field('site_phone', '+86 (0) 574 - 2370 6900', 'option');
update_field('site_fax', '+86 (0) 574 - 6326 1299', 'option');
update_field('site_address', '31 Pengmin Road, Baisha Street, Cixi, Zhejiang 315302 P.R. China', 'option');
update_field('footer_intro', 'JinSeal is a sealing and gasket material manufacturer providing metallic and non-metallic sealing products for global industrial customers since 1997.', 'option');
update_field('footer_badges', [['text' => 'ISO 9001'], ['text' => 'Since 1997'], ['text' => 'China Manufacturer']], 'option');
update_field('inquiry_eyebrow', 'Send Inquiry', 'option');
update_field('inquiry_title', 'Need help choosing a sealing product?', 'option');
update_field('inquiry_text', 'Share your working medium, temperature, pressure, flange standard or drawing. JinSeal can recommend suitable gasket, packing, sheet material or sealing accessories for your project.', 'option');
update_field('inquiry_extra_text', 'For gasket or packing inquiries, include product size, material preference, order quantity and any available drawings or sample photos so our team can respond more efficiently.', 'option');
update_field('inquiry_stats', [
    ['label' => 'Response', 'value' => 'Fast Quote'],
    ['label' => 'Support', 'value' => 'Material Advice'],
    ['label' => 'Supply', 'value' => 'OEM / ODM'],
], 'option');
update_field('inquiry_checklist', [
    ['icon' => 'science', 'text' => 'Working medium'],
    ['icon' => 'device_thermostat', 'text' => 'Temp / pressure'],
    ['icon' => 'straighten', 'text' => 'Size / standard'],
    ['icon' => 'description', 'text' => 'Drawing / quantity'],
], 'option');
update_field('products_archive_title', 'Sealing products for demanding industrial applications.', 'option');
update_field('products_archive_text', 'Explore JinSeal metallic gaskets, non-metallic gaskets, gland packing, gasket sheets and gasket materials for process, energy and OEM equipment.', 'option');
update_field('products_intro_title', 'One-stop sealing product categories.', 'option');
update_field('products_intro_text', 'JinSeal supports industrial buyers with a practical range of gasket, packing, sheet and sealing material options. Use the category links to browse each product range, then send your working condition for a recommendation or quotation.', 'option');
update_field('products_seo_title', 'Industrial sealing product categories from JinSeal.', 'option');
update_field('products_seo_content', '<p>JinSeal supplies a broad range of sealing products for chemical, petrochemical, refining, power generation, pulp and paper, food, pharmaceutical, mining and OEM equipment applications. This product category page covers metallic gaskets, non-metallic gaskets, gland packing, gasket sheets, gasket materials and sealing accessories.</p><p>Product selection can be based on application conditions, material compatibility, flange standards, temperature and pressure requirements, production capability and quotation guidance.</p>', 'option');
update_field('fluent_form_shortcode', '[fluentform id="1"]', 'option');

$home_id = jinseal_seed_page('Home', 'home', [
    'hero_eyebrow' => 'Sealing Products Since 1997',
    'hero_title' => 'Your Reliable Sealing & Gasket Material China Manufacturer.',
    'hero_text' => 'One-stop metallic and non-metallic sealing, gasket and material manufacture and solution provider.',
    'home_hero_badges' => [['text' => 'Sealing Products Since 1997'], ['text' => 'ISO 9001 Quality System']],
    'home_hero_secondary_text' => 'JinSeal supplies gaskets, gland packing, sealing sheets, semi-finished products, sealing machines and sealing accessories for global industrial customers.',
    'home_trust_items' => [
        ['icon' => 'verified_user', 'text' => 'Quality Sealing Partner', 'primary' => 1],
        ['icon' => 'history', 'text' => 'Established in 1997', 'primary' => 0],
        ['icon' => 'assignment_turned_in', 'text' => 'ISO 9001 Certified', 'primary' => 0],
        ['icon' => 'public', 'text' => 'Worldwide Supply', 'primary' => 0],
    ],
    'home_about_eyebrow' => 'About JinSeal',
    'home_about_title' => 'JinSeal Sealing Solutions: Your Sealing Products Manufacturer',
    'home_about_text' => 'JinSeal has been involved in sealing products manufacturing since 1997, efficiently providing quality sealing products to customers in China and around the world.',
    'home_about_points' => [
        ['title' => 'Broad product range', 'text' => 'Metallic gaskets, non-metallic gaskets, gland packing, gasket sheets, semi-finished materials, sealing machines and accessories.'],
        ['title' => 'Industrial focus', 'text' => 'Products are used in chemicals, petrochemicals, refining, pulp and paper, power generation, food, pharmaceuticals, mining and OEM applications.'],
        ['title' => 'Quality first', 'text' => 'JinSeal has developed a strict quality management system to satisfy customer requirements and expectations.'],
    ],
    'home_about_badge_label' => 'Production Base',
    'home_about_badge_value' => 'Cixi, Zhejiang, China',
    'home_products_eyebrow' => 'Product Range',
    'home_products_title' => 'Our Sealing Products',
    'home_products_text' => 'One-stop selection of gasket, packing and sheet materials for demanding industrial sealing applications.',
    'home_quality_eyebrow' => 'Quality Control',
    'home_quality_title' => 'Quality - What We Care',
    'home_quality_text' => 'JinSeal focuses on dependable materials, stable manufacturing and practical sealing solutions for industrial buyers.',
    'home_quality_items' => [
        ['icon' => 'inventory_2', 'title' => 'Complete Product Coverage', 'text' => 'Flange gaskets, rubber seals, PTFE gaskets, EPDM gaskets, spiral wound gaskets, compression packing and graphite sheets.'],
        ['icon' => 'fact_check', 'title' => 'Strict Quality Management', 'text' => 'Quality control is built to better satisfy requirements and expectations from customers.'],
        ['icon' => 'workspace_premium', 'title' => 'Industry Recognition', 'text' => 'JinSeal is an ISO 9001 certified sealing company and a member of static sealing industry organizations.'],
        ['icon' => 'language', 'title' => 'Global Customer Base', 'text' => 'Products are popular in America, the UK, Germany, Italy, Canada, Australia and Southeast Asia.'],
        ['icon' => 'engineering', 'title' => 'Solution Support', 'text' => 'The team supports mechanical seals, oil seals, hydraulic seals, packing seals, pneumatic seals and fluid sealing needs.'],
        ['icon' => 'handshake', 'title' => 'Distributor Cooperation', 'text' => 'JinSeal welcomes cooperation with local brand agents and long-term sealing product partners.'],
    ],
    'home_industries_eyebrow' => 'Industry',
    'home_industries_title' => 'Application Industry',
    'home_industries_text' => 'JinSeal sealing products are used across demanding process, energy and manufacturing industries.',
    'home_stories_eyebrow' => 'Customer Voice',
    'home_stories_title' => "Customer's Stories",
    'home_stories_text' => 'Feedback from international buyers working with JinSeal sealing products, stable supply and project support.',
    'home_stories_button' => 'Send Inquiry',
    'home_testimonials' => [
        ['initial' => 'R', 'name' => 'Ron Burnwood', 'role' => 'Industrial Buyer', 'quote' => 'I am so glad cooperation with JinSeal 5 years. Ms. Lynne supplies stable quality and helps me solve important and urgent problems.', 'featured' => 0],
        ['initial' => 'L', 'name' => 'Lily Granger', 'role' => 'Project Buyer', 'quote' => 'As a buyer, JinSeal supports our projects team very well and our customers are satisfied.', 'featured' => 1],
        ['initial' => 'J', 'name' => 'Jeson Foxx', 'role' => 'Purchaser', 'quote' => 'Reliable supplier is important for purchasers. JinSeal is a dependable sealing product partner.', 'featured' => 0],
    ],
]);

$about_id = jinseal_seed_page('About', 'about', [
    'hero_eyebrow' => 'About JinSeal',
    'hero_title' => 'High-performance sealing products manufacturer since 1997.',
    'hero_text' => 'From Cixi, China to demanding industrial sites worldwide, JinSeal provides metallic and non-metallic gaskets, gland packing, gasket sheets, sealing materials and tailored sealing solutions.',
]);

$contact_id = jinseal_seed_page('Contact', 'contact', [
    'hero_eyebrow' => 'Contact JinSeal',
    'hero_title' => 'Tell us about your sealing project.',
    'hero_text' => 'Send working medium, temperature, pressure, standard, drawing or quantity. JinSeal can respond with suitable sealing product options.',
]);

update_post_meta($about_id, '_wp_page_template', 'page-about.php');
update_post_meta($contact_id, '_wp_page_template', 'page-contact.php');

$about_fields = [
    'about_hero_facts' => [
        ['value' => '8,000+', 'label' => 'sqm production base'],
        ['value' => 'ISO 9001', 'label' => 'quality management'],
        ['value' => 'Global', 'label' => 'industrial supply'],
    ],
    'about_story_eyebrow' => 'Our Story',
    'about_story_title' => "One of China's experienced sealing products manufacturers.",
    'about_story_text_one' => 'JinSeal has been acknowledged as a leading manufacturer of high-performance sealing products since its establishment in 1997 in Cixi, China. With a production base of over 8,000 sqm and advanced machinery and facilities, JinSeal offers customers both high-standard products and individually tailored sealing solutions.',
    'about_story_text_two' => 'After years of development, JinSeal has built an extensive global client base. Its products are widely used in chemicals and petrochemicals, refining, pulp and paper, power generation, semiconductor, primary metals, food and pharmaceuticals, mining and OEM applications.',
    'about_story_card_label' => 'Certified Quality',
    'about_story_card_value' => 'ISO 9001 since 2000',
    'about_process_eyebrow' => 'What We Do',
    'about_process_title' => 'End-to-end sealing manufacturing support.',
    'about_process_text' => 'From product recommendation to delivery support, JinSeal keeps the sealing supply process clear, practical and quality-focused.',
    'about_process_items' => [
        ['icon' => 'design_services', 'title' => 'Product Engineering', 'text' => 'Recommend suitable gasket, packing, sheet material or accessory options based on medium, temperature, pressure, flange standard and drawings.'],
        ['icon' => 'precision_manufacturing', 'title' => 'Manufacturing', 'text' => 'Produce metallic gaskets, non-metallic gaskets, gland packing, gasket sheets, gasket materials and related sealing accessories.'],
        ['icon' => 'fact_check', 'title' => 'Quality Control', 'text' => 'Monitor low return levels, delivery performance and customer satisfaction through a strict quality management system.'],
        ['icon' => 'local_shipping', 'title' => 'Global Supply', 'text' => 'Support industrial buyers, OEM customers and distributors with stable sealing product supply and project communication.'],
    ],
    'about_facility_eyebrow' => 'Our Facility',
    'about_facility_title' => 'Production base in Cixi, Zhejiang, China.',
    'about_facility_text' => "JinSeal's production base is supported by advanced machinery and facilities for industrial sealing products. The company continuously improves product quality, manufacturing efficiency and customized solution capability.",
    'about_facility_features' => [
        ['icon' => 'factory', 'title' => 'Advanced Equipment', 'text' => 'Machinery and facilities for a broad sealing product range.'],
        ['icon' => 'inventory_2', 'title' => 'Broad Product Range', 'text' => 'Gaskets, packing, sheets, semi-finished materials and accessories.'],
        ['icon' => 'groups', 'title' => 'Experienced Team', 'text' => 'Long-term sealing know-how for industrial and OEM customers.'],
    ],
    'about_values_eyebrow' => 'Brand Values',
    'about_values_title' => 'We Seal, You Smile.',
    'about_values_text' => "JinSeal's mission is to deliver world-class sealing solutions. Its brand values are trust, leadership and sustainability.",
    'about_values_items' => [
        ['icon' => 'handshake', 'title' => 'Trust', 'text' => 'JinSeal builds trust through quality, safety and reliability, creating value with customized solutions and consistent product performance.'],
        ['icon' => 'workspace_premium', 'title' => 'Leadership', 'text' => 'As an active member of sealing industry associations, JinSeal keeps investing in product innovation and international expansion.'],
        ['icon' => 'eco', 'title' => 'Sustainability', 'text' => 'Continuity matters in durable sealing products and environmental commitment, supporting long-term win-win cooperation.'],
    ],
    'about_quality_eyebrow' => 'Quality Assurance',
    'about_quality_title' => 'Quality has always been the key.',
    'about_quality_text' => 'JinSeal continually monitors progress toward perfection through quality indicators including low return levels, strong delivery performance and high customer satisfaction.',
    'about_recognition_title' => 'Industry Recognition',
    'about_recognition_items' => [
        ['text' => 'Executive member of the Static Sealing Branch of CHPSA and Cixi Seal Association.'],
        ['text' => 'Involved in drafting and reviewing national sealing machinery standards.'],
        ['text' => 'Elected as president member of Cixi Seal Association in 2006.'],
        ['text' => 'Elected as member of CHPSA in 2009 and vice president member of the Machinery and Filling Static Sealing Branch in 2010.'],
    ],
    'about_milestones_eyebrow' => 'Milestones',
    'about_milestones_title' => "Key moments in JinSeal's development.",
    'about_milestones_text' => 'From registration and quality certification to international offices and brand upgrade, these milestones show the long-term development of JinSeal.',
    'about_milestones' => [
        ['month' => 'Apr', 'year' => '2013', 'text' => 'Redesign and update company image and CIS (corporate identity system) for a much more vibrant future.'],
        ['month' => 'Jan', 'year' => '2013', 'text' => 'Representative office was set up in Stuttgart, Germany.'],
        ['month' => 'Dec', 'year' => '2012', 'text' => 'Invested in Siyang, China by purchasing 150 acres of industrial land and setting up a joint venture company, with more advanced facilities and larger product range.'],
        ['month' => 'May', 'year' => '2012', 'text' => 'Newly invented metal and vermiculite composite gasket obtained national patent.'],
        ['month' => 'Dec', 'year' => '2011', 'text' => 'Representative office was set up in Sydney, Australia.'],
        ['month' => 'Jun', 'year' => '2010', 'text' => 'Elected as a vice president member of the Machinery and Filling Static Sealing Branch of CHPSA.'],
        ['month' => 'Dec', 'year' => '2009', 'text' => 'Elected as a member of CHPSA.'],
        ['month' => 'May', 'year' => '2008', 'text' => 'CEO Mr Shengbo Ye was elected as a member of China Packing and Sealing Standardization Committee.'],
        ['month' => 'Jan', 'year' => '2007', 'text' => 'Elected as the president member of Cixi Seal Association.'],
        ['month' => 'Jan', 'year' => '2006', 'text' => 'Elected as a vice president member of Cixi Seal Association.'],
        ['month' => 'Jul', 'year' => '2005', 'text' => 'Plant and headquarters building established in Henghe Industrial Zone, Cixi, China.'],
        ['month' => 'Nov', 'year' => '2002', 'text' => 'Elected as a member of the Machinery and Filling Static Sealing Branch of CHPSA.'],
        ['month' => 'Mar', 'year' => '2001', 'text' => 'In the first batch to obtain Safety Certificate and Special Equipment Manufacturing License.'],
        ['month' => 'Sep', 'year' => '2000', 'text' => 'Certified with ISO 9001.'],
        ['month' => 'Mar', 'year' => '2000', 'text' => 'Plant established in Hushan, Cixi, China.'],
        ['month' => 'Nov', 'year' => '1998', 'text' => 'Awarded for excellent quality by the State Administration of Machinery Industry.'],
        ['month' => 'Dec', 'year' => '1997', 'text' => 'Officially registered and established.'],
    ],
    'about_industries_eyebrow' => 'Industries We Serve',
    'about_industries_title' => 'Sealing solutions for demanding sectors.',
    'about_industries_text' => 'JinSeal products are used across process, energy, manufacturing and OEM applications.',
];
foreach ($about_fields as $key => $value) {
    update_field($key, $value, $about_id);
}

$contact_fields = [
    'contact_hero_panels' => [
        ['icon' => 'schedule', 'title' => 'Fast Response', 'text' => 'Inquiry review for industrial sealing product needs.'],
        ['icon' => 'engineering', 'title' => 'Technical Support', 'text' => 'Material suggestions based on working conditions.'],
    ],
    'contact_inquiry_extra_text' => 'For gasket or packing inquiries, include product size, material preference, order quantity and any available drawings or sample photos so our team can respond more efficiently.',
    'contact_map_eyebrow' => 'Visit & Cooperation',
    'contact_map_title' => 'Find JinSeal in Cixi, Zhejiang.',
    'contact_map_text' => 'Use the map for location reference, or contact us directly for factory visit and sealing product cooperation.',
    'contact_map_url' => 'https://www.openstreetmap.org/export/embed.html?bbox=121.236%2C30.145%2C121.296%2C30.195&layer=mapnik&marker=30.17078%2C121.266595',
];
foreach ($contact_fields as $key => $value) {
    update_field($key, $value, $contact_id);
}

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
    $term_id = jinseal_seed_term('jinseal_product_category', $name, $slug);
    $term_ref = 'jinseal_product_category_' . $term_id;
    update_field('hero_text', $name . ' products for industrial sealing, maintenance, equipment manufacturing and project supply.', $term_ref);
    update_field('archive_intro_eyebrow', 'Product Category', $term_ref);
    update_field('intro_title', $name . ' Products', $term_ref);
    update_field('intro_text', 'Browse JinSeal ' . strtolower($name) . ' options, review product features and send your working conditions for material selection or quotation support.', $term_ref);
    update_field('seo_eyebrow', 'SEO Content Area', $term_ref);
    update_field('seo_title', $name . ' Products from JinSeal.', $term_ref);
    update_field('long_content', '<p>JinSeal supplies ' . esc_html(strtolower($name)) . ' products for industrial flange, equipment, maintenance and OEM applications. Product selection can be based on working medium, temperature, pressure, standard, size and material requirements.</p><p>Send available drawings, sample photos or technical requirements for quotation and product recommendation.</p>', $term_ref);
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
    $term_id = jinseal_seed_term('jinseal_industry', $name, $slug, 'JinSeal sealing products for ' . $name . ' applications.');
    $term_ref = 'jinseal_industry_' . $term_id;
    update_field('hero_text', 'Sealing products for ' . $name . ' applications where media compatibility, temperature, pressure and stable equipment operation matter.', $term_ref);
    update_field('archive_intro_eyebrow', 'Industry Application', $term_ref);
    update_field('intro_title', $name . ' sealing product selection.', $term_ref);
    update_field('intro_text', 'JinSeal helps industrial buyers choose metallic gaskets, non-metallic gaskets, gland packing, gasket sheets and gasket materials according to actual ' . $name . ' working conditions.', $term_ref);
    update_field('seo_eyebrow', 'SEO Content Area', $term_ref);
    update_field('seo_title', $name . ' sealing solutions from JinSeal.', $term_ref);
    update_field('long_content', '<p>This ' . esc_html($name) . ' industry page covers common sealing problems, product selection logic, gasket material choices, working medium, temperature, pressure range, flange standard and quotation guidance.</p><p>JinSeal supports project supply, industrial maintenance, OEM equipment and distributor cooperation with gaskets, packing, sheets and related sealing materials.</p>', $term_ref);
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
        'overview_title' => 'Reliable flange sealing for process and pressure equipment.',
        'features' => ['Stable sealing for flange systems', 'Metal and filler construction', 'Inner and outer ring options', 'Custom size and material support'],
        'description_sections' => [
            ['title' => 'Spiral wound gasket for industrial flange sealing.', 'text' => '<p>Spiral wound gasket is commonly selected for pipelines, heat exchangers, pressure vessels, valves and other industrial flange connections. The gasket structure helps maintain sealing reliability when equipment faces temperature cycling, vibration or pressure fluctuation.</p>', 'image' => ''],
            ['title' => '', 'text' => '<p>The product is formed by winding a metal strip together with a soft filler material. Depending on the working condition, JinSeal can recommend stainless steel strip, graphite filler, PTFE filler, inner ring, outer ring or inner and outer ring structures.</p><p>For quotation and production, customers can provide medium, temperature, pressure, flange standard, size, drawing or sample photo.</p>', 'image' => ''],
            ['title' => '', 'text' => '<p>JinSeal supports customized sealing product supply for chemical, petrochemical, refining, power generation and OEM equipment projects.</p>', 'image' => ''],
        ],
        'specs' => [
            ['name' => 'Product Name', 'value' => 'Spiral Wound Gasket'],
            ['name' => 'Category', 'value' => 'Metallic Gasket'],
            ['name' => 'Metal Strip', 'value' => 'SS304, SS316, SS316L, carbon steel or customized'],
            ['name' => 'Filler Material', 'value' => 'Flexible graphite, PTFE, non-asbestos or customized'],
            ['name' => 'Ring Type', 'value' => 'Basic type, inner ring, outer ring, inner and outer ring'],
            ['name' => 'Standard', 'value' => 'ASME, DIN, JIS, EN or drawing-based production'],
            ['name' => 'Application', 'value' => 'Pipeline flange, valve, pump, pressure vessel, heat exchanger'],
            ['name' => 'Customization', 'value' => 'Size, material, thickness, ring design, packaging and OEM supply'],
        ],
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
        'categories' => ['gland-packing', 'non-metallic-gasket'],
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
        'categories' => ['gasket-sheet', 'non-metallic-gasket'],
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
        'categories' => ['gasket-materials', 'gasket-sheet'],
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
