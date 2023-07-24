<?php 
/**
 * File Type: Practice Templates Class
 */
 

if ( !class_exists('PracticeTemplates') ) {
	
	class PracticeTemplates
	{
		
		function __construct()
		{
			// Constructor Code here..
		}
	
		//======================================================================
		// Practice Grid 3 View
		//======================================================================
		public function cs_grid_3_view( $atts ) {
			global $post;
			$width = '358';
			$height = '202';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$cs_practice_subtitle = '';
			$cs_practice_icon = '';
			$post_xml = get_post_meta(get_the_id(), "practice", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$cs_practice_subtitle = $cs_xmlObject->cs_practice_subtitle;
				$cs_practice_icon = $cs_xmlObject->cs_practice_icon;
			}
				
			?>
			
			<div class="col-md-4">
              <!-- Cs Services Start -->
              <article class="cs-services top-left has-caption">
               <figure>
               <?php
			   if ( isset( $thumbnail ) && $thumbnail !='' ) {
			   ?>
              <a href="<?php the_permalink(); ?>"> <img src="<?php echo esc_url($thumbnail); ?>" alt=""></a>
               <?php
			   }
			   if ( isset( $cs_practice_icon ) && $cs_practice_icon != '' ) {
			   ?>
               <i class="<?php echo cs_allow_special_char($cs_practice_icon); ?> fa-4x"></i>
               <?php
			   }
			   ?>
               </figure>
                <div class="text">
                  <h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                  <?php
				  if ( isset( $cs_practice_subtitle ) && $cs_practice_subtitle != '' ) {
				  ?>
                  <p><?php echo cs_allow_special_char($cs_practice_subtitle); ?></p>
                  <?php
				  }
				  ?>
                </div>
              </article>
              <!-- Cs Services End -->
               <div class="cs-seprator">
                  <div class="devider1"></div>
              </div>
            </div>
			
		<?php 
		}
		
		
		//======================================================================
		// Practice Grid Modern View
		//======================================================================
		public function cs_grid_modern_view( $atts ) { 
			global $post;
			$width = '358';
			$height = '202';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$cs_practice_subtitle = '';
			$cs_practice_icon = '';
			$post_xml = get_post_meta(get_the_id(), "practice", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$cs_practice_subtitle = $cs_xmlObject->cs_practice_subtitle;
				$cs_practice_icon = $cs_xmlObject->cs_practice_icon;
			}
		?>
		
            <div class="col-md-4">
              <!-- Cs Services Start -->
              <article class="cs-services modren top-center">
               <figure>
                   <?php
				   if ( isset( $thumbnail ) && $thumbnail !='' ) {
				   ?>
				   <a href="<?php the_permalink(); ?>"> <img src="<?php echo esc_url($thumbnail); ?>" alt=""></a>
				   <?php
				   }
				   if ( isset( $cs_practice_icon ) && $cs_practice_icon != '' ) {
				   ?>
				   <i class="<?php echo cs_allow_special_char($cs_practice_icon); ?> fa-3x"></i>
				   <?php
				   }
				   ?>
               </figure>
                <div class="text">
                  <h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                  <?php
				  if ( isset( $cs_practice_subtitle ) && $cs_practice_subtitle != '' ) {
				  ?>
                  <p><?php echo cs_allow_special_char($cs_practice_subtitle); ?></p>
                  <?php
				  }
				  ?>
                </div>
              </article>
              <!-- Cs Services End -->
               <div class="cs-seprator">
                  <div class="devider1"></div>
              </div>
            </div>
		<?php
        }
		
		
		//======================================================================
		// Practice grid_4_view View
		//======================================================================
		public function cs_grid_4_view( $atts ) {
			global $post;
			$width = '264';
			$height = '198';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$cs_practice_subtitle = '';
			$cs_practice_icon = '';
			$post_xml = get_post_meta(get_the_id(), "practice", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$cs_practice_subtitle = $cs_xmlObject->cs_practice_subtitle;
				$cs_practice_icon = $cs_xmlObject->cs_practice_icon;
			}
			?>
			
			<div class="col-md-3">
              <!-- Cs Services Start -->
              <article class="cs-services modren top-center">
               <figure>
				   <?php
				   if ( isset( $thumbnail ) && $thumbnail !='' ) {
				   ?>
				   <a href="<?php the_permalink(); ?>"> <img src="<?php echo esc_url($thumbnail); ?>" alt=""></a>
				   <?php
				   }
				   ?>
               </figure>
                <div class="text">
                  <h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                  <?php
				  if ( isset( $cs_practice_subtitle ) && $cs_practice_subtitle != '' ) {
				  ?>
                  <p><?php echo cs_allow_special_char($cs_practice_subtitle); ?></p>
                  <?php
				  }
				  ?>
                </div>
              </article>
              <!-- Cs Services End -->
               <div class="cs-seprator">
                  <div class="devider1"></div>
              </div>
            </div>
		
		<?php 
		
		}
		
		
		//======================================================================
		// Practice grid_curved View
		//======================================================================
		public function cs_grid_curved( $atts ) {
			global $post;
			$width = '274';
			$height = '274';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$cs_practice_subtitle = '';
			$cs_practice_icon = '';
			$post_xml = get_post_meta(get_the_id(), "practice", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$cs_practice_subtitle = $cs_xmlObject->cs_practice_subtitle;
				$cs_practice_icon = $cs_xmlObject->cs_practice_icon;
			}
		?>
		   <div class="col-md-3">
            <!-- Cs Services Start -->
            <article class="cs-services boxed">
             <figure class="frameshape">
             	<?php
			    if ( isset( $thumbnail ) && $thumbnail !='' ) {
			    ?>
                 <img src="<?php echo esc_url($thumbnail); ?>" alt="">
			    <?php
			    }
			    ?>
                <figcaption> 
                    <div class="text">
                    <?php
                    if ( isset( $cs_practice_icon ) && $cs_practice_icon != '' ) {
				    ?>
				    <i class="<?php echo cs_allow_special_char($cs_practice_icon); ?> fa-4x"></i>
				    <?php
				    }
				    ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
					<?php
                    if ( isset( $cs_practice_subtitle ) && $cs_practice_subtitle != '' ) {
                    ?>
                    <p><?php echo cs_allow_special_char($cs_practice_subtitle); ?></p>
                    <?php
                    }
                    ?>
                  </div>
              </figcaption>
             </figure>
            </article>
            <!-- Cs Services End -->
          </div>
        <?php }
		
	}
}