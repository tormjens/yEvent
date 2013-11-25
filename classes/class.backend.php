<?php

if(!class_exists('yEventBackend')) {

	class yEventBackend extends yEvent {

		/**
		 * Construct the backend
		 * @since 	0.1
		 */

		public function __construct() {

			add_action(	'init', array($this, 'post_types') );
			add_filter( 'post_updated_messages', array($this, 'post_types_messages') );
			add_action( 'admin_menu', array($this, 'admin_menu_separator') );
			add_action( 'admin_menu', array($this, 'admin_menu') );

		}

		/**
		 * Admin Menu
		 * @since 	0.1
		 */

		public function admin_menu() {

			add_menu_page( __('yEvent Overview', 'yevent'), 'yEvent', 'yevent_manage', 'yevent/main.php', array($this, 'admin_page_main'), PLUGIN_URL . '/assets/images/ticket-small.png', 51 );

		}

		public function admin_menu_separator() {
			$this->add_admin_menu_separator(50);
		}

		public function add_admin_menu_separator($position) {
			global $menu;
			$index = 0;
			foreach($menu as $offset => $section) {
				if (substr($section[2],0,9)=='separator')
					$index++;
				if ($offset>=$position) {
					$menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
					break;
				}
			}
			ksort( $menu );
		}

		/**
		 * Post Types
		 * @since 	0.1
		 */

		public function post_types() {

			/*
			 * Custom Post Type: Event
			 */

			$labels = array(
				'name'                => __('Events', 'yevent'),
				'singular_name'       => __('Event', 'yevent'),
				'menu_name'           => __('Events', 'yevent'),
				'parent_item_colon'   => __('Parent Event:', 'yevent'),
				'all_items'           => __('All Events', 'yevent'),
				'view_item'           => __('View Event', 'yevent'),
				'add_new_item'        => __('Add New Event', 'yevent'),
				'add_new'             => __('Add New', 'yevent'),
				'edit_item'           => __('Edit Event', 'yevent'),
				'update_item'         => __('Update Event', 'yevent'),
				'search_items'        => __('Search Events', 'yevent'),
				'not_found'           => __('No Events Found', 'yevent'),
				'not_found_in_trash'  => __('No Events Found in Trash', 'yevent'),
			);
			
			$args = array(
				'description'         => 'The post type for yEvent Events.',
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'thumbnail' ),
				'taxonomies'          => array(),
				'hierarchical'        => true,
				'public'              => true,
				'menu_position'		  => 52,
				'has_archive'         => _x('events', 'Event Archive Slug', 'yevent'),
				'rewrite' 			  => array( 'slug' => _x('event', 'Event Single Slug', 'yevent'), 'with_front' => false ),
				'capability_type'     => 'post',
			);
			
			register_post_type( 'yevent_events', $args );
			
			/*
			 * Custom Post Type: Ticket
			 */

			$labels = array(
				'name'                => __('Tickets', 'yevent'),
				'singular_name'       => __('Ticket', 'yevent'),
				'menu_name'           => __('Tickets', 'yevent'),
				'parent_item_colon'   => __('Parent Ticket:', 'yevent'),
				'all_items'           => __('All Tickets', 'yevent'),
				'view_item'           => __('View Ticket', 'yevent'),
				'add_new_item'        => __('Add New Ticket', 'yevent'),
				'add_new'             => __('Add New', 'yevent'),
				'edit_item'           => __('Edit Ticket', 'yevent'),
				'update_item'         => __('Update Ticket', 'yevent'),
				'search_items'        => __('Search Tickets', 'yevent'),
				'not_found'           => __('No Tickets Found', 'yevent'),
				'not_found_in_trash'  => __('No Tickets Found in Trash', 'yevent'),
			);
			
			$args = array(
				'description'         => 'The post type for yEvent Tickets.',
				'labels'              => $labels,
				'supports'            => array( 'title' ),
				'taxonomies'          => array(),
				'hierarchical'        => true,
				'public'              => true,
				'menu_position'		  => 53,
				'has_archive'         => false, // no archive for this baby
				'rewrite' 			  => array( 'slug' => _x('ticket', 'Ticket Slug', 'yevent'), 'with_front' => false ),
				'capability_type'     => 'post',
			);
			
			register_post_type( 'yevent_tickets', $args );
			

		}
		
		/**
		 * Post Type Admin Messages
		 * @since 	0.1
		 */

		function post_types_messages( $messages ) {

			$messages['yevent_events'] = array(
				1 => sprintf( __( 'Event updated. <a href="%s">View Event</a>', 'yevent' ), esc_url( get_permalink( $post_ID ) ) ),
				2 => $messages['post'][2],
				3 => $messages['post'][3],
				4 => __( 'Event updated.', 'yevent' ),
				5 => isset( $_GET['revision'] ) ? sprintf( __( 'Event restored to revision from %s', 'yevent' ), wp_post_revision_title( (int) $_GET['revision'], false) ) : false,
				6 => sprintf( __( 'Event published. <a href="%s">View Event</a>', 'yevent' ), esc_url( get_permalink( $post_ID ) ) ),
				7 => __( 'Event saved.', 'yevent' ),
				8 => sprintf( __( 'Event submitted. <a target="_blank" href="%s">Preview Event</a>', 'yevent' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID) ) ) ),
				9 => sprintf( __( 'Event scheduled for: <strong>%1</strong>. <a target="_blank" href="%2">Preview Event</a>', 'yevent' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
				10 => sprintf( __( 'Event draft updated. <a target="_blank" href="%s">Preview Event</a>', 'yevent' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) )
			);

			$messages['yevent_tickets'] = array(
				1 => sprintf( __( 'Ticket Information Changed. <a href="%s">View Ticket</a>', 'yevent' ), esc_url( get_permalink( $post_ID ) ) ),
				2 => $messages['post'][2],
				3 => $messages['post'][3],
				4 => __( 'Ticket Information Updated.', 'yevent' ),
				5 => isset( $_GET['revision'] ) ? sprintf( __( 'Ticket restored to revision from %s', 'yevent' ), wp_post_revision_title( (int) $_GET['revision'], false) ) : false,
				6 => sprintf( __( 'Ticket activated. <a href="%s">View Ticket</a>', 'yevent' ), esc_url( get_permalink( $post_ID ) ) ),
				7 => __( 'Ticket saved.', 'yevent' ),
				8 => sprintf( __( 'Ticket submitted. <a target="_blank" href="%s">Preview Ticket</a>', 'yevent' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID) ) ) ),
				9 => sprintf( __( 'Ticket scheduled for: <strong>%1</strong>. <a target="_blank" href="%2">Preview Ticket</a>', 'yevent' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ),
				10 => sprintf( __( 'Dummy Ticket updated. <a target="_blank" href="%s">Preview Ticket</a>', 'yevent' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) )
			);

			return $messages;
		}

	}

	$yEventBackend = new yEventBackend();

}

?>