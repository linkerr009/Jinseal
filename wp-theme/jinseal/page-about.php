<?php
/* Template Name: JinSeal About */
get_header();

$page_id = get_the_ID();
$hero_image = jinseal_acf_value('hero_image', $page_id);
$facts = jinseal_field_rows('about_hero_facts', $page_id);
$process_items = jinseal_field_rows('about_process_items', $page_id);
$facility_gallery = jinseal_field_rows('about_facility_gallery', $page_id);
$facility_features = jinseal_field_rows('about_facility_features', $page_id);
$value_items = jinseal_field_rows('about_values_items', $page_id);
$recognition_items = jinseal_field_rows('about_recognition_items', $page_id);
$milestones = jinseal_field_rows('about_milestones', $page_id);
$industries = get_terms(['taxonomy' => 'jinseal_industry', 'hide_empty' => false]);
?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="about-hero">
        <div class="about-hero__media"><?php echo jinseal_image($hero_image, 'full'); ?><div class="about-hero__overlay"></div></div>
        <div class="about-hero__inner">
            <div class="about-hero__content">
                <div class="about-eyebrow about-eyebrow--inverse"><span></span><p><?php echo esc_html(jinseal_acf_value('hero_eyebrow', $page_id, 'About JinSeal')); ?></p></div>
                <h1><?php echo esc_html(jinseal_acf_value('hero_title', $page_id, 'High-performance sealing products manufacturer since 1997.')); ?></h1>
                <p class="about-hero__lead"><?php echo esc_html(jinseal_acf_value('hero_text', $page_id)); ?></p>
                <div class="about-hero__crumbs"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="material-symbols-outlined">chevron_right</span><span>About Us</span></div>
            </div>
            <div class="about-hero__facts">
                <?php foreach ($facts as $fact) : ?><div><strong><?php echo esc_html($fact['value'] ?? ''); ?></strong><span><?php echo esc_html($fact['label'] ?? ''); ?></span></div><?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="about-story bg-white">
        <div class="about-container"><div class="about-story__grid">
            <div class="about-story__copy">
                <div class="about-eyebrow"><span></span><p><?php echo esc_html(jinseal_acf_value('about_story_eyebrow', $page_id, 'Our Story')); ?></p></div>
                <h2><?php echo esc_html(jinseal_acf_value('about_story_title', $page_id)); ?></h2>
                <p><?php echo esc_html(jinseal_acf_value('about_story_text_one', $page_id)); ?></p>
                <p><?php echo esc_html(jinseal_acf_value('about_story_text_two', $page_id)); ?></p>
                <a class="about-story__inquiry" href="#inquiry">Send Inquiry <span class="material-symbols-outlined">arrow_forward</span></a>
            </div>
            <div class="about-story__visual">
                <?php echo jinseal_image(jinseal_acf_value('about_story_image', $page_id), 'large'); ?>
                <div class="about-story__card"><span class="material-symbols-outlined icon-fill">verified</span><div><p><?php echo esc_html(jinseal_acf_value('about_story_card_label', $page_id, 'Certified Quality')); ?></p><strong><?php echo esc_html(jinseal_acf_value('about_story_card_value', $page_id, 'ISO 9001 since 2000')); ?></strong></div></div>
            </div>
        </div></div>
    </section>

    <section class="about-process bg-silver-bg">
        <div class="about-container">
            <div class="about-section-head about-section-head--left"><div class="about-eyebrow"><span></span><p><?php echo esc_html(jinseal_acf_value('about_process_eyebrow', $page_id, 'What We Do')); ?></p></div><h2><?php echo esc_html(jinseal_acf_value('about_process_title', $page_id)); ?></h2><p><?php echo esc_html(jinseal_acf_value('about_process_text', $page_id)); ?></p></div>
            <div class="about-process__grid">
                <?php foreach ($process_items as $index => $item) : ?><article><div class="about-process__num"><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></div><span class="material-symbols-outlined"><?php echo esc_html($item['icon'] ?? 'engineering'); ?></span><h3><?php echo esc_html($item['title'] ?? ''); ?></h3><p><?php echo esc_html($item['text'] ?? ''); ?></p></article><?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="about-facility bg-deep-navy text-white">
        <div class="about-container"><div class="about-facility__grid">
            <div class="about-facility__image"><div class="about-facility-carousel" data-facility-carousel>
                <div class="about-facility-carousel__track"><?php foreach ($facility_gallery as $index => $image_id) : ?><?php echo jinseal_image($image_id, 'large', ['class' => $index === 0 ? 'is-active' : '']); ?><?php endforeach; ?></div>
                <button class="about-facility-carousel__nav about-facility-carousel__nav--prev" type="button" aria-label="Previous factory image" data-facility-prev><span class="material-symbols-outlined">chevron_left</span></button>
                <button class="about-facility-carousel__nav about-facility-carousel__nav--next" type="button" aria-label="Next factory image" data-facility-next><span class="material-symbols-outlined">chevron_right</span></button>
                <div class="about-facility-carousel__dots" aria-label="Factory image carousel controls"><?php foreach ($facility_gallery as $index => $image_id) : ?><button class="<?php echo $index === 0 ? 'is-active' : ''; ?>" type="button" aria-label="Show factory image <?php echo esc_attr((string) ($index + 1)); ?>"></button><?php endforeach; ?></div>
            </div></div>
            <div class="about-facility__copy">
                <div class="about-eyebrow about-eyebrow--inverse"><span></span><p><?php echo esc_html(jinseal_acf_value('about_facility_eyebrow', $page_id, 'Our Facility')); ?></p></div>
                <h2><?php echo esc_html(jinseal_acf_value('about_facility_title', $page_id)); ?></h2><p><?php echo esc_html(jinseal_acf_value('about_facility_text', $page_id)); ?></p>
                <div class="about-feature-list"><?php foreach ($facility_features as $item) : ?><div><span class="material-symbols-outlined"><?php echo esc_html($item['icon'] ?? 'factory'); ?></span><div><h3><?php echo esc_html($item['title'] ?? ''); ?></h3><p><?php echo esc_html($item['text'] ?? ''); ?></p></div></div><?php endforeach; ?></div>
            </div>
        </div></div>
    </section>

    <section class="about-values bg-white"><div class="about-container">
        <div class="about-section-head"><div class="about-eyebrow"><span></span><p><?php echo esc_html(jinseal_acf_value('about_values_eyebrow', $page_id, 'Brand Values')); ?></p></div><h2><?php echo esc_html(jinseal_acf_value('about_values_title', $page_id)); ?></h2><p><?php echo esc_html(jinseal_acf_value('about_values_text', $page_id)); ?></p></div>
        <div class="about-values__grid"><?php foreach ($value_items as $item) : ?><article><span class="material-symbols-outlined icon-fill"><?php echo esc_html($item['icon'] ?? 'handshake'); ?></span><h3><?php echo esc_html($item['title'] ?? ''); ?></h3><p><?php echo esc_html($item['text'] ?? ''); ?></p></article><?php endforeach; ?></div>
    </div></section>

    <section class="about-quality bg-silver-bg"><div class="about-container"><div class="about-quality__grid">
        <div><div class="about-eyebrow"><span></span><p><?php echo esc_html(jinseal_acf_value('about_quality_eyebrow', $page_id, 'Quality Assurance')); ?></p></div><h2><?php echo esc_html(jinseal_acf_value('about_quality_title', $page_id)); ?></h2><p><?php echo esc_html(jinseal_acf_value('about_quality_text', $page_id)); ?></p><a class="about-quality__inquiry" href="#inquiry">Send Inquiry <span class="material-symbols-outlined">arrow_forward</span></a></div>
        <div class="about-quality__panel"><h3><?php echo esc_html(jinseal_acf_value('about_recognition_title', $page_id, 'Industry Recognition')); ?></h3><ul><?php foreach ($recognition_items as $item) : ?><li><span class="material-symbols-outlined icon-fill">check_circle</span><?php echo esc_html($item['text'] ?? ''); ?></li><?php endforeach; ?></ul></div>
    </div></div></section>

    <section class="about-milestones bg-white"><div class="about-container">
        <div class="about-section-head about-section-head--left"><div class="about-eyebrow"><span></span><p><?php echo esc_html(jinseal_acf_value('about_milestones_eyebrow', $page_id, 'Milestones')); ?></p></div><h2><?php echo esc_html(jinseal_acf_value('about_milestones_title', $page_id)); ?></h2><p><?php echo esc_html(jinseal_acf_value('about_milestones_text', $page_id)); ?></p></div>
        <div class="about-timeline-shell" data-timeline-carousel><div class="about-timeline-rail"><span>JINSEAL</span><strong>Development History</strong></div><div class="about-timeline"><?php foreach ($milestones as $item) : ?><article><time><span><?php echo esc_html($item['month'] ?? ''); ?></span><?php echo esc_html($item['year'] ?? ''); ?></time><p><?php echo esc_html($item['text'] ?? ''); ?></p></article><?php endforeach; ?></div><div class="about-timeline-controls"><button type="button" aria-label="Previous milestone" data-timeline-prev><span class="material-symbols-outlined">chevron_left</span></button><button class="is-playing" type="button" aria-label="Pause milestone carousel" data-timeline-toggle><span class="material-symbols-outlined">pause</span></button><button type="button" aria-label="Next milestone" data-timeline-next><span class="material-symbols-outlined">chevron_right</span></button></div></div>
    </div></section>

    <section class="about-industries bg-silver-bg"><div class="about-container">
        <div class="about-section-head"><div class="about-eyebrow"><span></span><p><?php echo esc_html(jinseal_acf_value('about_industries_eyebrow', $page_id, 'Industries We Serve')); ?></p></div><h2><?php echo esc_html(jinseal_acf_value('about_industries_title', $page_id)); ?></h2><p><?php echo esc_html(jinseal_acf_value('about_industries_text', $page_id)); ?></p></div>
        <div class="about-industries__grid"><?php foreach ($industries as $industry) : ?><a href="<?php echo esc_url(get_term_link($industry)); ?>"><?php echo esc_html($industry->name); ?></a><?php endforeach; ?></div>
    </div></section>

    <?php get_template_part('template-parts/inquiry'); ?>
</main>
<?php get_footer(); ?>
