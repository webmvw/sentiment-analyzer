<?php

/**
 * The public-facing functionality of the plugin.
 *
 */

class MR_Post_Sentiment_Analyzer_Public {


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'mr-post-sentiment-analyzer', plugin_dir_url( __FILE__ ) . 'css/mr-post-sentiment-analyzer-public.css', array(), '1.0.0', 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'mr-post-sentiment-analyzer', plugin_dir_url( __FILE__ ) . 'js/mr-post-sentiment-analyzer-public.js', array( 'jquery' ), '1.0.0', true );

	}





	/**
	 * Display Sentiment Badge on Front-End
	 */
	public function mr_sentiment_display_badge($content){
		if (is_single()) {
	        $sentiment = get_post_meta(get_the_ID(), '_sentiment_analysis', true);
	        if ($sentiment) {
	            $badge = '<span class="sentiment-badge ' . $sentiment . '">' . ucfirst($sentiment) . '</span>';
	            $content = $badge . $content;
	        }
	    }
	    return $content;
	}



}
