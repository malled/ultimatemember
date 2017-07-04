<?php

	$meta = get_post_custom( get_the_ID() );
	foreach( $meta as $k => $v ) {
		if ( strstr( $k, '_um_' ) && !is_array( $v[0] ) ) {
			//print "'$k' => '" . $v[0] . "',<br />";
		}
	}

	$show_these_users = get_post_meta( get_the_ID(), '_um_show_these_users', true );
	if ( $show_these_users ) {
		$show_these_users = implode("\n", str_replace("\r", "", $show_these_users));
	}

?>

<div class="um-admin-metabox">


	<?php $fields = array(
		array(
			'id'       		=> '_um_status',
			'type'     		=> 'selectbox',
			'label'    		=> __( 'Registration Status', 'ultimatemember' ),
			'description' 	=> __( 'Select the status you would like this user role to have after they register on your site', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_status'] ) ? $role['_um_status'] : array(),
			'options'		=> array(
				'approved'	=> __('Auto Approve','ultimatemember'),
				'checkmail' => __('Require Email Activation','ultimatemember'),
				'pending'	=> __('Require Admin Review','ultimatemember')
			),
		),
		array(
			'id'       		=> '_um_auto_approve_act',
			'type'     		=> 'selectbox',
			'label'    		=> __( 'Action to be taken after registration', 'ultimatemember' ),
			'description' 	=> __( 'Select what action is taken after a person registers on your site. Depending on the status you can redirect them to their profile, a custom url or show a custom message', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_auto_approve_act'] ) ? $role['_um_auto_approve_act'] : array(),
			'options'		=> array(
				'redirect_profile' 	=> __( 'Redirect to profile', 'ultimatemember' ),
				'redirect_url'		=> __( 'Redirect to URL', 'ultimatemember' ),
			),
			'conditional'	=> array( '_um_status', '=', 'approved' )
		),
		array(
			'id'       		=> '_um_auto_approve_url',
			'type'     		=> 'text',
			'label'    		=> __( 'Set Custom Redirect URL', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_auto_approve_url'] ) ? $role['_um_auto_approve_url'] : '',
			'conditional'	=> array( '_um_auto_approve_act', '=', 'redirect_url' )
		),

		array(
			'id'       		=> '_um_login_email_activate',
			'type'     		=> 'checkbox',
			'label'    		=> __( 'Login user after validating the activation link?', 'ultimatemember' ),
			'description' 	=> __( 'Login the user after validating the activation link', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_login_email_activate'] ) ? $role['_um_login_email_activate'] : 0,
			'conditional'	=> array( '_um_status', '=', 'checkmail' )
		),
		array(
			'id'       		=> '_um_checkmail_action',
			'type'     		=> 'selectbox',
			'label'    		=> __( 'Action to be taken after registration', 'ultimatemember' ),
			'description' 	=> __( 'Select what action is taken after a person registers on your site. Depending on the status you can redirect them to their profile, a custom url or show a custom message', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_checkmail_action'] ) ? $role['_um_checkmail_action'] : array(),
			'options'		=> array(
				'show_message' 	=> __( 'Show custom message', 'ultimatemember' ),
				'redirect_url'	=> __( 'Redirect to URL', 'ultimatemember' ),
			),
			'conditional'	=> array( '_um_status', '=', 'checkmail' )
		),
		array(
			'id'       		=> '_um_checkmail_message',
			'type'     		=> 'textarea',
			'label'    		=> __( 'Personalize the custom message', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_checkmail_message'] ) ? $role['_um_checkmail_message'] : '',
			'conditional'	=> array( '_um_checkmail_action', '=', 'show_message' )
		),
		array(
			'id'       		=> '_um_checkmail_url',
			'type'     		=> 'text',
			'label'    		=> __( 'Set Custom Redirect URL', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_checkmail_url'] ) ? $role['_um_checkmail_url'] : '',
			'conditional'	=> array( '_um_checkmail_action', '=', 'redirect_url' )
		),
		array(
			'id'       		=> '_um_url_email_activate',
			'type'     		=> 'text',
			'label'    		=> __( 'URL redirect after e-mail activation', 'ultimatemember' ),
			'description' 	=> __( 'If you want users to go to a specific page other than login page after e-mail activation, enter the URL here.', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_url_email_activate'] ) ? $role['_um_url_email_activate'] : '',
			'conditional'	=> array( '_um_status', '=', 'checkmail' ),
		),

		array(
			'id'       		=> '_um_pending_action',
			'type'     		=> 'selectbox',
			'label'    		=> __( 'Action to be taken after registration', 'ultimatemember' ),
			'description' 	=> __( 'Select what action is taken after a person registers on your site. Depending on the status you can redirect them to their profile, a custom url or show a custom message', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_pending_action'] ) ? $role['_um_pending_action'] : array(),
			'options'		=> array(
				'show_message' 	=> __( 'Show custom message', 'ultimatemember' ),
				'redirect_url'	=> __( 'Redirect to URL', 'ultimatemember' ),
			),
			'conditional'	=> array( '_um_status', '=', 'pending' )
		),
		array(
			'id'       		=> '_um_pending_message',
			'type'     		=> 'textarea',
			'label'    		=> __( 'Personalize the custom message', 'ultimatemember' ),
			'value' 		=> ! empty( $role['_um_pending_message'] ) ? $role['_um_pending_message'] : '',
			'conditional'	=> array( '_um_pending_action', '=', 'show_message' )
		),
		array(
			'id'       		=> '_um_pending_url',
			'type'     		=> 'text',
			'label'    		=> __( 'Set Custom Redirect URL', 'ultimatemember' ),
			'conditional'	=> array( '_um_pending_action', '=', 'redirect_url' ),
			'value' 		=> ! empty( $role['_um_pending_url'] ) ? $role['_um_pending_url'] : '',
		)
	);

	UM()->admin_forms( array(
		'class'		=> 'um-member-directory-general',
		'prefix_id'	=> 'um_metadata_',
		'fields' => array(
			array(
				'id'		=> '_um_mode',
				'type'		=> 'hidden',
				'name'		=> '_um_mode',
				'value'		=> 'directory',
			),
			array(
				'id'		=> '_um_sortby_custom',
				'type'		=> 'text',
				'name'		=> '_um_sortby_custom',
				'label'		=> __( 'User Roles to Display', 'ultimatemember' ),
				'tooltip'	=> __( 'If you do not want to show all members, select only user roles to appear in this directory', 'ultimatemember' ),
				'value'		=> UM()->query()->get_meta_value( '_um_sortby_custom', null, 'na' ),
			)
		)
	) )->render_form();

	/*echo UM()->metabox()->render_metabox_section( $fields, array( 'name' => 'role' ) );*/ ?>


	<div class="">

		<input type="hidden" name="_um_mode" id="_um_mode" value="directory" />

		<p>
			<label class="um-admin-half"><?php _e( 'User Roles to Display', 'ultimatemember' ); ?> <?php UM()->tooltip( __( 'If you do not want to show all members, select only user roles to appear in this directory', 'ultimatemember' ) ); ?></label>
			<span class="um-admin-half">

				<select multiple="multiple" name="_um_roles[]" id="_um_roles" class="umaf-selectjs" style="width: 300px">
					<?php foreach( UM()->roles()->get_roles() as $key => $value) { ?>
					<option value="<?php echo $key; ?>" <?php selected($key, UM()->query()->get_meta_value('_um_roles', $key ) ); ?>><?php echo $value; ?></option>
					<?php } ?>
				</select>

			</span>
		</p><div class="um-admin-clear"></div>

		<p>
			<label class="um-admin-half"><?php _e('Only show members who have uploaded a profile photo','ultimatemember'); ?><?php $this->tooltip('If \'Use Gravatars\' as profile photo is enabled, this option is ignored'); ?></label>
			<span class="um-admin-half">

				<?php $this->ui_on_off('_um_has_profile_photo'); ?>

			</span>
		</p><div class="um-admin-clear"></div>

		<p>
			<label class="um-admin-half"><?php _e('Only show members who have uploaded a cover photo','ultimatemember'); ?></label>
			<span class="um-admin-half">

				<?php $this->ui_on_off('_um_has_cover_photo'); ?>

			</span>
		</p><div class="um-admin-clear"></div>

		<p>
			<label class="um-admin-half"><?php _e('Sort users by','ultimatemember'); ?> <?php $this->tooltip('Sort users by a specific parameter in the directory'); ?></label>
			<span class="um-admin-half">

				<select name="_um_sortby" id="_um_sortby" class="umaf-selectjs um-adm-conditional" style="width: 300px" data-cond1='other' data-cond1-show='custom-field'>
					<option value="user_registered_desc" <?php selected('user_registered_desc', UM()->query()->get_meta_value('_um_sortby') ); ?>><?php _e('New users first','ultimatemember'); ?></option>
					<option value="user_registered_asc" <?php selected('user_registered_asc', UM()->query()->get_meta_value('_um_sortby') ); ?>><?php _e('Old users first','ultimatemember'); ?></option>
					<option value="last_login" <?php selected('last_login', UM()->query()->get_meta_value('_um_sortby') ); ?>><?php _e('Last login','ultimatemember'); ?></option>
					<option value="display_name" <?php selected('display_name', UM()->query()->get_meta_value('_um_sortby') ); ?>><?php _e('Display Name','ultimatemember'); ?></option>
					<option value="first_name" <?php selected('first_name', UM()->query()->get_meta_value('_um_sortby') ); ?>><?php _e('First Name','ultimatemember'); ?></option>
					<option value="last_name" <?php selected('last_name', UM()->query()->get_meta_value('_um_sortby') ); ?>><?php _e('Last Name','ultimatemember'); ?></option>
					<option value="random" <?php selected('random', UM()->query()->get_meta_value('_um_sortby') ); ?>><?php _e('Random','ultimatemember'); ?></option>
					<option value="other" <?php selected('other', UM()->query()->get_meta_value('_um_sortby') ); ?>><?php _e('Other (custom field)','ultimatemember'); ?></option>
					<?php do_action('um_admin_directory_sort_users_select', '_um_sortby'); ?>
				</select>

			</span>
		</p><div class="um-admin-clear"></div>

		<p class="custom-field">
			<label class="um-admin-half"><?php _e('Meta key','ultimatemember'); ?> <?php $this->tooltip('To sort by a custom field, enter the meta key of field here'); ?></label>
			<span class="um-admin-half">

				<input type="text" name="_um_sortby_custom" id="_um_sortby_custom" value="<?php echo UM()->query()->get_meta_value('_um_sortby_custom', null, 'na' ); ?>" />

			</span>
		</p><div class="um-admin-clear"></div>

		<p>
			<label class="um-admin-half"><?php _e('Only show specific users (Enter one username per line)','ultimatemember'); ?></label>
			<span class="um-admin-half">

				<textarea name="_um_show_these_users" id="_um_show_these_users"><?php echo $show_these_users; ?></textarea>

			</span>
		</p><div class="um-admin-clear"></div>

		<?php do_action('um_admin_extend_directory_options_general', $this); ?>

	</div>

	<div class="um-admin-clear"></div>

</div>
