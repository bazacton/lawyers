<?php
/**
 * File Type: Team Page Builder Element
 */


//======================================================================
// Team html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_post_team' ) ) {
	function cs_pb_post_team($die = 0){
		global $cs_node, $post;
		$shortcode_element = '';
		$filter_element = 'filterdrag';
		$shortcode_view = '';
		$output = array();
		$counter = $_POST['counter'];
		$cs_counter = $_POST['counter'];
		if ( isset($_POST['action']) && !isset($_POST['shortcode_element_id']) ) {
			$POSTID = '';
			$shortcode_element_id = '';
		} else {
			$POSTID = $_POST['POSTID'];
			$shortcode_element_id = $_POST['shortcode_element_id'];
			$shortcode_str = stripslashes ($shortcode_element_id);
			$PREFIX = 'cs_post_team';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_post_team_section_title'=>'','cs_post_team_view'=>'','cs_team_cat' =>'','cs_post_team_orderby'=>'DESC','orderby'=>'ID','cs_post_team_num_post'=>'10','post_team_pagination'=>'','cs_post_team_class' => '','cs_post_team_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			$post_team_element_size = '50';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_post_team';
			$coloumn_class = 'column_'.$post_team_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
    <div id="<?php echo esc_attr( $name.$cs_counter );?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class );?> <?php echo esc_attr( $shortcode_view );?>" item="post_team" data="<?php echo element_size_data_array_index($post_team_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$post_team_element_size);?>
      <div class="cs-wrapp-class-<?php echo intval( $cs_counter )?> <?php echo esc_attr( $shortcode_element );?>" id="<?php echo esc_attr( $name.$cs_counter )?>" data-shortcode-template="[cs_post_team {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Team Options','Lawyer');?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_js( $name.$cs_counter );?>','<?php echo esc_js( $filter_element );?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
        <div class="cs-pbwp-content">
          <div class="cs-wrapp-clone cs-shortcode-wrapp">
            <?php
             if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Section Title','Lawyer');?></label></li>
                <li class="to-field">
                    <input  name="cs_post_team_section_title[]" type="text"  value="<?php echo esc_attr( $cs_post_team_section_title )?>"   />
                </li>                  
             </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Team Design Views','Lawyer');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
				    <select name="cs_post_team_view[]" class="dropdown">
                      <option value="grid-4-column" <?php if($cs_post_team_view == 'grid-4-column'){echo 'selected="selected"';}?>><?php _e('Grid 4 Column','Lawyer');?></option>
                      <option value="modern" <?php if($cs_post_team_view == 'modern'){echo 'selected="selected"';}?>><?php _e('Modern','Lawyer');?></option>
                      <option value="classic" <?php if($cs_post_team_view == 'classic'){echo 'selected="selected"';}?>><?php _e('Classic','Lawyer');?></option>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts','Lawyer');?></p>
                </div>
              </li>
            </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Choose Category','Lawyer');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <div class="select-style">
                    <select name="cs_team_cat[]" class="dropdown">
                      <option value="0"><?php _e('Select Category','Lawyer');?></option>
                      <?php show_all_cats('', '', $cs_team_cat, "team-category");?>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts','Lawyer');?></p>
                </div>
              </li>
            </ul>
            
            <div id="Team-listing<?php echo intval($cs_counter);?>" >
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Team Order','Lawyer');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <div class="select-style">
                      <select name="cs_post_team_orderby[]" class="dropdown" >
                        <option <?php if($cs_post_team_orderby=="ASC")echo "selected";?> value="ASC"><?php _e('Asc','Lawyer');?></option>
                        <option <?php if($cs_post_team_orderby=="DESC")echo "selected";?> value="DESC"><?php _e('DESC','Lawyer');?></option>
                      </select>
                    </div>
                  </div>
                </li>
              </ul>
              
            </div>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('No. of Post Per Page','Lawyer');?></label>
              </li>
              <li class="to-field">
                <div class="input-sec">
                  <input type="text" name="cs_post_team_num_post[]" class="txtfield" value="<?php echo esc_attr( $cs_post_team_num_post ); ?>" />
                </div>
                <div class="left-info">
                  <p><?php _e('To display all the records, leave this field blank','Lawyer');?></p>
                </div>
              </li>
            </ul>
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Pagination','Lawyer');?></label>
              </li>
              <li class="to-field select-style">
                <select name="post_team_pagination[]" class="dropdown">
                  <option <?php if($post_team_pagination=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination','Lawyer');?></option>
                  <option <?php if($post_team_pagination=="Single Page")echo "selected";?> ><?php _e('Single Page','Lawyer');?></option>
                </select>
              </li>
            </ul>
            <?php 
                if ( function_exists( 'cs_shortcode_custom_classes' ) ) {
                    cs_shortcode_custom_dynamic_classes($cs_post_team_class,$cs_post_team_animation,'','cs_post_team');
                }
            ?>
            <?php if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){?>
            <ul class="form-elements insert-bg">
              <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js( str_replace('cs_pb_','',$name) );?>','<?php echo esc_js( $name.$cs_counter )?>','<?php echo esc_js( $filter_element );?>')" ><?php _e('Insert','Lawyer');?></a> </li>
            </ul>
            <div id="results-shortocde"></div>
            <?php } else {?>
            <ul class="form-elements">
              <li class="to-label"></li>
              <li class="to-field">
                <input type="hidden" name="cs_orderby[]" value="post_team" />
                <input type="button" value="Save" style="margin-right:10px;" onclick="javascript:_removerlay(jQuery(this))" />
              </li>
            </ul>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
<?php
		if ( $die <> 1 ) die();
	}
	add_action('wp_ajax_cs_pb_post_team', 'cs_pb_post_team');
}