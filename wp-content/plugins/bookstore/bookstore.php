<?php 
/** 
 * Plugin Name: Bookstore
 * Description: A plugin to manage get_bookmarks
 * Version: 1.0
 */

if (! defined('ABSPATH')) {
    exit; //Exit if accessed directly
}

// adds action so it runs when WordPress is initialized
add_action('init', 'bookstore_register_book_post_type');
//Function to add a post type
function bookstore_register_book_post_type() {
    $args = array(
        'labels' => array (
            'name' => 'Books', 
            'singular_name' => 'Book',
            'menu_name' => 'Books',
            'add_new' => 'Add New Book',
            'add_new_item' => 'Add New Book',
            'new_item' => 'New Book',
            'edit_item' => 'Edit Book',
            'view_item' => 'View Book',
            'all_items' => 'All Books',
        ),
        'public' => true, 
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),

    );
        register_post_type('book', $args);
}

// add action hook to run when WordPress is initialized
add_action('init', 'bookstore_register_book_taxonomy');

function bookstore_register_book_taxonomy() {
    $args = array(
        'labels' => array(
            'name' => 'Genres',
            'singular_name' => 'Genre',
            'edit_item' => 'Edit Genre',
            'update_item' => 'Update Genre',
            'add_new_item' => 'Add New Genre',
            'new_item_name' => 'New Genre Name',
            'menu_name' => 'Genre',
        ),
        'hierarchical' => true,
        'rewrite' => array('slug' => 'genre'),
        'show_in_rest' => true,
    );
    register_taxonomy('genre', 'book', $args); 
}

add_action('wp_enqueue_scripts', 'bookstore_enqueue_scripts');
function bookstore_enqueue_scripts() {
    wp_enqueue_style('bookstore-style', plugins_url() . '/bookstore/bookstore.css');
    wp_enqueue_script('bookstore-script', plugins_url() . '/bookstore/bookstore.js');
}

