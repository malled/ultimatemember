<div class="um-admin-metabox">
	<?php
	$can_search_array = array();
	foreach ( UM()->roles()->get_roles() as $key => $value ) {
		if ( ! empty( UM()->query()->get_meta_value( '_um_roles_can_search', $key ) ) )
			$can_search_array[] = UM()->query()->get_meta_value( '_um_roles_can_search', $key );
	}

	UM()->admin_forms( array(
		'class'		=> 'um-member-directory-search um-half-column',
		'prefix_id'	=> 'um_metadata',
		'fields' => array(
			array(
				'id'		=> '_um_search',
				'type'		=> 'checkbox',
				'name'		=> '_um_search',
				'label'		=> __( 'Enable Search feature', 'ultimatemember' ),
				'tooltip'	=> __( 'If turned on, users will be able to search members in this directory', 'ultimatemember' ),
				'value'		=> UM()->query()->get_meta_value( '_um_search' ),
			),
			array(
				'id'		=> '_um_must_search',
				'type'		=> 'checkbox',
				'name'		=> '_um_must_search',
				'label'		=> __( 'Show results only after search', 'ultimatemember' ),
				'tooltip'	=> __( 'If turned on, member results will only appear after search is performed', 'ultimatemember' ),
				'value'		=> UM()->query()->get_meta_value( '_um_must_search' ),
				'conditional'   => array( '_um_search', '=', 1 )
			),
			array(
				'id'		=> '_um_roles_can_search',
				'type'		=> 'select',
				'multi'		=> true,
				'name'		=> '_um_roles_can_search',
				'label'		=> __( 'User Roles that can use search', 'ultimatemember' ),
				'tooltip'	=> __( 'If you want to allow specific user roles to be able to search only', 'ultimatemember' ),
				'value'		=> $can_search_array,
				'options'	=> UM()->roles()->get_roles(),
				'conditional'   => array( '_um_search', '=', 1 )
			),
			array(
				'id'		=> '_um_roles_can_search',
				'type'		=> 'multi-text',
				'name'		=> '_um_roles_can_search',
				'label'		=> __( 'Choose field(s) to enable in search', 'ultimatemember' ),
				'value'		=> $can_search_array,
				'conditional'   => array( '_um_search', '=', 1 )
			),
			array(
				'id'		=> '_um_directory_header',
				'type'		=> 'text',
				'name'		=> '_um_directory_header',
				'label'		=> __( 'Results Text', 'ultimatemember' ),
				'tooltip'	=> __( 'Customize the search result text . e.g. Found 3,000 Members. Leave this blank to not show result text', 'ultimatemember' ),
				'value'		=> UM()->query()->get_meta_value('_um_directory_header', null, __('{total_users} Members','ultimatemember') ),
				'conditional'   => array( '_um_search', '=', 1 )
			),
			array(
				'id'		=> '_um_directory_header_single',
				'type'		=> 'text',
				'name'		=> '_um_directory_header_single',
				'label'		=> __( 'Single Result Text', 'ultimatemember' ),
				'tooltip'	=> __( 'Same as above but in case of 1 user found only', 'ultimatemember' ),
				'value'		=> UM()->query()->get_meta_value('_um_directory_header_single', null, __('{total_users} Member','ultimatemember') ),
				'conditional'   => array( '_um_search', '=', 1 )
			),
			array(
				'id'		=> '_um_directory_no_users',
				'type'		=> 'text',
				'name'		=> '_um_directory_no_users',
				'label'		=> __( 'Custom text if no users were found', 'ultimatemember' ),
				'tooltip'	=> __( 'This is the text that is displayed if no users are found during a search', 'ultimatemember' ),
				'value'		=> UM()->query()->get_meta_value('_um_directory_no_users', null, __('We are sorry. We cannot find any users who match your search criteria.','ultimatemember') ),
				'conditional'   => array( '_um_search', '=', 1 )
			)
		)
	) )->render_form(); ?>
	<div class="">
		
		<p>
			<label class="um-admin-half"><?php _e('Enable Search feature','ultimatemember'); ?> <?php $this->tooltip('If turned on, users will be able to search members in this directory'); ?></label>
			<span class="um-admin-half">
			
				<?php $this->ui_on_off('_um_search', 0, true, 1, 'search-options', 'xxx'); ?>
				
			</span>
		</p><div class="um-admin-clear"></div>
		
		<p class="search-options">
			<label class="um-admin-half"><?php _e('Show results only after search','ultimatemember'); ?> <?php $this->tooltip('If turned on, member results will only appear after search is performed'); ?></label>
			<span class="um-admin-half">
			
				<?php $this->ui_on_off('_um_must_search', 0); ?>
				
			</span>
		</p><div class="um-admin-clear"></div>
		
		<p class="search-options">
			<label class="um-admin-half"><?php _e('User Roles that can use search','ultimatemember'); ?> <?php $this->tooltip('If you want to allow specific user roles to be able to search only'); ?></label>
			<span class="um-admin-half">
			
				<select multiple="multiple" name="_um_roles_can_search[]" id="_um_roles_can_search" class="umaf-selectjs" style="width: 300px">
					<?php foreach( UM()->roles()->get_roles() as $key => $value) { ?>
					<option value="<?php echo $key; ?>" <?php selected($key, UM()->query()->get_meta_value('_um_roles_can_search', $key) ); ?>><?php echo $value; ?></option>
					<?php } ?>	
				</select>
				
			</span>
		</p><div class="um-admin-clear"></div>
		
		<p class="search-options">
			<label class=""><?php _e( 'Choose field(s) to enable in search','ultimatemember' ); ?></label>
				
				<?php
				
				$custom_search = apply_filters('um_admin_custom_search_filters', array() );
				$searchable_fields = UM()->builtin()->all_user_fields('date,time,url');
				$searchable_fields = $searchable_fields + $custom_search;
				
				$meta_test = get_post_meta( get_the_ID(), '_um_search_fields', true );
				$i = 0;
				if ( is_array( $meta_test ) ) { 
					foreach( $meta_test as $val ) { $i++;
				?>
				
				<span class="um-admin-field">
				
				<select name="_um_search_fields[]" id="_um_search_fields" class="umaf-selectjs" style="width: 300px" data-placeholder="Choose a field">
					<?php foreach( $searchable_fields as $key => $arr) { ?>
					<option value="<?php echo $key; ?>" <?php selected($key, $val ); ?>><?php echo isset( $arr['title'] ) ? $arr['title'] : ''; ?></option>
					<?php } ?>	
				</select>
				
				<?php if ( $i == 1 ) { ?>
				<a href="#" class="um-admin-clone button um-admin-tipsy-n" title="New Field"><i class="um-icon-plus" style="margin-right:0!important"></i></a>
				<?php } else { ?>
				<a href="#" class="um-admin-clone-remove button um-admin-tipsy-n" title="Remove Field"><i class="um-icon-close" style="margin-right:0!important"></i></a>
				<?php } ?>
				
				</span>
				
				<?php }
				
				} else {
				?>
			
				<span class="um-admin-field">
				
				<select name="_um_search_fields[]" id="_um_search_fields" class="umaf-selectjs" style="width: 300px" data-placeholder="Choose a field">
					<?php foreach( $searchable_fields as $key => $arr) { ?>
					<option value="<?php echo $key; ?>" <?php selected($key, UM()->query()->get_meta_value('_um_search_fields', $key) ); ?>><?php echo isset( $arr['title'] ) ? $arr['title'] : ''; ?></option>
					<?php } ?>	
				</select>
				
				<a href="#" class="um-admin-clone button um-admin-tipsy-n" title="New Field"><i class="um-icon-plus" style="margin-right:0!important"></i></a>
				
				</span>
				
				<?php } ?>

		</p><div class="um-admin-clear"></div>
		
		<p class="search-options">
			<label class="um-admin-half"><?php _e('Results Text','ultimatemember'); ?> <?php $this->tooltip( __('Customize the search result text . e.g. Found 3,000 Members. Leave this blank to not show result text','ultimatemember') ); ?></label>
			<span class="um-admin-half">
				
				<input type="text" name="_um_directory_header" id="_um_directory_header" value="<?php echo UM()->query()->get_meta_value('_um_directory_header', null, __('{total_users} Members','ultimatemember') ); ?>" />
				
			</span>
		</p><div class="um-admin-clear"></div>
		
		<p class="search-options">
			<label class="um-admin-half"><?php _e('Single Result Text','ultimatemember'); ?> <?php $this->tooltip( __('Same as above but in case of 1 user found only','ultimatemember') ); ?></label>
			<span class="um-admin-half">
				
				<input type="text" name="_um_directory_header_single" id="_um_directory_header_single" value="<?php echo UM()->query()->get_meta_value('_um_directory_header_single', null, __('{total_users} Member','ultimatemember') ); ?>" />
				
			</span>
		</p><div class="um-admin-clear"></div>
		
		<p class="search-options">
			<label class="um-admin-half"><?php _e('Custom text if no users were found','ultimatemember'); ?> <?php $this->tooltip('This is the text that is displayed if no users are found during a search'); ?></label>
			<span class="um-admin-half">
				
				<input type="text" name="_um_directory_no_users" id="_um_directory_no_users" value="<?php echo UM()->query()->get_meta_value('_um_directory_no_users', null, __('We are sorry. We cannot find any users who match your search criteria.','ultimatemember') ); ?>" />
				
			</span>
		</p><div class="um-admin-clear"></div>
		
	</div>
	
	<div class="um-admin-clear"></div>
	
</div>