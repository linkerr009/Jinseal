<?php
if (!defined('ABSPATH')) {
    exit;
}

$email = jinseal_option('site_email', 'info@ginseal.com');
$phone = jinseal_option('site_phone', '+86 (0) 574 - 2370 6900');
$logo = jinseal_option('site_logo');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="light">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-background text-on-surface font-body-md antialiased overflow-x-hidden selection:bg-energy-red selection:text-white'); ?>>
<?php wp_body_open(); ?>
<section class="xz-topbar">
    <div class="xz-topbar__inner">
        <span class="xz-topbar__label">JinSeal Sealing Solutions</span>
        <a class="xz-topbar__label" href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
        <a class="xz-topbar__label" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
    </div>
</section>
<nav class="xz-header">
    <div class="xz-header__inner">
        <a class="xz-header__brand" href="<?php echo esc_url(home_url('/')); ?>">
            <?php echo $logo ? jinseal_image($logo, 'medium') : '<span>JINSEAL</span>'; ?>
        </a>
        <div class="xz-header__nav">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <a href="<?php echo esc_url(jinseal_page_url('about')); ?>">About</a>
            <div class="xz-nav-item">
                <a class="xz-nav-link" href="<?php echo esc_url(jinseal_products_url()); ?>">Products <span class="material-symbols-outlined">expand_more</span></a>
                <div class="xz-nav-dropdown">
                    <?php foreach (get_terms(['taxonomy' => 'jinseal_product_category', 'hide_empty' => false]) as $term) : ?>
                        <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="xz-nav-item">
                <a class="xz-nav-link" href="<?php echo esc_url(home_url('/industry/chemical-petrochemical/')); ?>">Industry <span class="material-symbols-outlined">expand_more</span></a>
                <div class="xz-nav-dropdown">
                    <?php foreach (get_terms(['taxonomy' => 'jinseal_industry', 'hide_empty' => false]) as $term) : ?>
                        <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="<?php echo esc_url(jinseal_page_url('contact')); ?>">Contact</a>
        </div>
        <div class="xz-header__actions">
            <a class="xz-header__cta" href="<?php echo esc_url(jinseal_page_url('contact') . '#inquiry'); ?>">Request a Quote</a>
        </div>
        <div class="xz-header__mobile">
            <button
                class="xz-header__mobile-btn"
                type="button"
                aria-expanded="false"
                aria-controls="xz-mobile-menu"
                aria-label="Open menu"
            >
                <span class="material-symbols-outlined" aria-hidden="true">menu</span>
            </button>
        </div>
    </div>
    <div class="xz-mobile-menu" id="xz-mobile-menu" aria-hidden="true">
        <div class="xz-mobile-menu__inner">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <a href="<?php echo esc_url(jinseal_page_url('about')); ?>">About</a>
            <div class="xz-mobile-menu__group">
                <button type="button" aria-expanded="false">
                    <span>Products</span>
                    <span class="material-symbols-outlined" aria-hidden="true">expand_more</span>
                </button>
                <div class="xz-mobile-menu__submenu">
                    <a href="<?php echo esc_url(jinseal_products_url()); ?>">All Products</a>
                    <?php foreach (get_terms(['taxonomy' => 'jinseal_product_category', 'hide_empty' => false]) as $term) : ?>
                        <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="xz-mobile-menu__group">
                <button type="button" aria-expanded="false">
                    <span>Industry</span>
                    <span class="material-symbols-outlined" aria-hidden="true">expand_more</span>
                </button>
                <div class="xz-mobile-menu__submenu">
                    <?php foreach (get_terms(['taxonomy' => 'jinseal_industry', 'hide_empty' => false]) as $term) : ?>
                        <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="<?php echo esc_url(jinseal_page_url('contact')); ?>">Contact</a>
            <a class="xz-mobile-menu__cta" href="<?php echo esc_url(jinseal_page_url('contact') . '#inquiry'); ?>">Request a Quote</a>
        </div>
    </div>
</nav>
