<div class="um-admin-metabox">

	<?php
	foreach ( UM()->roles()->get_roles( __( 'All roles', 'ultimatemember' ) ) as $key => $value ) {
		if ( ! empty( UM()->query()->get_meta_value( '_um_profile_role', $key ) ) )
			$profile_role = UM()->query()->get_meta_value( '_um_profile_role', $key );
	}

	UM()->admin_forms( array(
		'class'		=> 'um-form-profile-customize um-top-label',
		'prefix_id'	=> 'form',
		'fields' => array(
			array(
				'id'		    => '_um_profile_use_globals',
				'type'		    => 'select',
				'label'    		=> __( 'Apply custom settings to this form', 'ultimatemember' ),
				'tooltip' 	=> __( 'Switch to yes if you want to customize this form settings, styling &amp; appearance', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_use_globals', null, 0 ),
				'options'		=> array(
					0	=> __( 'No', 'ultimatemember' ),
					1	=> __( 'Yes', 'ultimatemember' ),
				),
			),
			array(
				'id'		    => '_um_profile_role',
				'type'		    => 'select',
				'label'    		=> __( 'Make this profile role-specific', 'ultimatemember' ),
				'value' 		=> ! empty( $profile_role ) ? $profile_role : 0,
				'options'		=> UM()->roles()->get_roles( __( 'All roles', 'ultimatemember' ) ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_template',
				'type'		    => 'select',
				'label'    		=> __( 'Template', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_template', null, um_get_option( 'profile_template' ) ),
				'options'		=> UM()->shortcodes()->get_templates( 'profile' ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_max_width',
				'type'		    => 'text',
				'label'    		=> __( 'Max. Width (px)', 'ultimatemember' ),
				'tooltip'    	=> __( 'The maximum width of shortcode in pixels e.g. 600px', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value('_um_profile_max_width', null, um_get_option( 'profile_max_width' ) ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_area_max_width',
				'type'		    => 'text',
				'label'    		=> __( 'Profile Area Max. Width (px)', 'ultimatemember' ),
				'tooltip'    	=> __( 'The maximum width of the profile area inside profile (below profile header)', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value('_um_profile_area_max_width', null, um_get_option( 'profile_area_max_width' ) ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_icons',
				'type'		    => 'select',
				'label'    		=> __( 'Field Icons', 'ultimatemember' ),
				'tooltip'    	=> __( 'Whether to show field icons and where to show them relative to the field', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_icons', null, um_get_option( 'profile_icons' ) ) ,
				'options'		=> array(
					'field' => __( 'Show inside text field', 'ultimatemember' ),
					'label' => __( 'Show with label', 'ultimatemember' ),
					'off' 	=> __( 'Turn off', 'ultimatemember' )
				),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_primary_btn_word',
				'type'		    => 'text',
				'label'    		=> __( 'Primary Button Text', 'ultimatemember' ),
				'tooltip'    	=> __( 'Customize the button text', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_primary_btn_word', null, um_get_option( 'profile_primary_btn_word' ) ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_secondary_btn',
				'type'		    => 'checkbox',
				'label'    		=> __( 'Show Secondary Button', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_secondary_btn', null, 1 ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_secondary_btn_word',
				'type'		    => 'text',
				'label'    		=> __( 'Primary Button Text', 'ultimatemember' ),
				'tooltip'    	=> __( 'Customize the button text', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_secondary_btn_word', null, um_get_option( 'profile_secondary_btn_word' ) ),
				'conditional'	=> array( '_um_profile_secondary_btn', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_cover_enabled',
				'type'		    => 'checkbox',
				'label'    		=> __( 'Enable Cover Photos', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_cover_enabled', null, 1 ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_cover_ratio',
				'type'		    => 'select',
				'label'    		=> __( 'Cover photo ratio', 'ultimatemember' ),
				'tooltip'    		=> __( 'The shortcode is centered by default unless you specify otherwise here', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_cover_ratio', null, um_get_option( 'profile_cover_ratio' ) ),
				'options'		=> array(
					'2.7:1'	=>	'2.7:1',
					'2.2:1'	=>	'2.2:1',
					'3.2:1'	=>	'3.2:1'
				),
				'conditional'	=> array( '_um_profile_cover_enabled', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_photosize',
				'type'		    => 'text',
				'label'    		=> __( 'Profile Photo Size', 'ultimatemember' ),
				'tooltip'    	=> __( 'Set the profile photo size in pixels here', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_photosize', null, um_get_option( 'profile_photosize' ) ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_photo_required',
				'type'		    => 'checkbox',
				'label'    		=> __( 'Make Profile Photo Required', 'ultimatemember' ),
				'tooltip'    		=> __( 'Require user to update a profile photo when updating their profile', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_photo_required' ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_show_name',
				'type'		    => 'checkbox',
				'label'    		=> __( 'Show display name in profile header?', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_show_name', null, 1 ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_show_social_links',
				'type'		    => 'checkbox',
				'label'    		=> __( 'Show social links in profile header?', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_show_social_links', null, 0 ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_profile_show_bio',
				'type'		    => 'checkbox',
				'label'    		=> __( 'Show user description in profile header?', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_profile_show_bio', null, 1 ),
				'conditional'	=> array( '_um_profile_use_globals', '=', 1 )
			),

		)
	) )->render_form(); ?>

	<div class="um-admin-clear"></div>
</div>