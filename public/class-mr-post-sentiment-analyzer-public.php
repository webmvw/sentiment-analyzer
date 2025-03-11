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



	/**
	 * Shortcode for Filtering Posts
	 */
	public function mr_sentiment_filter_shortcode_callback($atts){

		$atts = shortcode_atts( ['sentiment' => 'neutral'], $atts, 'sentiment_filter' ); //sentiment="positive|negative|neutral"

		$sentiment = sanitize_text_field($atts['sentiment']);


		// Generate a unique transient key based on the sentiment and query parameters
    	$transient_key = 'sentiment_filter_' . md5( $sentiment );

    	// Attempt to retrieve cached posts from the transient
    	$cached_posts = get_transient( $transient_key );

    	 if ( false === $cached_posts ) {
	        // If no cached posts, query the posts
	        $args = [
				'post_type' => 'post',
				'posts_per_page' => 10,
				'meta_query' => []
			];

		    if ($sentiment !== 'neutral') {
		        $args['meta_query'] = [
		            [
		                'key' => '_sentiment_analysis',
		                'value' => $sentiment,
		                'compare' => '='
		            ]
		        ];
		    }

		    $query = new WP_Query($args);

	        if ($query->have_posts()) {
		        ob_start();
		        ?>
		        <div class="mr-sentiment-container">
		        <?php
		        while ($query->have_posts()) {
		            $query->the_post();
		        ?>
		        	<article id="post-<?php the_ID(); ?>" class="mr-sentiment-post-article">
		
						<?php
						// Post Thumbnail
						printf(
							'<figure class="mr-sentiment-post-thumbnail"><img src="%1$s" alt="%2$s"></figure>',
							esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ),
							esc_attr( get_post_field('post_name') )
						);
						?>

						<div class="mr-sentiment-post-content">
							<?php
							// Post Title
							printf(
								'<h4 class="mr-sentiment-post-title"><a href="%1$s">%2$s</a></h4>',
								esc_url( get_the_permalink() ),
								esc_html__( get_the_title(), 'mr-post-sentiment-analyzer' )
							);

							// Post Excerpt
							printf(
								'<div class="mr-sentiment-post-excerpt">%1$s</div>',
								wp_kses_post( get_the_excerpt() )
							);

							// Read more link
							printf(
								'<a href="%1$s" class="mr-sentiment-post-readmore">%2$s</a>',
								esc_url(get_the_permalink()),
								esc_html__( "Read More", 'mr-post-sentiment-analyzer' )
							);
							?>
						</div>

					</article>

		        <?php
			    }
		        wp_reset_postdata();

           		// Store the query results in a transient, caching for 12 hours
            	$cached_posts = ob_get_clean();
          		set_transient( $transient_key, $cached_posts, 12 * 3600 );

		        ?>
		    	</div>
		        <?php

		    }else {
	            $cached_posts = 'No posts found with the selected sentiment.';
	        }
	    }

	    // Return the cached or freshly generated content
	    return $cached_posts;
	    
	}




}
