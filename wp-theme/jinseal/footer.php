<?php
if (!defined('ABSPATH')) {
    exit;
}

$email = jinseal_option('site_email', 'info@ginseal.com');
$phone = jinseal_option('site_phone', '+86 (0) 574 - 2370 6900');
$fax = jinseal_option('site_fax', '+86 (0) 574 - 6326 1299');
$address = jinseal_option('site_address', '31 Pengmin Road, Baisha Street, Cixi, Zhejiang 315302 P.R. China');
$footer_intro = jinseal_option('footer_intro', 'JinSeal is a sealing and gasket material manufacturer providing metallic and non-metallic sealing products for global industrial customers since 1997.');
$logo = jinseal_option('site_logo');
$badges = jinseal_field_rows('footer_badges', 'option', [
    ['text' => 'ISO 9001'],
    ['text' => 'Since 1997'],
    ['text' => 'China Manufacturer'],
]);
?>
<footer class="xz-footer bg-deep-navy text-white">
    <div class="border-b border-white/10">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter py-12">
            <div class="grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <?php echo $logo ? jinseal_image($logo, 'medium', ['class' => 'mb-6 h-14 w-auto brightness-0 invert']) : '<p class="font-headline-lg-mobile text-white mb-4">JINSEAL</p>'; ?>
                    <p class="xz-footer__copy text-surface-dim max-w-sm"><?php echo esc_html($footer_intro); ?></p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <?php foreach ($badges as $badge) : ?>
                            <span class="rounded-full border border-white/15 px-3 py-1 font-label-sm uppercase text-surface-dim"><?php echo esc_html($badge['text'] ?? ''); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <h3 class="xz-footer__title mb-5 text-white">Products</h3>
                    <ul class="xz-footer__copy space-y-3 text-surface-dim">
                        <?php foreach (get_terms(['taxonomy' => 'jinseal_product_category', 'hide_empty' => false]) as $term) : ?>
                            <li><a class="transition-colors hover:text-energy-red" href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="lg:col-span-2">
                    <h3 class="xz-footer__title mb-5 text-white">Industries</h3>
                    <ul class="xz-footer__copy space-y-3 text-surface-dim">
                        <?php foreach (get_terms(['taxonomy' => 'jinseal_industry', 'hide_empty' => false]) as $term) : ?>
                            <li><a class="transition-colors hover:text-energy-red" href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="lg:col-span-4">
                    <h3 class="xz-footer__title mb-5 text-white">Contact JinSeal</h3>
                    <div class="xz-footer__copy space-y-4 text-surface-dim">
                        <a class="flex gap-3 transition-colors hover:text-energy-red" href="mailto:<?php echo esc_attr($email); ?>"><span class="material-symbols-outlined text-energy-red text-[20px]">mail</span><span><?php echo esc_html($email); ?></span></a>
                        <a class="flex gap-3 transition-colors hover:text-energy-red" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><span class="material-symbols-outlined text-energy-red text-[20px]">call</span><span><?php echo esc_html($phone); ?></span></a>
                        <div class="flex gap-3"><span class="material-symbols-outlined text-energy-red text-[20px]">fax</span><span><?php echo esc_html($fax); ?></span></div>
                        <div class="flex gap-3"><span class="material-symbols-outlined text-energy-red text-[20px]">location_on</span><span><?php echo esc_html($address); ?></span></div>
                    </div>
                    <a href="<?php echo esc_url(jinseal_page_url('contact') . '#inquiry'); ?>" data-inquiry-popup class="mt-7 inline-flex items-center gap-2 rounded bg-energy-red px-6 py-3 font-label-sm uppercase tracking-wide text-white shadow-lg shadow-energy-red/20 transition-all hover:bg-primary active:scale-95">
                        Request a Quote
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-container-max mx-auto px-margin-mobile py-5 text-center text-sm text-surface-dim md:px-gutter">
        <p>Copyright <?php echo esc_html(gmdate('Y')); ?> JinSeal. All rights reserved.</p>
    </div>
</footer>
<div class="xz-inquiry-modal" data-inquiry-modal hidden>
    <button class="xz-inquiry-modal__backdrop" type="button" data-inquiry-close aria-label="Close inquiry form"></button>
    <div class="xz-inquiry-modal__panel" role="dialog" aria-modal="true" aria-labelledby="xz-inquiry-modal-title">
        <div class="xz-inquiry-modal__header">
            <div>
                <p>Request a Quote</p>
                <h2 id="xz-inquiry-modal-title">Tell us about your sealing project</h2>
            </div>
            <button class="xz-inquiry-modal__close" type="button" data-inquiry-close aria-label="Close inquiry form">
                <span class="material-symbols-outlined" aria-hidden="true">close</span>
            </button>
        </div>
        <div class="xz-inquiry-modal__mount" data-inquiry-modal-mount></div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>
