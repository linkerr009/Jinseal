<?php get_header(); ?>
<?php $term = get_queried_object(); ?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="products-hero">
        <div class="products-container products-hero__inner">
            <div>
                <div class="products-eyebrow products-eyebrow--inverse"><span></span><p>Product Category</p></div>
                <h1><?php echo esc_html($term->name); ?></h1>
                <p><?php echo esc_html(jinseal_acf_value('hero_text', $term, term_description($term))); ?></p>
            </div>
        </div>
    </section>
    <?php get_template_part('template-parts/product-archive'); ?>
    <?php get_template_part('template-parts/inquiry'); ?>
</main>
<?php get_footer(); ?>

