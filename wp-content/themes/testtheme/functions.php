<?php 

// Hook that adds post formats, which are templates you can choose for creating new posts
add_action( 'after_setup_theme', 'wp_learn_setup_theme' );
// use actions to perform something, either enabling some already existing feature, or adding something to the request execution.

// callback function that adds post formats
function wp_learn_setup_theme() {
    add_theme_support( 'post-formats', array('aside', 'gallery') );
}



//registering the hook with the callback function
add_filter('the_content', 'wp_learn_amend_content');
// filter function that passes in the post's content
function wp_learn_amend_content($content) {
    $additional_content = '<!-- wp:paragraph --><p>Filtered through <i>the_content</i></p><!-- /wp:paragraph -->';
    $content = $content . $additional_content;
    
    return $content; //dot is used to concatenate strings in php
}