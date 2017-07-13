<div class="um-admin-metabox">

	<?php
	foreach ( UM()->roles()->get_roles( __( 'Default', 'ultimatemember' ) ) as $key => $value ) {
		if ( ! empty( UM()->query()->get_meta_value( '_um_register_role', $key ) ) )
			$register_role = UM()->query()->get_meta_value( '_um_register_role', $key );
	}

	UM()->admin_forms( array(
		'class'		=> 'um-form-register-customize um-top-label',
		'prefix_id'	=> 'form',
		'fields' => array(
			array(
				'id'		    => '_um_register_use_globals',
				'type'		    => 'select',
				'label'    		=> __( 'Apply custom settings to this form', 'ultimatemember' ),
				'tooltip' 	=> __( 'Switch to yes if you want to customize this form settings, styling &amp; appearance', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_register_use_globals', null, 0 ),
				'options'		=> array(
					0	=> __( 'No', 'ultimatemember' ),
					1	=> __( 'Yes', 'ultimatemember' ),
				),
			),
			array(
				'id'		    => '_um_register_role',
				'type'		    => 'select',
				'label'    		=> __( 'Assign role to form', 'ultimatemember' ),
				'value' 		=> ! empty( $register_role ) ? $register_role : 0,
				'options'		=> UM()->roles()->get_roles( __( 'Default', 'ultimatemember' ) ),
				'conditional'	=> array( '_um_register_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_register_template',
				'type'		    => 'select',
				'label'    		=> __( 'Template', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_register_template', null, um_get_option( 'register_template' ) ),
				'options'		=> UM()->shortcodes()->get_templates( 'register' ),
				'conditional'	=> array( '_um_register_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_register_max_width',
				'type'		    => 'text',
				'label'    		=> __( 'Max. Width (px)', 'ultimatemember' ),
				'tooltip'    	=> __( 'The maximum width of shortcode in pixels e.g. 600px', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value('_um_register_max_width', null, um_get_option( 'register_max_width' ) ),
				'conditional'	=> array( '_um_register_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_register_icons',
				'type'		    => 'select',
				'label'    		=> __( 'Field Icons', 'ultimatemember' ),
				'tooltip'    	=> __( 'Whether to show field icons and where to show them relative to the field', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_register_icons', null, um_get_option( 'register_icons' ) ) ,
				'options'		=> array(
					'field' => __( 'Show inside text field', 'ultimatemember' ),
					'label' => __( 'Show with label', 'ultimatemember' ),
					'off' 	=> __( 'Turn off', 'ultimatemember' )
				),
				'conditional'	=> array( '_um_register_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_register_primary_btn_word',
				'type'		    => 'text',
				'label'    		=> __( 'Primary Button Text', 'ultimatemember' ),
				'tooltip'    	=> __( 'Customize the button text', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_register_primary_btn_word', null, um_get_option( 'register_primary_btn_word' ) ),
				'conditional'	=> array( '_um_register_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_register_secondary_btn',
				'type'		    => 'checkbox',
				'label'    		=> __( 'Show Secondary Button', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_register_secondary_btn', null, 1 ),
				'conditional'	=> array( '_um_register_use_globals', '=', 1 )
			),
			array(
				'id'		    => '_um_register_secondary_btn_word',
				'type'		    => 'text',
				'label'    		=> __( 'Primary Button Text', 'ultimatemember' ),
				'tooltip'    	=> __( 'Customize the button text', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_register_secondary_btn_word', null, um_get_option( 'register_secondary_btn_word' ) ),
				'conditional'	=> array( '_um_register_secondary_btn', '=', 1 )
			)
		)
	) )->render_form(); ?>

	<div class="um-admin-clear"></div>
</div>