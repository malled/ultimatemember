<div class="um-admin-metabox">

	<p>
		<label><?php _e('Use global settings?','ultimatemember'); ?> <?php $this->tooltip( __('Switch to no if you want to customize this form settings, styling &amp; appearance','ultimatemember'), 'e'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_register_use_globals', 1, true, 1, 'xxx', 'register-customize'); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	<div class="register-customize">
	
	<p><label for="_um_register_role"><?php _e('Assign role to form','ultimatemember'); ?></label>
		<select name="_um_register_role" id="_um_register_role" class="umaf-selectjs" style="width: 100%">
			
			<?php foreach( UM()->roles()->get_roles( $add_default = 'Default' ) as $key => $value) { ?>
			
			<option value="<?php echo $key; ?>" <?php selected($key, UM()->query()->get_meta_value('_um_register_role', null, um_get_option('register_role') ) ); ?>><?php echo $value; ?></option>
			
			<?php } ?>
			
		</select>
	</p>
	
	<p><label for="_um_register_template"><?php _e('Template','ultimatemember'); ?></label>
		<select name="_um_register_template" id="_um_register_template" class="umaf-selectjs" style="width: 100%">

			<?php foreach( UM()->shortcodes()->get_templates( 'register' ) as $key => $value) { ?>
			
			<option value="<?php echo $key; ?>" <?php selected($key, UM()->query()->get_meta_value('_um_register_template', null, um_get_option('register_template') ) ); ?>><?php echo $value; ?></option>
			
			<?php } ?>
			
		</select>
	</p>
	
	<p><label for="_um_register_max_width"><?php _e('Max. Width (px)','ultimatemember'); ?> <?php $this->tooltip('The maximum width of shortcode in pixels e.g. 600px', 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_register_max_width', null, um_get_option('register_max_width') ); ?>" name="_um_register_max_width" id="_um_register_max_width" />
	</p>
	
	<p><label for="_um_register_icons"><?php _e('Field Icons','ultimatemember'); ?> <?php $this->tooltip( __('Whether to show field icons and where to show them relative to the field','ultimatemember'), 'e'); ?></label>
		<select name="_um_register_icons" id="_um_register_icons" class="umaf-selectjs" style="width: 100%">

			<option value="field" <?php selected('field', UM()->query()->get_meta_value('_um_register_icons', null, um_get_option('register_icons') ) ); ?>>Show inside text field</option>
			<option value="label" <?php selected('label', UM()->query()->get_meta_value('_um_register_icons', null, um_get_option('register_icons') ) ); ?>>Show with label</option>
			<option value="off" <?php selected('off', UM()->query()->get_meta_value('_um_register_icons', null, um_get_option('register_icons') ) ); ?>>Turn off</option>
			
		</select>
	</p>
	
	<p><label for="_um_register_primary_btn_word"><?php _e('Primary Button Text','ultimatemember'); ?> <?php $this->tooltip( __('Customize the button text','ultimatemember'), 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_register_primary_btn_word', null, um_get_option('register_primary_btn_word') ); ?>" name="_um_register_primary_btn_word" id="_um_register_primary_btn_word" />
	</p>

	<p>
		<label><?php _e('Show Secondary Button','ultimatemember'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_register_secondary_btn', um_get_option('register_secondary_btn'), true, 1, 'register-secondary-btn', 'xxx'); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	<p class="register-secondary-btn"><label for="_um_register_secondary_btn_word"><?php _e('Secondary Button Text','ultimatemember'); ?> <?php $this->tooltip( __('Customize the button text','ultimatemember'), 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_register_secondary_btn_word', null, um_get_option('register_secondary_btn_word') ); ?>" name="_um_register_secondary_btn_word" id="_um_register_secondary_btn_word" />
	</p>
	
	</div>

</div>