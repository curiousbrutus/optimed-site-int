<?php
/**
 * Theme Functions
 * 
 * @package Optimed_Modern
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function optimed_modern_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'optimed-modern'),
        'footer'  => __('Footer Menu', 'optimed-modern'),
    ));
    
    // Set content width
    $GLOBALS['content_width'] = 1200;
}
add_action('after_setup_theme', 'optimed_modern_setup');

/**
 * Enqueue Scripts and Styles
 */
function optimed_modern_scripts() {
    // Main stylesheet
    wp_enqueue_style('optimed-modern-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Custom JavaScript
    wp_enqueue_script('optimed-modern-script', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
    
    // Font Awesome for icons
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
}
add_action('wp_enqueue_scripts', 'optimed_modern_scripts');

/**
 * Register Widget Areas
 */
function optimed_modern_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'optimed-modern'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'optimed-modern'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 1', 'optimed-modern'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'optimed-modern'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 2', 'optimed-modern'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in your footer.', 'optimed-modern'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 3', 'optimed-modern'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in your footer.', 'optimed-modern'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'optimed_modern_widgets_init');

/**
 * Performance Optimizations
 */
// Disable emoji scripts
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Remove jQuery migrate
function optimed_modern_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', 'optimed_modern_remove_jquery_migrate');

// Lazy load images
function optimed_modern_lazy_load_images($content) {
    if (is_feed() || is_admin()) {
        return $content;
    }
    
    $content = preg_replace('/<img(.*?)src=/i', '<img$1loading="lazy" src=', $content);
    return $content;
}
add_filter('the_content', 'optimed_modern_lazy_load_images');

/**
 * Custom Excerpt Length
 */
function optimed_modern_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'optimed_modern_excerpt_length');

/**
 * Custom Excerpt More
 */
function optimed_modern_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'optimed_modern_excerpt_more');

/**
 * Security Headers
 */
function optimed_modern_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
}
add_action('send_headers', 'optimed_modern_security_headers');

/**
 * Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Remove version from scripts and styles
 */
function optimed_modern_remove_version_scripts_styles($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'optimed_modern_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'optimed_modern_remove_version_scripts_styles', 9999);

/**
 * Breadcrumbs Function
 */
function optimed_modern_breadcrumbs() {
    $delimiter = ' &raquo; ';
    $home = __('Home', 'optimed-modern');
    $before = '<span class="current">';
    $after = '</span>';
    
    if (!is_home() && !is_front_page() || is_paged()) {
        echo '<div class="breadcrumbs">';
        global $post;
        $homeLink = home_url();
        echo '<a href="' . $homeLink . '">' . $home . '</a>' . $delimiter;
        
        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) {
                echo get_category_parents($parentCat, TRUE, $delimiter);
            }
            echo $before . single_cat_title('', false) . $after;
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter;
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $delimiter;
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo get_category_parents($cat, TRUE, $delimiter);
                echo $before . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, $delimiter);
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>' . $delimiter;
            echo $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb . $delimiter;
            }
            echo $before . get_the_title() . $after;
        } elseif (is_search()) {
            echo $before . __('Search results for: ', 'optimed-modern') . get_search_query() . $after;
        } elseif (is_tag()) {
            echo $before . __('Tag: ', 'optimed-modern') . single_tag_title('', false) . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . __('Author: ', 'optimed-modern') . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . __('Error 404', 'optimed-modern') . $after;
        }
        
        if (get_query_var('paged')) {
            echo ' (' . __('Page', 'optimed-modern') . ' ' . get_query_var('paged') . ')';
        }
        
        echo '</div>';
    }
}
