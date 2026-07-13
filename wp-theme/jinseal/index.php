<?php
get_header();
?>
<main class="pt-[118px] md:pt-[118px]">
    <section class="py-section-gap-md bg-white">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-gutter">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('mb-12'); ?>>
                        <h1 class="font-headline-xl text-deep-navy mb-4 text-[32px] font-extrabold leading-[1.2]"><?php the_title(); ?></h1>
                        <div class="font-body-lg text-steel-gray"><?php the_content(); ?></div>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php
get_footer();

