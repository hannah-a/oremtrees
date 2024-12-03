<?php
/*
Plugin Name: Custom Code Injector
Plugin URI: https://example.com
Description: Inject custom CSS and JavaScript code to specific pages.
Version: 1.0
Author: Joonsung Byun
Author URI: https://example.com
*/

if (!defined('ABSPATH')) {
    exit; // Direct access prevention
}

// Add admin menu
function cci_add_admin_menu()
{
    add_menu_page(
        'Custom Code Injector', // Page title
        'Custom Code', // Menu title
        'manage_options', // Capability
        'custom-code-injector', // Menu slug
        'cci_options_page' // Callback function
    );
}
add_action('admin_menu', 'cci_add_admin_menu');

// Options page
function cci_options_page() {
    
    $plugin_dir = plugin_dir_path(__FILE__);
    $css_file = $plugin_dir . 'custom-code.css';
    $homepage_js_file = $plugin_dir . 'homepage-code.js';
    $about_js_file = $plugin_dir . 'about-code.js';

    $custom_css = file_exists($css_file) ? file_get_contents($css_file) : '';
    $homepage_js = file_exists($homepage_js_file) ? file_get_contents($homepage_js_file) : '';
    $about_js = file_exists($about_js_file) ? file_get_contents($about_js_file) : '';
    ?>

    <div class="wrap">
        <h1>Custom Code Injector</h1>
        <h2>Custom CSS Code</h2>
        <textarea rows="10" cols="50" readonly><?php echo esc_textarea($custom_css); ?></textarea>

        <h2>Homepage JavaScript Code</h2>
        <textarea rows="10" cols="50" readonly><?php echo esc_textarea($homepage_js); ?></textarea>

        <h2>About Page JavaScript Code</h2>
        <textarea rows="10" cols="50" readonly><?php echo esc_textarea($about_js); ?></textarea>
    </div>
    <?php
}


function cci_insert_custom_code() {
    if (!is_page()) {
        return;
        //return!!!!!!!!!!!
    }

    global $post;
    $plugin_url = plugin_dir_url(__FILE__);
    $page_slug = $post->post_name; // Get the page slug, for exmaple, if the user in on tress/pine-tree, the slug is pine-tree

    // if the page url: /trees/home, then load the trees-home.js file and trees-home.css file
    if ($page_slug === 'trees/home') {
        wp_enqueue_script('trees-home-js', $plugin_url . 'js/trees-home.js', array(), null, true);
        wp_enqueue_style('trees-home-css', $plugin_url . 'css/trees-home.css');
    }  
    //if the page url: /trees/about, then load the trees-about.js file and trees-about.css file 
    elseif ($page_slug === 'trees/about' || is_page(72)) {
        wp_enqueue_script('trees-about-js', $plugin_url . 'js/trees-about.js', array(), null, true);
        wp_enqueue_style('trees-about-css', $plugin_url . 'css/trees-about.css');
    } 
    // if the page url: /trees/* but not /trees/home or /trees/about, then load the trees-code.js file and trees-code.css file
    elseif (strpos($page_slug, 'trees/') === 0) {
        wp_enqueue_script('trees-code-js', $plugin_url . 'js/trees-code.js', array(), null, true);
        wp_enqueue_style('trees-code-css', $plugin_url . 'css/trees-code.css');
    }
}
add_action('wp_enqueue_scripts', 'cci_insert_custom_code');

