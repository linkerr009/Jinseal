<section class="products-main bg-white">
    <div class="products-container products-layout">
        <aside class="products-sidebar" aria-label="Product category tools">
            <div class="products-panel">
                <h2>Product Categories</h2>
                <div class="products-category-list">
                    <?php foreach (get_terms(['taxonomy' => 'jinseal_product_category', 'hide_empty' => false]) as $term) : ?>
                        <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="products-side-cta">
                <span class="material-symbols-outlined icon-fill">support_agent</span>
                <h3>Need material advice?</h3>
                <p>Tell us your medium, temperature, pressure and standard. JinSeal can recommend suitable sealing options.</p>
                <a href="#inquiry">Send Inquiry <span class="material-symbols-outlined">arrow_forward</span></a>
            </div>
        </aside>
        <div class="products-content">
            <div class="products-intro">
                <div class="products-eyebrow"><span></span><p>JinSeal Product Range</p></div>
                <h2><?php echo is_tax() ? esc_html(single_term_title('', false)) : 'One-Stop Sealing Product Categories.'; ?></h2>
                <p>Use the category filters to browse products, then send your working condition for a recommendation or quotation.</p>
            </div>
            <div class="products-grid" data-products-grid>
                <?php while (have_posts()) : the_post(); jinseal_product_card(get_post()); endwhile; ?>
            </div>
        </div>
    </div>
</section>

