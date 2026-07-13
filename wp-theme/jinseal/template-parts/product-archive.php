<?php
$current_term = is_tax() ? get_queried_object() : null;
$is_industry = is_tax('jinseal_industry');
$sidebar_taxonomy = $is_industry ? 'jinseal_industry' : 'jinseal_product_category';
$sidebar_title = $is_industry ? 'Industry Categories' : 'Product Categories';
$sidebar_terms = get_terms(['taxonomy' => $sidebar_taxonomy, 'hide_empty' => false]);
$intro_eyebrow = $current_term ? jinseal_acf_value('archive_intro_eyebrow', $current_term, $is_industry ? 'Industry Application' : 'Product Category') : 'JinSeal Product Range';
$intro_title = $current_term ? jinseal_acf_value('intro_title', $current_term, $current_term->name . ($is_industry ? ' sealing product selection.' : ' Products')) : jinseal_option('products_intro_title', 'One-stop sealing product categories.');
$intro_text = $current_term ? jinseal_acf_value('intro_text', $current_term, term_description($current_term)) : jinseal_option('products_intro_text', 'JinSeal supports industrial buyers with a practical range of gasket, packing, sheet and sealing material options. Use the category links to browse each product range, then send your working condition for a recommendation or quotation.');
?>
<section class="products-main bg-white">
    <div class="products-container products-layout">
        <aside class="products-sidebar" aria-label="<?php echo esc_attr($sidebar_title); ?> tools">
            <?php if (!$is_industry) : ?>
                <div class="products-panel">
                    <h2>Search Products</h2>
                    <div class="products-search"><input type="search" placeholder="Search products" aria-label="Search products" data-product-search><button type="button" aria-label="Search products"><span class="material-symbols-outlined">search</span></button></div>
                </div>
            <?php endif; ?>
            <div class="products-panel">
                <h2><?php echo esc_html($sidebar_title); ?></h2>
                <div class="products-category-list">
                    <?php foreach ($sidebar_terms as $term) : ?>
                        <a class="<?php echo $current_term && (int) $current_term->term_id === (int) $term->term_id ? 'is-active' : ''; ?>" href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="products-side-cta"><span class="material-symbols-outlined icon-fill">support_agent</span><h3>Need material advice?</h3><p>Tell us your medium, temperature, pressure and standard. JinSeal can recommend suitable sealing options.</p><a href="#inquiry">Send Inquiry <span class="material-symbols-outlined">arrow_forward</span></a></div>
        </aside>
        <div class="products-content">
            <div class="products-intro"><div class="products-eyebrow"><span></span><p><?php echo esc_html($intro_eyebrow); ?></p></div><h2><?php echo esc_html($intro_title); ?></h2><p><?php echo esc_html(wp_strip_all_tags($intro_text)); ?></p></div>
            <div class="products-grid" data-products-grid><?php while (have_posts()) : the_post(); jinseal_product_card(get_post()); endwhile; ?></div>
            <p class="products-empty" data-products-empty hidden>No matching products found. Try another keyword.</p>
        </div>
    </div>
</section>
