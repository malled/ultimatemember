<div class="um-admin-metabox">

	<?php UM()->admin_forms( array(
		'class'		=> 'um-member-directory-pagination um-half-column',
		'prefix_id'	=> 'um_metadata',
		'fields' => array(
			array(
				'id'		=> '_um_profiles_per_page',
				'type'		=> 'text',
				'name'		=> '_um_profiles_per_page',
				'label'		=> __( 'Number of profiles per page', 'ultimatemember' ),
				'tooltip'	=> __( 'Number of profiles to appear on page for standard users', 'ultimatemember' ),
				'value'		=> UM()->query()->get_meta_value( '_um_profiles_per_page', null, 12 ),
				'size'		=> 'small'
			),
			array(
				'id'		=> '_um_profiles_per_page_mobile',
				'type'		=> 'text',
				'name'		=> '_um_profiles_per_page_mobile',
				'label'		=> __( 'Number of profiles per page (for Mobiles & Tablets)', 'ultimatemember' ),
				'tooltip'	=> __( 'Number of profiles to appear on page for mobile users', 'ultimatemember' ),
				'value'		=> UM()->query()->get_meta_value( '_um_profiles_per_page_mobile', null, 8 ),
				'size'		=> 'small'
			),
			array(
				'id'		=> '_um_max_users',
				'type'		=> 'text',
				'name'		=> '_um_max_users',
				'label'		=> __( 'Maximum number of profiles', 'ultimatemember' ),
				'tooltip'	=> __( 'Use this setting to control the maximum number of profiles to appear in this directory. Leave blank to disable this limit', 'ultimatemember' ),
				'value'		=> UM()->query()->get_meta_value( '_um_max_users', null, 'na' ),
				'size'		=> 'small'
			)
		)
	) )->render_form(); ?>

	<div class="um-admin-clear"></div>
</div>