/**
 * On option fields change
 */
jQuery( '.um-metadata-field' ).change( function() {
    if ( jQuery('.um-metadata-line[data-conditional*=\'"' + jQuery(this).data('field_id') + '",\']').length > 0 ) {
        run_check_conditions();
    }
});


//first load hide unconditional fields
run_check_conditions();


/**
 * Run conditional logic
 */
function run_check_conditions() {
    jQuery( '.um-metadata-line' ).removeClass('um-metadata-conditioned').each( function() {
        if ( typeof jQuery(this).data('conditional') === 'undefined' || jQuery(this).hasClass('um-metadata-conditioned') )
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
function check_condition( metabox_line ) {

    metabox_line.addClass('um-metadata-conditioned');

    var conditional = metabox_line.data('conditional');
    var condition = conditional[1];
    var value = conditional[2];

    var condition_field = jQuery( '#um_metadata_' + conditional[0] );
    var parent_condition = true;
    if ( typeof condition_field.parents('.um-metadata-line').data('conditional') !== 'undefined' ) {
        parent_condition = check_condition( condition_field.parents('.um-metadata-line') );
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
    } else if ( condition == '!=' ) {
        var tagName = condition_field.prop("tagName").toLowerCase();

        if ( tagName == 'input' ) {
            var input_type = condition_field.attr('type');
            if ( input_type == 'checkbox' ) {
                own_condition = ( value == '1' ) ? ! condition_field.is(':checked') : condition_field.is(':checked');
            } else {
                own_condition = ( condition_field.val() != value );
            }
        } else if ( tagName == 'select' ) {
            own_condition = ( condition_field.val() != value );
        }
    }

    return ( own_condition && parent_condition );
}