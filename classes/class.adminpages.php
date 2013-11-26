<?php

if ( ! class_exists( 'AdminPageFramework' ) )
    include_once( PLUGIN_PATH . '/classes/third-party/class.admin-page-framework.php' );
    
class yEventAdmin extends AdminPageFramework {

    public function setUp() {

		$this->setRootMenuPage( 
			'yEvent', 
			PLUGIN_URL . '/assets/images/ticket-small.png', 
			51
		);
		$this->addSubMenuItems(
			array(
				'strPageTitle' => __('Settings', 'yevent'),
				'strPageSlug' => 'yevent_settings',
				'strScreenIcon' => 'options-general',
				'strCapability' => 'yevent_manage',
				'numOrder' => 1,
			)
		);
				
		$this->addInPageTabs(

			array(
				'strPageSlug'	=> 'yevent_settings',
				'strTabSlug'	=> 'general',
				'strTitle'		=> __('General', 'yevent'),
				'numOrder'		=> 1,				
			),		
			array(
				'strPageSlug'	=> 'yevent_settings',
				'strTabSlug'	=> 'tickets',
				'strTitle'		=> __('Tickets', 'yevent'),
			),					
			array(
				'strPageSlug'	=> 'yevent_settings',
				'strTabSlug'	=> 'events',
				'strTitle'		=> __( 'Events', 'yevent' ),
			),
			array(
				'strPageSlug'	=> 'yevent_settings',
				'strTabSlug'	=> 'help',
				'strTitle'		=> __('Help', 'yevent'),
			),				
			array()
		);			
		
		$this->showPageHeadingTabs( false );
		$this->setInPageTabTag( 'h2' );		
		
		$this->addSettingSections(
			array(
				'strSectionID'		=> 'general',
				'strPageSlug'		=> 'yevent_settings',
				'strTabSlug'		=> 'general',
				'strTitle'			=> __('General Settings', 'yevent'),
				'strDescription'	=> __('The general settings for the plugin.', 'yevent'),
				'numOrder'			=> 10,
			),				
			array()			
		);

		$this->addSettingSections(
			array(
				'strSectionID'		=> 'tickets',
				'strPageSlug'		=> 'yevent_settings',
				'strTabSlug'		=> 'tickets',
				'strTitle'			=> __('Ticket Options', 'yevent'),
				'strDescription'	=> __('The options for tickets.', 'yevent'),
				'numOrder'			=> 10,
			),				
			array()			
		);
		
		$this->addSettingFields(
			array(	
				'strFieldID' => 'main_title',
				'strSectionID' => 'general',
				'strTitle' => __( 'Text', 'admin-page-framework-demo' ),
				'strDescription' => __( 'Type something here.', 'admin-page-framework-demo' ),	
				'strType' => 'text',
				'numOrder' => 1,
				'vDefault' => 123456,
				'vSize' => 40,
			),
			array(	
				'strFieldID' => 'ticket_slug',
				'strSectionID' => 'tickets',
				'strTitle' => __( 'Slug', 'yevent' ),
				'strDescription' => __( 'The slug for the ticket.', 'yevent' ),
				'strType' => 'text',
				'numOrder' => 1,
				'vDefault' => _x('ticket', 'Ticket Slug', 'yevent'),
				'vSize' => 20,
			),
			array( 
				'strFieldID' => 'ticket_scan',
				'strSectionID' => 'tickets',
				'strTitle' => __( 'Scan Type', 'yevent' ),
				'strDescription' => __( 'The type of scanning you want for your tickets.', 'yevent' ),
				'strType' => 'select',
				'vDefault' => 2,
				'vLabel' => array( 
					'barcode' => __('Barcode', 'yevent'),
					'qr' => __('QR Code', 'yevent'),
					'ticket' => __('Ticket Number', 'yevent'),
				)
			),
			array(	// Drop-down Lists with Mixed Types
				'strFieldID' => 'ticket_format',
				'strSectionID' => 'tickets',
				'strTitle' => __( 'Ticket Number Format', 'yevent' ),
				'strDescription' => __( 'This is multiple sets of drop down list.', 'admin-page-framework-demo' ) . ' <strong>Current:</strong> <span id="current-format">TT-EE-CC</span>',
				'strType' => 'select',
				'vLabel' => array( 
					array( 
						'ticket_id' => __('Ticket ID', 'yevent'),
						'event_id' => __('Event ID', 'yevent'),
						'order_date' => __('Order Date (YYYYMMDD)', 'yevent'),
						'currency_code' => __('Currency Code', 'yevent'),
						'none' => __('None', 'yevent'),
					),
					array( 
						'ticket_id' => __('Ticket ID', 'yevent'),
						'event_id' => __('Event ID', 'yevent'),
						'order_date' => __('Order Date (YYYYMMDD)', 'yevent'),
						'currency_code' => __('Currency Code', 'yevent'),
						'none' => __('None', 'yevent'),
					),
					array( 
						'ticket_id' => __('Ticket ID', 'yevent'),
						'event_id' => __('Event ID', 'yevent'),
						'order_date' => __('Order Date (YYYYMMDD)', 'yevent'),
						'currency_code' => __('Currency Code', 'yevent'),
						'none' => __('None', 'yevent'),
					),
				),
				'vSize' => array(
					1,
					1,
					1,
				),
				'vDefault' => array(
					'ticket_id',
					'event_id',
					'currency_code'
				),
				'vMultiple' => array(
					false,
					false,
					false,
				),
			),
			array(	// Single Drop-down List with Multiple Options
				'strFieldID' => 'ticket_fields',
				'strSectionID' => 'tickets',
				'strTitle' => __( 'Ticket Fields', 'yevent' ),
				'strDescription' => __( 'The fields you want to include in each ticket.', 'yevent' ),
				'strType' => 'select',
				'vMultiple' => true,
				'vDefault' => 2,
				'vSize' => 10,
				'vWidth' => '200px',
				'vLabel' => array( 
					'ticket_name' => __('Name', 'yevent'), 
					'ticket_price' => __('Price', 'yevent'), 
					'ticket_email' => __('Email', 'yevent'), 
					'ticket_number' => __('Ticket Number', 'yevent'), 
					'event_name' => __('Event Name', 'yevent'), 
					'event_venue' => __('Event Venue', 'yevent'), 
					'event_date' => __('Event Date', 'yevent'), 
					'event_time' => __('Event Time', 'yevent'), 
				)
			),
			array()
		);

		$this->setFooterInfoRight('Powered by <a href="http://yevent.im">yEvent</a> and <a href="http://wordpress.org" target="_blank" title="WordPress '.$GLOBALS['wp_version'].'">WordPress</a>', false);
		
		
    }
		
	public function do_yevent_settings() {
		submit_button();
	}
	
	/*
	 * Validation Callbacks
	 * */
	public function validation_yevent_settings( $arrInput, $arrOldPageOptions ) {	
				
		$fVerified = true;
		
		$arrErrors = array();
		
		if ( empty( $arrInput['yevent_settings']['tickets']['ticket_slug'] )  ) {
			
			$arrErrors['tickets']['ticket_slug'] = __('Ticket slug can not be empty.', 'yevent');	
			$fVerified = false;
			
		}
		
		if ( ! $fVerified ) {
		
			$this->setFieldErrors( $arrErrors );		
			$this->setSettingNotice( __('There was an error validation your inputs.', 'yevent') );
			return $arrOldPageOptions;
			
		}
				
		return $arrInput;
		
	}
	
}
if ( is_admin() )
	new yEventAdmin;
