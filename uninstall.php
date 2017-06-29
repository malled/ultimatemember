<?php
/**
 * Uninstall UM
 *
 */

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;

if ( ! defined( 'um_path' ) )
    define( 'um_path', plugin_dir_path( __FILE__ ) );

if ( ! defined( 'um_url' ) )
    define( 'um_url', plugin_dir_url( __FILE__ ) );

if ( ! defined( 'um_plugin' ) )
    define( 'um_plugin', plugin_basename( __FILE__ ) );

//for delete Email options only for Core email notifications
remove_all_filters( 'um_email_notifications' );
//for delete only Core Theme Link pages
remove_all_filters( 'um_core_pages' );

require_once plugin_dir_path( __FILE__ ) . 'um-functions.php';
require_once plugin_dir_path( __FILE__ ) . 'um-init.php';

$delete_options = UM()->um_get_option( 'uninstall_on_delete' );
if ( ! empty( $delete_options ) ) {

    //remove core pages
    foreach ( UM()->config()->core_pages as $page_key => $page_value ) {
        $page_id = UM()->um_get_option( apply_filters( 'um_core_page_id_filter', 'core_' . $page_key ) );
        if ( ! empty( $page_id ) )
            wp_delete_post( $page_id, true );
    }

    //remove core settings
    $settings_defaults = UM()->config()->settings_defaults;
    foreach ( $settings_defaults as $k => $v ) {
        UM()->um_remove_option( $k );
    }

    //delete UM Custom Post Types posts
    $um_posts = get_posts( array(
        'post_type'     => array(
            'um_form',
            'um_directory',
            'um_role'
        ),
        'numberposts'   => -1
    ) );

    foreach ( $um_posts as $um_post )
        wp_delete_post( $um_post->ID, 1 );

    delete_option( 'um_version' );
    delete_option( 'um_is_installed' );
    delete_option( 'um_core_forms' );
    delete_option( 'um_core_directories' );
    delete_option( 'um_last_version_upgrade' );
    delete_option( 'um_first_setup_roles' );
    delete_option( 'um_hashed_passwords_fix' );
    delete_option( 'um_cached_users_queue' );
    delete_option( 'um_options-transients' );
    delete_option( 'um_cached_role_admin' );
    delete_option( 'um_cached_role_member' );
    delete_option( 'um_cache_fonticons' );

    foreach ( wp_load_alloptions() as $k => $v ) {
        if ( substr( $k, 0, 18 ) == 'um_cache_userdata_' )
            delete_option( $k );
    }
}