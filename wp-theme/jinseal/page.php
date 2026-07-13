<?php get_header(); ?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="products-hero">
        <div class="products-container products-hero__inner">
            <div>
                <div class="products-eyebrow products-eyebrow--inverse"><span></span><p><?php echo esc_html(jinseal_acf_value('hero_eyebrow', get_the_ID(), get_the_title())); ?></p></div>
                <h1><?php echo esc_html(jinseal_acf_value('hero_title', get_the_ID(), get_the_title())); ?></h1>
                <p><?php echo esc_html(jinseal_acf_value('hero_text', get_the_ID(), get_the_excerpt())); ?></p>
            </div>
        </div>
    </section>
    <section class="py-section-gap-md bg-white">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
            <?php the_content(); ?>
            <?php if (have_rows('page_sections')) : ?>
                <?php while (have_rows('page_sections')) : the_row(); ?>
                    <section class="py-10">
                        <div class="about-eyebrow"><span></span><p><?php echo esc_html(get_sub_field('eyebrow')); ?></p></div>
                        <h2 class="font-headline-xl text-deep-navy mb-4 text-[32px] font-extrabold leading-[1.2]"><?php echo esc_html(get_sub_field('title')); ?></h2>
                        <div class="font-body-lg text-steel-gray"><?php echo wp_kses_post(get_sub_field('content')); ?></div>
                        <?php echo jinseal_image(get_sub_field('image'), 'large', ['class' => 'mt-6 w-full h-auto']); ?>
                    </section>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>
    <?php get_template_part('template-parts/inquiry'); ?>
</main>
<?php get_footer(); ?>
