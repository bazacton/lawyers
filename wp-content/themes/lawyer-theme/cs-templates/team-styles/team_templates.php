<?php 
/**
 * File Type: Team Templates Class
 */
 

if ( !class_exists('TeamTemplates') ) {
	
	class TeamTemplates
	{
		
		function __construct()
		{
			// Constructor Code here..
		}
	
		//======================================================================
		// Team Grid View
		//======================================================================
		public function cs_grid_view($team_view='col-md-3') {
			global $post;
			$width = '263';
			$height = '452';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$cs_team = get_post_meta(get_the_ID(), "team", true);
			if ( $cs_team <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($cs_team);
				$cs_team_phone_num = $cs_xmlObject->cs_team_phone_num;
				$cs_team_fax_num = $cs_xmlObject->cs_team_fax_num;
				$cs_team_email = $cs_xmlObject->cs_team_email;
				$cs_team_subtitle = $cs_xmlObject->cs_team_subtitle;
				$cs_team_facebook = $cs_xmlObject->cs_team_facebook;
				$cs_team_twitter = $cs_xmlObject->cs_team_twitter;
				$cs_team_google_plus = $cs_xmlObject->cs_team_google_plus;
				$cs_team_linked_in = $cs_xmlObject->cs_team_linked_in;
				$cs_team_vcard = $cs_xmlObject->cs_team_vcard;
				$cs_team_education_title = $cs_xmlObject->cs_team_education_title;
				$cs_team_practices_title = $cs_xmlObject->cs_team_practices_title;
				$cs_team_rich_edit_title = $cs_xmlObject->cs_team_rich_edit_title;
				
			} else {
				$cs_team_phone_num = '';
				$cs_team_fax_num = '';
				$cs_team_email = '';
				$cs_team_admissions = '';
				$cs_team_certifications = '';
				$cs_team_subtitle = '';
				$cs_team_facebook = '';
				$cs_team_twitter = '';
				$cs_team_google_plus = '';
				$cs_team_linked_in = '';
				$cs_team_vcard = '';
				$cs_team_education_title = '';
				$cs_team_practices_title = '';
				$cs_team_rich_edit_title = 'Professional Experience';
				
				if(!isset($cs_xmlObject))
					$cs_xmlObject = new stdClass();
			}
				
			?>
			<div class="<?php echo cs_allow_special_char($team_view); ?>">
                      <article class="cs-team team_grid_sh has-border">
                      
                          <figure>
                          <?php if($thumbnail<>''){ ?>
                              <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title();?>"></a>
                          <?php } ?>
                          
                          <?php if($cs_team_facebook<>'' || $cs_team_twitter<>'' || $cs_team_google_plus<>'' || $cs_team_linked_in<>''){ ?>
                              <figcaption>
                                  <div class="sg-socialmedia">
                                      <ul>
                                      	<?php if($cs_team_facebook<>''){ ?>
                                          <li><a data-original-title="Facebook" href="<?php echo esc_url($cs_team_facebook);?>"><i class="icon-facebook2"></i></a></li>
                                         <?php } 
										 	if($cs_team_twitter<>''){
										 ?>
                                          <li><a data-original-title="twitter" href="<?php echo esc_url($cs_team_twitter);?>"><i class="icon-twitter6"></i></a></li>
                                           <?php } 
										 	if($cs_team_google_plus<>''){
										 ?>
                                          <li><a data-original-title="google-plus" href="<?php echo esc_url($cs_team_google_plus); ?>"><i class="icon-googleplus7"></i></a></li>
                                           <?php } 
										 	if($cs_team_linked_in<>''){
										 ?>
                                          <li><a data-original-title="instagram" href="<?php echo esc_url($cs_team_linked_in); ?>"><i class="icon-linkedin4"></i></a></li>
                                          <?php } ?>
                                      </ul>
                                  </div>
                              </figcaption>
                          <?php } ?>
                          </figure>
                         
                          <div class="text">
                              <header>
                              <?php if($cs_team_subtitle<>''){ 
                                  		echo '<span>'.$cs_team_subtitle.'</span>';
                                } ?>
                                  <h2 class="cs-post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                              </header>
                              <ul class="post-options">
                              <?php if($cs_team_phone_num<>''){ ?>
                                <li>
                                  <span><?php _e('Phone Number','Lawyer');?></span>
                                  <p><?php echo cs_allow_special_char($cs_team_phone_num); ?></p>
                                </li>
                                <?php
							 	 }
							  	if($cs_team_email<>''){ 
								?>
                                <li>
                                  <span><?php _e('Email Address','Lawyer');?></span>
                                  <a href="mailto:<?php echo cs_allow_special_char($cs_team_email);?>"><?php echo cs_allow_special_char($cs_team_email); ?></a>
                                </li>
                                <?php } ?>
                              </ul>
                              <a href="<?php the_permalink();?>" class="Profile-btn"><?php _e('View Profile','Lawyer');?></a>
                          </div>
                      </article>
              </div>
		<?php 
		}
		
		
		//======================================================================
		// Team Modern View
		//======================================================================
		public function cs_modern_view() { 
			global $post;
			$width = '460';
			$height = '460';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			
			$cs_team = get_post_meta(get_the_ID(), "team", true);
			if ( $cs_team <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($cs_team);
				$cs_team_phone_num = $cs_xmlObject->cs_team_phone_num;
				$cs_team_fax_num = $cs_xmlObject->cs_team_fax_num;
				$cs_team_email = $cs_xmlObject->cs_team_email;
				$cs_team_subtitle = $cs_xmlObject->cs_team_subtitle;
				$cs_team_facebook = $cs_xmlObject->cs_team_facebook;
				$cs_team_twitter = $cs_xmlObject->cs_team_twitter;
				$cs_team_google_plus = $cs_xmlObject->cs_team_google_plus;
				$cs_team_linked_in = $cs_xmlObject->cs_team_linked_in;
				$cs_team_vcard = $cs_xmlObject->cs_team_vcard;
				$cs_team_education_title = $cs_xmlObject->cs_team_education_title;
				$cs_team_practices_title = $cs_xmlObject->cs_team_practices_title;
				$cs_team_rich_edit_title = $cs_xmlObject->cs_team_rich_edit_title;
				
			} else {
				$cs_team_phone_num = '';
				$cs_team_fax_num = '';
				$cs_team_email = '';
				$cs_team_admissions = '';
				$cs_team_certifications = '';
				$cs_team_subtitle = '';
				$cs_team_facebook = '';
				$cs_team_twitter = '';
				$cs_team_google_plus = '';
				$cs_team_linked_in = '';
				$cs_team_vcard = '';
				$cs_team_education_title = '';
				$cs_team_practices_title = '';
				
				if(!isset($cs_xmlObject))
					$cs_xmlObject = new stdClass();
			}
		?>
			<div class="col-md-4">
                <article class="cs-team team_grid_sh has-border btn-position-top">
                    <figure>
                     <?php if($thumbnail<>''){ ?>
                        <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title();?>"></a>
                     <?php } ?>
                      <?php if($cs_team_facebook<>'' || $cs_team_twitter<>'' || $cs_team_google_plus<>'' || $cs_team_linked_in<>''){ ?>
                        <figcaption>
                            <div class="sg-socialmedia">
                                <ul>
									<?php if($cs_team_facebook<>''){ ?>
                                      <li><a data-original-title="Facebook" href="<?php echo esc_url($cs_team_facebook);?>"><i class="icon-facebook2"></i></a></li>
                                     <?php } 
                                        if($cs_team_twitter<>''){
                                     ?>
                                      <li><a data-original-title="twitter" href="<?php echo esc_url($cs_team_twitter);?>"><i class="icon-twitter6"></i></a></li>
                                       <?php } 
                                        if($cs_team_google_plus<>''){
                                     ?>
                                      <li><a data-original-title="google-plus" href="<?php echo esc_url($cs_team_google_plus); ?>"><i class="icon-googleplus7"></i></a></li>
                                       <?php } 
                                        if($cs_team_linked_in<>''){
                                     ?>
                                      <li><a data-original-title="instagram" href="<?php echo esc_url($cs_team_linked_in); ?>"><i class="icon-linkedin4"></i></a></li>
                                      <?php } ?>
                                  </ul>
                            </div>
                        </figcaption>
                       <?php } ?>
                    </figure>
                    <div class="text">
                        <header>
                            <?php if($cs_team_subtitle<>''){ 
									echo '<span>'.$cs_team_subtitle.'</span>';
							} ?>
                             <h2 class="cs-post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                        </header>
                       		<ul class="post-options">
                              <?php if($cs_team_phone_num<>''){ ?>
                                <li>
                                  <span><?php _e('Phone Number','Lawyer');?></span>
                                  <p><?php echo cs_allow_special_char($cs_team_phone_num); ?></p>
                                </li>
                                <?php
							 	 }
							  	if($cs_team_email<>''){ 
								?>
                                <li>
                                  <span><?php _e('Email Address','Lawyer');?></span>
                                  <a href="mailto:<?php echo cs_allow_special_char($cs_team_email);?>"><?php echo cs_allow_special_char($cs_team_email); ?></a>
                                </li>
                                <?php } ?>
                           </ul>
                    </div>
                    <a href="<?php the_permalink();?>" class="Profile-btn"><?php _e('View Profile','Lawyer');?></a>
                </article>
            </div>
            	
		<?php
        }
		
		
		//======================================================================
		// Team Classic View
		//======================================================================
		public function cs_classic_view() {
			global $post;
			$width = '460';
			$height = '460';
			$title_limit = 1000;
			$thumbnail = cs_get_post_img_src( $post->ID, $width, $height );
			
			$cs_team = get_post_meta(get_the_ID(), "team", true);
			if ( $cs_team <> "" ) {
				$cs_xmlObject = new SimpleXMLElement($cs_team);
				$cs_team_phone_num = $cs_xmlObject->cs_team_phone_num;
				$cs_team_fax_num = $cs_xmlObject->cs_team_fax_num;
				$cs_team_email = $cs_xmlObject->cs_team_email;
				$cs_team_subtitle = $cs_xmlObject->cs_team_subtitle;
				$cs_team_facebook = $cs_xmlObject->cs_team_facebook;
				$cs_team_twitter = $cs_xmlObject->cs_team_twitter;
				$cs_team_google_plus = $cs_xmlObject->cs_team_google_plus;
				$cs_team_linked_in = $cs_xmlObject->cs_team_linked_in;
				$cs_team_vcard = $cs_xmlObject->cs_team_vcard;
				$cs_team_education_title = $cs_xmlObject->cs_team_education_title;
				$cs_team_practices_title = $cs_xmlObject->cs_team_practices_title;
				$cs_team_rich_edit_title = $cs_xmlObject->cs_team_rich_edit_title;
				
			} else {
				$cs_team_phone_num = '';
				$cs_team_fax_num = '';
				$cs_team_email = '';
				$cs_team_admissions = '';
				$cs_team_certifications = '';
				$cs_team_subtitle = '';
				$cs_team_facebook = '';
				$cs_team_twitter = '';
				$cs_team_google_plus = '';
				$cs_team_linked_in = '';
				$cs_team_vcard = '';
				$cs_team_education_title = '';
				$cs_team_practices_title = '';
				$cs_team_rich_edit_title = 'Professional Experience';
				
				if(!isset($cs_xmlObject))
					$cs_xmlObject = new stdClass();
			}
				
			?>
			<div class="col-md-4">
              	<article class="cs-team team_grid_sh btn-position-bottom">
                  <?php if($thumbnail<>''){ ?>
                       <figure> <a href="<?php the_permalink();?>"><img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>"></a></figure>
                    <?php } ?>
                  <div class="text">
                      <header>
                          <?php if($cs_team_subtitle<>''){ 
									echo '<span>'.$cs_team_subtitle.'</span>';
							} ?>
                          <h2 class="cs-post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                      </header>
                      <div class="sg-socialmedia">
                                <ul>
									<?php if($cs_team_facebook<>''){ ?>
                                      <li><a data-original-title="Facebook" href="<?php echo esc_url($cs_team_facebook);?>"><i class="icon-facebook2"></i></a></li>
                                     <?php } 
                                        if($cs_team_twitter<>''){
                                     ?>
                                      <li><a data-original-title="twitter" href="<?php echo esc_url($cs_team_twitter);?>"><i class="icon-twitter6"></i></a></li>
                                       <?php } 
                                        if($cs_team_google_plus<>''){
                                     ?>
                                      <li><a data-original-title="google-plus" href="<?php echo esc_url($cs_team_google_plus); ?>"><i class="icon-googleplus7"></i></a></li>
                                       <?php } 
                                        if($cs_team_linked_in<>''){
                                     ?>
                                      <li><a data-original-title="instagram" href="<?php echo esc_url($cs_team_linked_in); ?>"><i class="icon-linkedin4"></i></a></li>
                                      <?php } ?>
                              </ul>
                            </div>
                  </div>
                  <a href="<?php the_permalink();?>" class="Profile-btn"><?php _e('View Profile','Lawyer');?></a>
              </article>
          </div>
		<?php 
		
		}
		
	}
}