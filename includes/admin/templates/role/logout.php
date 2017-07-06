<div class="um-admin-metabox">

	<?php $role = $object['data'];

    UM()->admin_forms( array(
        'class'		=> 'um-role-logout um-half-column',
        'prefix_id'	=> 'role',
        'fields' => array(
            array(
                'id'		    => '_um_after_logout',
                'type'		    => 'select',
                'name'		    => '_um_after_logout',
                'label'    		=> __( 'Action to be taken after logout', 'ultimatemember' ),
                'description' 	=> __( 'Select what happens when a user with this role logouts of your site', 'ultimatemember' ),
                'value' 		=> ! empty( $role['_um_after_logout'] ) ? $role['_um_after_logout'] : array(),
                'options'		=> array(
                    'redirect_home' => __( 'Go to Homepage', 'ultimatemember' ),
                    'redirect_url'	=> __( 'Go to Custom URL', 'ultimatemember' ),
                )
            ),
            array(
                'id'		=> '_um_logout_redirect_url',
                'type'		=> 'text',
                'name'		=> '_um_logout_redirect_url',
                'label'    		=> __( 'Set Custom Redirect URL', 'ultimatemember' ),
                'description' 	=> __( 'Set a url to redirect this user role to after they logout from site', 'ultimatemember' ),
                'value' 		=> ! empty( $role['_um_logout_redirect_url'] ) ? $role['_um_logout_redirect_url'] : '',
                'conditional'	=> array( '_um_after_logout', '=', 'redirect_url' )
            )
        )
    ) )->render_form(); ?>

</div>