<?php 
/**
 * File Type: Blog Templates Class
 */
 

if ( !class_exists('caseStudyTemplates') ) {
	
	class caseStudyTemplates
	{
		
		function __construct()
		{
			// Constructor Code here..
		}


		
		//======================================================================
		// Blog Grid View
		//======================================================================
		public function cs_casestudy_list($cs_case_excerpt='500'){
			global $post;
			$width = '263';
			$height = '452';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$cs_casestudy = get_post_meta(get_the_ID(), "casestudy", true);
		if ( $cs_casestudy <> "" ) {
			$cs_xmlObject = new SimpleXMLElement($cs_casestudy);
			$cs_casestudy_case_charge = $cs_xmlObject->cs_casestudy_case_charge;
			$cs_casestudy_verdict = $cs_xmlObject->cs_casestudy_verdict;
			$cs_casestudy_team = $cs_xmlObject->cs_casestudy_team;
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
		?>
        <div class="col-md-12">
                <article class="cs-cases">
                    <ul class="post-options">
                       <li><i class="icon-calendar4"></i><time datetime="<?php echo date('Y-m-d',strtotime(get_the_date()));?>"><?php echo date_i18n(get_option( 'date_format' ),strtotime(get_the_date()));?></time></li>
                    </ul>
                    <div class="cs-heading"><h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2></div>
                    <?php if($thumbnail<>''){ ?>
                        <figure class="frameshape">
                            <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($thumbnail);?>" alt=""></a>
                        </figure>
                    <?php } ?>
                    <ul>
                    	<?php if($cs_casestudy_case_charge<>''){ 
							echo '<li>
										<span>'.$cs_casestudy_case_charge_title.'</span>
										<a href="'.get_the_permalink().'">'.substr($cs_casestudy_case_charge,0,90).'</a>
								</li>';
						}
						if($cs_casestudy_verdict<>''){
								echo '<li>
											<span>'.$cs_casestudy_verdict_title.'</span>
											<a href="'.get_the_permalink().'">'.substr($cs_casestudy_verdict,0,90).'</a>
									</li>';
						}
						 if(!empty($cs_casestudy_team)){
								$cs_casestudy_team = json_decode(json_encode($cs_casestudy_team), true);
								$cs_casestudy_team = explode(',',$cs_casestudy_team[0]);
							}
                        if(!empty($cs_casestudy_team)){
								echo '<li>
											<span>'.$cs_casestudy_team_title.'</span>';
										foreach($cs_casestudy_team as $id){
											echo '<a href="'.get_the_permalink($id).'">'.get_the_title($id).'</a>';
										}
								echo '</li>';
						}
						?>
                        
                    </ul>
                    <div class="text">
                    <?php if($cs_casestudy_rich_editor_title){ 
                        	echo '<span>'.$cs_casestudy_rich_editor_title.'</span>';
					} 
						echo '<p>'.cs_get_the_excerpt($cs_case_excerpt,false,'Read more').'</p>';
						echo '<a href="'.get_the_permalink().'" class="read-more">'.__('Read more','Lawyer').'</a>';
					?>
                        
                    </div>
                </article>
                <?php echo do_shortcode('[cs_divider divider_style="zigzag" divider_backtotop="yes" divider_margin_top="20" divider_margin_bottom="7" divider_height="1"]'); ?>
         </div>
              
        <?php }
		
		}
	
}