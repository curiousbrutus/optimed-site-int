/*
Template Name: Front Page
Template Post Type: page
*/

<?php get_header(); ?>

<main id="primary" class="site-content">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <section id="services" class="services-section">
            <div class="container">
                <h2 class="text-center"><?php esc_html_e('Our Services', 'optimed-modern'); ?></h2>
                
                <div class="card-grid">
                    <div class="card">
                        <i class="fas fa-heartbeat" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                        <h3><?php esc_html_e('Emergency Care', 'optimed-modern'); ?></h3>
                        <p><?php esc_html_e('24/7 emergency medical services with highly trained staff and modern equipment.', 'optimed-modern'); ?></p>
                    </div>
                    
                    <div class="card">
                        <i class="fas fa-user-md" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                        <h3><?php esc_html_e('Specialist Doctors', 'optimed-modern'); ?></h3>
                        <p><?php esc_html_e('Expert specialists across various medical fields to provide comprehensive care.', 'optimed-modern'); ?></p>
                    </div>
                    
                    <div class="card">
                        <i class="fas fa-procedures" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                        <h3><?php esc_html_e('Advanced Surgery', 'optimed-modern'); ?></h3>
                        <p><?php esc_html_e('State-of-the-art surgical facilities with experienced surgical teams.', 'optimed-modern'); ?></p>
                    </div>
                    
                    <div class="card">
                        <i class="fas fa-microscope" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                        <h3><?php esc_html_e('Laboratory', 'optimed-modern'); ?></h3>
                        <p><?php esc_html_e('Fully equipped laboratory for accurate and fast diagnostic testing.', 'optimed-modern'); ?></p>
                    </div>
                    
                    <div class="card">
                        <i class="fas fa-x-ray" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                        <h3><?php esc_html_e('Radiology', 'optimed-modern'); ?></h3>
                        <p><?php esc_html_e('Advanced imaging services including MRI, CT scan, and X-ray facilities.', 'optimed-modern'); ?></p>
                    </div>
                    
                    <div class="card">
                        <i class="fas fa-pills" style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                        <h3><?php esc_html_e('Pharmacy', 'optimed-modern'); ?></h3>
                        <p><?php esc_html_e('On-site pharmacy with a wide range of medications and healthcare products.', 'optimed-modern'); ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="about-section" style="background: var(--light-bg); padding: 4rem 0;">
            <div class="container">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
                    <div>
                        <h2><?php esc_html_e('About Optimed Hospital', 'optimed-modern'); ?></h2>
                        <?php the_content(); ?>
                    </div>
                    <div>
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', array('style' => 'border-radius: var(--border-radius); box-shadow: var(--shadow);')); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="contact-section" style="padding: 4rem 0;">
            <div class="container">
                <h2 class="text-center"><?php esc_html_e('Contact Us', 'optimed-modern'); ?></h2>
                
                <div class="card-grid">
                    <div class="card text-center">
                        <i class="fas fa-phone" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                        <h3><?php esc_html_e('Phone', 'optimed-modern'); ?></h3>
                        <p>+90 XXX XXX XX XX</p>
                    </div>
                    
                    <div class="card text-center">
                        <i class="fas fa-envelope" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                        <h3><?php esc_html_e('Email', 'optimed-modern'); ?></h3>
                        <p>info@optimedhospital.com</p>
                    </div>
                    
                    <div class="card text-center">
                        <i class="fas fa-map-marker-alt" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem;"></i>
                        <h3><?php esc_html_e('Address', 'optimed-modern'); ?></h3>
                        <p><?php esc_html_e('Address will be here', 'optimed-modern'); ?></p>
                    </div>
                </div>
                
                <div class="card mt-2">
                    <h3 class="text-center"><?php esc_html_e('Send us a message', 'optimed-modern'); ?></h3>
                    <?php echo do_shortcode('[contact-form-7]'); ?>
                </div>
            </div>
        </section>
    <?php
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
