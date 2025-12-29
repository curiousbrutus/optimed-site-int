<?php
/**
 * Search Form Template
 *
 * @package Optimed_Modern
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <span class="screen-reader-text"><?php esc_html_e('Search for:', 'optimed-modern'); ?></span>
        <input type="search" class="search-field" placeholder="<?php esc_attr_e('Search...', 'optimed-modern'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit">
        <i class="fas fa-search"></i>
        <span class="screen-reader-text"><?php esc_html_e('Search', 'optimed-modern'); ?></span>
    </button>
</form>

<style>
.search-form {
    display: flex;
    max-width: 500px;
    margin: 0 auto;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow);
}

.search-form label {
    flex: 1;
    margin: 0;
}

.search-field {
    width: 100%;
    padding: 0.75rem 1rem;
    border: none;
    font-size: 1rem;
    outline: none;
}

.search-submit {
    padding: 0.75rem 1.5rem;
    background: var(--primary-color);
    color: var(--white);
    border: none;
    cursor: pointer;
    transition: var(--transition);
}

.search-submit:hover {
    background: var(--secondary-color);
}

.screen-reader-text {
    position: absolute;
    left: -9999px;
}
</style>
