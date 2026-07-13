<?php
if (!defined('ABSPATH')) {
    exit;
}

$shortcode = jinseal_option('fluent_form_shortcode', '[fluentform id="1"]');
$background = jinseal_option('inquiry_background');
$email = jinseal_option('site_email', 'info@ginseal.com');
$phone = jinseal_option('site_phone', '+86 (0) 574 - 2370 6900');
$eyebrow = jinseal_option('inquiry_eyebrow', 'Send Inquiry');
$title = jinseal_option('inquiry_title', 'Need help choosing a sealing product?');
$text = jinseal_option('inquiry_text', 'Share your working medium, temperature, pressure, flange standard or drawing. JinSeal can recommend suitable gasket, packing, sheet material or sealing accessories for your project.');
$extra_text = jinseal_option('inquiry_extra_text', 'For gasket or packing inquiries, include product size, material preference, order quantity and any available drawings or sample photos so our team can respond more efficiently.');
$stats = jinseal_field_rows('inquiry_stats', 'option', [
    ['label' => 'Response', 'value' => 'Fast Quote'],
    ['label' => 'Support', 'value' => 'Material Advice'],
    ['label' => 'Supply', 'value' => 'OEM / ODM'],
]);
$checklist = jinseal_field_rows('inquiry_checklist', 'option', [
    ['icon' => 'science', 'text' => 'Working medium'],
    ['icon' => 'device_thermostat', 'text' => 'Temp / pressure'],
    ['icon' => 'straighten', 'text' => 'Size / standard'],
    ['icon' => 'description', 'text' => 'Drawing / quantity'],
]);
?>
<section id="inquiry" class="contact-inquiry bg-silver-bg products-inquiry">
    <?php if ($background) : ?>
        <div class="products-inquiry__media" aria-hidden="true">
            <?php echo jinseal_image($background, 'full'); ?>
        </div>
        <div class="products-inquiry__overlay" aria-hidden="true"></div>
    <?php endif; ?>
    <div class="contact-container">
        <div class="contact-inquiry__grid">
            <div class="contact-inquiry__content">
                <div class="contact-eyebrow"><span></span><p><?php echo esc_html($eyebrow); ?></p></div>
                <h2><?php echo esc_html($title); ?></h2>
                <p><?php echo esc_html($text); ?></p>
                <p><?php echo esc_html($extra_text); ?></p>
                <div class="contact-inquiry__stats">
                    <?php foreach ($stats as $stat) : ?>
                        <div><p><?php echo esc_html($stat['label'] ?? ''); ?></p><strong><?php echo esc_html($stat['value'] ?? ''); ?></strong></div>
                    <?php endforeach; ?>
                </div>
                <div class="contact-inquiry__checklist" aria-label="Helpful inquiry details">
                    <?php foreach ($checklist as $item) : ?>
                        <span><i class="material-symbols-outlined"><?php echo esc_html($item['icon'] ?? 'check_circle'); ?></i><?php echo esc_html($item['text'] ?? ''); ?></span>
                    <?php endforeach; ?>
                </div>
                <div class="contact-inquiry__channels">
                    <a href="mailto:<?php echo esc_attr($email); ?>"><span class="material-symbols-outlined">mail</span><?php echo esc_html($email); ?></a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><span class="material-symbols-outlined">call</span><?php echo esc_html($phone); ?></a>
                </div>
            </div>
            <div class="contact-form" data-inquiry-form-card>
                <div class="contact-form__head">
                    <p>Inquiry Form</p>
                    <h3>Tell us what you need</h3>
                </div>
                <?php echo do_shortcode($shortcode); ?>
            </div>
        </div>
    </div>
</section>
