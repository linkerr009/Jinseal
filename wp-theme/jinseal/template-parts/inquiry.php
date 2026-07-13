<?php
if (!defined('ABSPATH')) {
    exit;
}

$shortcode = jinseal_option('fluent_form_shortcode', '[fluentform id="1"]');
?>
<section id="inquiry" class="contact-inquiry bg-silver-bg products-inquiry">
    <div class="contact-container">
        <div class="contact-inquiry__grid">
            <div class="contact-inquiry__content">
                <div class="contact-eyebrow"><span></span><p>Send Inquiry</p></div>
                <h2>Need help choosing a sealing product?</h2>
                <p>Share your working medium, temperature, pressure, flange standard or drawing. JinSeal can recommend suitable gasket, packing, sheet material or sealing accessories for your project.</p>
                <div class="contact-inquiry__stats">
                    <div><p>Response</p><strong>Fast Quote</strong></div>
                    <div><p>Support</p><strong>Material Advice</strong></div>
                    <div><p>Supply</p><strong>OEM / ODM</strong></div>
                </div>
            </div>
            <div class="contact-form">
                <?php echo do_shortcode($shortcode); ?>
            </div>
        </div>
    </div>
</section>

