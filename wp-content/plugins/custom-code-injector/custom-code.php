<?php
/*
Plugin Name: Custom Code Injector
Plugin URI: https://example.com
Description: Display custom CSS and JavaScript code from files in the admin panel.
Version: 1.0
Author: Your Name
Author URI: https://example.com
*/

if (!defined('ABSPATH')) {
    exit; // Direct access prevention
}

// Add admin menu
function cci_add_admin_menu() {
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
    // 파일 경로 설정
    $plugin_dir = plugin_dir_path(__FILE__);
    $css_file = $plugin_dir . 'custom-code.css';
    $homepage_js_file = $plugin_dir . 'homepage-code.js';
    $about_js_file = $plugin_dir . 'about-code.js';

    // 파일 내용 읽기
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

// Load custom CSS and JavaScript on the website
function cci_insert_custom_code() {
    $plugin_url = plugin_dir_url(__FILE__);

    // Custom CSS
    $css_file_url = $plugin_url . 'custom-code.css';
    echo '<link rel="stylesheet" href="' . esc_url($css_file_url) . '">';

    // Homepage JavaScript
    if (is_front_page()) {
        $homepage_js_file_url = $plugin_url . 'homepage-code.js';
        echo '<script src="' . esc_url($homepage_js_file_url) . '"></script>';
    }

    // About Page JavaScript
    if (is_page(72)) { 
        $about_js_file_url = $plugin_url . 'about-code.js';
        echo '<script src="' . esc_url($about_js_file_url) . '"></script>';
    }

    if (is_page(75)) { 
        $contact_js_file_url = $plugin_url . 'contact-code.js';
        echo '<script src="' . esc_url($contact_js_file_url) . '"></script>';
    }

}
add_action('wp_head', 'cci_insert_custom_code');
