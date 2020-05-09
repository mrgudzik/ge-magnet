<?php 
/**
 * @package  ge-magnet
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class TemplateController extends BaseController {
	public $templates = array();

	public function register(){
		if ( ! $this->activated( 'templates_manager' ) ) return;

		$this->templates = array(
			'page-templates/two-columns-tpl.php' => 'Two Columns Layout'
		);

		add_filter( 'theme_page_templates', array( $this, 'custom_template') );

	}	
	
}