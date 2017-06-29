<div class="um-admin-metabox">

	<?php $role = $object['data'];

	$fields = array(
		array(
			'id'       		=> '_um_default_homepage',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Can view default homepage?', 'ultimatemember' ),
			'description' 	=> __( 'Allow this user role to view your site\'s homepage', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_default_homepage'] ) ? $role['_um_default_homepage'] : 0,
		),
		array(
			'id'       		=> '_um_redirect_homepage',
			'type'     		=> 'text',
			'label'    		=> __( 'Custom Homepage Redirect', 'ultimatemember' ),
			'description' 	=> __( 'Set a url to redirect this user role to if they try to view your site\'s homepage', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_redirect_homepage'] ) ? $role['_um_redirect_homepage'] : '',
			'conditional'	=> array( '_um_default_homepage', '=', '0' )
		)
	);

	echo UM()->metabox()->render_metabox_section( $fields, array( 'name' => 'role' ) ); ?>
	
</div>