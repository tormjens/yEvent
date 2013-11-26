<?php

if(!class_exists('yEventGateway')) {

	class yEventGateway extends yEventAdmin {

		public static $GatewayTabs = array();
		public static $GatewaySections = array();
		public static $GatewayFields = array();

		/**
		 * Construct the gateway
		 * @since 	0.1
		 */

		public function __construct() {

			add_action('init', array($this, 'gateways'));

		}

		public function gateways() {

			// include the bundled gateways
			include_once( PLUGIN_PATH . '/classes/gateways/paypal.php' ); // PayPal

			// add more gateways in to the class
			do_action('yevent_add_gateways');

		}

		public function addTab($tab) {
			$newtab = array();
			$newtab[] = $tab;
			self::$GatewayTabs = array_merge_recursive(self::$GatewayTabs, $newtab);
		}

		public function addSection($section) {
			$newsection = array();
			$newsection[] = $section;
			self::$GatewaySections = array_merge_recursive(self::$GatewaySections, $newsection);
		}

		public function addFields($field) {
			$newfield = array();
			$newfield[] = $field;
			self::$GatewayFields = array_merge_recursive(self::$GatewayFields, $newfield);
		}

		public function initGateways() {

			/*
			 * Tabs
			 */

			$tabs = self::$GatewayTabs;

			if($tabs) {
				foreach($tabs as $tab) {
					$strTabSlug = $this->oUtil->sanitizeSlug( $tab['slug'] );
					$strPageSlug = $this->oUtil->sanitizeSlug( 'yevent_payment' );
					$strTitle = trim( $tab['name'] );

					$this->addInPageTabs(
						array(
							'strPageSlug'	=> $strPageSlug,
							'strTabSlug'	=> $strTabSlug,
							'strTitle'		=> $strTitle,			
						)
					);
				}
			}// end add tabs

			/*
			 * Sections
			 */

			$sections = self::$GatewaySections;
			;
			if($sections) {
				foreach($sections as $section) {
					$strTabSlug = $this->oUtil->sanitizeSlug( $section['tab'] );
					$strSectionSlug = $this->oUtil->sanitizeSlug( $section['slug'] );
					$strPageSlug = $this->oUtil->sanitizeSlug( 'yevent_payment' );
					$strTitle = trim( $section['name'] );
					$strText = trim( $section['text'] );

					$this->addSettingSections(
						array(
							'strSectionID'		=> $strSectionSlug,
							'strPageSlug'		=> $strPageSlug,
							'strTabSlug'		=> $strTabSlug,
							'strTitle'			=> $strTitle,
							'strDescription'	=> $strText,
						),
						array()				
					);
				}
			}// end add sections	

			/*
			 * Fields
			 */

			$fields = self::$GatewayFields;
			;
			if($fields) {
				foreach($fields as $_field) {
					foreach($_field as $field) 
						$this->addSettingFields($field);
				}
			}// end add sections			

			//var_dump($this->oProps->arrSections);
		}


	}

	new yEventGateway;

}

?>