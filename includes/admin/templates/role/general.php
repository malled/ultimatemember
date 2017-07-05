<div class="um-admin-metabox">
	<?php $role = $object['data'];

	$fields = array(
		array(
			'id'       		=> '_um_can_edit_profile',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Can edit their profile?', 'ultimatemember' ),
			'description' 	=> __( 'Can this role edit his own profile?', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_can_edit_profile'] ) ? $role['_um_can_edit_profile'] : 0,
		),
		array(
			'id'       		=> '_um_can_delete_profile',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Can delete their account?', 'ultimatemember' ),
			'description' 	=> __( 'Allow this role to delete their account and end their membership on your site', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_can_delete_profile'] ) ? $role['_um_can_delete_profile'] : 0,
		)
	);

	echo UM()->metabox()->render_metabox_section( $fields, array( 'name' => 'role' ) ); ?>
</div>