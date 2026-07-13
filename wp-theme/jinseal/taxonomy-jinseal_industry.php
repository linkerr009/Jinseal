<?php
get_header();
$term = get_queried_object();
?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="products-hero">
        <div class="products-hero__media"><?php echo jinseal_term_image('hero_image', $term, 'full'); ?><div class="products-hero__overlay"></div></div>
        <div class="products-container products-hero__inner"><div><div class="products-eyebrow products-eyebrow--inverse"><span></span><p>Industry</p></div><h1><?php echo esc_html($term->name); ?> Sealing Solutions.</h1><p><?php echo esc_html(jinseal_acf_value('hero_text', $term, term_description($term))); ?></p><div class="products-hero__crumbs"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="material-symbols-outlined">chevron_right</span><span>Industry</span><span class="material-symbols-outlined">chevron_right</span><span><?php echo esc_html($term->name); ?></span></div></div></div>
    </section>
    <?php get_template_part('template-parts/product-archive'); ?>
    <section class="products-capability bg-silver-bg"><div class="products-container"><div class="products-seo-box"><div class="products-eyebrow"><span></span><p><?php echo esc_html(jinseal_acf_value('seo_eyebrow', $term, 'SEO Content Area')); ?></p></div><h2><?php echo esc_html(jinseal_acf_value('seo_title', $term, $term->name . ' sealing solutions from JinSeal.')); ?></h2><div class="products-seo-box__content"><?php echo wp_kses_post(jinseal_acf_value('long_content', $term, '')); ?></div></div></div></section>
    <?php get_template_part('template-parts/inquiry'); ?>
</main>
<?php get_footer(); ?>
