<?php
// Enqueue plugin styles
function day_product_plugin_enqueue_styles() {
    wp_enqueue_style('day-product-plugin-style', plugins_url('style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'day_product_plugin_enqueue_styles');
?>