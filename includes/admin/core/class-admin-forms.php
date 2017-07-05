<?php
namespace um\admin\core;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Admin_Forms' ) ) {
    class Admin_Forms {

        var $form_data;

        /**
         * Admin_Forms constructor.
         * @param bool $form_data
         */
        function __construct( $form_data = false ) {

            if ( $form_data )
                $this->form_data = $form_data;

        }


        /**
         * Render form
         *
         *
         * @param bool $echo
         * @return string
         */
        function render_form( $echo = true ) {

            if ( empty( $this->form_data['fields'] ) )
                return '';

            $class = 'form-table um-form-table ' . ( ! empty( $this->form_data['class'] ) ? $this->form_data['class'] : '' );
            $class_attr = ' class="' . $class . '" ';

            $prefix_attr = ! empty( $this->form_data['prefix_id'] ) ? ' data-prefix="' . $this->form_data['prefix_id'] . '" ' : '';

            ob_start();

            foreach ( $this->form_data['fields'] as $field_data ) {
                if ( isset( $field_data['type'] ) && 'hidden' == $field_data['type'] )
                    echo $this->render_form_row( $field_data );
            } ?>

            <table <?php echo $class_attr . $prefix_attr ?>>
                <tbody>
                    <?php foreach ( $this->form_data['fields'] as $field_data ) {
                        if ( isset( $field_data['type'] ) && 'hidden' != $field_data['type'] )
                            echo $this->render_form_row( $field_data );
                    } ?>
                </tbody>
            </table>

            <?php if ( $echo ) {
                ob_get_flush();
                return '';
            } else {
                return ob_get_clean();
            }
        }


        function render_form_row( $data ) {

            if ( empty( $data['type'] ) )
                return '';

            $conditional = ! empty( $data['conditional'] ) ? 'data-conditional="' . esc_attr( json_encode( $data['conditional'] ) ) . '"' : '';

            $html = '';
            if ( $data['type'] != 'hidden' ) {
                if ( strpos( $this->form_data['class'], 'um-top-label' ) !== false ) {
                    $html .= '<tr class="um-forms-line" ' . $conditional . '>
                    <td>' . $this->render_field_label( $data );
                    if ( method_exists( $this, 'render_' . $data['type'] ) ) {

                        $html .= call_user_func( array( &$this, 'render_' . $data['type'] ), $data );

                    }

                    if ( ! empty( $data['description'] ) )
                        $html .= '<div class="description">' . $data['description'] . '</div>';

                    $html .= '</td></tr>';
                } else {
                    $html .= '<tr class="um-forms-line" ' . $conditional . '>
                    <th>' . $this->render_field_label( $data ) . '</th>
                    <td>';
                        if ( method_exists( $this, 'render_' . $data['type'] ) ) {

                            $html .= call_user_func( array( &$this, 'render_' . $data['type'] ), $data );

                        }

                        if ( ! empty( $data['description'] ) )
                            $html .= '<div class="description">' . $data['description'] . '</div>';

                        $html .= '</td></tr>';
                }
            } else {
                if ( method_exists( $this, 'render_' . $data['type'] ) ) {

                    $html .= call_user_func( array( &$this, 'render_' . $data['type'] ), $data );

                }
            }

            return $html;
        }



        function render_field_label( $data ) {
            if ( empty( $data['label'] ) )
                return false;

            $id = ( ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] : '' ) . '_' . $data['id'];
            $for_attr = ' for="' . $id . '" ';

            $label = $data['label'];
            $tooltip = $data['tooltip'] ? UM()->tooltip( $data['tooltip'], false, false ) : '';

            return "<label $for_attr>$label $tooltip</label>";
        }


        function render_text( $field_data ) {

            if ( empty( $field_data['name'] ) || empty( $field_data['id'] ) )
                return false;

            $id = ( ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] : '' ) . '_' . $field_data['id'];
            $id_attr = ' id="' . $id . '" ';

            $class = ! empty( $field_data['class'] ) ? $field_data['class'] : '';
            $class .= ! empty( $field_data['size'] ) ? 'um-' . $field_data['size'] . '-field' : 'um-long-field';
            $class_attr = ' class="um-forms-field ' . $class . '" ';

            $data = array(
                'field_id' => $field_data['id']
            );

            $data_attr = '';
            foreach ( $data as $key => $value ) {
                $data_attr .= " data-{$key}=\"{$value}\" ";
            }

            $name = $field_data['name'];
            $name = ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] . '[' . $name . ']' : $name;
            $name_attr = ' name="' . $name . '" ';

            $value = ! empty( $field_data['value'] ) ? $field_data['value'] : '';
            $value_attr = ' value="' . $value . '" ';

            $html = "<input type=\"text\" $id_attr $class_attr $name_attr $data_attr $value_attr />";

            return $html;
        }


        function render_hidden( $field_data ) {

            if ( empty( $field_data['name'] ) || empty( $field_data['id'] ) )
                return false;

            $id = ( ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] : '' ) . '_' . $field_data['id'];
            $id_attr = ' id="' . $id . '" ';

            $class = ! empty( $field_data['class'] ) ? $field_data['class'] : '';
            $class_attr = ' class="um-forms-field ' . $class . '" ';

            $data = array(
                'field_id' => $field_data['id']
            );

            $data_attr = '';
            foreach ( $data as $key => $value ) {
                $data_attr .= " data-{$key}=\"{$value}\" ";
            }

            $name = $field_data['name'];
            $name = ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] . '[' . $name . ']' : $name;
            $name_attr = ' name="' . $name . '" ';

            $value = ! empty( $field_data['value'] ) ? $field_data['value'] : '';
            $value_attr = ' value="' . $value . '" ';

            $html = "<input type=\"hidden\" $id_attr $class_attr $name_attr $data_attr $value_attr />";

            return $html;
        }


        function render_checkbox( $field_data ) {

            if ( empty( $field_data['name'] ) || empty( $field_data['id'] ) )
                return false;

            $id = ( ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] : '' ) . '_' . $field_data['id'];
            $id_attr = ' id="' . $id . '" ';
            $id_attr_hidden = ' id="' . $id . '_hidden" ';

            $class = ! empty( $field_data['class'] ) ? $field_data['class'] : '';
            $class .= ! empty( $field_data['size'] ) ? $field_data['size'] : 'um-long-field';
            $class_attr = ' class="um-forms-field ' . $class . '" ';

            $data = array(
                'field_id' => $field_data['id']
            );

            $data_attr = '';
            foreach ( $data as $key => $value ) {
                $data_attr .= " data-{$key}=\"{$value}\" ";
            }

            $name = $field_data['name'];
            $name = ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] . '[' . $name . ']' : $name;
            $name_attr = ' name="' . $name . '" ';

            $value = ! empty( $field_data['value'] ) ? $field_data['value'] : 0;

            $html = "<input type=\"hidden\" $id_attr_hidden $name_attr value=\"0\" />
            <input type=\"checkbox\" $id_attr $class_attr $name_attr $data_attr " . checked( $value, true, false ) . " value=\"1\" />";


            return $html;
        }


        function render_select( $field_data ) {

            if ( empty( $field_data['name'] ) || empty( $field_data['id'] ) )
                return false;

            $multiple = ! empty( $field_data['multi'] ) ? 'multiple' : '';

            $id = ( ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] : '' ) . '_' . $field_data['id'];
            $id_attr = ' id="' . $id . '" ';

            $class = ! empty( $field_data['class'] ) ? $field_data['class'] : '';
            $class .= ! empty( $field_data['size'] ) ? $field_data['size'] : 'um-long-field';
            $class_attr = ' class="um-forms-field ' . $class . '" ';

            $data = array(
                'field_id' => $field_data['id']
            );

            $data_attr = '';
            foreach ( $data as $key => $value ) {
                $data_attr .= " data-{$key}=\"{$value}\" ";
            }

            $name = $field_data['name'];
            $name = ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] . '[' . $name . ']' : $name;
            $name = $name . ( ! empty( $field_data['multi'] ) ? '[]' : '' );
            $name_attr = ' name="' . $name . '" ';

            $value = ! empty( $field_data['value'] ) ? $field_data['value'] : ( ! empty( $field_data['default'] ) ? $field_data['default'] : '' );

            $options = '';
            foreach ( $field_data['options'] as $key=>$option ) {
                if ( ! empty( $field_data['multi'] ) ) {
                    $options .= '<option value="' . $key . '" ' . selected( in_array( $key, $value ), true, false ) . '>' . $option . '</option>';
                } else {
                    $options .= '<option value="' . $key . '" ' . selected( $key == $value, true, false ) . '>' . $option . '</option>';
                }
            }

            $html = "<select $multiple $id_attr $name_attr $class_attr $data_attr>$options</select>";

            return $html;
        }


        function render_multi_selects( $field_data ) {

            if ( empty( $field_data['name'] ) || empty( $field_data['id'] ) )
                return false;

            $id = ( ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] : '' ) . '_' . $field_data['id'];

            $class = ! empty( $field_data['class'] ) ? $field_data['class'] : '';
            $class .= ! empty( $field_data['size'] ) ? $field_data['size'] : 'um-long-field';
            $class_attr = ' class="um-forms-field ' . $class . '" ';

            $data = array(
                'field_id' => $field_data['id']
            );

            $data_attr = '';
            foreach ( $data as $key => $value ) {
                $data_attr .= " data-{$key}=\"{$value}\" ";
            }

            $name = $field_data['name'];
            $name = ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] . '[' . $name . ']' : $name;
            $name = "{$name}[]";
            $name_attr = ' name="' . $name . '" ';

            $values = ! empty( $field_data['value'] ) ? $field_data['value'] : ( ! empty( $field_data['default'] ) ? $field_data['default'] : '' );

            $html = "<ul class=\"um-multi-selects-list\" $data_attr>";

            if ( ! empty( $values ) ) {
                foreach ( $values as $k=>$value ) {

                    $id_attr = ' id="' . $id . '-' . $k . '" ';

                    $options = '';
                    foreach ( $field_data['options'] as $key=>$option ) {
                        $options .= '<option value="' . $key . '" ' . selected( $key == $value, true, false ) . '>' . $option . '</option>';
                    }

                    $html .= "<li class=\"um-multi-selects-option-line\">
                        <select $id_attr $name_attr $class_attr $data_attr>$options</select>
                        <a href=\"javascript:void(0);\" class=\"um-select-delete\">" . __( 'Remove', 'ultimatemember' ) . "</a></li>";
                }
            }

            $html .= "</ul><a href=\"javascript:void(0);\" class=\"button button-primary um-multi-selects-add-option\" data-name=\"$name\">{$field_data['add_text']}</a>";

            return $html;
        }


        function render_textarea( $field_data ) {

            if ( empty( $field_data['name'] ) || empty( $field_data['id'] ) )
                return false;

            $id = ( ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] : '' ) . '_' . $field_data['id'];
            $id_attr = ' id="' . $id . '" ';

            $class = ! empty( $field_data['class'] ) ? $field_data['class'] : '';
            $class .= ! empty( $field_data['size'] ) ? $field_data['size'] : 'um-long-field';
            $class_attr = ' class="um-forms-field ' . $class . '" ';

            $data = array(
                'field_id' => $field_data['id']
            );

            $data_attr = '';
            foreach ( $data as $key => $value ) {
                $data_attr .= " data-{$key}=\"{$value}\" ";
            }

            $name = $field_data['name'];
            $name = ! empty( $this->form_data['prefix_id'] ) ? $this->form_data['prefix_id'] . '[' . $name . ']' : $name;
            $name_attr = ' name="' . $name . '" ';

            $value = ! empty( $field_data['value'] ) ? $field_data['value'] : '';

            $html = "<textarea $id_attr $class_attr $name_attr $data_attr>$value</textarea>";

            return $html;
        }


    }
}