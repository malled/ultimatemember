<div class="um-admin-metabox">
    <?php
    $role = $object['data'];
    $role_capabilities = ! empty( $role['wp_capabilities'] ) ? array_keys( $role['wp_capabilities'] ) : array();

    if ( ! empty( $_GET['id'] ) ) {
        $role = get_role( $_GET['id'] );
    }

    $all_caps = array();
    foreach ( get_editable_roles() as $role_info ) {
        if ( ! empty( $role_info['capabilities'] ) )
            $all_caps = array_merge( $all_caps, $role_info['capabilities'] );
    }

    $fields = array();
    foreach ( array_keys( $all_caps ) as $cap ) {
        $fields[] = array(
            'id'       		=> $cap,
            'type'     		=> 'checkbox',
            'label'    		=> $cap,
            'value' 		=> ( ! empty( $role_capabilities ) && in_array( $cap, $role_capabilities ) ) ? '1' : '0',
        );
    }

    echo UM()->metabox()->render_metabox_section( $fields, array( 'name' => 'role[wp_capabilities]' ), 3, true ); ?>
</div>