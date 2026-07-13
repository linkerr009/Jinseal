<?php
get_header();

$post_id = get_the_ID();
$gallery = jinseal_field_rows('product_gallery', $post_id);
if (!$gallery && has_post_thumbnail()) {
    $gallery = [get_post_thumbnail_id($post_id)];
}
$features = jinseal_field_rows('product_features', $post_id);
$description_sections = jinseal_field_rows('description_sections', $post_id);
$specs = jinseal_field_rows('product_specs', $post_id);
$faqs = jinseal_field_rows('product_faq', $post_id);
$industries = get_the_terms($post_id, 'jinseal_industry');
$related = jinseal_acf_value('related_products', $post_id, []);
if (!$related) {
    $category_ids = wp_get_post_terms($post_id, 'jinseal_product_category', ['fields' => 'ids']);
    $related = get_posts(['post_type' => 'jinseal_product', 'posts_per_page' => 3, 'post__not_in' => [$post_id], 'tax_query' => $category_ids ? [['taxonomy' => 'jinseal_product_category', 'field' => 'term_id', 'terms' => $category_ids]] : []]);
}
$category_terms = get_terms(['taxonomy' => 'jinseal_product_category', 'hide_empty' => false]);
?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="pd-hero">
        <div class="pd-hero__media"><?php echo jinseal_image(jinseal_option('products_archive_hero_image'), 'full'); ?><div class="pd-hero__overlay"></div></div>
        <div class="pd-container pd-hero__inner"><div><div class="pd-eyebrow pd-eyebrow--inverse"><span></span><p>Product Detail</p></div><h1><?php the_title(); ?></h1><p><?php echo esc_html(get_the_excerpt()); ?></p><div class="pd-hero__crumbs"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="material-symbols-outlined">chevron_right</span><a href="<?php echo esc_url(jinseal_products_url()); ?>">Products</a><span class="material-symbols-outlined">chevron_right</span><span><?php the_title(); ?></span></div></div></div>
    </section>

    <section class="pd-overview bg-white"><div class="pd-container pd-overview__grid">
        <div class="pd-gallery">
            <?php if ($gallery) : ?>
                <div class="pd-gallery__main"><?php echo jinseal_image($gallery[0], 'large', ['data-gallery-main' => '']); ?></div>
                <div class="pd-gallery__thumbs" aria-label="Product images">
                    <?php foreach ($gallery as $index => $image_id) : ?>
                        <button class="<?php echo $index === 0 ? 'is-active' : ''; ?>" type="button" data-gallery-thumb data-gallery-src="<?php echo esc_url(jinseal_image_url($image_id, 'large')); ?>" data-gallery-alt="<?php echo esc_attr(get_post_meta((int) $image_id, '_wp_attachment_image_alt', true)); ?>"><?php echo jinseal_image($image_id, 'thumbnail'); ?></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="pd-summary">
            <p class="pd-summary__label"><?php echo esc_html(jinseal_acf_value('product_label', $post_id, 'Sealing Product')); ?></p>
            <h2><?php echo esc_html(jinseal_acf_value('product_overview_title', $post_id, get_the_title())); ?></h2>
            <p><?php echo esc_html(jinseal_acf_value('product_summary', $post_id, get_the_excerpt())); ?></p>
            <?php if ($features) : ?><ul class="pd-summary__features"><?php foreach ($features as $feature) : ?><li><span class="material-symbols-outlined">check_circle</span><?php echo esc_html($feature['feature'] ?? ''); ?></li><?php endforeach; ?></ul><?php endif; ?>
            <div class="pd-summary__actions"><a href="#inquiry">Request a Quote <span class="material-symbols-outlined">arrow_forward</span></a><a href="mailto:<?php echo esc_attr(jinseal_option('site_email', 'info@ginseal.com')); ?>?subject=<?php echo rawurlencode(get_the_title() . ' Catalog Request'); ?>">Ask for Catalog</a></div>
        </div>
    </div></section>

    <nav class="pd-anchor" aria-label="Product detail sections"><div class="pd-container"><a href="#description">Description</a><a href="#specifications">Specifications</a><a href="#applications">Applications</a><a href="#faq">FAQ</a><a href="#inquiry">Inquiry</a></div></nav>

    <section class="pd-content bg-silver-bg"><div class="pd-container pd-content__grid">
        <div class="pd-main">
            <section id="description" class="pd-block"><div class="pd-eyebrow"><span></span><p>Description</p></div><h2><?php echo esc_html($description_sections[0]['title'] ?? get_the_title() . ' for industrial sealing.'); ?></h2><div class="pd-description-flow">
                <?php if ($description_sections) : ?>
                    <?php foreach ($description_sections as $section) : ?><div><?php echo wp_kses_post($section['text'] ?? ''); ?></div><?php if (!empty($section['image'])) : ?><figure><?php echo jinseal_image($section['image'], 'large'); ?></figure><?php endif; ?><?php endforeach; ?>
                <?php else : ?><?php the_content(); ?><?php endif; ?>
            </div></section>

            <section id="specifications" class="pd-block"><div class="pd-eyebrow"><span></span><p>Specifications</p></div><h2>Typical product parameters.</h2><?php if ($specs) : ?><div class="pd-table-wrap"><table class="pd-table"><tbody><?php foreach ($specs as $spec) : ?><tr><th><?php echo esc_html($spec['name'] ?? ''); ?></th><td><?php echo esc_html($spec['value'] ?? ''); ?></td></tr><?php endforeach; ?></tbody></table></div><?php endif; ?></section>

            <section id="applications" class="pd-block"><div class="pd-eyebrow"><span></span><p>Applications</p></div><h2>Used across demanding industrial sectors.</h2><p><?php echo esc_html(jinseal_acf_value('product_applications_intro', $post_id, 'JinSeal products support process, energy, maintenance and OEM equipment applications.')); ?></p><?php if ($industries && !is_wp_error($industries)) : ?><div class="pd-application-grid"><?php foreach ($industries as $industry) : ?><div><?php echo esc_html($industry->name); ?></div><?php endforeach; ?></div><?php endif; ?></section>

            <section id="faq" class="pd-block"><div class="pd-eyebrow"><span></span><p>FAQ</p></div><h2>Common questions before quotation.</h2><?php if ($faqs) : ?><div class="pd-faq"><?php foreach ($faqs as $index => $faq) : ?><details <?php echo $index === 0 ? 'open' : ''; ?>><summary><?php echo esc_html($faq['question'] ?? ''); ?></summary><p><?php echo esc_html($faq['answer'] ?? ''); ?></p></details><?php endforeach; ?></div><?php endif; ?></section>
        </div>
        <aside class="pd-side">
            <div class="pd-side-card pd-side-card--dark"><p>Quick Inquiry</p><h3>Need a gasket recommendation?</h3><span>Send medium, pressure, temperature and flange standard. JinSeal will help select suitable material and structure.</span><a href="#inquiry">Send Inquiry <span class="material-symbols-outlined">arrow_forward</span></a></div>
            <div class="pd-side-card"><p>Product Range</p><ul><?php foreach ($category_terms as $term) : ?><li><a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a></li><?php endforeach; ?></ul></div>
        </aside>
    </div></section>

    <?php if ($related) : ?><section class="pd-related bg-white"><div class="pd-container"><div class="pd-section-head"><div class="pd-eyebrow"><span></span><p>Related Products</p></div><h2>Other sealing products you may need.</h2></div><div class="pd-related__grid">
        <?php foreach (array_slice($related, 0, 3) as $related_product) : $related_post = get_post($related_product); if (!$related_post) { continue; } $related_terms = get_the_terms($related_post, 'jinseal_product_category'); ?>
            <article><?php echo get_the_post_thumbnail($related_post, 'medium_large'); ?><p><?php echo esc_html($related_terms && !is_wp_error($related_terms) ? $related_terms[0]->name : 'Sealing Product'); ?></p><h3><?php echo esc_html(get_the_title($related_post)); ?></h3><a href="<?php echo esc_url(get_permalink($related_post)); ?>">View Details <span class="material-symbols-outlined">arrow_forward</span></a></article>
        <?php endforeach; ?>
    </div></div></section><?php endif; ?>

    <?php get_template_part('template-parts/inquiry'); ?>
</main>
<?php get_footer(); ?>
