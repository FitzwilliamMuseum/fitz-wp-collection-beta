// This line is for debugging in Chrome devtools
//# sourceURL=fitz-collection-shortcode-form.js

//<![CDATA[

/**
 * No-conflict WordPress wrapper. $ can be used safely inside this function for jQuery.
 */
jQuery(function ($) {

        /**
         * ------------
         * Form actions
         * ------------
         */

        /**
         * Insert the shortcode when the submit button is clicked.
         */
        $('#fitz-collection-shortcode-submit').click(function () {
            // Get the entry type and value
            var entryType = $('#entry-type').val();
            var entryValue = $("#" + entryType).val();

            // If no input is provided, display error
            if (!entryValue.trim()) {
                fitzCollectionDisplayErrorMessage("No artwork identification ID entered. Please enter an artwork and try again.");
            } else { // Otherwise, validate input and try to submit form

                // If the entry-type is 'unique-id'
                if (entryType === "unique-id") {
                    // @TODO Validate the input (with regex!)
                    // Look up the record id (send ajax request) and try to submit the form
                    fitzCollectionLookupRecordIdAndSubmit();
                }
            }

            // If the entry-type is 'url'
            if (entryType === "url") {
                // Extract the record id from the url
                var validRecordId = fitzCollectionExtractRecordId();
                // If record id is valid, update the input and submit the form
                if (validRecordId) {
                    $("#record-id").val(validRecordId);
                    fitzCollectionSubmitForm();
                } else {
                    fitzCollection("Please check your URL for errors and try again.");
                }
            }

            // If the entry-type is 'record-id'
            if (entryType === "record-id") {
                var validRecordId = fitzCollectionValidateRecordId();
                // If record id is valid, update the input and submit the form
                if (validRecordId) {
                    $("#record-id").val(validRecordId);
                    fitzCollectionSubmitForm();
                } else {
                    fitzCollectionDisplayErrorMessage("Please check your artwork ID for errors and try again.");
                }
            }

    });

    /**
     * Show the input (url, unique-id or record-id) to match whatever entry-type is chosen by the user.
     */
    // If a change is detected in the entry-type selection drop down
    $("#entry-type").change(function () {
        // Reset any error message
        fitzCollectionResetErrorMessage();
        // Get the value of the currently selected option
        var entryType = $('#entry-type option:selected').val();
        // Depending on what entry-type the user chooses, display the label, text input and explanation accordingly
        switch (entryType) {
            case 'url':
                $('.unique-id').hide();
                $('.record-id').hide();
                $('.url').show();
                $('label.url').css('display', 'block');
                break;
            case 'unique-id':
                $('.url').hide();
                $('.record-id').hide();
                $('.unique-id').show();
                $('label.unique-id').css('display', 'block');
                break;
            case 'record-id':
                $('.url').hide();
                $('.unique-id').hide();
                $('.record-id').show();
                $('label.record-id').css('display', 'block');
                break;
            default:
        }
    });

    /**
     * Toggle the visibility of the caption text input depending on whether the user chooses automatic or no caption.
     */
    // If a change is detected in the entry-type selection dropdown
    $("#caption-option").change(function () {
        // Toggle the visibility
        $("label.caption-text").toggle("fast");
        $("#caption-text").toggle("fast");
        $("#caption-text-explanation").toggle("fast");

    });

    /**
     * -----------------------------------------------------------------------
     * Helper functions for validating and processing input, reporting errors
     * and submitting the form to insert the shortcode
     * -----------------------------------------------------------------------
     */

    /**
     * Submit the form: create and insert the shortcode and close the modal box.
     *
     * @return {undefined}
     */
    function fitzCollectionSubmitForm() {
        // Get the form fields
        var values = {};
        $('#TB_ajaxContent form :input').each(function (index, field) {
            name = '#TB_ajaxContent form #' + field.id;
            values[$(name).attr('name')] = $(name).val();
        });

        // Clear the submit button, entry-type select, url and unique-id inputs so shortcode does not take their values
        values['submit'] = null;
        values['entry-type'] = null;
        values['url'] = null;
        values['unique-id'] = null;

        var defaults = {
            'caption-option': 'auto',
            'figure-size': 'medium'
        };

        // Start shortcode text
        var fitzCollectionShortcode = '[artefact';
        // Get the attributes and values
        for (attributes in values) {
            // If not empty or null
            if (values[attributes]) {
                // And the values are not the default values
                if (values[attributes] != defaults[attributes]) {
                    // If the value has more than 1 word
                    if (countWords(String(values[attributes])) > 1) {
                        // Add the key="value" pair with quotes around the value
                        fitzCollectionShortcode += ' ' + attributes + '="' + values[attributes] + '"';
                    } else {
                        // Otherwise just add the key=value pair
                        fitzCollectionShortcode += ' ' + attributes + '=' + values[attributes];
                    }
                }
            }
        }
        // End shortcode text
        fitzCollectionShortcode += ']';
        // Insert shortcode into the active editor
        tinyMCE.activeEditor.execCommand('mceInsertContent', false, fitzCollectionShortcode);
        // Close Thickbox
        tb_remove();


        /**
         * Count the number of words in a text string.
         *
         * @param {string} text Text with words to count.
         * @return {number} Number of words found.
         */
        function countWords(text) {
            return text.split(/[ \t\r\n]/).length;
        }

    }

    /**
     * Display the supplied error message in the page.
     *
     * @param {string} message Error message.
     * @return {undefined}
     */
    function fitzCollectionDisplayErrorMessage(message) {
        var entryType = $('#entry-type').val();
        $("#" + entryType + "-explanation").html(message).addClass("fitzCollection-validation-error");
        $("#" + entryType).addClass("fitzCollection-validation-error");
    }

    /**
     * Reset any error messages in the page.
     *
     * @return {undefined}
     */
    function fitzCollectionResetErrorMessage() {
        // If there is an error message
        if ($(".artefact-input").hasClass("fitzCollection-validation-error")) {
            var entryType = $('#entry-type option:selected').val();
            // Remove the error class from the input
            $("#" + entryType).removeClass("fitzCollection-validation-error");
            // Remove error class from explanation and reset explanation text
            $("#" + entryType + "-explanation").removeClass("fitzCollection-validation-error").html(function () {
                var entryType = $('#entry-type').val();
                switch (entryType) {
                    case 'url':
                        return "Example: <strong>https://collection.beta.fitz.ms/id/object/656/</strong>";
                        break;
                    case 'record-id':
                        return "Example: for https://collection.beta.fitz.ms/id/object/656/ the record ID is <strong>656</strong>"
                        break;
                    default:
                }
            });
        }
    }

    /**
     * Check if record id is valid, and if so, return a version trimmed of whitespace.
     *
     * If the record id is not valid, returns the empty string.
     *
     * @return {string} A record id, the empty string if not valid.
     */
    function fitzCollectionValidateRecordId() {
        var recordId = $("#record-id").val().trim();
        if (fitzCollectionIsInt1To999999(recordId)) {
            return recordId;
        } else {
            return '';
        }
    }

    /**
     * Check if a value is an integer between 1 and 999999.
     *
     * @param {string} val Value to check.
     * @return {boolean} True if 1-999999, otherwise false.
     */
    function fitzCollectionIsInt1To999999(val) {
        var num = parseInt(val, 10);
        return !isNaN(num) && val == num && val.toString() == num.toString() && num > 1 && num < 1000000;
    }

    /**
     * Extract the record id from a valid fitzwilliam museum url.
     *
     * If the url is not valid, returns the empty string.
     *
     * @return {string} Record id.
     */
    function fitzCollectionExtractRecordId() {
        var prefixWithHttps = "https://collection.beta.fitz.ms/id/object/";
        var prefixWithHttp = "http://collection.beta.fitz.ms/id/object/";
        var prefixNoScheme = "collection.beta.fitz.ms/id/object/";
        var prefix = '';
        var recordId = '';
        var url = $("#url").val().trim();

        // Check url starts with correct prefix
        if (url.startsWith(prefixWithHttps)) {
            prefix = prefixWithHttps;
        } else if (url.startsWith(prefixWithHttp)) {
            prefix = prefixWithHttp;
        } else if (url.startsWith(prefixNoScheme)) {
            prefix = prefixNoScheme;
        }
        // If there is a correct prefix remove the url to get the record id at the end and remove any slashes
        if (prefix) {
            recordId = url.substring(prefix.length).replace(/\//g, '');
            // If the record id is a number between 1 and 999999, return it
            if (fitzCollectionIsInt1To999999(recordId)) {
                return recordId;
            } else {
                return '';
            }
        }
        // Return an empty recordId if the url is not as expected
        return recordId;
    }


    /**
     * Lookup an artefact record id from a unique id (aka 'old finds id') and try to submit the form.
     *
     * Makes an ajax call to the Fitzwilliam Museum CIIM endpoint server and checks the response to make sure it is a valid unique id
     * and that the record is on public display. If not, displays an error message.
     *
     * @return {undefined}
     */
    function fitzCollectionLookupRecordIdAndSubmit() {
        $.ajax({
            url: 'https://collection.beta.fitz.ms/search/results?query=accession_number%3A'
            + $("#accession_number").val()
            + '/json',
            type: 'GET',
            timeout: 5000,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.meta.totalResults == 0) {
                    // No record returned so error
                    fitzCollectionDisplayErrorMessage("No artwork with that accession ID is available. Please check and try again.");
                } else if (data.results[0].id) {
                    // Record id available so update the input value with the record id, and submit the form
                    $('#record-id').val(data.results[0].id);
                    fitzCollectionSubmitForm();
                } else {
                    fitzCollectionDisplayErrorMessage("Something has gone wrong. Please check your accession ID for errors and try again.");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                fitzCollectionDisplayErrorMessage("Something has gone wrong when trying to contact finds.org.uk: " +
                    textStatus + " (" + errorThrown + ")");
            }
        });
    }

});


//]]>
