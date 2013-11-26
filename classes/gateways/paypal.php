<?php

if(!class_exists('yEventGateway_PayPal')) {

	class yEventGateway_PayPal extends yEventGateway {

		public function __construct() {

			// defines the tab of the gateway options
			$tab = array(
				'slug' => 'paypal',
				'name' => __('PayPal', 'yevent'),
			);

			// defines the settings section of the gateway option
			$section = array(
				'tab' => $tab['slug'],
				'slug' => 'paypal',
				'name' => __('PayPal', 'yevent'),
				'text' => __('Settings for PayPal Payment Gateway', 'yevent'),
			);

			// define the fields of the gateway options
			// see http://admin-page-framework.michaeluno.jp/en/v2/classes/AdminPageFramework.html for reference
			$fields = array(	
				array(	
					'strFieldID' => 'paypal_email',
					'strSectionID' => $tab['slug'],
					'strTitle' => __( 'PayPal Email', 'yevent' ),
					'strDescription' => __( 'The reciepent of the payments.', 'yevent' ),
					'strType' => 'text',
					'vSize' => 40,
				),
			);
			parent::addTab($tab);
			parent::addSection($section);
			parent::addFields($fields);

		}

	}

	new yEventGateway_PayPal;

}