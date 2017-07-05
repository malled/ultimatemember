jQuery(document).ready(function() {

    /**
     * Licenses
     */
    jQuery( 'body' ).on( 'click', '.um_license_deactivate', function() {
        jQuery(this).siblings('.um-option-field').val('');
        jQuery(this).parents('form.um-settings-form').submit();
    });


    /**
     * Multi-text field
     */
    jQuery( 'body' ).on( 'click', '.um-option-delete', function() {
        jQuery(this).parents('li.um-multi-text-option-line').remove();
    });

    jQuery( '.um-multi-text-add-option' ).click( function() {
        var list = jQuery(this).siblings('ul.um-multi-text-list');

        var field_id = list.data('field_id');
        var k = 0;
        if ( list.find( 'li:last input.um-option-field' ).length > 0 ) {
            k = list.find( 'li:last input.um-option-field' ).attr('id').split("-");
            k = k[1]*1 + 1;
        }

        list.append(
            '<li class="um-multi-text-option-line"><input type="text" id="um_options_' + field_id + '-' + k + '" name="um_options[' + field_id + '][]" value="" class="um-option-field" data-field_id="' + field_id + '" /> ' +
            '<a href="javascript:void(0);" class="um-option-delete">' + php_data.texts.remove + '</a></li>'
        );
    });


    /**
     * Media uploader
     */
    jQuery( '.um-media-upload' ).each( function() {
        var field = jQuery(this).find( '.um-option-field' );
        var default_value = field.data('default');

        if ( field.val() != '' && field.val() != default_value ) {
            field.siblings('.um-set-image').hide();
            field.siblings('.um-clear-image').show();
            field.siblings('.icon_preview').show();
        } else {
            if ( field.val() == default_value ) {
                field.siblings('.icon_preview').show();
            }
            field.siblings('.um-set-image').show();
            field.siblings('.um-clear-image').hide();
        }
    });


    if ( typeof wp !== 'undefined' && wp.media && wp.media.editor ) {
        var frame;

        jQuery( '.um-set-image' ).click( function(e) {
            var button = jQuery(this);

            e.preventDefault();

            // If the media frame already exists, reopen it.
            if ( frame ) {
                frame.remove();
                /*frame.open();
                return;*/
            }

            // Create a new media frame
            frame = wp.media({
                title: button.data('upload_frame'),
                button: {
                    text: php_data.texts.select
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });

            // When an image is selected in the media frame...
            frame.on( 'select', function() {
                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                button.siblings('.icon_preview').attr( 'src', attachment.url ).show();

                button.siblings('.um-option-field').val( attachment.url );
                button.siblings('.um-media-upload-data-id').val(attachment.id);
                button.siblings('.um-media-upload-data-width').val(attachment.width);
                button.siblings('.um-media-upload-data-height').val(attachment.height);
                button.siblings('.um-media-upload-data-thumbnail').val(attachment.thumbnail);
                button.siblings('.um-media-upload-url').val(attachment.url);

                button.siblings('.um-clear-image').show();
                button.hide();
            });

            frame.open();
        });

        jQuery('.icon_preview').click( function(e) {
            jQuery(this).siblings('.um-set-image').trigger('click');
        });

        jQuery('.um-clear-image').click( function(e) {
            var default_image_url = jQuery(this).siblings('.um-option-field').data('default');
            jQuery(this).siblings('.um-set-image').show();
            jQuery(this).hide();
            jQuery(this).siblings('.icon_preview').attr( 'src', default_image_url );
            jQuery(this).siblings('.um-media-upload-data-id').val('');
            jQuery(this).siblings('.um-media-upload-data-width').val('');
            jQuery(this).siblings('.um-media-upload-data-height').val('');
            jQuery(this).siblings('.um-media-upload-data-thumbnail').val('');
            jQuery(this).siblings('.um-option-field').val( default_image_url );
            jQuery(this).siblings('.um-media-upload-url').val( default_image_url );
        });
    }


    /**
     * On option fields change
     */
    jQuery( '.um-option-field' ).change( function() {
        if ( jQuery('.um-settings-line[data-conditional*=\'"' + jQuery(this).data('field_id') + '",\']').length > 0 ) {
            run_check_conditions();
        }
    });


    //first load hide unconditional fields
    run_check_conditions();


    /**
     * Run conditional logic
     */
    function run_check_conditions() {
        jQuery( '.um-settings-line' ).removeClass('um-setting-conditioned').each( function() {
            if ( typeof jQuery(this).data('conditional') === 'undefined' || jQuery(this).hasClass('um-setting-conditioned') )
                return;

            if ( check_condition( jQuery(this) ) )
                jQuery(this).show();
            else
                jQuery(this).hide();
        });
    }


    /**
     * Conditional logic
     *
     * true - show field
     * false - hide field
     *
     * @returns {boolean}
     */
    function check_condition( settings_line ) {

        settings_line.addClass('um-setting-conditioned');

        var conditional = settings_line.data('conditional');
        var condition = conditional[1];
        var value = conditional[2];

        var condition_field = jQuery( '#um_options_' + conditional[0] );
        var parent_condition = true;
        if ( typeof condition_field.parents('.um-settings-line').data('conditional') !== 'undefined' ) {
            parent_condition = check_condition( condition_field.parents('.um-settings-line') );
        }

        var own_condition = false;
        if ( condition == '=' ) {
            var tagName = condition_field.prop("tagName").toLowerCase();

            if ( tagName == 'input' ) {
                var input_type = condition_field.attr('type');
                if ( input_type == 'checkbox' ) {
                    own_condition = ( value == '1' ) ? condition_field.is(':checked') : ! condition_field.is(':checked');
                } else {
                    own_condition = ( condition_field.val() == value );
                }
            } else if ( tagName == 'select' ) {
                own_condition = ( condition_field.val() == value );
            }
        }

        return ( own_condition && parent_condition );
    }

});