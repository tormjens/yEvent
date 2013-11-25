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
		
		// Page style.
		$this->showPageHeadingTabs( false );		// disables the page heading tabs by passing false.
		$this->setInPageTabTag( 'h2' );		
		
		// Add setting sections
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
		
		// Add setting fields
		$this->addSettingFields(
			array(	// Single text field
				'strFieldID' => 'main_title',
				'strSectionID' => 'general',
				'strTitle' => __( 'Text', 'admin-page-framework-demo' ),
				'strDescription' => __( 'Type something here.', 'admin-page-framework-demo' ),	// additional notes besides the form field
				'strHelp' => __( 'This is a text field and typed text will be saved.', 'admin-page-framework-demo' ),
				'strType' => 'text',
				'numOrder' => 1,
				'vDefault' => 123456,
				'vSize' => 40,
			),			
			array()
		);
		
 		$this->addLinkToPluginDescription( 
			"<a href='http://www.google.com'>Google</a>",
			"<a href='http://www.yahoo.com'>Yahoo!</a>",
			"<a href='http://en.michaeluno.jp'>miunosoft</a>",
			"<a href='https://github.com/michaeluno/admin-page-framework' title='Contribute to the GitHub repository!' >Repository</a>"
		);
		$this->addLinkToPluginTitle(
			"<a href='http://www.wordpress.org'>WordPress</a>"
		);

		$this->setFooterInfoRight('Powered by <a href="http://yevent.im">yEvent</a> and <a href="http://wordpress.org" target="_blank" title="WordPress '.$GLOBALS['wp_version'].'">WordPress</a>', false);
		
		
    }
		
	/*
	 * First Page
	 * */
	public function do_first_page() {
		submit_button();
	}
	
	/*
	 * Validation Callbacks
	 * */
	public function validation_first_page_verification( $arrInput, $arrOldPageOptions ) {	// valication_ + page slug + _ + tab slug
				
		// Set a flag.
		$fVerified = true;
		
		// We store values that have an error in an array and pass it to the setFieldErrors() method.
		// It internally stores the error array in a temporary area of the database called transient.
		// The used name of the transient is a md5 hash of 'instantiated class name' + '_' + 'page slug'. 
		// The library class will search for this transient when it renders the form fields 
		// and if it is found, it will display the error message set in the field array. 
		$arrErrors = array();
		
		// Check if the submitted value meets your criteria. As an example, here a numeric value is expected.
		if ( isset( $arrInput['first_page']['verification']['verify_text_field'] ) && ! is_numeric( $arrInput['first_page']['verification']['verify_text_field'] ) ) {
			
			// Start with the section key in $arrErrors, not the key of page slug.
			$arrErrors['verification']['verify_text_field'] = 'The value must be numeric: ' . $arrInput['first_page']['verification']['verify_text_field'];	
			$fVerified = false;
			
		}
		
		// An invalid value is found.
		if ( ! $fVerified ) {
		
			// Set the error array for the input fields.
			$this->setFieldErrors( $arrErrors );		
			$this->setSettingNotice( 'There was an error in your input.' );
			return $arrOldPageOptions;
			
		}
				
		return $arrInput;
		
	}
	public function validation_first_page_files( $arrInput, $arrOldPageOptions ) {	// validation_ + page slug + _ + tab slug

		// Display the uploaded file information.
		$arrFileErrors = array();
		$arrFileErrors[] = $_FILES[ $this->oProps->strOptionKey ]['error']['first_page']['file_uploads']['file_single'];
		$arrFileErrors[] = $_FILES[ $this->oProps->strOptionKey ]['error']['first_page']['file_uploads']['file_multiple'][0];
		$arrFileErrors[] = $_FILES[ $this->oProps->strOptionKey ]['error']['first_page']['file_uploads']['file_multiple'][1];
		$arrFileErrors[] = $_FILES[ $this->oProps->strOptionKey ]['error']['first_page']['file_uploads']['file_multiple'][2];
		foreach( $_FILES[ $this->oProps->strOptionKey ]['error']['first_page']['file_uploads']['file_repeatable'] as $arrFile )
			$arrFileErrors[] = $arrFile;
			
		if ( in_array( 0, $arrFileErrors ) ) 
			$this->setSettingNotice( '<h3>File(s) Uploaded</h3>' . $this->oDebug->getArray( $_FILES ), 'updated' );
		
		return $arrInput;
		
	}
	
	public function validation_APF_Demo( $arrInput, $arrOldOptions ) {
		
		// If the delete options button is pressed, return an empty array that will delete the entire options stored in the database.
		if ( isset( $_POST[ $this->oProps->strOptionKey ]['second_page']['submit_buttons_confirm']['submit_delete_options_confirmation'] ) ) 
			return array();
			
		return $arrInput;
		
	}
	
}
if ( is_admin() )
	new yEventAdmin;
