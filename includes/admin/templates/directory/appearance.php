<div class="um-admin-metabox">

	<?php UM()->admin_forms( array(
		'class'		=> 'um-member-directory-appearance um-top-label',
		'prefix_id'	=> 'um_metadata',
		'fields' => array(
			array(
				'id'		=> '_um_directory_template',
				'type'		=> 'select',
				'name'		=> '_um_directory_template',
				'label'		=> __( 'Template', 'ultimatemember' ),
				'value'		=> UM()->query()->get_meta_value( '_um_directory_template', null, um_get_option( 'directory_template' ) ),
				'options'	=> UM()->shortcodes()->get_templates( 'members' ),
			)
		)
	) )->render_form(); ?>


<!--	<p><label for="_um_directory_template"><?php /*_e('Template','ultimatemember'); */?></label>
		<select name="_um_directory_template" id="_um_directory_template" class="umaf-selectjs" style="width: 100%">

			<?php /*foreach( UM()->shortcodes()->get_templates( 'members' ) as $key => $value) { */?>
			
			<option value="<?php /*echo $key; */?>" <?php /*selected($key, UM()->query()->get_meta_value('_um_directory_template', null, um_get_option('directory_template') ) ); */?>><?php /*echo $value; */?></option>
			
			<?php /*} */?>
			
		</select>
	</p>
	-->
</div>