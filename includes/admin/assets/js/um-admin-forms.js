/**
 * Multi-selects field
 */
jQuery( 'body' ).on( 'click', '.um-select-delete', function() {
    jQuery( this ).parents( 'li.um-multi-selects-option-line' ).remove();
});

jQuery( '.um-multi-selects-add-option' ).click( function() {
    var list = jQuery(this).siblings('ul.um-multi-selects-list');

    var field_id = list.data('field_id');
    var k = 0;
    if ( list.find( 'li:last input.um-option-field' ).length > 0 ) {
        k = list.find( 'li:last input.um-option-field' ).attr('id').split("-");
        k = k[1]*1 + 1;
    }

    list.append(
        '<li class="um-multi-selects-option-line"><input type="text" id="um_options_' + field_id + '-' + k + '" name="um_options[' + field_id + '][]" value="" class="um-option-field" data-field_id="' + field_id + '" /> ' +
        '<a href="javascript:void(0);" class="um-option-delete">' + php_data.texts.remove + '</a></li>'
    );
});


/**
 * On option fields change
 */
jQuery('body').on('change', '.um-forms-field', function() {
    if ( jQuery('.um-forms-line[data-conditional*=\'"' + jQuery(this).data('field_id') + '",\']').length > 0 ) {
        run_check_conditions();
    }
});


//first load hide unconditional fields
run_check_conditions();


/**
 * Run conditional logic
 */
function run_check_conditions() {
    jQuery( '.um-forms-line' ).removeClass('um-forms-line-conditioned').each( function() {
        if ( typeof jQuery(this).data('conditional') === 'undefined' || jQuery(this).hasClass('um-forms-line-conditioned') )
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
function check_condition( form_line ) {

    form_line.addClass( 'um-forms-line-conditioned' );

    var conditional = form_line.data('conditional');
    var condition = conditional[1];
    var value = conditional[2];

    var prefix = form_line.parents( '.um-form-table' ).data( 'prefix' );

    var condition_field = jQuery( '#' + prefix + '_' + conditional[0] );
    var parent_condition = true;
    if ( typeof condition_field.parents('.um-forms-line').data('conditional') !== 'undefined' ) {
        parent_condition = check_condition( condition_field.parents('.um-forms-line') );
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