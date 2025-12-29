<?php
/**
 * The main template file
 *
 * @package Optimed_Modern
 */

get_header();
?>

<main id="primary" class="site-content">
    <div class="container">
        <?php if (!is_front_page()) : ?>
            <?php optimed_modern_breadcrumbs(); ?>
        <?php endif; ?>

        <?php if (have_posts()) : ?>

            <div class="card-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <header class="entry-header">
                            <?php
                            if (is_singular()) :
                                the_title('<h1 class="entry-title">', '</h1>');
                            else :
                                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                            endif;
                            ?>

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
                                </div>
                            <?php endif; ?>
                        </header>

                        <div class="entry-content">
                            <?php
                            if (is_singular()) :
                                the_content();
                                
                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'optimed-modern'),
                                    'after'  => '</div>',
                                ));
                            else :
                                the_excerpt();
                                ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                    <?php esc_html_e('Read More', 'optimed-modern'); ?>
                                </a>
                                <?php
                            endif;
                            ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            the_posts_navigation(array(
                'prev_text' => '<i class="fas fa-arrow-left"></i> ' . __('Older posts', 'optimed-modern'),
                'next_text' => __('Newer posts', 'optimed-modern') . ' <i class="fas fa-arrow-right"></i>',
            ));
            ?>

        <?php else : ?>

            <article class="card no-results not-found">
                <header class="entry-header">
                    <h1 class="entry-title"><?php esc_html_e('Nothing Found', 'optimed-modern'); ?></h1>
                </header>

                <div class="entry-content">
                    <?php if (is_home() && current_user_can('publish_posts')) : ?>
                        <p><?php
                        printf(
                            wp_kses(
                                __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'optimed-modern'),
                                array(
                                    'a' => array(
                                        'href' => array(),
                                    ),
                                )
                            ),
                            esc_url(admin_url('post-new.php'))
                        );
                        ?></p>
                    <?php elseif (is_search()) : ?>
                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'optimed-modern'); ?></p>
                        <?php get_search_form(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'optimed-modern'); ?></p>
                        <?php get_search_form(); ?>
                    <?php endif; ?>
                </div>
            </article>

        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
