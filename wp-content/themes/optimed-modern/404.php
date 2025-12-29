<?php
/**
 * 404 Error Page Template
 *
 * @package Optimed_Modern
 */

get_header();
?>

<main id="primary" class="site-content">
    <div class="container">
        <article class="card text-center error-404 not-found">
            <header class="entry-header">
                <h1 class="entry-title" style="font-size: 6rem; color: var(--primary-color);">404</h1>
                <h2><?php esc_html_e('Oops! Page Not Found', 'optimed-modern'); ?></h2>
            </header>

            <div class="entry-content">
                <p><?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'optimed-modern'); ?></p>
                
                <div style="margin: 2rem 0;">
                    <?php get_search_form(); ?>
                </div>

                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <i class="fas fa-home"></i>
                    <?php esc_html_e('Go to Homepage', 'optimed-modern'); ?>
                </a>
            </div>
        </article>

        <?php if (is_active_sidebar('sidebar-1')) : ?>
            <section class="widget-area mt-2">
                <h3><?php esc_html_e('You might be interested in:', 'optimed-modern'); ?></h3>
                <?php dynamic_sidebar('sidebar-1'); ?>
            </section>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
