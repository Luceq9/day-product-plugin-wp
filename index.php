
<?php
/*
 * Plugin Name: Product Day
 * Plugin URI: http://www.abc.com
 * Description: This plugin displays the product of the day.
 * Version: 1.0
 * Author: Your Name
 * Author URI: http://www.abc.com
 */

if (!defined('ABSPATH')) {
    exit; // Zapobiega bezpośredniemu dostępowi do pliku
}
// Load functions.php
require_once(plugin_dir_path(__FILE__) . 'functions.php');

// Funkcja do wyświetlenia produktu dnia
function product_day_display() {
    // Query dla losowego produktu - wybierzemy jeden losowy produkt z WooCommerce
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 1,
        'orderby' => 'rand',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $output = '<div class="product-day">';
        while ($query->have_posts()) {
            $query->the_post();

            global $product;

            $output .= '<h2>Produkt Dnia</h2>';
            $output .= '<h3>' . get_the_title() . '</h3>';
            $output .= '<a href="' . get_the_permalink() . '">';
            $output .= get_the_post_thumbnail(get_the_ID(), 'medium');
            $output .= '</a>';
            $output .= '<p>' . $product->get_price_html() . '</p>';
            $output .= '<a href="' . get_the_permalink() . '" class="button">Zobacz Produkt</a>';
        }
        $output .= '</div>';
    } else {
        $output = '<p>Nie znaleziono produktu dnia.</p>';
    }

    wp_reset_postdata();

    return $output;
}

// Rejestracja shortcode'u
function product_day_shortcode() {
    add_shortcode('product_day', 'product_day_display');
}
add_action('init', 'product_day_shortcode');
?>
