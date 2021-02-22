<?php
/*
 Fitzwilliam Museum Collection  Shortcode Form
 Version 1.0
 Author Mary Chester-Kadwell
 Author URI https://github.com/mchesterkadwell
 */

/*  Copyright 2017  Mary Chester-Kadwell  (email : mchester-kadwell@britishmuseum.org)

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

$shortcode_form = "<h1>Add artwork shortcode</h1>";
$shortcode_form.= "<form id='fitzcol-shortcode' name='fitzcol-shortcode' method='POST' action=''>";
// artwork //
$shortcode_form.= "<fieldset><legend class='fitzcol-legend'>Artwork</legend>";
// entry-type
$shortcode_form.= "<label for='entry-type'>" . 'Choose how to enter the artwork:' . "</label>";
$shortcode_form.= "<select id='entry-type' name='entry-type'>";
$shortcode_form.= "<option value='url' selected='selected'>" . 'URL' . "</option>";
$shortcode_form.= "<option value='unique-id'>" . 'Unique ID' . "</option>";
$shortcode_form.= "<option value='record-id'>" . 'Record ID' . "</option>";
$shortcode_form.= "</select>";
// id (from url)
$shortcode_form.= "<label for='url' class='url'>" . 'Enter the full web address of the artwork record:' . "</label>";
$shortcode_form.= "<input type='text' id='url' name='url' class='artwork-input url' size='55' required />";
$shortcode_form.= "<p id='url-explanation' class='explanation url'>" . "Example: <strong>https://collection.beta.fitz.ms/id/object/656</strong>" ."</p>";
$shortcode_form.= "<label for='unique-id' class='unique-id'>" . "Enter the unique ID found on the artwork's page:" . "</label>";
$shortcode_form.= "<input type='text' id='unique-id' name='unique-id' class='artwork-input unique-id' size='20' required />";
$shortcode_form.= "<p id='unique-id-explanation' class='explanation unique-id'>" . "Example: <strong>P.250-1937</strong>" . "</p>";
$shortcode_form.= "<label for='record-id' class='record-id'>" . 'Enter the record ID found at the end of the web address:' . "</label>";
$shortcode_form.= "<input type='text' id='record-id' name='id' class='artwork-input record-id' size='15' required />";
$shortcode_form.= "<p id='record-id-explanation' class='explanation record-id'>" . "Example: for https://collection.beta.fitz.ms/id/object/656 the record ID is <strong>656</strong>" ."</p>";
$shortcode_form.= "</fieldset>";
// OPTIONS //
$shortcode_form.= "<fieldset><legend class='fitzcol-legend'>Options</legend>";
// caption-option
$shortcode_form.= "<label for='caption-option'>" . 'Caption display:' . "</label>";
$shortcode_form.= "<select id='caption-option' name='caption-option'>";
$shortcode_form.= "<option value='auto' selected='selected'>" . 'Automatic caption' . "</option>";
$shortcode_form.= "<option value='none'>" . 'No caption' . "</option>";
$shortcode_form.= "</select>";
// caption-text
$shortcode_form.= "<label for='caption-text' class='caption-text'>" . 'Caption text (optional):' . "</label>";
$shortcode_form.= "<textarea id='caption-text' name='caption-text' rows='5' cols='50'></textarea>";
$shortcode_form.= "<p id='caption-text-explanation'>If you leave this blank a caption will be generated automatically.</p>";
// image-size
$shortcode_form.= "<label for='image-size'>" . 'Image size:' . "</label>";
$shortcode_form.= "<select id='image-size' name='image-size'>";
$shortcode_form.= "<option value='preview'>" . 'Small or preview' . "</option>";
$shortcode_form.= "<option value='medium' selected='selected'>" . 'Medium' . "</option>";
$shortcode_form.= "<option value='large'>" . 'Large' . "</option>";
$shortcode_form.= "<option value='origina'>" . 'Original' . "</option>";

$shortcode_form.= "</select>";
$shortcode_form.= "<p id='image-size-explanation'>Medium is recommended.</p>";
$shortcode_form.= "</fieldset>";
$shortcode_form.= "<input type='button' id='fitzcol-shortcode-submit' name='submit' class='button button-primary button-large' value='"."Insert Shortcode"."' />";
$shortcode_form.= "</form>";
echo $shortcode_form;
?>
