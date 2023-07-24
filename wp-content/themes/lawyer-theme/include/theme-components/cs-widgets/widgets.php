<?php
/**
 * Widgets Classes & Functions
 */
/**
 * @Facebook widget Class
 *
 *
 */
if ( ! class_exists( 'facebook_module' ) ) { 
    class facebook_module extends WP_Widget {      
        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
         /**
         * @Facebook Module
         *
         *
         */
		public function __construct() {
		
			parent::__construct(
				'facebook_module', // Base ID
				__( 'CS : Facebook','lawyer' ), // Name
				array( 'classname' => 'facebok_widget', 'description' =>esc_html__('Facebook widget like box total customized with theme.', 'lawyer'), ) // Args
			);
		}
        /**
         * @Facebook html Form
         *
         *
         */
         function form($instance) {
                $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
                $title = $instance['title'];
                $pageurl = isset( $instance['pageurl'] ) ? esc_attr( $instance['pageurl'] ) : '';
                $showfaces = isset( $instance['showfaces'] ) ? esc_attr( $instance['showfaces'] ) : '';
                $showstream = isset( $instance['showstream'] ) ? esc_attr( $instance['showstream'] ) : '';
                $showheader = isset( $instance['showheader'] ) ? esc_attr( $instance['showheader'] ) : '';
                $fb_bg_color = isset( $instance['fb_bg_color'] ) ? esc_attr( $instance['fb_bg_color'] ) : '';
                $likebox_height = isset( $instance['likebox_height'] ) ? esc_attr( $instance['likebox_height'] ) : '';         
				
				
				$width = isset( $instance['width'] ) ? esc_attr( $instance['width'] ) : '';   
				$hide_cover = isset( $instance['hide_cover'] ) ? esc_attr( $instance['hide_cover'] ) : '';   
				$show_posts = isset( $instance['show_posts'] ) ? esc_attr( $instance['show_posts'] ) : '';   
				$hide_cta = isset( $instance['hide_cta'] ) ? esc_attr( $instance['hide_cta'] ) : '';   
				$small_header = isset( $instance['small_header'] ) ? esc_attr( $instance['small_header'] ) : '';   
				$adapt_container_width = isset( $instance['adapt_container_width'] ) ? esc_attr( $instance['adapt_container_width'] ) : '';   
	              
            ?>
            <p>
            	<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title','lawyer');?>
                	<input class="upcoming" id="<?php echo esc_attr($this->get_field_id('title')); ?>" size='40' name="<?php echo esc_attr($this->                    get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
              </label>
            </p>
            <p>
            	<label for="<?php echo esc_attr($this->get_field_id('pageurl')); ?>"><?php esc_html_e('Page Url','lawyer');?> 
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('pageurl')); ?>" size='40' name="<?php echo                 esc_attr($this->get_field_name('pageurl')); ?>" type="text" value="<?php echo esc_attr($pageurl); ?>" />
                <br />
                <small><?php esc_html_e('Please enter your page or User profile url example:L','lawyer');?> http://www.facebook.com/profilename OR <br />
                https://www.facebook.com/pages/wxyz/123456789101112 </small><br />
              </label>
            </p>
            
           
            <p>
            	<label for="<?php echo cs_allow_special_char($this->get_field_id('fb_bg_color')); ?>"><?php esc_html_e('Background Color','lawyer');?> 
                <input type="text" name="<?php echo cs_allow_special_char($this->get_field_name('fb_bg_color')); ?>" size='4' id="<?php echo cs_allow_special_char($this->get_field_id('fb_bg_color')); ?>"  value="<?php if(!empty($fb_bg_color))
				{ echo cs_allow_special_char($fb_bg_color);} ?>" class="fb_bg_color upcoming"  />
              </label>
            </p>   
            
             <p>
            	<label for="<?php echo cs_allow_special_char($this->get_field_id('width')); ?>"><?php esc_html_e('width','lawyer');?> 
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('width')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('width')); ?>" type="text" value="<?php echo esc_attr($width); ?>" />
              </label>
            </p>
            
              <p>
            	<label for="<?php echo cs_allow_special_char($this->get_field_id('likebox_height')); ?>"><?php esc_html_e('Like Box Height','lawyer');?> 
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('likebox_height')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('likebox_height')); ?>" type="text" value="<?php echo esc_attr($likebox_height); ?>" />
              </label>
            </p>
            
              <p>
            	<label for="<?php echo esc_attr($this->get_field_id('hide_cover')); ?>"><?php esc_html_e('Hide Cover','lawyer');?> 
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('hide_cover')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_cover')); ?>" type="checkbox" <?php if(esc_attr($hide_cover) != '' ){echo 'checked';}?> />
              </label>
            </p>
            
            
              <p>
            	<label for="<?php echo esc_attr($this->get_field_id('showfaces')); ?>"><?php esc_html_e('Show Faces','lawyer');?> 
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('showfaces')); ?>" name="<?php echo esc_attr($this->get_field_name('showfaces')); ?>" type="checkbox" <?php if(esc_attr($showfaces) != '' ){echo 'checked';}?> />
              </label>
            </p>
            
            
              <p>
            	<label for="<?php echo esc_attr($this->get_field_id('show_posts')); ?>"><?php esc_html_e('Show Posts','lawyer');?> 
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('show_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('show_posts')); ?>" type="checkbox" <?php if(esc_attr($show_posts) != '' ){echo 'checked';}?> />
              </label>
            </p>
            
            
              <p>
            	<label for="<?php echo esc_attr($this->get_field_id('hide_cta')); ?>"><?php esc_html_e('Hide Cta','lawyer');?> 
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('hide_cta')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_cta')); ?>" type="checkbox" <?php if(esc_attr($hide_cta) != '' ){echo 'checked';}?> />
              </label>
            </p>
            
              <p>
            	<label for="<?php echo esc_attr($this->get_field_id('small_header')); ?>"><?php esc_html_e('Small Header','lawyer');?> 
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('small_header')); ?>" name="<?php echo esc_attr($this->get_field_name('small_header')); ?>" type="checkbox" <?php if(esc_attr($small_header) != '' ){echo 'checked';}?> />
              </label>
            </p>
            
                    <p>
            	<label for="<?php echo esc_attr($this->get_field_id('adapt_container_width')); ?>"><?php esc_html_e('Adapt width','lawyer');?> 
                <input class="upcoming" id="<?php echo esc_attr($this->get_field_id('adapt_container_width')); ?>" name="<?php echo esc_attr($this->get_field_name('adapt_container_width')); ?>" type="checkbox" <?php if(esc_attr($adapt_container_width) != '' ){echo 'checked';}?> />
              </label>
            </p>
                     
            <?php       
        }        
        /**
         * @Facebook Update Form Data
         *
         *
         */
         function update($new_instance, $old_instance) {    
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['pageurl'] = $new_instance['pageurl'];
			$instance['showfaces'] = $new_instance['showfaces'];    
			$instance['showstream'] = $new_instance['showstream'];
			$instance['showheader'] = $new_instance['showheader'];
			$instance['fb_bg_color'] = $new_instance['fb_bg_color'];        
			$instance['likebox_height'] = $new_instance['likebox_height'];
			
			$instance['width'] = $new_instance['width'];
			$instance['hide_cover'] = $new_instance['hide_cover'];
			$instance['show_posts'] = $new_instance['show_posts'];
			$instance['hide_cta'] = $new_instance['hide_cta'];
			$instance['small_header'] = $new_instance['small_header'];
			$instance['adapt_container_width'] = $new_instance['adapt_container_width'];
		 
 
			return $instance;
        }
        /**
         * @Facebook Widget Display
         *
         *
         */
         function widget($args, $instance) {    
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$title = htmlspecialchars_decode(stripslashes($title));
            $pageurl = empty($instance['pageurl']) ? ' ' : apply_filters('widget_title', $instance['pageurl']);
            $showfaces = empty($instance['showfaces']) ? ' ' : apply_filters('widget_title', $instance['showfaces']);
            $showstream = empty($instance['showstream']) ? ' ' : apply_filters('widget_title', $instance['showstream']);
            $showheader = empty($instance['showheader']) ? ' ' : apply_filters('widget_title', $instance['showheader']);
            $fb_bg_color = empty($instance['fb_bg_color']) ? ' ' : apply_filters('widget_title', $instance['fb_bg_color']);                        
            $likebox_height = empty($instance['likebox_height']) ? ' ' : apply_filters('widget_title', $instance['likebox_height']);
			
			 $width = empty($instance['width']) ? ' ' : apply_filters('widget_title', $instance['width']);
			 $hide_cover = empty($instance['hide_cover']) ? ' ' : apply_filters('widget_title', $instance['hide_cover']);
			 $show_posts = empty($instance['show_posts']) ? ' ' : apply_filters('widget_title', $instance['show_posts']);
			 $hide_cta = empty($instance['hide_cta']) ? ' ' : apply_filters('widget_title', $instance['hide_cta']);
		     $small_header = empty($instance['small_header']) ? ' ' : apply_filters('widget_title', $instance['small_header']);
			 $adapt_container_width = empty($instance['adapt_container_width']) ? ' ' : apply_filters('widget_title', $instance['adapt_container_width']);
		 
				   
			if(isset($showfaces) AND $showfaces == 'on'){$showfaces ='true';}else{$showfaces = 'false';}
            if(isset($showstream) AND $showstream == 'on'){$showstream ='true';}else{$showstream ='false';}
			
				if(isset($hide_cover) AND $hide_cover == 'on'){$hide_cover ='true';}else{$hide_cover ='false';}
				if(isset($show_posts) AND $show_posts == 'on'){$show_posts ='true';}else{$show_posts ='false';}
				if(isset($hide_cta) AND $hide_cta == 'on'){$hide_cta ='true';}else{$hide_cta ='false';}
				if(isset($small_header) AND $small_header == 'on'){$small_header ='true';}else{$small_header ='false';}
				if(isset($adapt_container_width) AND $adapt_container_width == 'on'){$adapt_container_width ='true';}else{$adapt_container_width ='false';}
		 
				  
           		echo cs_allow_special_char($before_widget);
			?>
            <style scoped>
				.facebookOuter {background-color:<?php echo cs_allow_special_char($fb_bg_color);?>; width:100%;padding:0;float:left;}
				.facebookInner {float: left; width: 100%;}
				.facebook_module, .fb_iframe_widget > span, .fb_iframe_widget > span > iframe { width: 100% !important;}
				.fb_iframe_widget, .fb-like-box div span iframe { width: 100% !important; float: left;}
			</style>
            <?php
            if (!empty($title) && $title <> ' '){
                echo cs_allow_special_char($before_title);
                echo cs_allow_special_char($title);
                echo cs_allow_special_char($after_title);
            }    
        global $wpdb, $post;?>		
        
        	<div id="fb-root"></div>
			<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
               js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
			
            <?php
	 
		$output  = '';
$output .= '<div style="background:' . esc_attr( $instance['fb_bg_color'] ) . ';" class="fb-like-box" '; 
$output .= ' data-href="'.esc_url($pageurl).'"';
$output .= ' data-width="'.$width.'" ';
$output .= ' data-height="'.$likebox_height.'" ';
$output .= ' data-hide-cover="'.$hide_cover.'" ';
$output .= ' data-show-facepile="'.$showfaces.'" ';
$output .= ' data-show-posts="'.$show_posts.'">';
$output .= ' </div>';
	  	echo cs_allow_special_char($output);
		
	  echo cs_allow_special_char($after_widget);
		}
	}    
}
add_action( 'widgets_init', create_function('', 'return register_widget("facebook_module");') );


/**
 * @Social Network widget Class
 *
 *
 */
if (!class_exists('cs_social_network_widget')) {

    class cs_social_network_widget extends WP_Widget {
        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */

        /**
         * @Social Network Module
         *
         *
         */
        public function __construct() {

            parent::__construct(
                    'cs_social_network_widget', // Base ID
                    __('CS : Social Newtork', 'lawyer'), // Name
                    array('classname' => 'widget-socialnetwork', 'description' => 'Social Newtork widget',) // Args
            );
        }

        /**
         * @Social Network html form
         *
         *
         */
        function form($instance) {
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = $instance['title'];
            ?>
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size='40' name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </label>
            </p>
            <?php
        }

        /**
         * @Social Network Update from data 
         *
         *
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            return $instance;
        }

        /**
         * @Social Network Widget
         *
         *
         */
        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            echo cs_allow_special_char($before_widget);

            if (!empty($title) && $title <> ' ') {
                echo cs_allow_special_char($before_title);
                echo cs_allow_special_char($title);
                echo cs_allow_special_char($after_title);
            }
            global $wpdb, $post;
            echo '<div class="followus">';
            cs_social_network_widget();
            echo '</div>';
            echo cs_allow_special_char($after_widget);
        }

    }

}
add_action('widgets_init', create_function('', 'return register_widget("cs_social_network_widget");'));


/**
 * @Flickr widget Class
 *
 *
 */
if (!class_exists('cs_flickr')) {

    class cs_flickr extends WP_Widget {
        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */

        /**
         * @init Flickr Module
         *
         *
         */
        public function __construct() {

            parent::__construct(
                    'cs_flickr', // Base ID
                    __('CS : Flickr Gallery', 'lawyer'), // Name
                    array('classname' => 'widget-flickr widget-gallery', 'description' => 'Type a user name to show photos in widget',) // Args
            );
        }

        /**
         * @Flickr html form
         *
         *
         */
        function form($instance) {
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = $instance['title'];
            $username = isset($instance['username']) ? esc_attr($instance['username']) : '';
            $no_of_photos = isset($instance['no_of_photos']) ? esc_attr($instance['no_of_photos']) : '';
            ?>
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> Title:
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('username')); ?>"> Flickr username:
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('username')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('no_of_photos')); ?>"> Number of Photos:
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('no_of_photos')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('no_of_photos')); ?>" type="text" value="<?php echo esc_attr($no_of_photos); ?>" />
                </label>
            </p>
            <?php
        }

        /**
         * @Flickr update form data
         *
         *
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['username'] = $new_instance['username'];
            $instance['no_of_photos'] = $new_instance['no_of_photos'];

            return $instance;
        }

        /**
         * @Display Flickr widget
         *
         *
         */
        function widget($args, $instance) {
            global $cs_theme_options;

            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            $username = empty($instance['username']) ? ' ' : apply_filters('widget_title', $instance['username']);
            $no_of_photos = empty($instance['no_of_photos']) ? ' ' : apply_filters('widget_title', $instance['no_of_photos']);
            if ($instance['no_of_photos'] == "") {
                $instance['no_of_photos'] = '3';
            }

            echo cs_allow_special_char($before_widget);

            if (!empty($title) && $title <> ' ') {
                echo cs_allow_special_char($before_title);
                echo cs_allow_special_char($title);
                echo cs_allow_special_char($after_title);
            }

            $get_flickr_array = array();

            $apiKey = $cs_theme_options['flickr_key'];
            $apiSecret = $cs_theme_options['flickr_secret'];

            if ($apiKey <> '') {

                // Getting transient
                $cachetime = 86400;
                $transient = 'flickr_gallery_data';
                $check_transient = get_transient($transient);

                // Get Flickr Gallery saved data
                $saved_data = get_option('flickr_gallery_data');

                $db_apiKey = '';
                $db_user_name = '';
                $db_total_photos = '';

                if ($saved_data <> '') {
                    $db_apiKey = isset($saved_data['api_key']) ? $saved_data['api_key'] : '';
                    $db_user_name = isset($saved_data['user_name']) ? $saved_data['user_name'] : '';
                    $db_total_photos = isset($saved_data['total_photos']) ? $saved_data['total_photos'] : '';
                }

                if ($check_transient === false || ($apiKey <> $db_apiKey || $username <> $db_user_name || $no_of_photos <> $db_total_photos)) { 
				
					$user_id = "https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=".$apiKey."&username=".$username."&format=json&nojsoncallback=1";
					
					
					$response = wp_remote_get( esc_url_raw( $user_id ),array( 'decompress' => false ) );
					$user_info = json_decode( wp_remote_retrieve_body( $response ), true );
				 
					 
								
					if ($user_info['stat'] == 'ok') {
						
						$user_get_id = $user_info['user']['id'];
						
						$get_flickr_array['api_key'] = $apiKey;
						$get_flickr_array['user_name'] = $username;
						$get_flickr_array['user_id'] = $user_get_id;
						
						$url = "https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=".$apiKey."&user_id=".$user_get_id."&per_page=".$no_of_photos."&format=json&nojsoncallback=1";
						
						$response = wp_remote_get( esc_url_raw( $url ),array( 'decompress' => false ) );
					    $content = json_decode( wp_remote_retrieve_body( $response ), true );
					 	if ($content['stat'] == 'ok') {
							$counter = 0;
							echo '<ul class="gallery-list">';			 				
							foreach ((array)$content['photos']['photo'] as $photo) {
								
								$image_file = "https://farm{$photo['farm']}.staticflickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_s.jpg";
								
								$img_headers = get_headers($image_file);
								if(strpos($img_headers[0], '200') !== false) {
									
									$image_file = $image_file;
								}
								else{
									$image_file = "https://farm{$photo['farm']}.staticflickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_q.jpg";
									$img_headers = get_headers($image_file);
									if(strpos($img_headers[0], '200') !== false) {
										
										$image_file = $image_file;
									}
									else{
										$image_file = get_template_directory_uri().'/assets/images/no_image_thumb.jpg';
									}
								}
								
								echo '<li>';
								echo "<a target='_blank' title='" . $photo['title'] . "' href='https://www.flickr.com/photos/" . $photo['owner'] . "/" . $photo['id'] . "/'>";
								echo "<img alt='".$photo['title']."' src='".$image_file."'>";
								echo "</a>";
								echo '</li>';
														
								$counter++;
								
								$get_flickr_array['photo_src'][] = $image_file;
								$get_flickr_array['photo_title'][] = $photo['title'];
								$get_flickr_array['photo_owner'][] = $photo['owner'];
								$get_flickr_array['photo_id'][] = $photo['id'];
								
							}
							echo '</ul>';
							
							$get_flickr_array['total_photos'] = $counter;
							
							// Setting Transient
							set_transient( $transient, true, $cachetime );
					 update_option('flickr_gallery_data', $get_flickr_array);
							
							if($counter == 0) _e('No result found.', 'pc');
						}
						
						else {
							echo 'Error:' . $content['code'] . ' - ' . $content['message'];
						}
					}
					
					else {
						echo 'Error:' . $user_info['code'] . ' - ' . $user_info['message'];
					}
				
				} else {
                    if (get_option('flickr_gallery_data') <> '') {

                        $flick_data = get_option('flickr_gallery_data');
                        echo '<ul class="gallery-list">';
                        if (isset($flick_data['photo_src'])):
                            $i = 0;
                            foreach ($flick_data['photo_src'] as $ph) {
                                echo '<li>';
                                echo "<a target='_blank' title='" . $flick_data['photo_title'][$i] . "' href='https://www.flickr.com/photos/" . $flick_data['photo_owner'][$i] . "/" . $flick_data['photo_id'][$i] . "/'>";
                                echo "<img alt='" . $flick_data['photo_title'][$i] . "' src='" . $flick_data['photo_src'][$i] . "'>";
                                echo "</a>";
                                echo '</li>';
                                $i++;
                            }
                        endif;
                        echo '</ul>';
                    } else {
                        _e('No result found.', 'Lawyer');
                    }
                }
            } else {
                _e('Please Enter Flickr API key from Theme Options.', 'Lawyer');
            }
            echo cs_allow_special_char($after_widget);
        }

    }

}
add_action('widgets_init', create_function('', 'return register_widget("cs_flickr");'));


/**
 * @Recent posts widget Class
 *
 *
 */
if (!class_exists('recentposts')) {

    class recentposts extends WP_Widget {
        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */

        /**
         * @init Recent posts Module
         *
         *
         */
        public function __construct() {

            parent::__construct(
                    'recentposts', // Base ID
                    __('CS : Recent Posts', 'directory'), // Name
                    array('classname' => 'widget-recent-blog widget_latest_post', 'description' => 'Recent Posts from category',) // Args
            );
        }

        /**
         * @Recent posts html form
         *
         *
         */
        function form($instance) {
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = $instance['title'];
            $select_category = isset($instance['select_category']) ? esc_attr($instance['select_category']) : '';
            $showcount = isset($instance['showcount']) ? esc_attr($instance['showcount']) : '';
            $thumb = isset($instance['thumb']) ? esc_attr($instance['thumb']) : '';
            ?>
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"><?php _e('Title', 'Lawyer'); ?> 
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>"><?php _e('Select Category', 'Lawyer'); ?> 
                    <select id="<?php echo cs_allow_special_char($this->get_field_id('select_category')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('select_category')); ?>" style="width:225px">
                        <option value="" ><?php _e('All', 'Lawyer'); ?> </option>
                        <?php
                        $categories = get_categories();
                        if ($categories <> "") {
                            foreach ($categories as $category) {
                                ?>
                                <option <?php
                                if ($select_category == $category->slug) {
                                    echo 'selected';
                                }
                                ?> value="<?php echo cs_allow_special_char($category->slug); ?>" ><?php echo cs_allow_special_char($category->name); ?></option>
                                    <?php
                                }
                            }
                            ?>
                    </select>
                </label>
            </p>
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>"><?php _e('Number of Posts To Display', 'Lawyer'); ?> 
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('showcount')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('showcount')); ?>" type="text" value="<?php echo esc_attr($showcount); ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('thumb')); ?>"><?php _e('Display Thumbnails', 'Lawyer'); ?> 
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('thumb')); ?>" size='2' name="<?php echo cs_allow_special_char($this->get_field_name('thumb')); ?>" value="true" type="checkbox"  <?php if (isset($instance['thumb']) && $instance['thumb'] == 'true') echo 'checked="checked"'; ?> />
                </label>
            </p>
            <?php
        }

        /**
         * @Recent posts update form data
         *
         *
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['select_category'] = $new_instance['select_category'];
            $instance['showcount'] = $new_instance['showcount'];
            $instance['thumb'] = $new_instance['thumb'];

            return $instance;
        }

        /**
         * @Display Recent posts widget
         *
         *
         */
        function widget($args, $instance) {
            global $cs_node;

            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            $select_category = empty($instance['select_category']) ? ' ' : apply_filters('widget_title', $instance['select_category']);
            $showcount = empty($instance['showcount']) ? ' ' : apply_filters('widget_title', $instance['showcount']);
            $thumb = isset($instance['thumb']) ? esc_attr($instance['thumb']) : '';
            if ($instance['showcount'] == "") {
                $instance['showcount'] = '-1';
            }

            echo cs_allow_special_char($before_widget);

            if (!empty($title) && $title <> ' ') {
                echo cs_allow_special_char($before_title);
                echo cs_allow_special_char($title);
                echo cs_allow_special_char($after_title);
            }

            global $wpdb, $post;
            ?>
            <?php
            wp_reset_query();

            /**
             * @Display Recent posts
             *
             *
             */
            if (isset($select_category) and $select_category <> ' ' and $select_category <> '') {
                $args = array('posts_per_page' => "$showcount", 'post_type' => 'post', 'category_name' => "$select_category", 'ignore_sticky_posts' => 1);
            } else {
                $args = array('posts_per_page' => "$showcount", 'post_type' => 'post', 'ignore_sticky_posts' => 1);
            }

            $custom_query = new WP_Query($args);
            if ($custom_query->have_posts() <> "") {
                if ($thumb <> true)
                    echo '<ul>';
                while ($custom_query->have_posts()) : $custom_query->the_post();
                    $post_xml = get_post_meta($post->ID, "post", true);
                    $cs_xmlObject = new stdClass();
                    $cs_noimage = '';
                    if ($post_xml <> "") {
                        $cs_xmlObject = new SimpleXMLElement($post_xml);
                    }//43

                    if ($thumb <> true) {
                        ?>
                        <li>
                            <div class="cs-time"> <span><?php echo date_i18n('M', strtotime(get_the_date())); ?></span>
                                <time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><?php echo date_i18n('d', strtotime(get_the_date())); ?></time>
                            </div>
                            <div class="letest-post-title">
                                <h5><a href="<?php the_permalink(); ?>"><?php
                                        echo substr(get_the_title(), 0, 27);
                                        if (strlen(get_the_title()) > 27)
                                            echo "...";
                                        ?></a></h5>
                                <ul class="post-options">
                                    <li><?php echo cs_category_render('', 'category', ', '); ?></li>
                                    <li><?php comments_popup_link(__('Leave a comment', 'Lawyer'), __('1 Comment', 'Lawyer'), __('% Comments', 'Lawyer')); ?></li>
                                </ul>
                            </div>
                        </li>
                        <?php
                    }
                    else {
                        $cs_noimage = '';
                        $width = 150;
                        $height = 150;
                        $image_id = get_post_thumbnail_id($post->ID);
                        $image_url = cs_attachment_image_src($image_id, $width, $height);
                        if ($image_id == '') {
                            $cs_noimage = ' class="cs-noimage"';
                        }
                        ?>
                        <article<?php echo cs_allow_special_char($cs_noimage); ?>>
                            <?php
                            if ($image_id <> '') {
                                ?>
                                <figure><a href="<?php the_permalink(); ?>"><img alt="<?php the_title(); ?>" width="70" height="70" src="<?php echo esc_url($image_url); ?>"></a></figure>
                                <?php
                            }
                            ?>
                            <div class="infotext">
                                <a class="pix-colrhvr" href="<?php the_permalink(); ?>"><?php
                                    echo substr(get_the_title(), 0, 27);
                                    if (strlen(get_the_title()) > 27)
                                        echo "...";
                                    ?></a>
                                <ul class="post-option">
                                    <li>
                                        <i class="icon-calendar4"></i>
                                        <?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?>
                                    </li>
                                </ul>
                            </div>
                        </article>
                        <?php
                    }

                endwhile;

                if ($thumb <> true)
                    echo '</ul>';
            }
            else {
                if (function_exists('fnc_no_result_found')) {
                    fnc_no_result_found(false);
                }
            }
            echo cs_allow_special_char($after_widget);
        }

    }

}
add_action('widgets_init', create_function('', 'return register_widget("recentposts");'));


/**
 * @Twitter Tweets widget Class
 *
 *
 */
if (!class_exists('cs_twitter_widget')) {

    class cs_twitter_widget extends WP_Widget {
        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */

        /**
         * @init Twitter Module
         *
         *
         */
        public function __construct() {

            parent::__construct(
                    'cs_twitter_widget', // Base ID
                    __('CS : Twitter Widget', 'Lawyer'), // Name
                    array('classname' => 'twitter_widget', 'description' => 'Twitter Widget',) // Args
            );
        }

        /**
         * @Twitter html form
         *
         *
         */
        function form($instance) {
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = $instance['title'];
            $username = isset($instance['username']) ? esc_attr($instance['username']) : '';
            $numoftweets = isset($instance['numoftweets']) ? esc_attr($instance['numoftweets']) : '';
            ?>
            <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"> <span><?php _e('Title', 'Lawyer'); ?> </span>
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
            <label for="screen_name"><?php _e('User Name', 'Lawyer'); ?><span class="required">(*)</span>: </label>
            <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('username')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
            <label for="tweet_count">
                <span><?php _e('Num of Tweets', 'Lawyer'); ?> </span>
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('numoftweets')); ?>" size="2" name="<?php echo cs_allow_special_char($this->get_field_name('numoftweets')); ?>" type="text" value="<?php echo esc_attr($numoftweets); ?>" />
                <div class="clear"></div>
            </label>
            <?php
        }

        /**
         * @Twitter update form data 
         *
         *
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['username'] = $new_instance['username'];
            $instance['numoftweets'] = $new_instance['numoftweets'];

            return $instance;
        }

        /**
         * @Display Twitter widget
         *
         *
         */
       
		//Updated Widget
		function widget($args, $instance) {
            global $cs_theme_options, $cs_twitter_arg;
            $cs_twitter_arg['consumerkey'] = isset($cs_theme_options['cs_consumer_key']) ? $cs_theme_options['cs_consumer_key'] : '';
            $cs_twitter_arg['consumersecret'] = isset($cs_theme_options['cs_consumer_secret']) ? $cs_theme_options['cs_consumer_secret'] : '';
            $cs_twitter_arg['accesstoken'] = isset($cs_theme_options['cs_access_token']) ? $cs_theme_options['cs_access_token'] : '';
            $cs_twitter_arg['accesstokensecret'] = isset($cs_theme_options['cs_access_token_secret']) ? $cs_theme_options['cs_access_token_secret'] : '';
			$cs_twitter_api_switch = isset($cs_theme_options['cs_twitter_api_switch']) ? $cs_theme_options['cs_twitter_api_switch']: '';
            $cs_cache_limit_time = isset($cs_theme_options['cs_cache_limit_time']) ? $cs_theme_options['cs_cache_limit_time']: '';
            $cs_tweet_num_from_twitter = isset($cs_theme_options['cs_tweet_num_post']) ? $cs_theme_options['cs_tweet_num_post'] : '';
            $cs_twitter_datetime_formate = isset($cs_theme_options['cs_twitter_datetime_formate']);
            if ($cs_cache_limit_time == '') {
                $cs_cache_limit_time = 60;
            }
            if ($cs_twitter_datetime_formate == '') {
                $cs_twitter_datetime_formate = 'time_since';
            }
            if ($cs_tweet_num_from_twitter == '') {
                $cs_tweet_num_from_twitter = 5;
            }
			if($cs_twitter_api_switch=='on')
			{
            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
            $title = htmlspecialchars_decode(stripslashes($title));
            $username = $instance['username'];
            $numoftweets = $instance['numoftweets'];
            if ($numoftweets == '') {
                $numoftweets = 2;
            }
            echo cs_allow_special_char($before_widget);
            // WIDGET display CODE Start
            if (!empty($title) && $title <> ' ') {
                echo cs_allow_special_char($before_title . $title . $after_title);
            }
            if (strlen($username) > 1) {
				if($cs_twitter_arg['consumerkey'] <> '' && $cs_twitter_arg['consumersecret'] <> '' &&  $cs_twitter_arg['accesstoken'] <> '' && $cs_twitter_arg['accesstokensecret'] <> '')
				{
                require_once get_template_directory() . '/include/theme-components/cs-twitter/display-tweets.php';
                display_tweets($username,$cs_twitter_datetime_formate , $cs_tweet_num_from_twitter, $numoftweets, $cs_cache_limit_time);
				}
				else{
					echo '<p>'.__('Please Set Twitter API','Lawyer ').'</p>';
					}
            }
			echo cs_allow_special_char($after_widget);
        }
		}

    }

}
add_action('widgets_init', create_function('', 'return register_widget("cs_twitter_widget");'));

/**
 * @latest reviews widget Class
 *
 *
 */
class contactinfo extends WP_Widget {
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */

    /**
     * @init Contact Info Module
     *
     *
     */
    public function __construct() {

        parent::__construct(
                'contactinfo', // Base ID
                __('CS : Contact info', 'Lawyer'), // Name
                array('classname' => 'widget_text', 'description' => 'Footer Contact Information',) // Args
        );
    }

    /**
     * @Contact Info html form
     *
     *
     */
    function form($instance) {
        $instance = wp_parse_args((array) $instance);
        $image_url = isset($instance['image_url']) ? esc_attr($instance['image_url']) : '';
        $address = isset($instance['address']) ? esc_attr($instance['address']) : '';
        $phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
        $fax = isset($instance['fax']) ? esc_attr($instance['fax']) : '';
        $email = isset($instance['email']) ? esc_attr($instance['email']) : '';
        $randomID = rand(40, 9999999);
        ?>
        <ul class="form-elements-widget">
            <li class="to-label" style="margin-top:20px;">
                <label><?php _e('Image', 'Lawyer'); ?></label>
            </li>
            <li class="to-field">
                <input id="form-widget_cs_widget_logo<?php echo absint($randomID) ?>" name="<?php echo cs_allow_special_char($this->get_field_name('image_url')); ?>" type="hidden" class="" value="<?php echo esc_url($image_url); ?>"/>
                <label class="browse-icon" style="width:100%;">
                    <input name="form-widget_cs_widget_logo<?php echo absint($randomID) ?>"  type="button" class="uploadMedia left" value="<?php _e('Browse', 'Lawyer'); ?>"/>
                </label>
            </li>
        </ul>
        <div class="page-wrap"  id="form-widget_cs_widget_logo<?php echo absint($randomID); ?>_box" style="margin-top:10px; margin-bottom:10px; float:left; overflow:hidden; display:<?php echo cs_allow_special_char($image_url) && cs_allow_special_char($image_url) != '' ? 'inline' : 'none'; ?>">
            <div class="gal-active">
                <div class="dragareamain" style="padding-bottom:0px;">
                    <ul id="gal-sortable" style="margin-bottom:0px;">
                        <li class="ui-state-default" style="margin:6px">
                            <div class="thumb-secs"> <img src="<?php echo cs_allow_special_char($image_url); ?>"  id="form-widget_cs_widget_logo<?php echo absint($randomID); ?>_img" style="max-height:80px; max-width:180px" alt="" />
                                <div class="gal-edit-opts"> <a   href="javascript:del_media('cs_widget_logo<?php echo absint($randomID) ?>')" class="delete"></a> </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <p style="margin-top:0px; float:left;">
            <label for="<?php echo cs_allow_special_char($this->get_field_id('address')); ?>"><?php _e('Address', 'Lawyer'); ?> <br />
                <textarea cols="20" rows="5" id="<?php echo cs_allow_special_char($this->get_field_id('address')); ?>" name="<?php echo cs_allow_special_char($this->get_field_name('address')); ?>" style="width:315px"><?php echo esc_attr($address); ?></textarea>
            </label>
        </p>
        <p style="margin-top:0px; float:left;">
            <label for="<?php echo cs_allow_special_char($this->get_field_id('phone')); ?>"><?php _e('Phone', 'Lawyer'); ?> <br />
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('phone')); ?>" size="40"
                       name="<?php echo cs_allow_special_char($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
            </label>
        </p>

        <p style="margin-top:0px; float:left;">
            <label for="<?php echo cs_allow_special_char($this->get_field_id('fax')); ?>"><?php _e('Fax', 'Lawyer'); ?><br />
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('fax')); ?>" size="40" 
                       name="<?php echo cs_allow_special_char($this->get_field_name('fax')); ?>" type="text" value="<?php echo esc_attr($fax); ?>" />
            </label>
        </p>

        <p style="margin-top:0px; float:left;">
            <label for="<?php echo cs_allow_special_char($this->get_field_id('email')); ?>"><?php _e('Email', 'Lawyer'); ?><br />
                <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('email')); ?>" size="40" 
                       name="<?php echo cs_allow_special_char($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
            </label>
        </p>
        <?php
    }

    /**
     * @Update Info html form
     *
     *
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['image_url'] = $new_instance['image_url'];
        $instance['address'] = $new_instance['address'];
        $instance['phone'] = $new_instance['phone'];
        $instance['fax'] = $new_instance['fax'];
        $instance['email'] = $new_instance['email'];
        return $instance;
    }

    /**
     * @Widget Info html form
     *
     *
     */
    function widget($args, $instance) {
        global $px_node;
        extract($args, EXTR_SKIP);
        $image_url = empty($instance['image_url']) ? '' : apply_filters('widget_title', $instance['image_url']);
        $address = empty($instance['address']) ? '' : apply_filters('widget_title', $instance['address']);
        $phone = empty($instance['phone']) ? '' : apply_filters('widget_title', $instance['phone']);
        $fax = empty($instance['fax']) ? '' : apply_filters('widget_title', $instance['fax']);
        $email = empty($instance['email']) ? '' : apply_filters('widget_title', $instance['email']);
        echo cs_allow_special_char($before_widget);
        if (isset($image_url) && $image_url != '') {
            echo '<div class="logo"><a href="' . esc_url(home_url()) . '"><img src="' . $image_url . '" alt="" /></a></div>';
        }

        echo '<ul class="group">';
        if (isset($address) and $address <> '') {
            echo '<li><i class="icon-institution"></i>' . do_shortcode(htmlspecialchars_decode($address)) . '</li>';
        }
        if (isset($phone) and $phone <> '') {
            echo '<li><i class="icon-phone"></i>' . htmlspecialchars_decode($phone) . '</li>';
        }
        if (isset($fax) and $fax <> '') {
            echo '<li><i class="icon-fax"></i>' . htmlspecialchars_decode($fax) . '</li>';
        }
        if (isset($email) and $email <> '') {
            echo '<li><i class="icon-envelope"></i>' . htmlspecialchars_decode($email) . '</li>';
        }
        echo '</ul>';


        echo cs_allow_special_char($after_widget);
    }

}

add_action('widgets_init', create_function('', 'return register_widget("contactinfo");'));

/**
 * @Contact form widget Class
 *
 *
 */
if (!class_exists('cs_contact_msg')) {

    class cs_contact_msg extends WP_Widget {
        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */

        /**
         * @init Contact Module
         *
         *
         */
        public function __construct() {

            parent::__construct(
                    'cs_contact_msg', // Base ID
                    __('CS : Contact Form', 'Lawyer'), // Name
                    array('classname' => 'widget-form', 'description' => 'Select contact form to show in widget',) // Args
            );
        }

        /**
         * @Contact html form
         *
         *
         */
        function form($instance) {
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = $instance['title'];
            $contact_email = isset($instance['contact_email']) ? esc_attr($instance['contact_email']) : '';
            $contact_succ_msg = isset($instance['contact_succ_msg']) ? esc_attr($instance['contact_succ_msg']) : '';
            ?>
            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>"><?php _e('Title', 'Lawyer'); ?> 
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('title')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('contact_email')); ?>"><?php _e('Contact Email', 'Lawyer'); ?> 
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('contact_email')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('contact_email')); ?>" type="text" value="<?php echo esc_attr($contact_email); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo cs_allow_special_char($this->get_field_id('contact_succ_msg')); ?>"><?php _e('Success Message', 'Lawyer'); ?> 
                    <input class="upcoming" id="<?php echo cs_allow_special_char($this->get_field_id('contact_succ_msg')); ?>" size="40" name="<?php echo cs_allow_special_char($this->get_field_name('contact_succ_msg')); ?>" type="text" value="<?php echo esc_attr($contact_succ_msg); ?>" />
                </label>
            </p>


            <?php
        }

        /**
         * @Contact Update form data
         *
         *
         */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['contact_email'] = $new_instance['contact_email'];
            $instance['contact_succ_msg'] = $new_instance['contact_succ_msg'];

            return $instance;
        }

        /**
         * @Display Contact widget
         *
         *
         */
        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            global $wpdb, $post;
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
            $contact_email = isset($instance['contact_email']) ? esc_attr($instance['contact_email']) : '';
            $contact_succ_msg = isset($instance['contact_succ_msg']) ? esc_attr($instance['contact_succ_msg']) : '';

            // WIDGET display CODE Start
            echo cs_allow_special_char($before_widget);
            if (strlen($title) <> 1 || strlen($title) <> 0) {
                echo cs_allow_special_char($before_title . $title . $after_title);
            }


            $msg_form_counter = rand(1, 999);
            if (function_exists('cs_enqueue_validation_script')) {
                cs_enqueue_validation_script();
            }
            $error = __('An error Occured, please try again later.', 'Lawyer');
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    var container = $('');
                    var validator = jQuery("#frm<?php echo absint($msg_form_counter) ?>").validate({
                        messages: {
                            contact_name: '',
                            contact_email: {
                                required: '',
                                email: '',
                            },
                            subject: {
                                required: '',
                            },
                            contact_msg: '',
                        },
                        errorContainer: container,
                        errorLabelContainer: jQuery(container),
                        errorElement: 'div',
                        errorClass: 'frm_error',
                        meta: "validate"
                    });
                });
                function frm_submit<?php echo cs_allow_special_char($msg_form_counter) ?>() {
                    var $ = jQuery;
                    $("#submit_btn<?php echo cs_allow_special_char($msg_form_counter) ?>").hide();
                    $("#loading_div<?php echo cs_allow_special_char($msg_form_counter) ?>").html('<img src="<?php echo esc_js(get_template_directory_uri()); ?>/assets/images/ajax-loader.gif" alt="" />');
                    var datastring = $('#frm<?php echo cs_allow_special_char($msg_form_counter) ?>').serialize() + "&cs_contact_email=<?php echo esc_js($contact_email); ?>&cs_contact_succ_msg=<?php echo cs_allow_special_char($contact_succ_msg); ?>&cs_contact_error_msg=<?php echo cs_allow_special_char($error); ?>&action=cs_contact_form_submit";
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo esc_js(admin_url('admin-ajax.php')); ?>',
                        data: datastring,
                        dataType: "json",
                        success: function (response) {
                            if (response.type == 'error') {
                                $("#loading_div<?php echo cs_allow_special_char($msg_form_counter); ?>").html('');
                                $("#loading_div<?php echo cs_allow_special_char($msg_form_counter); ?>").hide();
                                $("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").addClass('error_mess');
                                $("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").show();
                                $("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").html(response.message);
                            } else if (response.type == 'success') {
                                $("#loading_div<?php echo cs_allow_special_char($msg_form_counter); ?>").html('');
                                $("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").addClass('succ_mess');
                                $("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").show();
                                $("#message<?php echo cs_allow_special_char($msg_form_counter); ?>").html(response.message);
                            }
                        }
                    });
                }
            </script>

            <div id="form_hide<?php echo absint($msg_form_counter); ?>">
                <form id="frm<?php echo absint($msg_form_counter); ?>" name="frm<?php echo absint($msg_form_counter); ?>" method="post" action="javascript:<?php echo "frm_submit" . $msg_form_counter . "()";
            ?>" novalidate>
                    <ul class="group">
                        <li>
                            <input type="text" placeholder="<?php _e('Name', 'Lawyer'); ?>" name="contact_name" id="contact_name" class="nameinput {validate:{required:true}}">
                        </li>
                        <li>
                            <input type="text" placeholder="<?php _e('Email', 'Lawyer'); ?>" name="contact_email" id="contact_email" class="emailinput {validate:{required:true ,email:true}}">
                        </li>
                        <li>
                            <textarea placeholder="<?php _e('Message', 'Lawyer'); ?>" name="contact_msg" id="contact_msg" class="{validate:{required:true}}"></textarea>
                        </li>

                        <input type="hidden" value="<?php echo cs_allow_special_char($contact_succ_msg); ?>" name="cs_contact_succ_msg">
                        <input type="hidden" name="bloginfo" value="<?php echo get_bloginfo() ?>" />
                        <input type="hidden" name="counter_node" value="<?php echo absint($msg_form_counter) ?>" />
                        <span id="loading_div<?php echo absint($msg_form_counter) ?>"><i class="icon-envelope"></i></span>
                        <div id="message<?php echo absint($msg_form_counter); ?>" style="display:none;"></div>
                        <input type="submit" value="<?php _e('Send message', 'Lawyer'); ?>" name="submit" id="submit_btn<?php echo absint($msg_form_counter) ?>">
                    </ul>
                </form>
            </div>
            <?php
            echo cs_allow_special_char($after_widget); // WIDGET display CODE End
        }

    }

}
add_action('widgets_init', create_function('', 'return register_widget("cs_contact_msg");'));
