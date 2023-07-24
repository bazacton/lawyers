<?php
/**
 * The template for displaying all single posts
 */
 	global $cs_node,$post,$cs_theme_options,$cs_counter_node;
	
	$cs_uniq = rand(40, 9999999);
	if ( is_single() ) {
		cs_set_post_views($post->ID);
	}	
	$cs_node = new stdClass();
  	get_header();
 	$cs_layout = '';
	$leftSidebarFlag	= false;
	$rightSidebarFlag	= false;
	?>
<!-- PageSection Start -->

<section class="page-section" style=" padding: 0; "> 
  <!-- Container -->
  <div class="container"> 
    <!-- Row -->
    <div class="row">
      <?php
	if (have_posts()):
		while (have_posts()) : the_post();	
		$cs_tags_name = '';
		$cs_categories_name = 'casestudy-category';
		$postname = 'casestudy';
		$image_url = cs_get_post_img_src($post->ID, 820, 462);	

		$post_xml = get_post_meta($post->ID, "casestudy", true);	
			if ( $post_xml <> "" ) {
			
				$cs_xmlObject = new SimpleXMLElement($post_xml);
				$cs_layout 			= $cs_xmlObject->sidebar_layout->cs_page_layout;
				$cs_sidebar_left 	= $cs_xmlObject->sidebar_layout->cs_page_sidebar_left;
				$cs_sidebar_right   = $cs_xmlObject->sidebar_layout->cs_page_sidebar_right;
				if(isset($cs_xmlObject->cs_related_post))
					$cs_related_post = $cs_xmlObject->cs_related_post;
				else 
					$cs_related_post = '';
				
				if(isset($cs_xmlObject->cs_post_tags_show))
					$post_tags_show = $cs_xmlObject->cs_post_tags_show;
				else 
					$post_tags_show = '';
				
				if(isset($cs_xmlObject->post_social_sharing))
					$cs_post_social_sharing = $cs_xmlObject->post_social_sharing;
				else 
					$cs_post_social_sharing = '';
				
				if(isset($cs_xmlObject->cs_post_author_info_show))
					 $cs_post_author_info_show = $cs_xmlObject->cs_post_author_info_show;
				else 
					$cs_post_author_info_show = '';
				
				if(isset($cs_xmlObject->post_pagination_show))
					 $post_pagination_show = $cs_xmlObject->post_pagination_show;
				else 
					$post_pagination_show = '';

				if ( $cs_layout == "left") {
					$cs_layout = "page-content blog-editor";
					$custom_height = 408;
					$leftSidebarFlag	= true;
				}
				else if ( $cs_layout == "right" ) {
					$cs_layout = "page-content blog-editor";
					$custom_height = 408;
					$rightSidebarFlag	= true;
				}
				else {
					$cs_layout = "col-md-12";
					$custom_height = 408;
				}
			}else{
				$cs_layout 	=  $cs_theme_options['cs_single_post_layout'];
				if ( isset( $cs_layout ) && $cs_layout == "sidebar_left") {
					$cs_layout = "page-content blog-editor";
					$cs_sidebar_left	= $cs_theme_options['cs_single_layout_sidebar'];
					$custom_height = 408;
					$leftSidebarFlag	= true;
				} else if ( isset( $cs_layout ) && $cs_layout == "sidebar_right" ) {
					$cs_layout = "page-content blog-editor";
					$cs_sidebar_right	= $cs_theme_options['cs_single_layout_sidebar'];
					$custom_height = 408;
					$rightSidebarFlag	= true;
				} else {
					$cs_layout = "col-md-12";
					$custom_height = 408;
				}
  				$post_pagination_show = 'on';
				$post_tags_show = '';
				$cs_related_post = '';
				$post_social_sharing = '';
				$post_social_sharing = '';
				$cs_post_author_info_show = '';
				$postname = 'casestudy';
				$cs_post_social_sharing = '';
			}
			
		if ( $post_xml <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($post_xml);
			$cs_casestudy_case_charge = $cs_xmlObject->cs_casestudy_case_charge;
			$cs_casestudy_verdict = $cs_xmlObject->cs_casestudy_verdict;
			$cs_casestudy_team = isset($cs_xmlObject->cs_casestudy_team) ? $cs_xmlObject->cs_casestudy_team : '';
			$cs_casestudy_case_charge_title = $cs_xmlObject->cs_casestudy_case_charge_title;
			$cs_casestudy_verdict_title = $cs_xmlObject->cs_casestudy_verdict_title;
			$cs_casestudy_rich_editor_title = $cs_xmlObject->cs_casestudy_rich_editor_title;
			$cs_casestudy_team_title = $cs_xmlObject->cs_casestudy_team_title;
			
		} else {
			$cs_casestudy_case_charge = '';
			$cs_casestudy_verdict = '';
			$cs_casestudy_team = '';
			$cs_casestudy_rich_editor_title = 'Description';
			$cs_casestudy_case_charge_title = 'Case Charge';
			$cs_casestudy_verdict_title = 'The Verdict';
			$cs_casestudy_team_title = 'Our Team';
			
			if(!isset($cs_xmlObject))
				$cs_xmlObject = new stdClass();
		}		
		$custom_height = 408;	
		$width = 820;
		$height = 462;
		$image_url = cs_get_post_img_src($post->ID, $width, $height);
		?>
      <!--Left Sidebar Starts-->
      <?php if ($leftSidebarFlag == true){ ?>
      <aside class="page-sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left) ) : ?>
        <?php endif; ?>
      </aside>
      <?php } ?>
      <!--Left Sidebar End--> 
      
      <!-- casestudy Detail Start -->
      <div class="<?php echo esc_attr($cs_layout); ?>"> 
        <!-- casestudy Start --> 
        <!-- Row --> 
          <div class="col-md-12">
            <?php 
				if (isset($image_url) and $image_url <> '') {
							echo '<figure class="detailpost">
										<img src="'.$image_url.'" alt="" >
            				 	  </figure>';
			}
			?>
           		<ul class="post-options">
                   <li><i class="icon-calendar4"></i><time datetime="<?php echo date_i18n('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date()));?></time></li>
                </ul>
          </div>

          <div class="col-md-12">
            
            <div class="rich_editor_text blog-editor">
                <?php 
                    the_content();
                    wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages', 'Lawyer' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); 
                ?>
            </div>
            <div class="casedetail">
                     <ul>
                         <?php if($cs_casestudy_case_charge<>''){ 
							echo '<li>
										<h3>'.$cs_casestudy_case_charge_title.'</h3>
										<p>'.$cs_casestudy_case_charge.'</p>
								</li>';
						}
						if($cs_casestudy_verdict<>''){ 
							echo '<li>
										<h3>'.$cs_casestudy_verdict_title.'</h3>
										<p>'.$cs_casestudy_verdict.'</p>
								</li>';
						}
						 ?>
                        </ul>
                    </div>
          </div>
           
         <?php if ($cs_post_social_sharing == "on"){?>
          <div class="col-md-12">
           <div class="detail-post">
              <div class="socialmedia">
                <?php cs_social_share(false,true,'');?>
              </div>
            </div>
          </div>
		  <?php  }?>
          <?php 
		  		$team_view = 'col-md-4';
		  				if(!empty($cs_casestudy_team)){
								$cs_casestudy_team = json_decode(json_encode($cs_casestudy_team), true);
								$cs_casestudy_team = explode(',',$cs_casestudy_team[0]);
						
		  		$args = array('posts_per_page' => "-1",'post__in' => $cs_casestudy_team  ,'post_type' => 'team', 'orderby' => 'DESC', 'post_status' => 'publish');
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) { 
					echo '<div class="col-md-12" style="margin:0;">
								<div class="widget-section-title"><h2>'.__('Case Team','Lawyer').'</h2></div>
							</div> ';
					  $teamObject	= new TeamTemplates();
                      while ( $query->have_posts() )  : $query->the_post();
								$teamObject->cs_grid_view($team_view);
					  endwhile;
					  wp_reset_query();
				}
			}
		  ?>
          <div class="col-md-12">
            <?php if(isset($post_pagination_show) &&  $post_pagination_show == 'on'){
                  cs_next_prev_custom_links($postname);
             }
            ?>
          </div>
          
          <!-- Col Recent Posts Start -->
          <?php if($cs_related_post =='on'){} ?>
       <!-- Col Recent Posts End --> 
          
          <!-- Col Comments Start -->
		  <?php comments_template('', true); ?>
          <!-- Col Comments End --> 
          
          <!-- casestudy Post End --> 
        <!-- casestudy End --> 
       <!-- casestudy Detail End --> 
      <!-- Right Sidebar Start --> 
		
      <!-- Right Sidebar End -->
      <?php endwhile;   
		endif; ?>
        
    </div>
    <?php if ($rightSidebarFlag == true){ ?>
      		<aside class="page-sidebar">
       			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right) ) : endif; ?>
      		</aside>
      <?php } ?>
  </div>
  </div>
</section>
<!-- PageSection End --> 
<!-- Footer -->

<?php get_footer(); ?>