<?php
/**
 * File Type: CaseStudy Page Builder Element
 */


//======================================================================
// CaseStudy html form for page builder start
//======================================================================
if ( ! function_exists( 'cs_pb_casestudy' ) ) {
	function cs_pb_casestudy($die = 0){
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
			$PREFIX = 'cs_casestudy';
			$parseObject 	= new ShortcodeParse();
			$output = $parseObject->cs_shortcodes( $output, $shortcode_str , true , $PREFIX );
		}
		$defaults = array('cs_casestudy_section_title'=>'','cs_casestudy_cat'=>'','cs_casestudy_orderby'=>'DESC','orderby'=>'ID','cs_casestudy_num_post'=>'10','cs_case_excerpt'=>'500','casestudy_pagination'=>'','cs_casestudy_class' => '','cs_casestudy_animation' => '');
			if(isset($output['0']['atts']))
				$atts = $output['0']['atts'];
			else 
				$atts = array();
			$casestudy_element_size = '50';
			foreach($defaults as $key=>$values){
				if(isset($atts[$key]))
					$$key = $atts[$key];
				else 
					$$key =$values;
			 }
			$name = 'cs_pb_casestudy';
			$coloumn_class = 'column_'.$casestudy_element_size;
		if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){
			$shortcode_element = 'shortcode_element_class';
			$shortcode_view = 'cs-pbwp-shortcode';
			$filter_element = 'ajax-drag';
			$coloumn_class = '';
		}
	?>
    <div id="<?php echo esc_attr( $name.$cs_counter );?>_del" class="column  parentdelete <?php echo esc_attr( $coloumn_class );?> <?php echo esc_attr( $shortcode_view );?>" item="casestudy" data="<?php echo element_size_data_array_index($casestudy_element_size)?>">
      <?php cs_element_setting($name,$cs_counter,$casestudy_element_size);?>
      <div class="cs-wrapp-class-<?php echo intval( $cs_counter )?> <?php echo esc_attr( $shortcode_element );?>" id="<?php echo esc_attr( $name.$cs_counter )?>" data-shortcode-template="[cs_casestudy {{attributes}}]"  style="display: none;">
        <div class="cs-heading-area">
          <h5><?php _e('Edit Case Study Options','Lawyer'); ?></h5>
          <a href="javascript:removeoverlay('<?php echo esc_js( $name.$cs_counter );?>','<?php echo esc_js( $filter_element );?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
        <div class="cs-pbwp-content">
          <div class="cs-wrapp-clone cs-shortcode-wrapp">
            <?php
             if(isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode'){cs_shortcode_element_size();}?>
            <ul class="form-elements">
                <li class="to-label"><label><?php _e('Section Title','Lawyer');?></label></li>
                <li class="to-field">
                    <input  name="cs_casestudy_section_title[]" type="text"  value="<?php echo esc_attr( $cs_casestudy_section_title )?>"   />
                </li>                  
             </ul>
            
            
            <div id="casestudy-listing<?php echo intval($cs_counter);?>" >
              <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Case Study Order','Lawyer');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <div class="select-style">
                      <select name="cs_casestudy_orderby[]" class="dropdown" >
                        <option <?php if($cs_casestudy_orderby=="ASC")echo "selected";?> value="ASC"><?php _e('Asc','Lawyer');?></option>
                        <option <?php if($cs_casestudy_orderby=="DESC")echo "selected";?> value="DESC"><?php _e('DESC','Lawyer');?></option>
                      </select>
                    </div>
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
                    <select name="cs_casestudy_cat[]" class="dropdown">
                      <option value="0"><?php _e('Select Category','Lawyer');?></option>
                      <?php show_all_cats('', '', $cs_casestudy_cat, "casestudy-category");?>
                    </select>
                  </div>
                </div>
                <div class="left-info">
                  <p><?php _e('Please select category to show posts. If you dont select category it will display all posts.','Lawyer');?></p>
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
                  <input type="text" name="cs_casestudy_num_post[]" class="txtfield" value="<?php echo esc_attr( $cs_casestudy_num_post ); ?>" />
                </div>
                <div class="left-info">
                  <p><?php _e('To display all the records, leave this field blank','Lawyer');?></p>
                </div>
              </li>
            </ul>
            
            <ul class="form-elements">
                <li class="to-label">
                  <label><?php _e('Length of Excerpt','Lawyer');?></label>
                </li>
                <li class="to-field">
                  <div class="input-sec">
                    <input type="text" name="cs_case_excerpt[]" class="txtfield" value="<?php echo intval( $cs_case_excerpt );?>" />
                  </div>
                  <div class="left-info">
                    <p><?php _e('Enter number of character for short description text','Lawyer');?></p>
                  </div>
                </li>
              </ul>
            
            <ul class="form-elements">
              <li class="to-label">
                <label><?php _e('Pagination','Lawyer');?></label>
              </li>
              <li class="to-field select-style">
                <select name="casestudy_pagination[]" class="dropdown">
                  <option <?php if($casestudy_pagination=="Show Pagination")echo "selected";?> ><?php _e('Show Pagination','Lawyer');?></option>
                  <option <?php if($casestudy_pagination=="Single Page")echo "selected";?> ><?php _e('Single Page','Lawyer');?></option>
                </select>
              </li>
            </ul>
            <?php 
                if ( function_exists( 'cs_shortcode_custom_classes' ) ) {
                    cs_shortcode_custom_dynamic_classes($cs_casestudy_class,$cs_casestudy_animation,'','cs_casestudy');
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
                <input type="hidden" name="cs_orderby[]" value="casestudy" />
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
	add_action('wp_ajax_cs_pb_casestudy', 'cs_pb_casestudy');
}