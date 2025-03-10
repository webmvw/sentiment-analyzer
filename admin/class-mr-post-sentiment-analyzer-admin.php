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


	/**
	 * Register admin menu page.
	 *
	 * @since    1.0.0
	 */
	public function post_sentiment_analyzer_admin_menu_callback(){
		add_menu_page( "Post Sentiment Analyzer", "Post Sentiment Analyzer", "manage_options", "mr-post-sentiment-analyzer", [$this, 'post_sentiment_analyzer_admin_page']);
	}



	public function post_sentiment_analyzer_admin_page(){
		ob_start();
		require_once( plugin_dir_path( __FILE__ ) . 'partials/post-sentiment-analyzer-admin-display.php');
		$template = ob_get_contents();
		ob_clean();
		echo $template;
	}



	public function post_sentiment_analyzer_settings(){
		/**
		 * ================================================================================
		 *	Settings API Section
		 * ================================================================================ 
		 */

		// Section for primary settings
		add_settings_section( 
			'mr_primary_settings_id', // id
			'MR Post Sentiment Analyzer Settings page', // title
			array($this, 'mr_post_sentiment_analyzer_settings_primary_section_callback'), // callback
			'mr_primary_settings_page' // page 
		);


		/**
		 * ================================================================================
		 *	Settings API add settings field
		 * ================================================================================ 
		 */
		// settings field for primary settings
		add_settings_field( 
			"positive_post_sentiment", // id 
			"Positive Post Sentiment", //title
			array($this, 'mr_positive_post_sentiment_field_callback'), // callback
			'mr_primary_settings_page', // page
			'mr_primary_settings_id', // section
		);
		add_settings_field( 
			"negative_post_sentiment", // ID
			"Negative Post Sentiment", // Title
			array($this, 'mr_negative_post_sentiment_field_callback'), // callback
			'mr_primary_settings_page', //page
			'mr_primary_settings_id' // section
		);
		add_settings_field(
			"neutral_post_sentiment", // IDneutral 
			"Neutral Post Sentiment", // title
			array($this, 'mr_neutral_post_sentiment_field_callback'), // callback
			"mr_primary_settings_page", // page
			"mr_primary_settings_id"  // section
		);


		/**
		 * ================================================================================
		 *	Settings API register settings
		 * ================================================================================ 
		 */
		// register settings for primary settings
		register_setting(
			"primary_settings_group", // option group
			"positive_post_sentiment", // option name
			array('sanitize_callback'=>'esc_attr') // args 
		);
		register_setting(
			"primary_settings_group", // option group
			"negative_post_sentiment", // option name
			array('sanitize_callback'=>'esc_attr') // args 
		);
		register_setting(
			"primary_settings_group", // option group
			"neutral_post_sentiment", // option name
			array('sanitize_callback' => 'esc_attr')
		);
	}




	public function mr_post_sentiment_analyzer_settings_primary_section_callback(){
		_e("Here you can set all the options by using the Settings API", 'mr-post-sentiment-analyzer');
	}


	public function mr_positive_post_sentiment_field_callback(){
		$setting = get_option('positive_post_sentiment');
		?>
		<input type="text" name="positive_post_sentiment" value="<?php echo isset($setting)? esc_attr($setting):''; ?>">
		<label><?php _e('Please input positive post sentiment', 'mr-post-sentiment-analyzer'); ?></label>
		<?php
	}

	public function mr_negative_post_sentiment_field_callback(){
		$setting = get_option('negative_post_sentiment');
		?>
		<input type="text" name="negative_post_sentiment" value="<?php echo isset($setting)? esc_attr($setting):''; ?>">
		<label><?php _e('Please input negative post sentiment', 'mr-post-sentiment-analyzer'); ?></label>
		<?php
	}

	public function mr_neutral_post_sentiment_field_callback(){
		$setting = get_option('neutral_post_sentiment');
		?>
		<input type="text" name="neutral_post_sentiment" value="<?php echo isset($setting)? esc_attr($setting):''; ?>">
		<label><?php _e('Please input neutral post sentiment', 'mr-post-sentiment-analyzer'); ?></label>
		<?php
	}


}