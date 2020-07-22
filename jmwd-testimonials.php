<?php
/*
Plugin Name:  JMWD Testimonials
Description:  A custom testimonial plugin
Version:      1.0
Author:       Jason Mitchell Web Development
Text Domain:  jmwd-testimonials
Domain Path:  /languages
 */

require_once(__DIR__ . '/admin/class-JMTestimonialsAdmin.php');

if (!class_exists('JMTestimonials')) {
    class JMTestimonials
    {

        public function __construct()
        {
            add_shortcode('testimonial_slider', array($this, 'slider'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        }

        public function enqueue_scripts()
        {
            wp_deregister_script('jquery');

            wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js", "", "3.5.1", true);
            wp_register_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js', array('jquery'), '1.6.0', true); // Custom scripts
            wp_register_script('jmwd-script', plugins_url('/public/js/script.js', __FILE__), array('jquery', 'slick'), 1, true);
            wp_enqueue_script('jquery');
            wp_enqueue_script('slick');
            wp_enqueue_script('jmwd-script');
        }

        public function enqueue_styles()
        {
            wp_enqueue_style('slick', "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css", array(), '1.9.0');
            wp_enqueue_style('slick-theme', "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css", array(), '1.9.0');
            wp_enqueue_style('jmwd-style', plugins_url('/public/css/style.css', __FILE__), array('slick','slick-theme'), 0.1);
        }

        public function slider($atts)
        {
            $atts = shortcode_atts(
                array(),
                $atts,
                'testimonial_slider'
            );
            ob_start();

            $args = array('post_type' => 'testimonials');
            $testimonials = new WP_Query($args);
            echo ("<div class='container-fluid testimonial-slider-wrapper py-5'><div class='container'><div class='row'><div class='col-12'><div class='testimonial-slider'>");
            while ($testimonials->have_posts()) {
                $testimonials->the_post();
                printf("<div class='slider-wrapper'>");
                the_title("<h2>", "</h2>");
                the_excerpt();
                printf("</div>");
                /*
                ?>
                <div>
                    <h2><?php the_title() ?></h2>
                    <div><?php the_content() ?></div>
                </div>
                <?php
*/
            }
            echo "</div></div></div></div></div>";
            return ob_get_clean();
        }

    }

}

$jm_testimonial = new JMTestimonials;