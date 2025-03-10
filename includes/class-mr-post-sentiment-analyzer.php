<?php

/**
 *
 * @link       https://https://profiles.wordpress.org/webmvw/
 * @since      1.0.0
 *
 * @package    Mr_Post_Sentiment_Analyzer
 * @subpackage Mr_Post_Sentiment_Analyzer/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Mr_Post_Sentiment_Analyzer
 * @subpackage Mr_Post_Sentiment_Analyzer/includes
 * @author     webmvw <masudrana.bbpi@gmail.com>
 */


class PostSentimentAnalyzer{


	public function __construct() {
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}


	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mr-post-sentiment-analyzer-admin.php';

		$plugin_admin = new MR_Post_Sentiment_Analyzer_Admin();

		add_action( 'admin_enqueue_scripts', [ $plugin_admin, 'enqueue_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $plugin_admin, 'enqueue_scripts' ] );

	}



	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mr-post-sentiment-analyzer-public.php';

		$plugin_public = new MR_Post_Sentiment_Analyzer_Public();

		add_action( 'wp_enqueue_scripts', [ $plugin_public, 'enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $plugin_public, 'enqueue_scripts' ] );

	}

}