<?php

/**
 * Plugin Name:       MR Post Sentiment Analyzer
 * Plugin URI:        https://https://wordpress.org/plugins/mr-post-sentiment-analyser
 * Description:       Analyze and display sentiment (positive, negative, neutral) on posts with keyword-based analysis, badges, and filtering options.
 * Version:           1.0.0
 * Author:            webmvw
 * Author URI:        https://https://profiles.wordpress.org/webmvw//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mr-post-sentiment-analyzer
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * The main plugin class
 */

final class MrPostSentimentAnalyzer{


	/**
	 * Class constructor
	 */
	private function __construct()
	{

		add_action('plugins_loaded', [$this, 'init_plugin']);
	}



	/**
	 * Initializes a singleton instance
	 * @return \PostSentimentAnalyzer
	 */
	public static function init(){
		static $instance =  false;

		if( ! $instance ){
			$instance =  new self();
		}

		return $instance;
	}


	/**
	 * Initialize the plugins
	 * @return void
	 */
	public function init_plugin(){
		require plugin_dir_path( __FILE__ ) . 'includes/class-mr-post-sentiment-analyzer.php';
		new PostSentimentAnalyzer();
	}


}



/**
 * Initializes the main plugin
 * @return \PostSentimentAnalyzer
 */
function post_sentiment_analyzer(){
	return MrPostSentimentAnalyzer::init();
}


// kick-off the plugin
post_sentiment_analyzer();
