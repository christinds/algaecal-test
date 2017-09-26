<?php

 /*********** PART TWO ANSWER ********/
 function my_init() {
    if (!is_admin()) {
        // comment out the next two lines to load the local copy of jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', false, '1.3.2');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'my_init');
