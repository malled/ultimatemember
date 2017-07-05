<div class="um-admin-metabox">
	<?php $role = $object['data'];

	$fields = array(
		array(
			'id'       		=> '_um_can_access_wpadmin',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Can access wp-admin?', 'ultimatemember' ),
			'description' 	=> __( 'The core admin role must always have access to wp-admin / WordPress backend', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_can_access_wpadmin'] ) ? $role['_um_can_access_wpadmin'] : 0,
		),
		array(
			'id'       		=> '_um_can_not_see_adminbar',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Force hiding adminbar in frontend?', 'ultimatemember' ),
			'description' 	=> __( 'Show/hide the adminbar on frontend', 'ultimatemember' ),
            'value' 		=> ! empty( $role['_um_can_not_see_adminbar'] ) ? $role['_um_can_not_see_adminbar'] : 0
		),
		array(
			'id'       		=> '_um_can_edit_everyone',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Can edit other member accounts?', 'ultimatemember' ),
			'description' 	=> __( 'Allow this role to edit accounts of other members', 'ultimatemember' ),
            'value' 		=> ! empty( $role['_um_can_edit_everyone'] ) ? $role['_um_can_edit_everyone'] : 0
		),
		array(
			'id'       		=> '_um_can_edit_roles',
			'type'     		=> 'selectbox',
			'multi'     	=> true,
			'label'    		=> __( 'Can edit these user roles only', 'ultimatemember' ),
			'description' 	=> __( 'Which roles that role can edit, choose none to allow role to edit all member roles', 'ultimatemember' ),
            'value' 		=> ! empty( $role['_um_can_edit_roles'] ) ? $role['_um_can_edit_roles'] : array(),
			'options'		=> UM()->roles()->get_roles(),
			'conditional'	=> array( '_um_can_edit_everyone', '=', '1' )
		),
		array(
			'id'       		=> '_um_can_delete_everyone',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Can delete other member accounts?', 'ultimatemember' ),
			'description' 	=> __( 'Allow this role to edit accounts of other members', 'ultimatemember' ),
            'value' 		=> ! empty( $role['_um_can_delete_everyone'] ) ? $role['_um_can_delete_everyone'] : 0
		),
		array(
			'id'       		=> '_um_can_delete_roles',
			'type'     		=> 'selectbox',
			'multi'     	=> true,
			'label'    		=> __( 'Can delete these user roles only', 'ultimatemember' ),
			'description' 	=> __( 'Which roles that role can edit, choose none to allow role to edit all member roles', 'ultimatemember' ),
            'value' 		=> ! empty( $role['_um_can_delete_roles'] ) ? $role['_um_can_delete_roles'] : array(),
			'options'		=> UM()->roles()->get_roles(),
			'conditional'	=> array( '_um_can_delete_everyone', '=', '1' )
		)
	);

	echo UM()->metabox()->render_metabox_section( $fields, array( 'name' => 'role' ) ); ?>
	
</div>