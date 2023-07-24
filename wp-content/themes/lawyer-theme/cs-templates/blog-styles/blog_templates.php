<?php 
/**
 * File Type: Blog Templates Class
 */
 

if ( !class_exists('BlogTemplates') ) {
	
	class BlogTemplates
	{
		
		function __construct()
		{
			// Constructor Code here..
		}
	
		//======================================================================
		// Blog Small View
		//======================================================================
		public function cs_small_view( $description,$excerpt,$cs_category) {
			global $post,$post_thumb_view;
			$width = '264';
			$height = '198';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = isset($cs_xmlObject->post_thumb_view) ? $cs_xmlObject->post_thumb_view : '';	
			}
			
				
			?>
			
			<div class="col-md-12">
			  <article class="cs-blog blog-medium-small">
              	<div class="date-time"><time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><span><?php echo date_i18n('j',strtotime(get_the_date()));?></span> <small><?php echo date_i18n('M',strtotime(get_the_date()));?></small></time></div>
				<?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure>
                              	  <a class="blog-hover" href="<?php echo the_permalink();?>"><i class="icon-plus8"></i></a>
                                 <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
 							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
				<section class="blog-text">
				  <div class="title">
                  	<ul class="post-options-v1">
					  <li><?php $this->cs_get_categories( $cs_category ); ?></li>
					</ul>
					<h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
				  </div>
				  <ul class="post-option-btn">
					<li><a href="<?php comments_link(); ?>"><i class="icon-comment2"></i><?php echo comments_number(__('0 comments', 'Lawyer'), __('1 comments', 'Lawyer'), __('% comments', 'Lawyer') );?> </a></li>
                     <?php cs_featured(); ?>
				  </ul>
				</section>
			  </article>
			</div>
			
		<?php 
		}
		
		
		//======================================================================
		// Blog Medium View
		//======================================================================
		public function cs_medium_view( $description,$excerpt,$cs_category ) { 
			global $post,$post_thumb_view;
			$width = '274';
			$height = '274';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = isset($cs_xmlObject->post_thumb_view) ? $cs_xmlObject->post_thumb_view : '';	
			}
			
		?>
            <div class="col-md-12">
              <article class="cs-blog blog-medium">
                <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure class="frameshape">
                              	<a class="blog-hover" href="<?php echo the_permalink();?>"><i class="icon-plus8"></i></a>
                                <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
 							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
                <section class="blog-text">
                	<ul class="post-options-v1">
                       <li><?php $this->cs_get_categories( $cs_category ); ?> </li>
                    </ul>
                    <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                    <ul class="post-options">
					  <li><i class="icon-calendar4"></i> <?php echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date()));?></li>
            			<?php cs_featured(); ?>

					</ul>
                    <div class="cs-seprator"><div class="devider1"></div></div>
                  <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
                  <a href="<?php echo the_permalink();?>" class="readmore-btn"><?php _e('Read More','Lawyer');?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-icon.png" alt="blog"></a>
				  <ul class="post-option-btn">
					<li><a href="<?php comments_link(); ?>"><i class="icon-comment2"></i><?php echo comments_number(__('0 comments', 'Lawyer'), __('1 comments', 'Lawyer'), __('% comments', 'Lawyer') );?> </a></li>
                  </ul>
                </section>
              </article>
            </div>	
		<?php
        }
		
		
		//======================================================================
		// Blog Large View
		//======================================================================
		public function cs_large_view( $description,$excerpt,$cs_category) {
			global $post,$post_thumb_view;
			$width = '820';
			$height = '462';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = isset($cs_xmlObject->post_thumb_view) ? $cs_xmlObject->post_thumb_view : '';	
			}
			
			?>
			
			<div class="col-md-12">
			  <article class="cs-blog blog-lrg">
              	<div class="date-time"><time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><span><?php echo date_i18n('j',strtotime(get_the_date()));?></span> <small><?php echo date_i18n('M',strtotime(get_the_date()));?></small></time></div>
                <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure>
								<a class="blog-hover" href="<?php echo the_permalink();?>"><i class="icon-plus8"></i></a>
                                <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
 							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
                <section class="blog-text">
                  <ul class="post-options-v1">
                 	 <li><?php $this->cs_get_categories( $cs_category ); ?> </li>
                  </ul>
                  <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                  <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
                  <a href="<?php echo the_permalink();?>" class="readmore-btn"><?php _e('Read More','Lawyer');?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-icon.png" alt="read_more"></a>
				  <ul class="post-option-btn">
					<li><a href="<?php comments_link(); ?>"><i class="icon-comment2"></i><?php echo comments_number(__('0 comments', 'Lawyer'), __('1 comments', 'Lawyer'), __('% comments', 'Lawyer') );?></a></li>
                    	<?php cs_featured(); ?>
                  </ul>
                </section>
              </article>
			</div>
		
		<?php 
		
		}
		
		
		//======================================================================
		// Blog Mesnory View
		//======================================================================
		public function cs_mesnory_view( $description,$excerpt ) {
			global $post,$post_thumb_view;
			$width = '370';
			$height = '208';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = isset($cs_xmlObject->post_thumb_view) ? $cs_xmlObject->post_thumb_view : '';	
			}
			
		?>
		   <div class="col-md-4">
            <article class="cs-blog cs-blog-grid">
               <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure><a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
								<figcaption><a href="<?php echo the_permalink();?>"><i class="icon-align-justify"></i></a></figcaption>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
 							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
              <section>
                <time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n('M',strtotime(get_the_date()));?><small><?php echo date_i18n('j',strtotime(get_the_date()));?></small> </time>
                <div class="title clearfix">
                  <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                   <ul class="post-option clearfix">
                      <li><i class="icon-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author();?></a> </li>
                      <?php cs_featured(); ?>
                   </ul>
                  <!--title--> 
                </div>
                <?php if ($description == 'yes') {?><p><?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
                  <a href="<?php echo the_permalink();?>" class="continue-reading"><i class="icon-angle-right"></i><?php _e('Continue Reading','Lawyer');?></a>
                  <ul class="post-option-btm clearfix">
                    <li><a href="<?php comments_link(); ?>"><i class="icon-comment-o"></i><?php echo comments_number(__('0', 'Lawyer'), __('1', 'Lawyer'), __('%', 'Lawyer') );?> </a></li>
                    <?php //if ( $post_social_sharing == 'on' ) { ?>
                        <?php cs_addthis_script_init_method();?>
                        <li><a class="btnshare addthis_button_compact"><i class="icon-share-alt"></i><?php _e('Share','Lawyer');?></a></li>
                    <?php //}?>
                  </ul>
              </section>
              <!--blog-grid--> 
            </article>
           </div>
        <?php }
		//======================================================================
		  // Blog Categories
		  //======================================================================
		  public function cs_get_categories( $cs_blog_cat ) {
			
			global $post,$wpdb;         
			if ( isset( $cs_blog_cat ) && $cs_blog_cat !='' && $cs_blog_cat !='0' ){ 
			$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_blog_cat ));
			echo '<a href="'.site_url().'?cat='.$row_cat->term_id.'">'.$row_cat->name.'</a>';
			} else {
			 /* Get All Categories */
			  $before_cat = "";
			  $categories_list = get_the_term_list ( get_the_id(), 'category', $before_cat , ' ', '' );
			  if ( $categories_list ){
			 printf( __( '%1$s', 'Lawyer'),$categories_list );
			  } 
			 // End if Categories 
			}
		  }
		
		
		//======================================================================
		// Blog Grid View
		//======================================================================
		public function cs_grid_view( $description,$excerpt,$cs_category ,$cs_blog_grid_layout='col-md-4') {
			global $post,$post_thumb_view;
			$width = '360';
			$height = '270';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = isset($cs_xmlObject->post_thumb_view)? $cs_xmlObject->post_thumb_view : '';	
			}
			
		?>
		   <div class="<?php echo cs_allow_special_char($cs_blog_grid_layout); ?>">
            <article class="cs-blog blog-grid">
               <?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure>
                              	<a class="blog-hover" href="<?php echo the_permalink();?>"><i class="icon-plus8"></i></a>
                              	<a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
							cs_featured();
							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
              <section class="blog-text">
              		<ul class="post-options-v1">
                      <li><?php $this->cs_get_categories( $cs_category ); ?></li>
                   </ul>
                  <h2><a href="<?php echo the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
                  <ul class="post-options">
                  	<li><i class="icon-calendar4"></i> <?php echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date()));?></li>
                    <?php cs_featured(); ?>
                  </ul>
                <?php if ($description == 'yes') {?><p> <?php echo cs_get_the_excerpt($excerpt,'ture','');?></p><?php } ?> 
                  <a href="<?php echo the_permalink();?>" class="readmore-btn"><?php _e('Read More','Lawyer');?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-icon.png" alt="read_more"></a>
                  <ul class="post-option-btn">
                    <li><a href="<?php comments_link(); ?>"><i class="icon-comment2"></i><?php echo comments_number(__('0', 'Lawyer'), __('1', 'Lawyer'), __('%', 'Lawyer') );?> </a></li>
                  </ul>
              </section>
              <!--blog-grid--> 
            </article>
            <div class="cs-seprator"><div class="devider1"></div></div>
           </div>
              
        <?php }
		
		
		//======================================================================
		// Blog Masonry View
		//======================================================================
		public function cs_masonry_view( $description,$excerpt,$cs_category) {
			global $post,$post_thumb_view;
			$width = '';
			$height = '';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$post_xml = get_post_meta(get_the_id(), "post", true);
			if ( $post_xml <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$post_thumb_view = isset($cs_xmlObject->post_thumb_view) ? $cs_xmlObject->post_thumb_view : '';	
			}
			
			?>
			<div class="col-md-3">
			  <div class="cs-blog blog-masnery">
				<?php if ( $post_thumb_view == 'Single Image' ){
						if ( isset( $thumbnail ) && $thumbnail !='' ) {?>
							<div class="cs-media">
							  <figure>
								
                                <a href="<?php echo the_permalink();?>"><img alt="blog-grid" src="<?php echo esc_url( $thumbnail );?>"></a>
							  </figure>
							</div>
					<?php }
					  } else if ($post_thumb_view == 'Slider') {
					  		echo '<div class="cs-media"><figure>';
 							cs_post_flex_slider($width,$height,get_the_id(),'post-list');
							echo '</figure></div>';
					  } 
				 ?>
				<section class="blog-text">
                  	<ul class="post-options-v1">
					  <li><?php $this->cs_get_categories( $cs_category ); ?></li>
					</ul>
					<h2><a href="<?php the_permalink();?>"><?php echo substr(get_the_title(),0, $title_limit); if(strlen(get_the_title())>$title_limit){echo '...';}?></a></h2>
				  <ul class="post-options">
                    <li><i class="icon-calendar4"></i><time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n(get_option('date_format'),strtotime(get_the_date()));?></time></li>
                     <?php cs_featured(); ?>
                  </ul>
                  <?php if ($description == 'yes') {?><p><?php echo cs_get_the_excerpt($excerpt,'false','');?></p><?php } ?>
                  <a href="<?php the_permalink();?>" class="readmore-btn"><?php _e('Read More','Lawyer')?><img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-icon.png" alt="read_more"></a>
					<ul class="post-option-btn">
                    <li><a href="<?php comments_link(); ?>"><i class="icon-comment2"></i><?php echo comments_number(__('0', 'Lawyer'), __('1', 'Lawyer'), __('%', 'Lawyer') );?> </a></li>
                   
                  </ul>
                </section>
			  </div>
			</div>
			
		<?php 
		cs_blog_masonry();
		}
		
	}
}