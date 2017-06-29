<div class="um-admin-metabox">

	<p>
		<label><?php _e('Use global settings?','ultimatemember'); ?> <?php $this->tooltip('Switch to no if you want to customize this form settings, styling &amp; appearance', 'e'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_profile_use_globals', 1, true, 1, 'xxx', 'profile-customize'); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	<div class="profile-customize">
	
	<p><label for="_um_profile_role"><?php _e('Make this profile role-specific','ultimatemember'); ?></label>
		<select name="_um_profile_role" id="_um_profile_role" class="umaf-selectjs" style="width: 100%">
			
			<?php foreach( UM()->roles()->get_roles( $add_default = 'All roles' ) as $key => $value) { ?>
			
			<option value="<?php echo $key; ?>" <?php selected($key, UM()->query()->get_meta_value('_um_profile_role', null, um_get_option('profile_role') ) ); ?>><?php echo $value; ?></option>
			
			<?php } ?>
			
		</select>
	</p>
	
	<p><label for="_um_profile_template"><?php _e('Template','ultimatemember'); ?></label>
		<select name="_um_profile_template" id="_um_profile_template" class="umaf-selectjs" style="width: 100%">

			<?php foreach( UM()->shortcodes()->get_templates( 'profile' ) as $key => $value) { ?>
			
			<option value="<?php echo $key; ?>" <?php selected($key, UM()->query()->get_meta_value('_um_profile_template', null, um_get_option('profile_template') ) ); ?>><?php echo $value; ?></option>
			
			<?php } ?>
			
		</select>
	</p>
	
	<p><label for="_um_profile_max_width"><?php _e('Max. Width (px)','ultimatemember'); ?> <?php $this->tooltip('The maximum width of shortcode in pixels e.g. 600px', 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_profile_max_width', null, um_get_option('profile_max_width') ); ?>" name="_um_profile_max_width" id="_um_profile_max_width" />
	</p>
	
	<p><label for="_um_profile_area_max_width"><?php _e('Profile Area Max. Width (px)','ultimatemember'); ?> <?php $this->tooltip('The maximum width of the profile area inside profile (below profile header)', 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_profile_area_max_width', null, um_get_option('profile_area_max_width') ); ?>" name="_um_profile_area_max_width" id="_um_profile_area_max_width" />
	</p>
	
	<p><label for="_um_profile_icons"><?php _e('Field Icons','ultimatemember'); ?> <?php $this->tooltip('Whether to show field icons and where to show them relative to the field', 'e'); ?></label>
		<select name="_um_profile_icons" id="_um_profile_icons" class="umaf-selectjs" style="width: 100%">

			<option value="field" <?php selected('field', UM()->query()->get_meta_value('_um_profile_icons', null, um_get_option('profile_icons') ) ); ?>>Show inside text field</option>
			<option value="label" <?php selected('label', UM()->query()->get_meta_value('_um_profile_icons', null, um_get_option('profile_icons') ) ); ?>>Show with label</option>
			<option value="off" <?php selected('off', UM()->query()->get_meta_value('_um_profile_icons', null, um_get_option('profile_icons') ) ); ?>>Turn off</option>
			
		</select>
	</p>

	<p><label for="_um_profile_primary_btn_word"><?php _e('Primary Button Text','ultimatemember'); ?> <?php $this->tooltip('Customize the button text', 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_profile_primary_btn_word', null, um_get_option('profile_primary_btn_word') ); ?>" name="_um_profile_primary_btn_word" id="_um_profile_primary_btn_word" />
	</p>

	<p>
		<label><?php _e('Show Secondary Button','ultimatemember'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_profile_secondary_btn', um_get_option('profile_secondary_btn'), true, 1, 'profile-secondary-btn', 'xxx'); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	<p class="profile-secondary-btn"><label for="_um_profile_secondary_btn_word"><?php _e('Secondary Button Text','ultimatemember'); ?> <?php $this->tooltip('Customize the button text', 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_profile_secondary_btn_word', null, um_get_option('profile_secondary_btn_word') ); ?>" name="_um_profile_secondary_btn_word" id="_um_profile_secondary_btn_word" />
	</p>
	
	<p><label for="_um_profile_cover_enabled"><?php _e('Enable Cover Photos','ultimatemember'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_profile_cover_enabled', um_get_option('profile_cover_enabled') , true, 1, 'cover-photo-opts', 'xxx'); ?>
				
		</span>
	</p>

	<p class="cover-photo-opts"><label for="_um_profile_cover_ratio"><?php _e('Cover photo ratio','ultimatemember'); ?> <?php $this->tooltip('The shortcode is centered by default unless you specify otherwise here', 'e'); ?></label>
		<select name="_um_profile_cover_ratio" id="_um_profile_cover_ratio" class="umaf-selectjs" style="width: 100%">

			<option value="2.7:1" <?php selected('2.7:1', UM()->query()->get_meta_value('_um_profile_cover_ratio', null, um_get_option('profile_cover_ratio') ) ); ?>>2.7:1</option>
			<option value="2.2:1" <?php selected('2.2:1', UM()->query()->get_meta_value('_um_profile_cover_ratio', null, um_get_option('profile_cover_ratio') ) ); ?>>2.2:1</option>
			<option value="3.2:1" <?php selected('3.2:1', UM()->query()->get_meta_value('_um_profile_cover_ratio', null, um_get_option('profile_cover_ratio') ) ); ?>>3.2:1</option>
			
		</select>
	</p>
	
	<p><label for="_um_profile_photosize"><?php _e('Profile Photo Size','ultimatemember'); ?> <?php $this->tooltip('Set the profile photo size in pixels here', 'e'); ?></label>
		<input type="text" value="<?php echo UM()->query()->get_meta_value('_um_profile_photosize', null, um_get_option('profile_photosize') ); ?>" name="_um_profile_photosize" id="_um_profile_photosize" />
	</p>
	
	<p><label for="_um_profile_photo_required"><?php _e('Make Profile Photo Required','ultimatemember'); ?><?php $this->tooltip('Require user to update a profile photo when updating their profile', 'e'); ?></label>
	    <span>
	        
	        <?php $this->ui_on_off('_um_profile_photo_required'); ?>
	            
	    </span>
	</p>

	<p>
		<label><?php _e('Show display name in profile header?','ultimatemember'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_profile_show_name', 1 ); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	<p>
		<label><?php _e('Show social links in profile header?','ultimatemember'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_profile_show_social_links', 0 ); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	<p>
		<label><?php _e('Show user description in profile header?','ultimatemember'); ?></label>
		<span>
			
			<?php $this->ui_on_off('_um_profile_show_bio', 1 ); ?>
				
		</span>
	</p><div class="um-admin-clear"></div>
	
	</div>
	
</div>