<?php
/*
Plugin Name: Custom Code Injector
Plugin URI: https://example.com
Description: Add custom CSS and JavaScript to your site.
Version: 1.0
Author: Your Name
Author URI: https://example.com
*/

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
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
    ?>
    <div class="wrap">
        <h1>Custom Code Injector</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('cci_options_group');
            do_settings_sections('custom-code-injector');
            ?>
            <h2>Custom CSS Code</h2>
            <textarea name="cci_custom_css" rows="10" cols="50"><?php echo esc_textarea(cci_load_css_code()); ?></textarea>
            
            <h2>Homepage JavaScript Code</h2>
            <textarea name="cci_homepage_js" rows="10" cols="50"><?php echo esc_textarea(cci_load_homepage_js_code()); ?></textarea>
            
            <h2>About Page JavaScript Code</h2>
            <textarea name="cci_about_js" rows="10" cols="50"><?php echo esc_textarea(cci_load_about_js_code()); ?></textarea>
            
            <?php
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings and add fields
function cci_settings_init() {

    add_settings_section('cci_section', 'Custom Code Settings', null, 'custom-code-injector');

    add_settings_field('cci_custom_css', 'Custom CSS', 'cci_custom_css_field', 'custom-code-injector', 'cci_section');
    add_settings_field('cci_homepage_js', 'Homepage JavaScript', 'cci_homepage_js_field', 'custom-code-injector', 'cci_section');
    add_settings_field('cci_about_js', 'About Page JavaScript', 'cci_about_js_field', 'custom-code-injector', 'cci_section');
}
add_action('admin_init', 'cci_settings_init');

// Field output functions
function cci_custom_css_field() {
    $custom_css = get_option('cci_custom_css', '');
    echo '<textarea name="cci_custom_css" rows="10" cols="50" class="large-text code">' . esc_textarea($custom_css) . '</textarea>';
}

function cci_homepage_js_field() {
    $homepage_js = get_option('cci_homepage_js', '');
    echo '<textarea name="cci_homepage_js" rows="10" cols="50" class="large-text code">' . esc_textarea($homepage_js) . '</textarea>';
}

function cci_about_js_field() {
    $about_js = get_option('cci_about_js', '');
    echo '<textarea name="cci_about_js" rows="10" cols="50" class="large-text code">' . esc_textarea($about_js) . '</textarea>';
}

// Save CSS and JS code to files
function cci_save_css_code($code) {
    $file = plugin_dir_path(__FILE__) . 'custom-code.css';
    file_put_contents($file, $code);
    return $code;
}

function cci_save_homepage_js_code($code) {
    $file = plugin_dir_path(__FILE__) . 'homepage-code.js';
    file_put_contents($file, $code);
    return $code;
}

function cci_save_about_js_code($code) {
    $file = plugin_dir_path(__FILE__) . 'about-code.js';
    file_put_contents($file, $code);
    return $code;
}

// Load CSS and JS code from files
function cci_load_css_code() {
    $file = plugin_dir_path(__FILE__) . 'custom-code.css';
    if (file_exists($file)) {
        return file_get_contents($file);
    }
    return '';
}

function cci_load_homepage_js_code() {
    $file = plugin_dir_path(__FILE__) . 'homepage-code.js';
    if (file_exists($file)) {
        return file_get_contents($file);
    }
    return '';
}

function cci_load_about_js_code() {
    $file = plugin_dir_path(__FILE__) . 'about-code.js';
    if (file_exists($file)) {
        return file_get_contents($file);
    }
    return '';
}

// Insert custom code into the appropriate pages
function cci_insert_custom_code() {
    $upload_dir = wp_upload_dir();

    // Insert Homepage JavaScript
    $homepage_js = get_option('cci_homepage_js');
    if ($homepage_js) {
        $homepage_js_file_path = $upload_dir['basedir'] . '/custom-code-injector/homepage-script.js';

        if (!file_exists($upload_dir['basedir'] . '/custom-code-injector')) {
            mkdir($upload_dir['basedir'] . '/custom-code-injector', 0755, true);
        }

        file_put_contents($homepage_js_file_path, $homepage_js);

        if (is_front_page()) {
            $homepage_js_file_url = $upload_dir['baseurl'] . '/custom-code-injector/homepage-script.js';
            echo '<script src="' . esc_url($homepage_js_file_url) . '"></script>';
        }
    }

    // Insert About Page JavaScript
    $about_js = get_option('cci_about_js');
    if ($about_js) {
        $about_js_file_path = $upload_dir['basedir'] . '/custom-code-injector/about-script.js';

        file_put_contents($about_js_file_path, $about_js);

        if (is_page(72)) {
            $about_js_file_url = $upload_dir['baseurl'] . '/custom-code-injector/about-script.js';
            echo '<script src="' . esc_url($about_js_file_url) . '"></script>';
        }
    }
}
add_action('wp_head', 'cci_insert_custom_code');