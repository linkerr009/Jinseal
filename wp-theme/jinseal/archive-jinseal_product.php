<?php get_header(); ?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="products-hero">
        <div class="products-hero__media"><?php echo jinseal_image(jinseal_option('products_archive_hero_image'), 'full'); ?><div class="products-hero__overlay"></div></div>
        <div class="products-container products-hero__inner"><div><div class="products-eyebrow products-eyebrow--inverse"><span></span><p>Product Categories</p></div><h1><?php echo esc_html(jinseal_option('products_archive_title', 'Sealing products for demanding industrial applications.')); ?></h1><p><?php echo esc_html(jinseal_option('products_archive_text', 'Explore JinSeal metallic gaskets, non-metallic gaskets, gland packing, gasket sheets and gasket materials for process, energy and OEM equipment.')); ?></p><div class="products-hero__crumbs"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="material-symbols-outlined">chevron_right</span><span>Products</span></div></div></div>
    </section>
    <?php get_template_part('template-parts/product-archive'); ?>
    <section class="products-capability bg-silver-bg"><div class="products-container"><div class="products-seo-box"><div class="products-eyebrow"><span></span><p>SEO Content Area</p></div><h2><?php echo esc_html(jinseal_option('products_seo_title', 'Industrial sealing product categories from JinSeal.')); ?></h2><div class="products-seo-box__content"><?php echo wp_kses_post(jinseal_option('products_seo_content', '')); ?></div></div></div></section>
    <?php get_template_part('template-parts/inquiry'); ?>
</main>
<?php get_footer(); ?>
