<?php

/**
 * The admin-specific functionality of the plugin.
 *
 */


class MR_Post_Sentiment_Analyzer_Admin {

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style('mr-post-sentiment-analyzer', plugin_dir_url( __FILE__ ) . 'css/mr-post-sentiment-analyzer-admin.css', array(), '1.0.0', 'all' );

	}


	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'mr-post-sentiment-analyzer', plugin_dir_url( __FILE__ ) . 'js/mr-post-sentiment-analyzer-admin.js', array('jquery'), '1.0.0', false);

	}

}