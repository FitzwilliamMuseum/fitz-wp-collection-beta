<?php
/*
Plugin Name: Fitzwilliam Museum Collection Data for Wordpress
Description: Display up-to-date artwork info from the Fitzwilliam Museum.
Version:     1.0.0
Author:      Mary Chester-Kadwell
Author URI:  https://github.com/marychesterkadwell
Author:      Daniel Pett
Author URI:  https://github.com/marychesterkadwell
License:     GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: finds-org-uk
*/

/*
    Copyright 2017  Mary Chester-Kadwell
    Copyright 2021  Daniel Pett

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 3 as published by
    the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Block direct access to plugin file
defined( 'ABSPATH' ) or exit("Plugin must not be accessed directly.");

/**
 * ----------
 * CSS STYLES
 * ----------
 */

// Enqueue CSS styles for artefact display
add_action( 'wp_enqueue_scripts', 'fitzcol_load_styles' );
// Enqueue CSS styles for shortcode popup form display
add_action( 'admin_enqueue_scripts', 'fitzcol_load_form_styles' );

/**
 * Load CSS styles for artefact display
 */
function fitzcol_load_styles() {
    wp_register_style( 'fitzcol-display-style', plugins_url('/css/fitzcol-style.css', __FILE__) );
    wp_enqueue_style( 'fitzcol-display-style');
}

/**
 * Load CSS styles for shortcode popup form display
 *
 * @TODO This should only load on the specific page it is needed.
 */
function fitzcol_load_form_styles() {
    wp_register_style( 'fitzcol-form-style', plugins_url('/plugins/tinymce-button/fitzcol-shortcode-form.css', __FILE__) );
    wp_enqueue_style( 'fitzcol-form-style');
}

/**
 * -------------------
 * SHORTCODE: ARTEFACT
 * -------------------
 */

// Register a shortcode [artefact] to display an artefact record in posts
add_shortcode( 'artwork', 'fitzcol_display_artwork' );

/**
 * Shortcode function for [artefact] shortcode.
 *
 * Shortcode attributes:
 * 'id' is the record id of the collection.beta.fitz.ms artefact record - found on the end of the record URL.
 * 'caption-option' can be 'none' to turn off the caption; defaults to 'auto' which displays 'caption-text'
 *  or an automatic caption if no 'caption-text' is provided.
 * 'caption-text' is the desired manual caption text.
 * 'figure-size' is the display size of the image; can be 'preview', 'medium', 'large' or 'original'; defaults to 'medium'.
 * @TODO implement 'figure-size'
 *
 * @since 1.0.0
 * @param array $attr Shortcode attributes.
 * @return string HTML to display
 */

function fitzcol_display_artwork( $attr ) {
    // Insert default attribute values
    $attributes = shortcode_atts( array(
        'id' => '',
        'caption-option' => 'auto',
        'caption-text' => '',
        'figure-size' => 'medium',
        'image-size' => 'medium',
        'display-type' => 'figure'
    ),
        $attr, 'artwork'
    );
    // Load controller class
    require_once plugin_dir_path( __FILE__ ) . 'controllers/class-fitzcol-artwork-controller.php';
    $artwork_controller = new Fitzcol_Artwork_Controller( $attributes );
    return $artwork_controller->display_artwork();

}

/**
 * -----------------------
 * SHORTCODE EDITOR BUTTON
 * -----------------------
 */

// Add action to fire the TinyMCE editor button code after wp has finished loading
add_action('init', 'fitzcol_shortcode_button');

/**
 * Register button and plugin for TinyMCE button
 *
 * Users can click on this button in the TinyMCE visual editor to choose shortcode attributes and insert
 * the shortcode automatically.
 */
function fitzcol_shortcode_button() {
    if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
        add_filter( 'mce_external_plugins', 'fitzcol_shortcode_plugin' );
        add_filter( 'mce_buttons', 'fitzcol_register_button' );
    }
}

/**
 * Load the plugin javascript file that creates the new button
 *
 * @param array $plugins An array of all plugins.
 * @return array
 */
function fitzcol_shortcode_plugin( $plugin_array ) {
    $plugin_array['fitzcol'] = plugin_dir_url(__FILE__) .'plugins/tinymce-button/fitzcol-tinymce-button.js';
    return $plugin_array;
}

/**
 * Register a button named 'fitzcolF' to the editor buttons
 *
 * @param array $buttons An array of buttons.
 * @return array
 */
function fitzcol_register_button( $buttons ) {
    array_push( $buttons, 'fitzcol' ); // Button name 'fitzcol'
    return $buttons;
}
