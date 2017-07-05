<div class="um-admin-metabox">
	<?php $role = $object['data'];

	$fields = array(
		array(
			'id'       		=> '_um_can_view_all',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Can view other member profiles?', 'ultimatemember' ),
			'description' 	=> __( 'Can this role view all member profiles?', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_can_view_all'] ) ? $role['_um_can_view_all'] : 0,
		),
		array(
			'id'       		=> '_um_can_view_roles',
			'type'     		=> 'selectbox',
			'multi'     	=> true,
			'label'    		=> __( 'Can view these user roles only', 'ultimatemember' ),
			'description' 	=> __( 'Which roles that role can view, choose none to allow role to view all member roles', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_can_view_roles'] ) ? $role['_um_can_view_roles'] : array(),
			'options'		=> UM()->roles()->get_roles(),
			'conditional'	=> array( '_um_can_view_all', '=', '1' )
		),
		array(
			'id'       		=> '_um_can_make_private_profile',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Can make their profile private?', 'ultimatemember' ),
			'description' 	=> __( 'Can this role make their profile private?', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_can_make_private_profile'] ) ? $role['_um_can_make_private_profile'] : 0,
		),
		array(
			'id'       		=> '_um_can_access_private_profile',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Can view/access private profiles?', 'ultimatemember' ),
			'description' 	=> __( 'Can this role view private profiles?', 'ultimatemember' ),
            'value' 		=> ! empty( $role['_um_can_access_private_profile'] ) ? $role['_um_can_access_private_profile'] : 0,
		)
	);

	echo UM()->metabox()->render_metabox_section( $fields, array( 'name' => 'role' ) ); ?>

</div>