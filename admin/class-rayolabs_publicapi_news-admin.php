<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://facebook.com/tsal3
 * @since      1.0.0
 *
 * @package    Rayolabs_publicapi_news
 * @subpackage Rayolabs_publicapi_news/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rayolabs_publicapi_news
 * @subpackage Rayolabs_publicapi_news/admin
 * @author     Salako Teslim <tescointsite@gmail.com>
 */
class Rayolabs_publicapi_news_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $api_url;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version,$api_url ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->rayolabs_publicapi_news = get_option($this->plugin_name);
		$this->api_url = $api_url;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rayolabs_paper_admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rayolabs_paper_admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rayolabs_publicapi_news.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rayolabs_paper_admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rayolabs_paper_admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rayolabs_publicapi_news.js', array( 'jquery' ), $this->version, false );

	}

	/**
*
* admin/class-wp-cbf-admin.php - Don't add this
*
**/

/**
 * Register the administration menu for this plugin into the WordPress Dashboard menu.
 *
 * @since    1.0.0
 */

public function add_plugin_admin_menu() {

    /*
     * Add a settings page for this plugin to the Settings menu.
     *
     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
     *
     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
     *
     */
    add_options_page( 'Rayolabs Public Api News Content King Base Options Functions Setup', 'RayoLabs PublicApi Content King', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
    );
}

 /**
 * Add settings action link to the plugins page.
 *
 * @since    1.0.0
 */

public function add_action_links( $links ) {
    /*
    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
    */
   $settings_link = array(
    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
   );
   return array_merge(  $settings_link, $links );

}

/**
 * Render the settings page for this plugin.
 *
 * @since    1.0.0
 */

public function display_plugin_setup_page() {
    include_once( 'partials/rayolabs_publicapi_news-admin-display.php' );
}

public function options_update() {
    register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
 }

public function validate($input) {
    // All checkboxes inputs        
    $valid = array();
    //Verify Textbox is not empty
    $valid['site_token'] = sanitize_text_field($input['site_token']);
    if(isset($input['post_type'])){
    $valid['post_type'] = sanitize_text_field($input['post_type']);
    }
     if(isset($input['categories'])){
    $valid['categories'] = sanitize_text_field($input['categories']);
	}
	
    if(empty($valid['site_token'])){
    	$type = 'error';
    	$message = __( 'Token cannot be empty', 'my-text-domain' );
	}
	if($type != 'error'){
    $verify = $this->verify($valid['site_token']);
    if($verify !== true){
    	$type = 'error';
    	$message = __( 'We were unable to verify your token, kindly check and try again Response Returned: '.$verify, 'my-text-domain' );
	}
	}
    // //Cleanup
    // $valid['cleanup'] = (isset($input['cleanup']) && !empty($input['cleanup'])) ? 1 : 0;
    // $valid['comments_css_cleanup'] = (isset($input['comments_css_cleanup']) && !empty($input['comments_css_cleanup'])) ? 1: 0;
    // $valid['gallery_css_cleanup'] = (isset($input['gallery_css_cleanup']) && !empty($input['gallery_css_cleanup'])) ? 1 : 0;
    // $valid['body_class_slug'] = (isset($input['body_class_slug']) && !empty($input['body_class_slug'])) ? 1 : 0;
    // $valid['jquery_cdn'] = (isset($input['jquery_cdn']) && !empty($input['jquery_cdn'])) ? 1 : 0;
    // $valid['cdn_provider'] = esc_url($input['cdn_provider']);
    if($type == 'error'){
    add_settings_error(
        'myUniqueIdentifyer',
        esc_attr( 'settings_updated' ),
        $message,
        $type
    );
    }else{
    	return $valid;

    }

    }

    public function verify($token){
    	$url = site_url();
    	$url.="/index.php?my-plugin={$this->plugin_name}";
       $whd = array(
	  'site_token'=> $token,
	  'hook_url'=>$url
	  );
	  $api = "$this->api_url/$token/news";
	$data1 = http_build_query($whd);
    		$ch = curl_init();
	 	//Updating Hook URL To The Plugin Hook URL
	curl_setopt($ch, CURLOPT_URL, "$api/update_hook");
	curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
	// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	// curl_setopt($ch, CURLOPT_COOKIEJAR, "cache/$exam_number"."session.txt");  //could be empty, but cause problems on some hosts
	// curl_setopt($ch, CURLOPT_COOKIEFILE, '/var/www/ip4.x/file/tmp');  //could be empty, but cause problems on some hosts
 	$answer = curl_exec($ch);
 	$answer = trim($answer);
 	if($answer == 'true'){
 		return true;
 	}else{
 		return $answer;
 	}
    }

    




}
