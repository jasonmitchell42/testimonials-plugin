<?php
if ( ! class_exists( 'JMTestimonialsAdmin' ) ) {
    class JMTestimonialsAdmin {
        public function __construct()
        {
            // todo: add actions for the custom post type
            add_action('init',array($this,'create_post_type'));
        }

        public function create_post_type()
        {
            register_post_type('testimonials', array(
                'labels' => array('name' => 'Testimonials',
                    'singular' => 'Testimonial'),
                'hierarchical' => true,
                'menu_icon' => 'dashicons-testimonial',
                'public' => true,
                'has_archive' => true,
                'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
            ));
        }

        public function columns_head($defaults)
        {
            // todo: add custom values to post columns
        }

        public function columns_content($defaults)
        {
            // todo: match custom columns with content
        }

    }

}

$jm_testimonials_admin = new JMTestimonialsAdmin();