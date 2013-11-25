<?php

if(!class_exists('yEvent')) {

	class yEvent {

		/**
		 * Variables
		 * @since 	0.1
		 */

		// Plugin Slug
		public $plugin_slug = 'smart-booking';

		// Class Instance
		public static $instance = null;

		/** 
		 * Plugin Construct
		 * @since 	0.1
		 */
		public function __construct() {

			

		}

		/**
		 * Return an instance of this class.
		 * @since     0.1
		 */

		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Activation Procedure
		 * @since     0.1
		 */

		public function plugin_install() {
			
			// get the administrator role
			$role = get_role( 'administrator' );

			// add the yEvent capabilites to the administrator
			$role->add_cap('yevent_manage');

			// create a new role based on the editor role
			$role = get_role( 'editor' );

			// get the editor roles capabilities
			$capabilities = $role->capabilities;

			// create the role
			$addrole = add_role( 'yevent_manager', __('yEvent Manager', 'yevent'), $capabilities );

			// if successful add the yEvent capability
			if($addrole)
				$addrole->add_cap('yevent_manage');

			// create a default yEvent user role
			$addrole = add_role( 'yevent_user', __('yEvent User', 'yevent'), array('read' => true) );

			// add the view ticket capability
			if($addrole)
				$addrole->add_cap('yevent_view_own_ticket');

		}

		/**
		 * Deactivation Procedure
		 * @since     0.1
		 */

		public function plugin_uninstall() {

			// delete the custom roles on deactivation
			remove_role( 'yevent_manager' );
			remove_role( 'yevent_user' );

		}

	}

}

?>