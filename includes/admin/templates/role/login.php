<div class="um-admin-metabox">

	<?php $role = $object['data'];

	$fields = array(
		array(
			'id'       		=> '_um_after_login',
			'type'     		=> 'selectbox',
			'label'    		=> __( 'Action to be taken after login', 'ultimatemember' ),
			'description' 	=> __( 'Select what happens when a user with this role logins to your site', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_after_login'] ) ? $role['_um_after_login'] : array(),
			'options'		=> array(
				'redirect_profile'	=> __( 'Redirect to profile', 'ultimatemember' ),
				'redirect_url'		=> __( 'Redirect to URL', 'ultimatemember' ),
				'refresh'			=> __( 'Refresh active page', 'ultimatemember' ),
				'redirect_admin'	=> __( 'Redirect to WordPress Admin', 'ultimatemember' )
			)
		),
		array(
			'id'       		=> '_um_login_redirect_url',
			'type'     		=> 'text',
			'label'    		=> __( 'Set Custom Redirect URL', 'ultimatemember' ),
			'description' 	=> __( 'Set a url to redirect this user role to after they login with their account', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_login_redirect_url'] ) ? $role['_um_login_redirect_url'] : '',
			'conditional'	=> array( '_um_after_login', '=', 'redirect_url' )
		)
	);

	echo UM()->metabox()->render_metabox_section( $fields, array( 'name' => 'role' ) ); ?>
	
</div>