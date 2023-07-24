<?php
/**
 * File Type: Blog Shortcode
 */
	

//======================================================================
// Adding Blog Posts Start
//======================================================================
if (!function_exists('cs_casestudy_shortcode')) {
	function cs_casestudy_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_xmlObject;
		$defaults = array('cs_casestudy_section_title'=>'','cs_casestudy_cat'=>'','cs_casestudy_orderby'=>'DESC','orderby'=>'ID','cs_casestudy_num_post'=>'10','cs_case_excerpt'=>'500','casestudy_pagination'=>'','cs_casestudy_class' => '','cs_casestudy_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$CustomId	= '';
		if ( isset( $cs_casestudy_class ) && $cs_casestudy_class ) {
			$CustomId	= 'id="'.$cs_casestudy_class.'"';
		}
		
		if ( trim($cs_casestudy_animation) !='' ) {
			$cs_casestudy_animation	= 'wow'.' '.$cs_casestudy_animation;
		} else {
			$cs_casestudy_animation	= '';
		}
		$owlcount = rand(40, 9999999);
		$cs_counter_node++;
		ob_start();
		
		//==Filters
		$filter_category = '';
		$filter_tag = '';
		$author_filter = '';

		//==Sorting
		
		//==Sorting End 
		
		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		$cs_casestudy_num_post	= $cs_casestudy_num_post ? $cs_casestudy_num_post : '-1';
		
		$args = array('posts_per_page' => "-1", 'post_type' => 'casestudy', 'order' => $cs_casestudy_orderby, 'orderby' => $orderby, 'post_status' => 'publish');
		if(isset($cs_casestudy_cat) && $cs_casestudy_cat <> '' &&  $cs_casestudy_cat <> '0'){
			$casestudy_cat = array('casestudy-category' => "$cs_casestudy_cat");
			$args = array_merge($args, $casestudy_cat);
		}
		
		$query = new WP_Query( $args );
		$count_post = $query->post_count;
		
		$cs_casestudy_num_post	= $cs_casestudy_num_post ? $cs_casestudy_num_post : '-1';
		
		$args = array('posts_per_page' => "$cs_casestudy_num_post", 'post_type' => 'casestudy', 'paged' => $_GET['page_id_all'], 'order' => $cs_casestudy_orderby, 'orderby' => $orderby, 'post_status' => 'publish');
		
		if(isset($cs_casestudy_cat) && $cs_casestudy_cat <> '' &&  $cs_casestudy_cat <> '0'){
			$var_casestudy_cat = array('casestudy-category' => "$cs_casestudy_cat");
			$args = array_merge($args, $var_casestudy_cat);
		}
		
		$outerDivStart	= '<div '.$CustomId.' class="'.$cs_casestudy_animation.'">';
		$outerDivEnd	= '</div>';
		$section_title  = '';
		
		if(isset($cs_casestudy_section_title) && trim($cs_casestudy_section_title) <> ''){
			$section_title = '<div class="main-title col-md-12"><div class="cs-section-title"><h2>'.$cs_casestudy_section_title.'</h2></div></div>';
		}

		$query = new WP_Query( $args );
		
		
		if ( $query->have_posts() ) {  
			$postCounter	= 0;
                    	
					  echo cs_allow_special_char($outerDivStart);
					  echo cs_allow_special_char( $section_title );
					  $caseObject	= new caseStudyTemplates();
                      while ( $query->have_posts() )  : $query->the_post();
					  		
						$caseObject->cs_casestudy_list($cs_case_excerpt);
							
					  endwhile;
					  echo cs_allow_special_char( $outerDivEnd );
						  //==Pagination Start
							 if ( $casestudy_pagination == "Show Pagination" && $count_post > $cs_casestudy_num_post && $cs_casestudy_num_post > 0 ) {
								$qrystr = '';
								 if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
								 									 
								echo cs_pagination($count_post, $cs_casestudy_num_post,$qrystr,'Show Pagination');
							 }
						 //==Pagination End	
                         ?>                   
            <?php 
            }
            
		    wp_reset_postdata();	
                
            $post_data = ob_get_clean();
            return $post_data;
         }
	add_shortcode( 'cs_casestudy', 'cs_casestudy_shortcode' );
}
