<?php get_header(); ?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="pd-overview bg-white">
        <div class="pd-container pd-overview__grid">
            <div class="pd-gallery">
                <?php
                $gallery = jinseal_acf_value('product_gallery', get_the_ID(), []);
                if ($gallery) {
                    foreach ($gallery as $image_id) {
                        echo jinseal_image($image_id, 'large', ['class' => 'pd-gallery__image']);
                    }
                } elseif (has_post_thumbnail()) {
                    the_post_thumbnail('large', ['class' => 'pd-gallery__image']);
                }
                ?>
            </div>
            <div class="pd-summary">
                <p class="pd-summary__label"><?php echo esc_html(jinseal_acf_value('product_label', get_the_ID(), 'Product')); ?></p>
                <h1><?php the_title(); ?></h1>
                <p><?php echo esc_html(jinseal_acf_value('product_summary', get_the_ID(), get_the_excerpt())); ?></p>
                <?php if (have_rows('product_features')) : ?>
                    <ul>
                        <?php while (have_rows('product_features')) : the_row(); ?>
                            <li><?php echo esc_html(get_sub_field('feature')); ?></li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
                <a class="pd-btn" href="#inquiry">Request A Quote <span class="material-symbols-outlined">arrow_forward</span></a>
            </div>
        </div>
    </section>
    <section class="pd-content bg-silver-bg">
        <div class="pd-container pd-content__grid">
            <div class="pd-main">
                <?php if (have_rows('description_sections')) : ?>
                    <?php while (have_rows('description_sections')) : the_row(); ?>
                        <section class="pd-description-block">
                            <h2><?php echo esc_html(get_sub_field('title')); ?></h2>
                            <div><?php echo wp_kses_post(get_sub_field('text')); ?></div>
                            <?php echo jinseal_image(get_sub_field('image'), 'large', ['class' => 'w-full h-auto']); ?>
                        </section>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php the_content(); ?>
                <?php endif; ?>
            </div>
            <aside class="pd-sidebar">
                <div class="products-side-cta">
                    <span class="material-symbols-outlined icon-fill">support_agent</span>
                    <h3>Need A Gasket Recommendation?</h3>
                    <p>Send medium, pressure, temperature and flange standard. JinSeal will help select suitable material and structure.</p>
                    <a href="#inquiry">Send Inquiry <span class="material-symbols-outlined">arrow_forward</span></a>
                </div>
            </aside>
        </div>
    </section>
    <?php get_template_part('template-parts/inquiry'); ?>
</main>
<?php get_footer(); ?>

