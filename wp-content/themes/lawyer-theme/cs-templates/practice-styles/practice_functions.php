<?php
/**
 * File Type: Practice Shortcode
 */
	

//======================================================================
// Adding Practice Posts Start
//======================================================================
if (!function_exists('cs_practice_shortcode')) {
	function cs_practice_shortcode( $atts ) {
		global $post,$wpdb,$cs_theme_options,$cs_counter_node,$cs_xmlObject;
		$defaults = array('cs_practice_section_title'=>'','cs_practice_view'=>'','cs_practice_cat'=>'','cs_practice_orderby'=>'DESC','orderby'=>'ID','cs_practice_num_post'=>'10','practice_pagination'=>'','cs_practice_class' => '','cs_practice_animation' => '');
		extract( shortcode_atts( $defaults, $atts ) );
		
		$CustomId	= '';
		if ( isset( $cs_practice_class ) && $cs_practice_class ) {
			$CustomId	= 'id="'.$cs_practice_class.'"';
		}
		
		if ( trim($cs_practice_animation) !='' ) {
			$cs_custom_animation	= 'wow'.' '.$cs_practice_animation;
		} else {
			$cs_custom_animation	= '';
		}
		$owlcount = rand(40, 9999999);
		$cs_counter_node++;
		ob_start();
		
		if (isset($cs_xmlObject->sidebar_layout) && $cs_xmlObject->sidebar_layout->cs_page_layout <> '' and $cs_xmlObject->sidebar_layout->cs_page_layout <> "none"){				
				$cs_practice_layout = 'col-md-4';
		}else{
				$cs_practice_layout = 'col-md-3';	
		}
		
		//==Sorting
		
		if(isset($_GET['sort']) and $_GET['sort']=='asc'){
			$cs_practice_orderby	= 'ASC';
		} else{
			$cs_practice_orderby	= $cs_practice_orderby;
		}
		
		if(isset($_GET['sort']) and $_GET['sort']=='alphabetical'){
			$orderby				= 'title';
			$cs_practice_orderby	    = 'ASC';
		} else{
			$orderby	= 'meta_value';
		}
		
		//==Sorting End 
		
		if (empty($_GET['page_id_all'])) $_GET['page_id_all'] = 1;

		$cs_practice_num_post	= $cs_practice_num_post ? $cs_practice_num_post : '-1';
		
		$args = array('posts_per_page' => "-1", 'post_type' => 'practice', 'order' => $cs_practice_orderby, 'orderby' => $orderby, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
		
		if(isset($cs_practice_cat) && $cs_practice_cat <> '' &&  $cs_practice_cat <> '0'){
			$practice_category_array = array('practice-category' => "$cs_practice_cat");
			$args = array_merge($args, $practice_category_array);
		}
		
		$query = new WP_Query( $args );
		$count_post = $query->post_count;
		
		$cs_practice_num_post	= $cs_practice_num_post ? $cs_practice_num_post : '-1';
		$args = array('posts_per_page' => "$cs_practice_num_post", 'post_type' => 'practice', 'paged' => $_GET['page_id_all'], 'order' => $cs_practice_orderby, 'orderby' => $orderby, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
		
		if(isset($cs_practice_cat) && $cs_practice_cat <> '' &&  $cs_practice_cat <> '0'){
			$practice_category_array = array('practice-category' => "$cs_practice_cat");
			$args = array_merge($args, $practice_category_array);
		}
		
		if(isset($filter_category) && $filter_category <> '' && $filter_category <> '0'){
				
				if ( isset($_GET['filter-tag']) ) {$filter_tag = $_GET['filter-tag'];}
				if($filter_tag <> ''){
					$practice_category_array = array('practice-category' => "$filter_category",'tag' => "$filter_tag");
				}else{
					$practice_category_array = array('practice-category' => "$filter_category");
				}
				$args = array_merge($args, $practice_category_array);
			}
					
		if ( $cs_practice_cat !='' && $cs_practice_cat !='0'){ 
			$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_practice_cat ));
		}
		
		$outerDivStart	= '';
		$outerDivEnd	= '';
		$section_title  = '';
		
		if(isset($cs_practice_section_title) && trim($cs_practice_section_title) <> ''){
			$section_title = '<div class="main-title col-md-12"><div class="cs-section-title"><h2>'.$cs_practice_section_title.'</h2></div></div>';
		}
		
		$randomId = cs_generate_random_string('10');
		
		$query = new WP_Query( $args );
		$post_count = $query->post_count;
		
		
		if ( $query->have_posts() ) {  
			$postCounter	= 0;
                      
					  echo cs_allow_special_char($outerDivStart);
					  echo cs_allow_special_char( $section_title );
					  $practiceObject	= new PracticeTemplates();
                      while ( $query->have_posts() )  : $query->the_post();
					  		
					  $postCounter++;
					  $last_child = ( $post_count == $postCounter ) ? 'last_child' : '' ;
							if ( $cs_practice_view == 'grid-3-column' ) {
								echo $practiceObject->cs_grid_3_view( $atts );
							} else if ( $cs_practice_view == 'grid-modern' ) {
								echo $practiceObject->cs_grid_modern_view( $atts );
							} else if ( $cs_practice_view == 'grid-4-columns' ) {
								echo $practiceObject->cs_grid_4_view( $atts);
							} else if ( $cs_practice_view == 'grid-curved' ) {
								echo $practiceObject->cs_grid_curved( $atts );
							} else {
								echo $practiceObject->cs_grid_3_view( $atts );
							}
						
					  endwhile;
					  echo cs_allow_special_char( $outerDivEnd );
					  //==Pagination Start
						 if ( $practice_pagination == "Show Pagination" && $count_post > $cs_practice_num_post && $cs_practice_num_post > 0 ) {
							$qrystr = '';
							 if ( isset($_GET['page_id']) ) $qrystr .= "&amp;page_id=".$_GET['page_id'];
							 if ( isset($_GET['by_author']) ) $qrystr .= "&amp;by_author=".$_GET['by_author'];
							 if ( isset($_GET['sort']) ) $qrystr .= "&amp;sort=".$_GET['sort'];
							 if ( isset($_GET['filter_category']) ) $qrystr .= "&amp;filter_category=".$_GET['filter_category'];
							 if ( isset($_GET['filter-tag']) ) $qrystr .= "&amp;filter-tag=".$_GET['filter-tag'];
								 
							echo cs_pagination($count_post, $cs_practice_num_post,$qrystr,'Show Pagination');
						 }
					 //==Pagination End	
					 ?>                   
            <?php 
            }
            
		    wp_reset_postdata();	
                
            $post_data = ob_get_clean();
			
            return $post_data;
         }
	add_shortcode( 'cs_practice', 'cs_practice_shortcode' );
}
