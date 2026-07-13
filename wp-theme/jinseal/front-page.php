<?php get_header(); ?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="relative min-h-[90vh] flex items-center bg-deep-navy">
        <div class="relative z-10 w-full max-w-container-max mx-auto px-margin-mobile md:px-gutter grid md:grid-cols-12 gap-8 items-center">
            <div class="md:col-span-8 lg:col-span-7 flex flex-col gap-stack-lg gap-8">
                <div class="flex flex-wrap gap-3">
                    <span class="px-3 py-1 bg-surface/10 border border-slate-border/20 text-white rounded-full font-label-sm uppercase backdrop-blur-sm"><?php echo esc_html(jinseal_acf_value('hero_eyebrow', get_queried_object_id(), 'Sealing Products Since 1997')); ?></span>
                </div>
                <h1 class="font-headline-xl text-white text-[40px] font-extrabold leading-[1.1]"><?php echo esc_html(jinseal_acf_value('hero_title', get_queried_object_id(), 'Your Reliable Sealing & Gasket Material China Manufacturer.')); ?></h1>
                <p class="font-body-lg text-inverse-on-surface max-w-2xl"><?php echo esc_html(jinseal_acf_value('hero_text', get_queried_object_id(), 'One-stop metallic and non-metallic sealing, gasket and material manufacture and solution provider.')); ?></p>
                <div class="flex flex-col gap-4 sm:flex-row">
                    <a class="inline-flex w-fit items-center gap-2 rounded bg-energy-red px-7 py-4 font-label-sm uppercase tracking-wide text-white shadow-lg shadow-energy-red/30" href="#inquiry">Request A Quote <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                    <a class="inline-flex w-fit items-center gap-2 rounded border border-white/30 px-7 py-4 font-label-sm uppercase tracking-wide text-white" href="<?php echo esc_url(jinseal_products_url()); ?>">View Products</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-section-gap-md bg-white">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
            <div class="text-center mb-12">
                <div class="mb-4 flex items-center justify-center gap-2"><div class="h-1 w-8 bg-energy-red"></div><span class="font-label-sm text-energy-red uppercase">Product Range</span></div>
                <h2 class="font-headline-xl text-deep-navy mb-4 text-[32px] font-extrabold leading-[1.2]">Our Sealing Products</h2>
            </div>
            <div class="products-grid">
                <?php
                $products = get_posts(['post_type' => 'jinseal_product', 'posts_per_page' => 8]);
                foreach ($products as $product) {
                    jinseal_product_card($product);
                }
                ?>
            </div>
        </div>
    </section>

    <?php get_template_part('template-parts/inquiry'); ?>
</main>
<?php get_footer(); ?>

