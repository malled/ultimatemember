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

<!--	<div class="">
		
		<p>
			<label class="um-admin-half"><?php /*_e('Number of profiles per page','ultimatemember'); */?> <?php /*$this->tooltip( __('Number of profiles to appear on page for standard users') ); */?></label>
			<span class="um-admin-half">
			
				<input type="text" name="_um_profiles_per_page" id="_um_profiles_per_page" value="<?php /*echo UM()->query()->get_meta_value('_um_profiles_per_page', null, 12); */?>" class="small" />
			
			</span>
		</p><div class="um-admin-clear"></div>
		
		<p>
			<label class="um-admin-half"><?php /*_e('Number of profiles per page (for Mobiles & Tablets)','ultimatemember'); */?> <?php /*$this->tooltip( __('Number of profiles to appear on page for mobile users') ); */?></label>
			<span class="um-admin-half">
			
				<input type="text" name="_um_profiles_per_page_mobile" id="_um_profiles_per_page_mobile" value="<?php /*echo UM()->query()->get_meta_value('_um_profiles_per_page_mobile', null, 8); */?>" class="small" />
			
			</span>
		</p><div class="um-admin-clear"></div>
		
		<p>
			<label class="um-admin-half"><?php /*_e('Maximum number of profiles','ultimatemember'); */?> <?php /*$this->tooltip( __('Use this setting to control the maximum number of profiles to appear in this directory. Leave blank to disable this limit','ultimatemember') ); */?></label>
			<span class="um-admin-half">
				
				<input type="text" name="_um_max_users" id="_um_max_users" value="<?php /*echo UM()->query()->get_meta_value('_um_max_users', null, 'na' ); */?>" class="small" />
				
			</span>
		</p><div class="um-admin-clear"></div>

	</div>-->
	
	<div class="um-admin-clear"></div>
	
</div>