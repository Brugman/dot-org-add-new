<?php

/**
 * Plugin Name: Dot Org Add New
 * Description: Replace the Add New Plugins page.
 * Version: 0.1.0
 * Plugin URI: https://github.com/Brugman/dot-org-add-new
 * Author: Tim Brugman
 * Author URI: https://timbr.dev
 * Text Domain: dotorgaddnew
 */

if ( !defined( 'ABSPATH' ) )
    exit;

if ( !class_exists( 'DotOrgAddNew' ) )
{
    class DotOrgAddNew
    {
        /**
         * Constructor.
         */

        public function __construct()
        {
        }

        /**
         * Debug.
         */

        private function d( $var = false )
        {
            echo "<pre style=\"max-height: 800px; z-index: 9999; position: relative; overflow-y: scroll; white-space: pre-wrap; word-wrap: break-word; padding: 10px 15px; border: 1px solid #fff; background-color: #161616; text-align: left; line-height: 1.5; font-family: Courier; font-size: 16px; color: #fff; \">";
            print_r( $var );
            echo "</pre>";
        }

        private function dd( $var = false )
        {
            $this->d( $var );
            exit;
        }

        /**
         * Helpers.
         */

        private function textdomain()
        {
            return 'dotorgaddnew';
        }

        /**
         * Page Helpers.
         */

        private function page_header()
        {
?>
<div class="wrap dotorgaddnew-wrapper">
<?php
        }

        private function page_footer()
        {
?>
</div><!-- wrap -->
<?php
        }

        /**
         * Pages.
         */

        public function page_add_new()
        {
            $this->page_header();
?>
<h1><?php _e( 'Add Plugins', $this->textdomain() ); ?></h1>

<?php
            $this->page_footer();
        }

        /**
         * Hooks.
         */

        public function hook_remove_plugins_add_new()
        {
            remove_submenu_page( 'plugins.php', 'plugin-install.php' );
        }

        public function hook_register_plugins_add_new()
        {
            add_plugins_page(
                __( 'Add Plugins', $this->textdomain() ), // page title
                __( 'Add New', $this->textdomain() ), // menu title
                'manage_options', // capability
                'dotorgaddnew', // menu slug
                [ $this, 'page_add_new' ], // function
                null // position
            );
        }

        /**
         * Register Hooks.
         */

        public function register_hooks()
        {
            // remove plugins add new
            add_action( 'admin_menu', [ $this, 'hook_remove_plugins_add_new' ] );
            // register plugins add new
            add_action( 'admin_menu', [ $this, 'hook_register_plugins_add_new' ] );
        }
    }

    /**
     * Instantiate.
     */

    $dotorgaddnew = new DotOrgAddNew();
    $dotorgaddnew->register_hooks();
}

