<?php
/**
 * File Type: Team Shortcode
 */
	

//======================================================================
// Adding Team Posts Start
//======================================================================
if (!function_exists('cs_post_team_shortcode')) {
	function cs_post_team_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_xmlObject;
		$defaults = array('cs_post_team_section_title'=>'','cs_post_team_view'=>'','cs_team_cat' =>'','cs_post_team_orderby'=>'DESC','orderby'=>'ID','cs_post_team_num_post'=>'10','post_team_pagination'=>'','cs_post_team_class' => '','cs_post_team_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$CustomId	= '';
		if ( isset( $cs_post_team_class ) && $cs_post_team_class ) {
			$CustomId	= 'id="'.$cs_post_team_class.'"';
		}
		
		if ( trim($cs_post_team_animation) !='' ) {
			$cs_custom_animation	= 'wow'.' '.$cs_post_team_animation;
		} else {
			$cs_custom_animation	= '';
		}
		$owlcount = rand(40, 9999999);
		$cs_counter_node++;
		ob_start();
		
		if (isset($cs_xmlObject->sidebar_layout) && $cs_xmlObject->sidebar_layout->cs_page_layout <> '' and $cs_xmlObject->sidebar_layout->cs_page_layout <> "none"){				
				$cs_post_team_layout = 'col-md-4';
		}else{
				$cs_post_team_layout = 'col-md-3';	
		}
		
		//==Filters
		$filter_category = '';
		$filter_tag = '';
		$author_filter = '';
       	
		//==Sorting End 
		
		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		$cs_post_team_num_post	= $cs_post_team_num_post ? $cs_post_team_num_post : '-1';
		
		$args = array('posts_per_page' => "-1", 'post_type' => 'team', 'order' => $cs_post_team_orderby, 'orderby' => $orderby, 'post_status' => 'publish');
		if(isset($cs_team_cat) && $cs_team_cat <> '' &&  $cs_team_cat <> '0'){
			$team_cat = array('team-category' => "$cs_team_cat");
			$args = array_merge($args, $team_cat);
		}
		$query = new WP_Query( $args );
		$count_post = $query->post_count;
		
		$cs_post_team_num_post	= $cs_post_team_num_post ? $cs_post_team_num_post : '-1';
		$args = array('posts_per_page' => "$cs_post_team_num_post", 'post_type' => 'team', 'paged' => $_GET['page_id_all'], 'order' => $cs_post_team_orderby, 'orderby' => $orderby, 'post_status' => 'publish');

		if(isset($cs_team_cat) && $cs_team_cat <> '' &&  $cs_team_cat <> '0'){
			$cs_team_cat = array('team-category' => "$cs_team_cat");
			$args = array_merge($args, $cs_team_cat);
		}

		$outerDivStart	= '<div '.$CustomId.' class="'.$cs_custom_animation.'">';
		$outerDivEnd	= '</div>';
		$section_title  = '';
		
		if(isset($cs_post_team_section_title) && trim($cs_post_team_section_title) <> ''){
			$section_title = '<div class="main-title col-md-12"><div class="cs-section-title"><h2>'.$cs_post_team_section_title.'</h2></div></div>';
		}
		
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
		
	
		if ( $query->have_posts() ) {  
			$postCounter	= 0;
                    	
					  echo cs_allow_special_char($outerDivStart);
					  echo cs_allow_special_char( $section_title );
					  $post_teamObject	= new TeamTemplates();
                      while ( $query->have_posts() )  : $query->the_post();
					  		
					  $postCounter++;
							if ( $cs_post_team_view == 'grid-4-column' ) {
								$post_teamObject->cs_grid_view();
							} else if ( $cs_post_team_view == 'modern' ) {
								$post_teamObject->cs_modern_view();
							} else if ( $cs_post_team_view == 'classic' ) {
								$post_teamObject->cs_classic_view();
							} 
						
					  endwhile;
					  echo cs_allow_special_char( $outerDivEnd );
						  //==Pagination Start
							 if ( $post_team_pagination == "Show Pagination" && $count_post > $cs_post_team_num_post && $cs_post_team_num_post > 0 ) {
								$qrystr = '';
								 if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
	 
								echo cs_pagination($count_post, $cs_post_team_num_post,$qrystr,'Show Pagination');
							 }
						 //==Pagination End	
                         ?>                   
            <?php 
            }
            
		    wp_reset_postdata();	
                
            $post_data = ob_get_clean();
            return $post_data;
         }
	add_shortcode( 'cs_post_team', 'cs_post_team_shortcode' );
}
