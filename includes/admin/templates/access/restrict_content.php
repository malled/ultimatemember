<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<div class="um-admin-metabox">
	<?php
    if ( ! empty( $object->ID ) )
        $data = get_post_meta( $object->ID, 'um_content_restriction', true );
    else
        $data = array();

	$fields = array(
        array(
            'id'       		=> '_um_custom_access_settings',
            'type'     		=> 'checkbox',
            'label'    		=> __( 'Restrict access to this content?', 'ultimatemember' ),
            'description' 	=> __( 'Activate content restriction for this post', 'ultimatemember' ),
            'value' 		=> ! empty( $data['_um_custom_access_settings'] ) ? $data['_um_custom_access_settings'] : 0,
        ),
        array(
            'id'       		=> '_um_accessible',
            'type'     		=> 'selectbox',
            'label'    		=> __( 'Who can access this content?', 'ultimatemember' ),
            'description' 	=> __( 'Activate content restriction for this post', 'ultimatemember' ),
            'value' 		=> ! empty( $data['_um_accessible'] ) ? $data['_um_accessible'] : 0,
            'options'		=> array(
                '0'         => __( 'Everyone', 'ultimatemember' ),
                '1'         => __( 'Logged out users', 'ultimatemember' ),
                '2'         => __( 'Logged in users', 'ultimatemember' ),
            ),
            'conditional'	=> array( '_um_custom_access_settings', '=', '1' )
        ),
        array(
            'id'       		=> '_um_access_roles',
            'type'     		=> 'multi-checkbox',
            'label'    		=> __( 'Select which roles can access this content', 'ultimatemember' ),
            'description' 	=> __( 'Activate content restriction for this post', 'ultimatemember' ),
            'value' 		=> ! empty( $data['_um_access_roles'] ) ? $data['_um_access_roles'] : array(),
            'options'		=> UM()->roles()->get_roles( false, array( 'administrator' ) ),
            'columns'       => 3,
            'conditional'	=> array( '_um_accessible', '=', '2' )
        ),
        array(
            'id'       		=> '_um_noaccess_action',
            'type'     		=> 'selectbox',
            'label'    		=> __( 'What happens when users without access tries to view the content?', 'ultimatemember' ),
            'description' 	=> __( 'Action when users without access tries to view the content', 'ultimatemember' ),
            'value' 		=> ! empty( $data['_um_noaccess_action'] ) ? $data['_um_noaccess_action'] : 0,
            'options'		=> array(
                '0'         => __( 'Show access restricted message', 'ultimatemember' ),
                '1'         => __( 'Redirect user', 'ultimatemember' ),
            ),
            'conditional'	=> array( '_um_accessible', '!=', '0' )
        ),
        array(
            'id'       		=> '_um_restrict_by_custom_message',
            'type'     		=> 'selectbox',
            'label'    		=> __( 'Would you like to use the global default message or apply a custom message to this content?', 'ultimatemember' ),
            'description' 	=> __( 'Action when users without access tries to view the content', 'ultimatemember' ),
            'value' 		=> ! empty( $data['_um_restrict_by_custom_message'] ) ? $data['_um_restrict_by_custom_message'] : '0',
            'options'		=> array(
                '0'         => __( 'Global default message (default)', 'ultimatemember' ),
                '1'         => __( 'Custom message', 'ultimatemember' ),
            ),
            'conditional'	=> array( '_um_noaccess_action', '=', '0' )
        ),
        array(
            'id'       		=> '_um_restrict_custom_message',
            'type'     		=> 'wp_editor',
            'label'    		=> __( 'Custom Restrict Content message', 'ultimatemember' ),
            'description' 	=> __( 'Changed global restrict message', 'ultimatemember' ),
            'value' 		=> ! empty( $data['_um_restrict_custom_message'] ) ? $data['_um_restrict_custom_message'] : '',
            'conditional'	=> array( '_um_restrict_by_custom_message', '=', '1' )
        ),
        array(
            'id'       		=> '_um_access_redirect',
            'type'     		=> 'selectbox',
            'label'    		=> __( 'Where should users be redirected to?', 'ultimatemember' ),
            'description' 	=> __( 'Select redirect to page when user hasn\'t access to content', 'ultimatemember' ),
            'value' 		=> ! empty( $data['_um_access_redirect'] ) ? $data['_um_access_redirect'] : '0',
            'conditional'	=> array( '_um_noaccess_action', '=', '1' ),
            'options'		=> array(
                '0'         => __( 'Login page', 'ultimatemember' ),
                '1'         => __( 'Custom URL', 'ultimatemember' ),
            ),
        ),
        array(
            'id'       		=> '_um_access_redirect_url',
            'type'     		=> 'text',
            'label'    		=> __( 'Redirect URL', 'ultimatemember' ),
            'description' 	=> __( 'Changed global restrict message', 'ultimatemember' ),
            'value' 		=> ! empty( $data['_um_access_redirect_url'] ) ? $data['_um_access_redirect_url'] : '',
            'conditional'	=> array( '_um_access_redirect', '=', '1' )
        ),
        array(
            'id'       		=> '_um_access_hide_from_queries',
            'type'     		=> 'checkbox',
            'label'    		=> __( 'Hide from queries', 'ultimatemember' ),
            'description' 	=> __( 'Hide this content from archives, RSS feeds etc for users who do not have permission to view this content', 'ultimatemember' ),
            'value' 		=> ! empty( $data['_um_access_hide_from_queries'] ) ? $data['_um_access_hide_from_queries'] : '',
            'conditional'	=> array( '_um_accessible', '!=', '0' )
        ),
    );

	echo UM()->metabox()->render_metabox_section( $fields, array( 'name' => 'um_content_restriction' ) ); ?>

</div>