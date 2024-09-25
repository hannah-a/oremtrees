<?php
/**
 * Plugin Name: WP Learn Hooks
 * Description: A simple plugin to demonstrate how to use hooks in WordPress.
 * Version: 1.0
 */
?>
<!-- https://learn.wordpress.org/lesson/wordpress-hooks/ -->

<?php
add_filter( 'the_content', 'wp_learn_amend_content' );

function wp_learn_amend_content( $content) {
    return $content . '<p>Thanks for Reading!</p>';
}
?>