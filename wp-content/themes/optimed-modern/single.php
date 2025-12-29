<?php
/**
 * Single Post Template
 *
 * @package Optimed_Modern
 */

get_header();
?>

<main id="primary" class="site-content">
    <div class="container">
        <?php optimed_modern_breadcrumbs(); ?>

        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                    <?php if ('post' === get_post_type()) : ?>
                        <div class="entry-meta">
                            <span class="posted-on">
                                <i class="far fa-calendar"></i>
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="byline">
                                <i class="far fa-user"></i>
                                <?php the_author(); ?>
                            </span>
                            <?php if (has_category()) : ?>
                                <span class="categories">
                                    <i class="far fa-folder"></i>
                                    <?php the_category(', '); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'optimed-modern'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <?php if (has_tag()) : ?>
                    <footer class="entry-footer">
                        <div class="tags">
                            <i class="fas fa-tags"></i>
                            <?php the_tags('', ', ', ''); ?>
                        </div>
                    </footer>
                <?php endif; ?>
            </article>

            <?php
            // Previous/Next post navigation
            the_post_navigation(array(
                'prev_text' => '<i class="fas fa-arrow-left"></i> %title',
                'next_text' => '%title <i class="fas fa-arrow-right"></i>',
            ));

            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
