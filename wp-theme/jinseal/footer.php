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
<footer class="bg-deep-navy text-white">
    <div class="border-b border-white/10">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter py-12">
            <div class="grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <?php echo $logo ? jinseal_image($logo, 'medium', ['class' => 'mb-6 h-14 w-auto brightness-0 invert']) : '<p class="font-headline-lg-mobile text-white mb-4">JINSEAL</p>'; ?>
                    <p class="font-body-md text-surface-dim max-w-sm"><?php echo esc_html($footer_intro); ?></p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <?php foreach ($badges as $badge) : ?>
                            <span class="rounded-full border border-white/15 px-3 py-1 font-label-sm uppercase text-surface-dim"><?php echo esc_html($badge['text'] ?? ''); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <h3 class="mb-5 font-headline-lg-mobile text-white">Products</h3>
                    <ul class="space-y-3 font-body-md text-surface-dim">
                        <?php foreach (get_terms(['taxonomy' => 'jinseal_product_category', 'hide_empty' => false]) as $term) : ?>
                            <li><a class="transition-colors hover:text-energy-red" href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="lg:col-span-2">
                    <h3 class="mb-5 font-headline-lg-mobile text-white">Industries</h3>
                    <ul class="space-y-3 font-body-md text-surface-dim">
                        <?php foreach (get_terms(['taxonomy' => 'jinseal_industry', 'hide_empty' => false]) as $term) : ?>
                            <li><a class="transition-colors hover:text-energy-red" href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="lg:col-span-4">
                    <h3 class="mb-5 font-headline-lg-mobile text-white">Contact JinSeal</h3>
                    <div class="space-y-4 font-body-md text-surface-dim">
                        <a class="flex gap-3 transition-colors hover:text-energy-red" href="mailto:<?php echo esc_attr($email); ?>"><span class="material-symbols-outlined text-energy-red text-[20px]">mail</span><span><?php echo esc_html($email); ?></span></a>
                        <a class="flex gap-3 transition-colors hover:text-energy-red" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><span class="material-symbols-outlined text-energy-red text-[20px]">call</span><span><?php echo esc_html($phone); ?></span></a>
                        <div class="flex gap-3"><span class="material-symbols-outlined text-energy-red text-[20px]">fax</span><span><?php echo esc_html($fax); ?></span></div>
                        <div class="flex gap-3"><span class="material-symbols-outlined text-energy-red text-[20px]">location_on</span><span><?php echo esc_html($address); ?></span></div>
                    </div>
                    <a href="<?php echo esc_url(jinseal_page_url('contact') . '#inquiry'); ?>" class="mt-7 inline-flex items-center gap-2 rounded bg-energy-red px-6 py-3 font-label-sm uppercase tracking-wide text-white shadow-lg shadow-energy-red/20 transition-all hover:bg-primary active:scale-95">
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
<?php wp_footer(); ?>
</body>
</html>
