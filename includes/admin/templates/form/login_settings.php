<div class="um-admin-metabox">

	<?php UM()->admin_forms( array(
		'class'		=> 'um-form-login-settings um-top-label',
		'prefix_id'	=> 'form',
		'fields' => array(
			array(
				'id'		    => '_um_login_after_login',
				'type'		    => 'select',
				'label'    		=> __( 'Redirection after Login', 'ultimatemember' ),
				'tooltip' 	=> __( 'Change this If you want to override role redirection settings after login only.', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value( '_um_login_after_login', null, 0 ),
				'options'		=> array(
					'0'	=> __( 'Default', 'ultimatemember' ),
					'redirect_profile'	=> __( 'Redirect to profile', 'ultimatemember' ),
					'redirect_url'	=> __( 'Redirect to URL', 'ultimatemember' ),
					'refresh'	=> __( 'Refresh active page', 'ultimatemember' ),
					'redirect_admin'	=> __( 'Redirect to WordPress Admin', 'ultimatemember' ),
				),
			),
			array(
				'id'		    => '_um_login_redirect_url',
				'type'		    => 'text',
				'label'    		=> __( 'Set Custom Redirect URL', 'ultimatemember' ),
				'value' 		=> UM()->query()->get_meta_value('_um_login_redirect_url', null, 'na' ),
				'conditional'	=> array( '_um_login_after_login', '=', 'redirect_url' )
			)
		)
	) )->render_form(); ?>

	<div class="um-admin-clear"></div>
</div>