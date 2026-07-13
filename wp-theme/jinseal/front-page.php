<?php
get_header();

$page_id = get_queried_object_id();
$hero_image = jinseal_acf_value('hero_image', $page_id);
$hero_badges = jinseal_field_rows('home_hero_badges', $page_id, [
    ['text' => 'Sealing Products Since 1997'],
    ['text' => 'ISO 9001 Quality System'],
]);
$trust_items = jinseal_field_rows('home_trust_items', $page_id, [
    ['icon' => 'verified_user', 'text' => 'Quality Sealing Partner', 'primary' => true],
    ['icon' => 'history', 'text' => 'Established in 1997'],
    ['icon' => 'assignment_turned_in', 'text' => 'ISO 9001 Certified'],
    ['icon' => 'public', 'text' => 'Worldwide Supply'],
]);
$about_points = jinseal_field_rows('home_about_points', $page_id);
$quality_items = jinseal_field_rows('home_quality_items', $page_id);
$testimonials = jinseal_field_rows('home_testimonials', $page_id);
$industries = get_terms(['taxonomy' => 'jinseal_industry', 'hide_empty' => false]);
?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="relative min-h-[90vh] flex items-center bg-deep-navy">
        <?php if ($hero_image) : ?>
            <div class="absolute inset-0 z-0">
                <?php echo jinseal_image($hero_image, 'full', ['class' => 'w-full h-full object-cover object-center opacity-70']); ?>
                <div class="absolute inset-0 hero-gradient"></div>
            </div>
        <?php endif; ?>
        <div class="relative z-10 w-full max-w-container-max mx-auto px-margin-mobile md:px-gutter grid md:grid-cols-12 gap-8 items-center">
            <div class="md:col-span-8 lg:col-span-7 flex flex-col gap-stack-lg gap-8">
                <div class="flex flex-wrap gap-3">
                    <?php foreach ($hero_badges as $badge) : ?>
                        <span class="px-3 py-1 bg-surface/10 border border-slate-border/20 text-white rounded-full font-label-sm uppercase backdrop-blur-sm"><?php echo esc_html($badge['text'] ?? ''); ?></span>
                    <?php endforeach; ?>
                </div>
                <h1 class="font-display-lg text-white text-[40px] font-extrabold leading-[1.1]"><?php echo esc_html(jinseal_acf_value('hero_title', $page_id, 'Your Reliable Sealing & Gasket Material China Manufacturer.')); ?></h1>
                <p class="font-body-lg text-inverse-on-surface max-w-2xl"><?php echo esc_html(jinseal_acf_value('hero_text', $page_id, 'One-stop metallic and non-metallic sealing, gasket and material manufacturer and solution provider.')); ?></p>
                <p class="font-body-md text-white/80 max-w-2xl"><?php echo esc_html(jinseal_acf_value('home_hero_secondary_text', $page_id, 'JinSeal supplies gaskets, gland packing, sealing sheets, semi-finished products, sealing machines and sealing accessories for global industrial customers.')); ?></p>
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="#inquiry" data-inquiry-popup class="bg-energy-red text-white px-8 py-4 rounded font-label-sm text-center uppercase tracking-wider hover:bg-primary transition-all active:scale-95 shadow-lg shadow-energy-red/20 flex items-center justify-center gap-2">Request a Quote <span class="material-symbols-outlined">arrow_forward</span></a>
                    <a href="<?php echo esc_url(jinseal_products_url()); ?>" class="bg-transparent border border-outline-variant text-white px-8 py-4 rounded font-label-sm text-center uppercase tracking-wider hover:bg-primary hover:border-primary transition-all active:scale-95 flex items-center justify-center gap-2">View Products</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-surface-container-low border-b border-slate-border">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter py-8">
            <div class="flex flex-wrap md:flex-nowrap items-center justify-between gap-8 md:gap-4">
                <?php foreach ($trust_items as $item) : ?>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined <?php echo !empty($item['primary']) ? 'text-energy-red text-[28px] icon-fill' : 'text-steel-gray text-[24px]'; ?>"><?php echo esc_html($item['icon'] ?? 'check_circle'); ?></span>
                        <span class="<?php echo !empty($item['primary']) ? 'font-headline-lg text-energy-red text-[24px] font-bold' : 'font-body-md text-steel-gray font-semibold'; ?>"><?php echo esc_html($item['text'] ?? ''); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="py-section-gap-md md:py-section-gap-lg bg-silver-bg">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
            <div class="grid md:grid-cols-12 gap-12 items-center">
                <div class="md:col-span-6 flex flex-col gap-6">
                    <div class="flex items-center gap-2 mb-2"><div class="w-8 h-1 bg-energy-red"></div><span class="font-label-sm text-energy-red uppercase"><?php echo esc_html(jinseal_acf_value('home_about_eyebrow', $page_id, 'About JinSeal')); ?></span></div>
                    <h2 class="font-headline-xl text-deep-navy text-[32px] font-extrabold leading-[1.2]"><?php echo esc_html(jinseal_acf_value('home_about_title', $page_id, 'JinSeal Sealing Solutions: Your Sealing Products Manufacturer')); ?></h2>
                    <p class="font-body-lg text-steel-gray"><?php echo esc_html(jinseal_acf_value('home_about_text', $page_id, 'JinSeal has been involved in sealing products manufacturing since 1997, efficiently providing quality sealing products to customers in China and around the world.')); ?></p>
                    <?php if ($about_points) : ?>
                        <ul class="space-y-4 mt-4">
                            <?php foreach ($about_points as $point) : ?>
                                <li class="flex items-start gap-3"><span class="material-symbols-outlined text-energy-red mt-1">check_circle</span><span class="font-body-md text-on-surface-variant"><strong class="text-deep-navy"><?php echo esc_html($point['title'] ?? ''); ?>:</strong> <?php echo esc_html($point['text'] ?? ''); ?></span></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="mt-6"><a href="<?php echo esc_url(jinseal_page_url('about')); ?>" class="bg-energy-red text-white px-6 py-3 rounded font-label-sm uppercase tracking-wide hover:bg-primary transition-colors active:scale-95 shadow-lg shadow-energy-red/20 flex items-center gap-2 w-fit">More About JinSeal <span class="material-symbols-outlined text-sm">arrow_forward</span></a></div>
                </div>
                <div class="md:col-span-6 relative about-visual">
                    <div class="about-visual__glow absolute -inset-4 bg-primary/5 rounded-2xl transform rotate-3"></div>
                    <?php echo jinseal_image(jinseal_acf_value('home_about_image', $page_id), 'large', ['class' => 'w-full h-[500px] object-cover rounded-xl shadow-lg relative z-10 border border-slate-border']); ?>
                    <div class="about-visual__badge absolute -bottom-6 -left-6 z-20 bg-white p-4 rounded shadow-xl border border-slate-border flex gap-4 items-center">
                        <div class="bg-silver-bg p-2 rounded"><span class="material-symbols-outlined text-primary text-[32px]">factory</span></div>
                        <div><p class="font-label-sm text-steel-gray"><?php echo esc_html(jinseal_acf_value('home_about_badge_label', $page_id, 'Production Base')); ?></p><p class="font-headline-lg-mobile text-deep-navy"><?php echo esc_html(jinseal_acf_value('home_about_badge_value', $page_id, 'Cixi, Zhejiang, China')); ?></p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-section-gap-md bg-white border-b border-slate-border">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
            <div class="text-center mb-16">
                <div class="mb-4 flex items-center justify-center gap-2"><div class="h-1 w-8 bg-energy-red"></div><span class="font-label-sm text-energy-red uppercase"><?php echo esc_html(jinseal_acf_value('home_products_eyebrow', $page_id, 'Product Range')); ?></span></div>
                <h2 class="font-headline-xl text-deep-navy mb-4 text-[32px] font-extrabold leading-[1.2]"><?php echo esc_html(jinseal_acf_value('home_products_title', $page_id, 'Our Sealing Products')); ?></h2>
                <p class="font-body-lg text-steel-gray max-w-3xl mx-auto"><?php echo esc_html(jinseal_acf_value('home_products_text', $page_id, 'One-stop selection of gasket, packing and sheet materials for demanding industrial sealing applications.')); ?></p>
            </div>
            <div class="products-grid home-products-grid">
                <?php foreach (get_posts(['post_type' => 'jinseal_product', 'posts_per_page' => 8, 'orderby' => 'menu_order date', 'order' => 'ASC']) as $product) : ?>
                    <?php jinseal_product_card($product); ?>
                <?php endforeach; ?>
            </div>
            <div class="mt-10 flex justify-center"><a href="<?php echo esc_url(jinseal_products_url()); ?>" class="bg-energy-red text-white px-8 py-4 rounded font-label-sm uppercase tracking-wider hover:bg-primary transition-all shadow-lg active:scale-95">View More Products</a></div>
        </div>
    </section>

    <section class="py-section-gap-md bg-silver-bg">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
            <div class="text-center mb-16">
                <div class="mb-4 flex items-center justify-center gap-2"><div class="h-1 w-8 bg-energy-red"></div><span class="font-label-sm text-energy-red uppercase"><?php echo esc_html(jinseal_acf_value('home_quality_eyebrow', $page_id, 'Quality Control')); ?></span></div>
                <h2 class="font-headline-xl text-deep-navy mb-4 text-[32px] font-extrabold leading-[1.2]"><?php echo esc_html(jinseal_acf_value('home_quality_title', $page_id, 'Quality - What We Care')); ?></h2>
                <p class="font-body-lg text-steel-gray max-w-2xl mx-auto"><?php echo esc_html(jinseal_acf_value('home_quality_text', $page_id, 'JinSeal focuses on dependable materials, stable manufacturing and practical sealing solutions for industrial buyers.')); ?></p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($quality_items as $item) : ?>
                    <article class="bg-white p-6 rounded-xl border border-slate-border shadow-sm flex flex-col gap-4"><span class="material-symbols-outlined text-energy-red text-[40px]"><?php echo esc_html($item['icon'] ?? 'verified'); ?></span><h3 class="font-headline-lg-mobile text-deep-navy font-bold text-[24px] leading-[1.2]"><?php echo esc_html($item['title'] ?? ''); ?></h3><p class="font-body-md text-steel-gray"><?php echo esc_html($item['text'] ?? ''); ?></p></article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="industry" class="py-section-gap-md bg-white border-y border-slate-border">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
            <div class="text-center mb-16">
                <div class="mb-4 flex items-center justify-center gap-2"><div class="h-1 w-8 bg-energy-red"></div><span class="font-label-sm text-energy-red uppercase"><?php echo esc_html(jinseal_acf_value('home_industries_eyebrow', $page_id, 'Industry')); ?></span></div>
                <h2 class="font-headline-xl text-deep-navy mb-4 text-[32px] font-extrabold leading-[1.2]"><?php echo esc_html(jinseal_acf_value('home_industries_title', $page_id, 'Application Industry')); ?></h2>
                <p class="font-body-lg text-steel-gray"><?php echo esc_html(jinseal_acf_value('home_industries_text', $page_id, 'JinSeal sealing products are used across demanding process, energy and manufacturing industries.')); ?></p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($industries as $industry) : ?>
                    <a href="<?php echo esc_url(get_term_link($industry)); ?>" class="group flex flex-col bg-surface rounded-xl border border-slate-border overflow-hidden hover:shadow-lg transition-all duration-300">
                        <div class="aspect-[4/3] overflow-hidden"><?php echo jinseal_term_image('hero_image', $industry, 'medium_large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500']); ?></div>
                        <div class="p-5"><h3 class="font-headline-lg-mobile text-deep-navy text-[20px] font-bold leading-[1.3]"><?php echo esc_html($industry->name); ?></h3></div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="py-section-gap-md bg-silver-bg">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-center">
                <div class="lg:col-span-4">
                    <div class="flex items-center gap-2 mb-4"><div class="h-1 w-8 bg-energy-red"></div><span class="font-label-sm text-energy-red uppercase"><?php echo esc_html(jinseal_acf_value('home_stories_eyebrow', $page_id, 'Customer Voice')); ?></span></div>
                    <h2 class="font-headline-xl text-deep-navy mb-5 text-[32px] font-extrabold leading-[1.2]"><?php echo esc_html(jinseal_acf_value('home_stories_title', $page_id, "Customer's Stories")); ?></h2>
                    <p class="font-body-lg text-steel-gray mb-8"><?php echo esc_html(jinseal_acf_value('home_stories_text', $page_id, 'Feedback from international buyers working with JinSeal sealing products, stable supply and project support.')); ?></p>
                    <a href="#inquiry" class="inline-flex w-fit items-center gap-2 rounded bg-energy-red px-6 py-3 font-label-sm uppercase tracking-wide text-white shadow-lg shadow-energy-red/20 transition-all hover:bg-primary active:scale-95"><?php echo esc_html(jinseal_acf_value('home_stories_button', $page_id, 'Send Inquiry')); ?> <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                </div>
                <div class="lg:col-span-8"><div class="grid gap-6 md:grid-cols-3">
                    <?php foreach ($testimonials as $item) : ?>
                        <article class="relative overflow-hidden rounded-lg border <?php echo !empty($item['featured']) ? 'border-energy-red/30 shadow-lg shadow-energy-red/10' : 'border-slate-border shadow-sm'; ?> bg-white p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <?php if (!empty($item['featured'])) : ?><div class="absolute inset-x-0 top-0 h-1 bg-energy-red"></div><?php endif; ?>
                            <span class="material-symbols-outlined absolute right-5 top-5 text-[48px] text-energy-red/10">format_quote</span>
                            <div class="mb-6 flex items-center gap-3"><div class="flex h-12 w-12 items-center justify-center rounded-full <?php echo !empty($item['featured']) ? 'bg-deep-navy' : 'bg-energy-red'; ?> text-white font-headline-lg-mobile font-bold"><?php echo esc_html($item['initial'] ?? 'J'); ?></div><div><h4 class="font-headline-lg-mobile text-deep-navy"><?php echo esc_html($item['name'] ?? ''); ?></h4><p class="font-label-sm uppercase text-energy-red"><?php echo esc_html($item['role'] ?? ''); ?></p></div></div>
                            <div class="mb-5 flex gap-1 text-energy-red" aria-label="Five star rating"><?php for ($star = 0; $star < 5; $star++) : ?><span class="material-symbols-outlined text-[18px] icon-fill">star</span><?php endfor; ?></div>
                            <p class="font-body-md text-steel-gray"><?php echo esc_html($item['quote'] ?? ''); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div></div>
            </div>
        </div>
    </section>

    <?php get_template_part('template-parts/inquiry'); ?>
</main>
<?php get_footer(); ?>
