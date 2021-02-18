<?php
/*
Plugin Name: Fitzwilliam Museum Object Parser
Description: Display up-to-date Fitzwilliam Museum Collection data n your Wordpress blog.
Version:     1.0.0
Author:      Daniel Pett
Author URI:  https://museologi.st
License:     GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: museologi.st
*/

/*  Copyright 2021  Daniel Pett  (email : dejp3@cam.ac.uk

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
add_action( 'wp_enqueue_scripts', 'fitz_collection_load_styles' );
// Enqueue CSS styles for shortcode popup form display
add_action( 'admin_enqueue_scripts', 'fitz_collection_form_styles' );

/**
 * Load CSS styles for artefact display
 */
function fouaac_load_styles() {
    wp_register_style( 'fitz-collection-display-style', plugins_url('/css/fitz-collection-style.css', __FILE__) );
    wp_enqueue_style( 'fitz-collection-display-style');
}

/**
 * Load CSS styles for shortcode popup form display
 *
 * @TODO This should only load on the specific page it is needed.
 */
function fouaac_load_form_styles() {
    wp_register_style( 'fitz-collection-form-style', plugins_url('/plugins/tinymce-button/fitz-collection-shortcode-form.css', __FILE__) );
    wp_enqueue_style( 'fitz-collection-form-style');
}

/**
 * -------------------
 * SHORTCODE: ARTEFACT
 * -------------------
 */

// Register a shortcode [artefact] to display an artefact record in posts
add_shortcode( 'artwork', 'fitz_collection_artwork' );

/**
 * Shortcode function for [artwork] shortcode.
 *
 * Shortcode attributes:
 * 'id' is the record id of the fitzCollection artefact record - found on the end of the record URL.
 * 'caption-option' can be 'none' to turn off the caption; defaults to 'auto' which displays 'caption-text'
 *  or an automatic caption if no 'caption-text' is provided.
 * 'caption-text' is the desired manual caption text.
 * 'figure-size' is the display size of the image; can be 'small', 'medium' or 'large'; defaults to 'medium'.
 * @TODO implement 'figure-size'
 *
 * @since 1.0.0
 * @param array $attr Shortcode attributes.
 * @return string HTML to display
 */

function fitz_collection_display_artwork( $attr ) {
    // Insert default attribute values
    $attributes = shortcode_atts( array(
        'id' => '',
        'caption-option' => 'auto',
        'caption-text' => '',
        'figure-size' => 'medium'
    ),
        $attr, 'artefact'
    );
    // Load controller class
    require_once plugin_dir_path( __FILE__ ) . 'controllers/class-fitz-collection-controller.php';
    $artwork_controller = new Fitz_Collection_Artwork_Controller( $attributes );
    return $artwork_controller->display_artwork();

}

/**
 * -----------------------
 * SHORTCODE EDITOR BUTTON
 * -----------------------
 */

// Add action to fire the TinyMCE editor button code after wp has finished loading
add_action('init', 'fitz_collection_shortcode_button');

/**
 * Register button and plugin for TinyMCE button
 *
 * Users can click on this button in the TinyMCE visual editor to choose shortcode attributes and insert
 * the shortcode automatically.
 */
function fitz_collection_shortcode_button() {
    if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
        add_filter( 'mce_external_plugins', 'fitz_collection_shortcode_plugin' );
        add_filter( 'mce_buttons', 'fitz_collection_register_button' );
    }
}

/**
 * Load the plugin javascript file that creates the new button
 *
 * @param array $plugins An array of all plugins.
 * @return array
 */
function fouaac_shortcode_plugin( $plugin_array ) {
    $plugin_array['fitz-collection'] = plugin_dir_url(__FILE__) .'plugins/tinymce-button/fitz-collection-tinymce-button.js';
    return $plugin_array;
}

/**
 * Register a button named 'fitz-collection' to the editor buttons
 *
 * @param array $buttons An array of buttons.
 * @return array
 */
function fouaac_register_button( $buttons ) {
    array_push( $buttons, 'fitz-collection' ); // Button name 'fitz-collection'
    return $buttons;
}
