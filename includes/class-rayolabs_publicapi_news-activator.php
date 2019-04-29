<?php

/**
 * Fired during plugin activation
 *
 * @link       https://facebook.com/tsal3
 * @since      1.0.0
 *
 * @package    Rayolabs_publicapi_news
 * @subpackage Rayolabs_publicapi_news/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rayolabs_publicapi_news
 * @subpackage Rayolabs_publicapi_news/includes
 * @author     Salako Teslim <tescointsite@gmail.com>
 */
class Rayolabs_publicapi_news_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$options = get_option("rayolabs_publicapi_news");
		$token = $options['site_token'];
		if(!empty($token)){
			$url = site_url();
			$url.="/index.php?my-plugin=rayolabs_publicapi_news";	
		
			//Set Hook Url to empty 
			$whd = array(
		  'site_token'=> $options['site_token'],
		  'hook_url'=>$url
		  );
		$data1 = http_build_query($whd);
				$ch = curl_init();
		$url = "https://publicapi.org.ng/api/$token/news";
			 //Update The Publicapi Database Via API and setting hook url to empty
		curl_setopt($ch, CURLOPT_URL, "$url/update_hook");
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		$answer = curl_exec($ch);
		//die($answer);
		}
		}
	

}
