<?php
/* Template Name: JinSeal Contact */
get_header();

$page_id = get_the_ID();
$email = jinseal_option('site_email', 'info@ginseal.com');
$phone = jinseal_option('site_phone', '+86 (0) 574 - 2370 6900');
$fax = jinseal_option('site_fax', '+86 (0) 574 - 6326 1299');
$address = jinseal_option('site_address', '31 Pengmin Road, Baisha Street, Cixi, Zhejiang 315302 P.R. China');
$hero_panels = jinseal_field_rows('contact_hero_panels', $page_id);
$map_url = jinseal_acf_value('contact_map_url', $page_id, 'https://www.openstreetmap.org/export/embed.html?bbox=121.236%2C30.145%2C121.296%2C30.195&layer=mapnik&marker=30.17078%2C121.266595');
?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="contact-hero">
        <div class="contact-hero__media"><?php echo jinseal_image(jinseal_acf_value('hero_image', $page_id), 'full'); ?><div class="contact-hero__overlay"></div></div>
        <div class="contact-container contact-hero__inner">
            <div class="contact-hero__copy">
                <div class="contact-eyebrow contact-eyebrow--inverse"><span></span><p><?php echo esc_html(jinseal_acf_value('hero_eyebrow', $page_id, 'Contact JinSeal')); ?></p></div>
                <h1><?php echo esc_html(jinseal_acf_value('hero_title', $page_id, 'Tell us about your sealing project.')); ?></h1>
                <p><?php echo esc_html(jinseal_acf_value('hero_text', $page_id)); ?></p>
                <div class="contact-hero__crumbs"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="material-symbols-outlined">chevron_right</span><span>Contact Us</span></div>
            </div>
            <div class="contact-hero__panel">
                <?php foreach ($hero_panels as $panel) : ?><div><span class="material-symbols-outlined icon-fill"><?php echo esc_html($panel['icon'] ?? 'schedule'); ?></span><strong><?php echo esc_html($panel['title'] ?? ''); ?></strong><p><?php echo esc_html($panel['text'] ?? ''); ?></p></div><?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="contact-overview bg-white"><div class="contact-container"><div class="contact-card-grid">
        <a class="contact-info-card" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><span class="material-symbols-outlined">call</span><p>Phone Number</p><strong><?php echo esc_html($phone); ?></strong></a>
        <a class="contact-info-card" href="mailto:<?php echo esc_attr($email); ?>"><span class="material-symbols-outlined">mail</span><p>Email Address</p><strong><?php echo esc_html($email); ?></strong></a>
        <div class="contact-info-card"><span class="material-symbols-outlined">fax</span><p>Fax</p><strong><?php echo esc_html($fax); ?></strong></div>
        <div class="contact-info-card contact-info-card--wide"><span class="material-symbols-outlined">location_on</span><p>Office Address</p><strong><?php echo esc_html($address); ?></strong></div>
    </div></div></section>

    <?php get_template_part('template-parts/inquiry'); ?>

    <section class="contact-map bg-white"><div class="contact-container">
        <div class="contact-map__head"><div class="contact-eyebrow"><span></span><p><?php echo esc_html(jinseal_acf_value('contact_map_eyebrow', $page_id, 'Visit & Cooperation')); ?></p></div><h2><?php echo esc_html(jinseal_acf_value('contact_map_title', $page_id, 'Find JinSeal in Cixi, Zhejiang.')); ?></h2><p><?php echo esc_html(jinseal_acf_value('contact_map_text', $page_id)); ?></p></div>
        <div class="contact-map__shell">
            <iframe title="JinSeal location map" src="<?php echo esc_url($map_url); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="contact-map__card">
                <div><span class="material-symbols-outlined icon-fill">location_on</span><div><p>Office Address</p><strong><?php echo esc_html($address); ?></strong></div></div>
                <div><span class="material-symbols-outlined icon-fill">mail</span><div><p>Email</p><strong><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></strong></div></div>
                <div><span class="material-symbols-outlined icon-fill">call</span><div><p>Phone</p><strong><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></strong></div></div>
            </div>
        </div>
    </div></section>
</main>
<?php get_footer(); ?>
