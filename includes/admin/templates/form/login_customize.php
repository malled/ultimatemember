<div class="um-admin-metabox">

	<p>
		<label><?php _e('Use global settings?','ultimatemember'); ?> <?php $this->tooltip('Switch to no if you want to customize this form settings, styling &amp; appearance', 'e'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_login_use_globals', 1, true, 1, 'xxx', 'login-customize'); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	<div class="login-customize">
	
	<p><label for="_um_login_template"><?php _e('Template','ultimatemember'); ?></label>
		<select name="_um_login_template" id="_um_login_template" class="umaf-selectjs" style="width: 100%">

			<?php foreach( UM()->shortcodes()->get_templates( 'login' ) as $key => $value) { ?>
			
			<option value="<?php echo $key; ?>" <?php selected($key, UM()->query()->get_meta_value('_um_login_template', null, um_get_option('login_template') ) ); ?>><?php echo $value; ?></option>
			
			<?php } ?>
			
		</select>
	</p>
	
	<p><label for="_um_login_max_width"><?php _e('Max. Width (px)','ultimatemember'); ?> <?php $this->tooltip('The maximum width of shortcode in pixels e.g. 600px', 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_login_max_width', null, um_get_option('login_max_width') ); ?>" name="_um_login_max_width" id="_um_login_max_width" />
	</p>
	
	<p><label for="_um_login_icons"><?php _e('Field Icons','ultimatemember'); ?> <?php $this->tooltip('Whether to show field icons and where to show them relative to the field', 'e'); ?></label>
		<select name="_um_login_icons" id="_um_login_icons" class="umaf-selectjs" style="width: 100%">

			<option value="field" <?php selected('field', UM()->query()->get_meta_value('_um_login_icons', null, um_get_option('login_icons') ) ); ?>>Show inside text field</option>
			<option value="label" <?php selected('label', UM()->query()->get_meta_value('_um_login_icons', null, um_get_option('login_icons') ) ); ?>>Show with label</option>
			<option value="off" <?php selected('off', UM()->query()->get_meta_value('_um_login_icons', null, um_get_option('login_icons') ) ); ?>>Turn off</option>
			
		</select>
	</p>
	
	<p><label for="_um_login_primary_btn_word"><?php _e('Primary Button Text','ultimatemember'); ?> <?php $this->tooltip('Customize the button text', 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_login_primary_btn_word', null, um_get_option('login_primary_btn_word') ); ?>" name="_um_login_primary_btn_word" id="_um_login_primary_btn_word" />
	</p>

	<p>
		<label><?php _e('Show Secondary Button','ultimatemember'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_login_secondary_btn', um_get_option('login_secondary_btn'), true, 1, 'login-secondary-btn', 'xxx'); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	<p class="login-secondary-btn"><label for="_um_login_secondary_btn_word"><?php _e('Secondary Button Text','ultimatemember'); ?> <?php $this->tooltip('Customize the button text', 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_login_secondary_btn_word', null, um_get_option('login_secondary_btn_word') ); ?>" name="_um_login_secondary_btn_word" id="_um_login_secondary_btn_word" />
	</p>
	
	<p>
		<label><?php _e('Show Forgot Password Link?','ultimatemember'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_login_forgot_pass_link', um_get_option('login_forgot_pass_link') ); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	<p>
		<label><?php _e('Show "Remember Me"?','ultimatemember'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_login_show_rememberme', um_get_option('login_show_rememberme') ); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	</div>
	
</div>