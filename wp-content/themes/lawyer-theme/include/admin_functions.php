<?php
/**
 * Page Builder Functions 
 */
/**
 * @Generate Random String
 *
 *
 */
if (!function_exists('cs_generate_random_string')) {

    function cs_generate_random_string($length = 3) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}

/**
 * @Page builder Element (shortcode(s))
 *
 *
 */
if (!function_exists('cs_element_setting')) {

    function cs_element_setting($name, $cs_counter, $element_size, $element_description = '', $page_element_icon = 'fa-star', $type = '') {
        $element_title = str_replace("cs_pb_", "", $name);
        ?>
        <div class="column-in">
            <input type="hidden" name="<?php echo esc_attr($element_title); ?>_element_size[]" class="item" value="<?php echo esc_attr($element_size); ?>" >
            <!--<a href="javascript:;" onclick="javascript:_createclone(jQuery(this),'<?php echo esc_attr($cs_counter) ?>', '', '')" class="options"><i class="icon-star"></i></a>--><a href="javascript:;" onclick="javascript:_createpopshort(jQuery(this))" class="options"><i class="icon-gear"></i></a> <a href="#" class="delete-it btndeleteit"><i class="icon-trash-o"></i></a> &nbsp; <a class="decrement" onclick="javascript:decrement(this)"><i class="icon-minus4"></i></a> &nbsp; <a class="increment" onclick="javascript:increment(this)"><i class="icon-plus3"></i></a> 
            <span> <i class="cs-icon <?php echo str_replace("cs_pb_", "", $name); ?>-icon"></i> 
                <strong><?php echo strtoupper(str_replace('_', ' ', str_replace("cs_pb_", "", $name))) ?></strong><br/>
                <?php echo esc_attr($element_description); ?> </span>
        </div>
        <?php
    }

}


/**
 * @Page builder Element (shortcode(s))
 *
 */
if (!function_exists('cs_page_composer_elements')) {

    function cs_page_composer_elements($element = '', $icon = 'accordion-icon', $description = 'Dribble is community of designers') {
        echo '<i class="' . $icon . '"></i><span data-title="' . $element . '"> ' . $element . '</span>';
    }

}

/**
 * @Page builder Sorting List
 *
 *
 */
if (!function_exists('cs_elements_categories')) {

    function cs_elements_categories() {
        return array('typography' => __('Typography', 'Lawyer'), 'commonelements' => __('Common Elements', 'Lawyer'), 'mediaelement' => __('Media Element', 'Lawyer'), 'contentblocks' => __('Content Blocks', 'Lawyer'), 'loops' => __('Loops', 'Lawyer'));
    }

}

/**
 * @Page builder Ajax Element (shortcode(s))
 *
 *
 */
if (!function_exists('cs_ajax_element_setting')) {

    function cs_ajax_element_setting($name, $cs_counter, $element_size, $shortcode_element_id, $POSTID, $element_description = '', $page_element_icon = '', $type = '') {
        global $cs_node, $post;
        $element_title = str_replace("cs_pb_", "", $name);
        ?>
        <div class="column-in">
            <input type="hidden" name="<?php echo esc_attr($element_title); ?>_element_size[]" class="item" value="<?php echo esc_attr($element_size); ?>" >
             <!--<a href="javascript:;" onclick="javascript:_createclone(jQuery(this),'<?php echo esc_attr($cs_counter) ?>', '<?php echo esc_attr($shortcode_element_id); ?>', '<?php echo absint($POSTID); ?>')" class="options"><i class="icon-star"></i></a>--><a href="javascript:;" onclick="javascript:ajax_shortcode_widget_element(jQuery(this), '<?php echo esc_js(admin_url('admin-ajax.php')); ?>', '<?php echo esc_js($POSTID); ?>', '<?php echo esc_js($name); ?>')" class="options"><i class="icon-gear"></i></a><a href="#" class="delete-it btndeleteit"><i class="icon-trash-o"></i></a> &nbsp; <a class="decrement" onclick="javascript:decrement(this)"><i class="icon-minus4"></i></a> &nbsp; <a class="increment" onclick="javascript:increment(this)"><i class="icon-plus3"></i></a> 
            <span> <i class="cs-icon <?php echo str_replace("cs_pb_", "", $name); ?>-icon"></i> 
                <strong>
                    <?php
                    if ($cs_node->getName() == 'page_element') {
                        $element_name = $cs_node->element_name;
                        $element_name = str_replace("cs-", "", $element_name);
                    } else {
                        $element_name = $cs_node->getName();
                    }

                    echo strtoupper(str_replace('_', ' ', $element_name));
                    ?></strong><br/>
                <?php echo esc_attr($element_description); ?> </span>
        </div>
        <?php
    }

}

/**
 * @Page builder Section Settings
 *
 *
 */
if (!function_exists('cs_column_pb')) {

    function cs_column_pb($die = 0, $shortcode = '') {
        global $post, $cs_node, $cs_xmlObject, $cs_count_node, $column_container, $coloum_width;

        $total_widget = 0;


        $i = 1;
        $cs_page_section_title = $cs_page_section_height = $cs_page_section_width = '';
        $cs_section_background_option = '';
        $cs_section_bg_image = '';
        $cs_section_bg_image_position = '';
        $cs_section_parallax = '';
        $cs_section_flex_slider = '';
        $cs_section_custom_slider = '';
        $cs_section_video_url = '';
        $cs_section_video_mute = '';
        $cs_section_video_autoplay = '';
        $cs_section_border_bottom = '0';
        $cs_section_border_top = '0';
        $cs_section_border_color = '#e0e0e0';
        $cs_section_padding_top = '30';
        $cs_section_padding_bottom = '30';
        $cs_section_margin_top = '0';
        $cs_section_margin_bottom = '30';
        $cs_section_css_class = '';
        $cs_section_css_id = '';
        $cs_section_view = 'container';
        $cs_layout = '';

        $cs_sidebar_left = '';
        $cs_sidebar_right = '';
        $cs_section_bg_color = '';
        if (isset($column_container)) {
            $column_attributes = $column_container->attributes();
            $column_class = $column_attributes->class;
            $cs_section_background_option = $column_attributes->cs_section_background_option;
            $cs_section_bg_image = $column_attributes->cs_section_bg_image;
            $cs_section_bg_image_position = $column_attributes->cs_section_bg_image_position;
            $cs_section_flex_slider = $column_attributes->cs_section_flex_slider;
            $cs_section_custom_slider = $column_attributes->cs_section_custom_slider;
            $cs_section_video_url = $column_attributes->cs_section_video_url;
            $cs_section_video_mute = $column_attributes->cs_section_video_mute;
            $cs_section_video_autoplay = $column_attributes->cs_section_video_autoplay;
            $cs_section_bg_color = $column_attributes->cs_section_bg_color;
            $cs_section_parallax = $column_attributes->cs_section_parallax;
            $cs_section_padding_top = $column_attributes->cs_section_padding_top;
            $cs_section_padding_bottom = $column_attributes->cs_section_padding_bottom;
            $cs_section_border_bottom = $column_attributes->cs_section_border_bottom;
            $cs_section_border_top = $column_attributes->cs_section_border_top;
            $cs_section_border_color = $column_attributes->cs_section_border_color;
            $cs_section_margin_top = $column_attributes->cs_section_margin_top;
            $cs_section_margin_bottom = $column_attributes->cs_section_margin_bottom;
            $cs_section_css_id = $column_attributes->cs_section_css_id;
            $cs_section_view = $column_attributes->cs_section_view;
            $cs_layout = $column_attributes->cs_layout;
            $cs_sidebar_left = $column_attributes->cs_sidebar_left;
            $cs_sidebar_right = $column_attributes->cs_sidebar_right;
        }
        $style = '';

        if (isset($_POST['action'])) {
            $name = $_POST['action'];
            $cs_counter = $_POST['counter'];
            $total_column = $_POST['total_column'];
            $column_class = $_POST['column_class'];
            $postID = $_POST['postID'];
            $randomno = cs_generate_random_string('5');
            $rand = rand(1, 999);
            $style = '';
        } else {
            $postID = $post->ID;
            $name = '';
            $cs_counter = '';
            $total_column = 0;
            $rand = rand(1, 999);
            $randomno = cs_generate_random_string('5');
            $name = $_REQUEST['action'];
            $style = 'style="display:none;"';
        }
        $cs_page_elements_name = cs_shortcode_names();
        $cs_page_categories_name = cs_elements_categories();
        ?>
        <div class="cs-page-composer composer-<?php echo absint($rand) ?>" id="composer-<?php echo absint($rand) ?>" style="display:none">
            <div class="page-elements">
                <div class="cs-heading-area">
                    <h5> <i class="icon-plus-circle"></i> Add Element </h5>
                    <span class='cs-btnclose' onclick='javascript:removeoverlay("composer-<?php echo absint($rand) ?>", "append")'><i class="icon-times"></i></span> </div>
                <script>
                    jQuery(document).ready(function ($) {
                        cs_page_composer_filterable('<?php echo absint($rand) ?>');
                    });
                </script>
                <div class="cs-filter-content">
                    <p><input type="text" id="quicksearch<?php echo absint($rand) ?>" placeholder="<?php _e('Search', 'Lawyer'); ?>" /></p>
                    <div class="cs-filtermenu-wrap">
                        <h6><?php _e('Filter by', 'Lawyer'); ?></h6>
                        <ul class="cs-filter-menu" id="filters<?php echo absint($rand) ?>">
                            <li data-filter="all" class="active"><?php _e('Show all', 'Lawyer'); ?></li>
                            <?php foreach ($cs_page_categories_name as $key => $value) { ?>
                                <li data-filter="<?php echo esc_attr($key); ?>"><?php echo esc_attr($value); ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="cs-filter-inner" id="page_element_container<?php echo absint($rand) ?>">
                        <?php foreach ($cs_page_elements_name as $key => $value) { ?>
                            <div class="element-item <?php echo esc_attr($value['categories']); ?>"> <a href='javascript:ajaxSubmitwidget("cs_pb_<?php echo esc_js($value['name']); ?>","<?php echo esc_js($rand) ?>")'>
                                    <?php cs_page_composer_elements($value['title'], $value['icon']); ?>
                                </a> </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($shortcode) && $shortcode <> '') {
            ?>
            <a class="button" href="javascript:_createpop('composer-<?php echo esc_js($rand) ?>', 'filter')"><i class="icon-plus-circle"></i><?php _e('CS: Insert shortcode', 'Lawyer'); ?> </a>
            <?php
        } else {
            ?>
            <div id="<?php echo esc_attr($randomno); ?>_del" class="column columnmain parentdeletesection column_100" >
                <div class="column-in"> <a class="button" href="javascript:_createpop('composer-<?php echo esc_js($rand) ?>', 'filter')"><i class="icon-plus-circle"></i> <?php _e('Add Element', 'Lawyer'); ?></a>
                    <p> <a href="javascript:_createpop('<?php echo esc_js($column_class . $randomno); ?>','filterdrag')" class="options"><i class="icon-gear"></i></a> &nbsp; <a href="#" class="delete-it btndeleteitsection"><i class="icon-trash-o"></i></a> &nbsp; </p>
                </div>
                <div class="column column_container page_section <?php echo esc_attr($column_class); ?>" >
                    <?php
                    $parts = explode('_', $column_class);
                    if ($total_column > 0) {
                        for ($i = 1; $i <= $total_column; $i++) {
                            ?>
                            <div class="dragarea" data-item-width="col_width_<?php echo esc_attr($parts[$i]); ?>">
                                <input name="total_widget[]" type="hidden" value="0" class="textfld" />
                                <div class="draginner" id="counter_<?php echo absint($rand) ?>"></div>
                            </div>
                            <?php
                        }
                    }
                    $i = 1;

                    if (isset($column_container)) {
                        global $wpdb;
                        $total_column = count($column_container->children());
                        $section = 0;
                        $section_widget_element_num = 0;
                        foreach ($column_container->children() as $column) {
                            $section++;
                            $total_widget = count($column->children());
                            ?>
                            <div class="dragarea" data-item-width="col_width_<?php echo esc_attr($parts[$i]) ?>">
                                <div class="toparea">
                                    <input name="total_widget[]" type="hidden" value="<?php echo esc_attr($total_widget) ?>" class="textfld page-element-total-widget" />
                                </div>
                                <div class="draginner" id="counter_<?php echo absint($rand) ?>">
                                    <?php
                                    $shortcode_element = '';
                                    $abccc_golabal = 'Glo0ab testinggg';
                                    $filter_element = 'filterdrag';
                                    $shortcode_view = '';
                                    $global_array = array();
                                    $section_widget__element = 0;
                                    foreach ($column->children() as $cs_node) {

                                        $section_widget__element++;
                                        $shortcode_element_idd = $rand . '_' . $section_widget__element;
                                        $global_array[] = $cs_node;
                                        $cs_count_node++;
                                        $cs_counter = $postID . $cs_count_node;
                                        $a = $name = "cs_pb_" . $cs_node->getName();
                                        $coloumn_class = 'column_' . $cs_node->page_element_size;
                                        $abbbbc = (string) $cs_node->cs_shortcode;
                                        $type = '';
                                        if ($cs_node->getName() == 'page_element') {
                                            $type = 'page_element';
                                        }
                                        ?>
                                        <div id="<?php echo esc_attr($name . $cs_counter); ?>_del" class="column  parentdelete  <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="<?php echo esc_attr($cs_node->getName()); ?>" data="<?php echo element_size_data_array_index($cs_node->page_element_size) ?>" >
                                            <?php cs_ajax_element_setting($cs_node->getName(), $cs_counter, $cs_node->page_element_size, $shortcode_element_idd, $postID, $element_description = '', $cs_node->getName() . '-icon', $type); ?>
                                            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" style="display: none;">
                                                <div class="cs-heading-area">
                                                    <h5>Edit  <?php echo esc_attr($cs_node->getName()); ?> Options</h5>
                                                    <a href="javascript:;" onclick="javascript:_removerlay(jQuery(this))" class="cs-btnclose"><i class="icon-times"></i></a>
                                                </div>
                                                <?php
                                                echo '<input type="hidden"  class="cs-wiget-element-type"  id="shortcode_' . $name . $cs_counter . '" name="cs_widget_element_num[]" value="shortcode" />';
                                                ?>
                                                <div class="pagebuilder-data-load">
                                                    <?php
                                                    echo '<input type="hidden" name="cs_orderby[]" value="' . $cs_node->getName() . '" />';
                                                    echo '<textarea name="shortcode[' . $cs_node->getName() . '][]" style="display:none;" class="cs-textarea-val">' . htmlspecialchars_decode($cs_node->cs_shortcode) . '</textarea>';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
                <div id="<?php echo esc_attr($column_class . $randomno); ?>" style="display:none">
                    <div class="cs-heading-area">
                        <h5><?php _e('Edit Page Section', 'Lawyer'); ?></h5>
                        <a href="javascript:removeoverlay('<?php echo esc_js($column_class . $randomno); ?>','filterdrag')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                    <div class="cs-pbwp-content">
                        <ul class="form-elements  noborder">
                            <li class="to-label">
                                <label><?php _e('Background View', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="select-style">
                                        <select name="cs_section_background_option[]" class="dropdown" onchange="javascript:cs_section_background_settings_toggle(this.value, '<?php echo cs_allow_special_char($randomno); ?>')">
                                            <option <?php if ($cs_section_background_option == 'no-image') echo "selected"; ?> value="no-image"><?php _e('None', 'Lawyer'); ?></option>
                                            <option <?php if ($cs_section_background_option == 'section-custom-background-image') echo "selected"; ?> value="section-custom-background-image"><?php _e('Background Image', 'Lawyer'); ?></option>
                                            <option <?php if ($cs_section_background_option == 'section-custom-slider') echo "selected"; ?> value="section-custom-slider"><?php _e('Custom Slider', 'Lawyer'); ?></option>
                                            <option  <?php if ($cs_section_background_option == 'section_background_video') echo "selected"; ?> value="section_background_video" ><?php _e('Video', 'Lawyer'); ?> </option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="meta-body noborder section-custom-background-image-<?php echo esc_attr($randomno); ?>" style=" <?php
                        if ($cs_section_background_option == "section-custom-background-image") {
                            echo "display:block";
                        } else
                            echo "display:none";
                        ?>" >
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Background Image', 'Lawyer'); ?></label>
                                </li>
                                <li class="to-field">
                                    <input id="cs_section_bg_image<?php echo absint($rand); ?>" name="cs_section_bg_image[]" type="hidden" class="" value="<?php echo esc_url($cs_section_bg_image); ?>"/>
                                    <input name="cs_section_bg_image<?php echo absint($rand); ?>"  type="button" class="uploadMedia left" value="<?php _e('Browse', 'Lawyer'); ?>"/>
                                </li>
                            </ul>
                            <div class="page-wrap" style="overflow:hidden; display:<?php echo esc_attr($cs_section_bg_image) && trim($cs_section_bg_image) != '' ? 'inline' : 'none'; ?>" id="cs_section_bg_image<?php echo absint($rand); ?>_box" >
                                <div class="gal-active">
                                    <div class="dragareamain" style="padding-bottom:0px;">
                                        <ul id="gal-sortable">
                                            <li class="ui-state-default" id="">
                                                <div class="thumb-secs"> <img src="<?php echo esc_url($cs_section_bg_image); ?>" alt="" id="cs_section_bg_image<?php echo absint($rand); ?>_img" width="100" height="150"  />
                                                    <div class="gal-edit-opts"> <a href="javascript:del_media('cs_section_bg_image<?php echo absint($rand); ?>')" class="delete"></a> </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <ul class="form-elements noborder">
                                <li class="to-label">
                                    <label><?php _e('Background Image Position', 'Lawyer'); ?></label>
                                </li>
                                <li class="to-field">
                                    <div class="input-sec">
                                        <div class="select-style">
                                            <select name="cs_section_bg_image_position[]" class="select_dropdown">
                                                <option value=""><?php _e('Select position', 'Lawyer'); ?></option>
                                                <option value="left" <?php if ($cs_section_bg_image_position == 'light') echo "selected"; ?>><?php _e('Left', 'Lawyer'); ?></option>
                                                <option value="right" <?php if ($cs_section_bg_image_position == 'right') echo "selected"; ?>><?php _e('Right', 'Lawyer'); ?></option>
                                                <option value="center" <?php if ($cs_section_bg_image_position == 'center') echo "selected"; ?>><?php _e('Center', 'Lawyer'); ?></option>
                                                <option value="repeat" <?php if ($cs_section_bg_image_position == 'repeat') echo "selected"; ?>><?php _e('Repeat', 'Lawyer'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="meta-body noborder section-slider-<?php echo esc_attr($randomno); ?>" style=" <?php
                        if ($cs_section_background_option == "section-slider") {
                            echo "display:block";
                        } else
                            echo "display:none";
                        ?>" >
                                 <?php //cs_section_slider('section_field_name2');  ?>
                        </div>
                        <div class="meta-body noborder section-custom-slider-<?php echo esc_attr($randomno); ?>" style=" <?php
                        if ($cs_section_background_option == "section-custom-slider") {
                            echo "display:block";
                        } else
                            echo "display:none";
                        ?>" >
                            <ul class="form-elements noborder">
                                <li class="to-label">
                                    <label><?php _e('Custom Slider', 'Lawyer'); ?></label>
                                </li>
                                <li class="to-field">
                                    <div class="input-sec">
                                        <input type="text" name="cs_section_custom_slider[]" class="txtfield" value="<?php
                                        echo esc_attr($cs_section_custom_slider);
                                        ;
                                        ?>" />
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="meta-body noborder section-background-video-<?php echo esc_attr($randomno); ?>" style=" <?php
                        if ($cs_section_background_option == "section_background_video") {
                            echo "display:block";
                        } else
                            echo "display:none";
                        ?>">
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Video Url', 'Lawyer'); ?></label>
                                </li>
                                <li class="to-field">
                                    <div class="input-sec">
                                        <input id="cs_section_video_url_<?php echo esc_attr($randomno) ?>" name="cs_section_video_url[]" value="<?php
                                               echo esc_url($cs_section_video_url);
                                               ;
                                               ?>" type="text" />
                                        <label class="cs-browse">
                                            <input name="cs_section_video_url_<?php echo esc_attr($randomno); ?>" type="button" class="uploadMedia left" value="<?php _e('Browse', 'Lawyer'); ?>" />
                                        </label>
                                    </div>
                                    <div class="left-info">
                                        <p><?php _e('Please enter Vimeo/Youtube Video Url', 'Lawyer'); ?></p>
                                    </div>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Enable Mute', 'Lawyer'); ?></label>
                                </li>
                                <li class="to-field">
                                    <div class="input-sec">
                                        <div class="select-style">
                                            <select name="cs_section_video_mute[]" class="select_dropdown">
                                                <option value="yes" <?php if ($cs_section_video_mute == 'yes') echo "selected"; ?>><?php _e('Yes', 'Lawyer'); ?></option>
                                                <option value="no" <?php if ($cs_section_video_mute == 'no') echo "selected"; ?>><?php _e('No', 'Lawyer'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="form-elements">
                                <li class="to-label">
                                    <label><?php _e('Video Auto Play', 'Lawyer'); ?></label>
                                </li>
                                <li class="to-field">
                                    <div class="input-sec">
                                        <div class="select-style">
                                            <select name="cs_section_video_autoplay[]" class="select_dropdown">
                                                <option value="yes" <?php if ($cs_section_video_autoplay == 'yes') echo "selected"; ?>><?php _e('Yes', 'Lawyer'); ?></option>
                                                <option value="no" <?php if ($cs_section_video_autoplay == 'no') echo "selected"; ?>><?php _e('No', 'Lawyer'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                                <label><?php _e('Enable Parallax', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="select-style">
                                        <select name="cs_section_parallax[]" class="select_dropdown">
                                            <option value="no" <?php if ($cs_section_parallax == 'no') echo "selected"; ?>><?php _e('No', 'Lawyer'); ?></option>
                                            <option value="yes" <?php if ($cs_section_parallax == 'yes') echo "selected"; ?>><?php _e('Yes', 'Lawyer'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Select View', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="select-style">
                                        <select name="cs_section_view[]" class="select_dropdown">
                                            <option value="container" <?php if ($cs_section_view == 'container') echo "selected"; ?>><?php _e('Box', 'Lawyer'); ?></option>
                                            <option value="wide" <?php if ($cs_section_view == 'wide') echo "selected"; ?>><?php _e('Wide', 'Lawyer'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                                <label><?php _e('Background Color', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <input type="text" name="cs_section_bg_color[]" class="bg_color" value="<?php if (isset($cs_section_bg_color)) echo esc_attr($cs_section_bg_color); ?>" />
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                                <label><?php _e('Padding Top', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="cs-drag-slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo absint($cs_section_padding_top) ?>"></div>
                                    <input  class="cs-range-input"  name="cs_section_padding_top[]" type="text" value="<?php echo absint($cs_section_padding_top) ?>"   />
                                    <p><?php _e('Set the Padding top (In px)', 'Lawyer'); ?></p>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                                <label><?php _e('Padding Bottom', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="cs-drag-slider" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo absint($cs_section_padding_bottom); ?>"></div>
                                    <input  class="cs-range-input"  name="cs_section_padding_bottom[]" type="text" value="<?php echo absint($cs_section_padding_bottom); ?>"   />
                                    <p><?php _e('Set the Padding Bottom (In px)', 'Lawyer'); ?></p>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                                <label><?php _e('Margin Top', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="cs-drag-slider" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo intval($cs_section_margin_top); ?>"></div>
                                    <input  class="cs-range-input"  name="cs_section_margin_top[]" type="text" value="<?php echo intval($cs_section_margin_top); ?>"   />
                                    <p><?php _e('Set the Border Bottom (In px)', 'Lawyer'); ?></p>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                                <label><?php _e('Margin Bottom', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="cs-drag-slider" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo intval($cs_section_margin_bottom); ?>"></div>
                                    <input  class="cs-range-input"  name="cs_section_margin_bottom[]" type="text" value="<?php echo intval($cs_section_margin_bottom); ?>"   />
                                    <p><?php _e('Set the Margin Bottom (In px)', 'Lawyer'); ?></p>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                                <label><?php _e('Border Top', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="cs-drag-slider" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo absint($cs_section_border_top); ?>"></div>
                                    <input  class="cs-range-input"  name="cs_section_border_top[]" type="text" value="<?php echo absint($cs_section_border_top); ?>"   />
                                    <p><?php _e('Set the Border top (In px)', 'Lawyer'); ?></p>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                                <label><?php _e('Border Bottom', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <div class="cs-drag-slider" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo absint($cs_section_border_bottom); ?>"></div>
                                    <input  class="cs-range-input"  name="cs_section_border_bottom[]" type="text" value="<?php echo absint($cs_section_border_bottom); ?>"   />
                                    <p><?php _e('Set the Border Bottom (In px)', 'Lawyer'); ?></p>
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                                <label><?php _e('Border Color', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <input type="text" name="cs_section_border_color[]" class="bg_color" value="<?php echo esc_attr($cs_section_border_color); ?>" />
                                </div>
                            </li>
                        </ul>
                        <ul class="form-elements noborder">
                            <li class="to-label">
                                <label><?php _e('Custom Id', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <div class="input-sec">
                                    <input type="text" name="cs_section_css_id[]" class="txtfield" value="<?php echo esc_attr($cs_section_css_id); ?>" />
                                </div>
                            </li>
                        </ul>
                        <div class="form-elements elementhiddenn">
                            <ul class="noborder">
                                <li class="to-label">
                                    <label><?php _e('Select Layout', 'Lawyer'); ?></label>
                                </li>
                                <li class="to-field">
                                    <div class="meta-input">
                                        <div class="meta-input pattern">
                                            <div class='radio-image-wrapper'>
                                                <input <?php if ($cs_layout == "none") echo "checked" ?> onclick="show_sidebar('none', '<?php echo esc_js($randomno); ?>')" type="radio" name="cs_layout[<?php echo esc_attr($rand); ?>][]" class="radio_cs_sidebar" value="none" id="radio_1<?php echo esc_attr($randomno); ?>" />
                                                <label for="radio_1<?php echo esc_attr($randomno) ?>"> <span class="ss"><img src="<?php echo esc_url(get_template_directory_uri() . '/include/assets/images/no_sidebar.png') ?>"  alt="" /></span> <span <?php if ($cs_layout == "none") echo "class='check-list'" ?> id="check-list"></span> </label>
                                            </div>
                                            <div class='radio-image-wrapper'>
                                                <input <?php if ($cs_layout == "right") echo "checked" ?> onclick="show_sidebar('right', '<?php echo esc_js($randomno) ?>')" type="radio" name="cs_layout[<?php echo esc_attr($rand); ?>][]" class="radio_cs_sidebar" value="right" id="radio_2<?php echo esc_attr($randomno); ?>"  />
                                                <label for="radio_2<?php echo esc_attr($randomno) ?>"> <span class="ss"><img src="<?php echo esc_url(get_template_directory_uri() . '/include/assets/images/sidebar_right.png') ?>" alt="" /></span> <span <?php if ($cs_layout == "right") echo "class='check-list'" ?> id="check-list"></span> </label>
                                            </div>
                                            <div class='radio-image-wrapper'>
                                                <input <?php if ($cs_layout == "left") echo "checked" ?> onclick="show_sidebar('left', '<?php echo esc_attr($randomno); ?>')" type="radio" name="cs_layout[<?php echo esc_attr($rand) ?>][]" class="radio_cs_sidebar" value="left" id="radio_3<?php echo esc_attr($randomno); ?>" />
                                                <label for="radio_3<?php echo esc_attr($randomno); ?>"> <span class="ss"><img src="<?php echo esc_url(get_template_directory_uri() . '/include/assets/images/sidebar_left.png'); ?>" alt="" /></span> <span <?php if ($cs_layout == "left") echo "class='check-list'" ?> id="check-list"></span> </label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <ul class="meta-body" style=" <?php
                            if ($cs_layout == "left") {
                                echo "display:block";
                            } else
                                echo "display:none";
                            ?>" id="<?php echo esc_attr($randomno); ?>_sidebar_left" >
                                <li class="to-label">
                                    <label><?php _e('Select Left Sidebar', 'Lawyer'); ?></label>
                                </li>
                                <li class="to-field">
                                    <select name="cs_sidebar_left[]" class="select_dropdown">
                                        <?php
                                        global $wpdb, $cs_theme_options;
                                        $cs_theme_options = $cs_theme_options;
                                        
                                        if (isset($cs_theme_options['sidebar']) and count($cs_theme_options['sidebar']) > 0) {
                                            foreach ($cs_theme_options['sidebar'] as $sidebar) {
                                                ?>
                                                <option <?php if ($cs_sidebar_left == $sidebar) echo "selected"; ?> ><?php
                                                echo esc_attr($sidebar);
                                                ;
                                                ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <p><?php _e('Add New Sidebar', 'Lawyer'); ?><a href="<?php echo admin_url(); ?>themes.php?page=cs_theme_options#tab-manage-sidebars-show" target="_blank"><?php _e('Click Here', 'Lawyer'); ?></a></p>
                                </li>
                            </ul>
                            <ul class="meta-body" style=" <?php
                            if ($cs_layout == "right") {
                                echo "display:block";
                            } else
                                echo "display:none";
                            ?>" id="<?php echo esc_attr($randomno); ?>_sidebar_right" >
                                <li class="to-label">
                                    <label><?php _e('Select Right Sidebar', 'Lawyer'); ?></label>
                                </li>
                                <li class="to-field">
                                    <select name="cs_sidebar_right[]" class="select_dropdown">
                                        <?php
                                        if (isset($cs_theme_options['sidebar']) and count($cs_theme_options['sidebar']) > 0) {
                                            foreach ($cs_theme_options['sidebar'] as $sidebar) {
                                                ?>
                                                <option <?php if ($cs_sidebar_right == $sidebar) echo "selected"; ?> ><?php echo esc_attr($sidebar); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <p><?php _e('Add New Sidebar', 'Lawyer'); ?><a href="<?php echo esc_url(admin_url('themes.php?page=cs_theme_options#tab-manage-sidebars-show')); ?>" target="_blank"><?php _e('Click Here', 'Lawyer'); ?></a></p>
                                </li>
                            </ul>
                        </div>
                        <ul class="form-elements noborder">
                            <li class="to-label"></li>
                            <li class="to-field">
                                <input type="button" value="Save" style="margin-right:10px;" onclick="javascript:removeoverlay('<?php echo esc_js($column_class . $randomno); ?>', 'filterdrag')" />
                            </li>
                        </ul>
                    </div>
                </div>
                <input type="hidden" name="column_rand_id[]" value="<?php echo esc_attr($rand); ?>" />
                <input type="hidden" name="column_class[]" value="<?php echo esc_attr($column_class); ?>" />
                <input type="hidden" name="total_column[]" value="<?php echo esc_attr($total_column); ?>" />
            </div>
            <?php
        }

        if ($die <> 1)
            die();
    }

    add_action('wp_ajax_cs_column_pb', 'cs_column_pb');
}

/**
 * @Media Pagination for slider/gallery in admin side
 *
 *
 */
if (!function_exists('media_pagination')) {

    function media_pagination($id = '', $func = 'clone') {
        foreach ($_REQUEST as $keys => $values) {
            $$keys = $values;
        }
        $records_per_page = 18;
        if (empty($page_id))
            $page_id = 1;
        $offset = $records_per_page * ($page_id - 1);
        ?>
        <ul class="gal-list">
            <?php
            $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => -1,);
            $query_images = new WP_Query($query_images_args);
            if (empty($total_pages))
                $total_pages = count($query_images->posts);
            $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => $records_per_page, 'offset' => $offset,);
            $query_images = new WP_Query($query_images_args);
            $images = array();
            foreach ($query_images->posts as $image) {
                $image_path = wp_get_attachment_image_src((int) $image->ID, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h")));
                ?>
                <li style="cursor:pointer"><img src="<?php echo esc_url($image_path[0]); ?>" onclick="javascript:<?php echo esc_attr($func); ?>('<?php echo esc_js($image->ID) ?>', 'gal-sortable-<?php echo esc_js($id); ?>')" alt="" /></li>
        <?php } ?>
        </ul>
        <br />
        <div class="pagination-cus">
            <ul>
                <?php
                if ($page_id > 1)
                    echo "<li><a href='javascript:show_next(" . ($page_id - 1) . ",$total_pages)'>Prev</a></li>";
                for ($i = 1; $i <= ceil($total_pages / $records_per_page); $i++) {
                    if ($i <> $page_id)
                        echo "<li><a href='javascript:show_next($i,$total_pages)'>" . $i . "</a></li> ";
                    else
                        echo "<li class='active'><a>" . $i . "</a></li>";
                }
                if ($page_id < $total_pages / $records_per_page)
                    echo "<li><a href='javascript:show_next(" . ($page_id + 1) . ",$total_pages)'>Next</a></li>";
                ?>
            </ul>
        </div>
        <?php
        if (isset($_POST['action']))
            die();
    }

    add_action('wp_ajax_media_pagination', 'media_pagination');
}

/**
 * @Media Slider Pagination
 *
 *
 */
if (!function_exists('slider_media_pagination')) {

    function slider_media_pagination($id = '', $func = 'clone') {

        foreach ($_REQUEST as $keys => $values) {
            $$keys = $values;
        }
        $records_per_page = 18;
        if (empty($page_id))
            $page_id = 1;
        $offset = $records_per_page * ($page_id - 1);
        ?>
        <ul class="gal-list">
            <?php
            $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => -1,);
            $query_images = new WP_Query($query_images_args);
            if (empty($total_pages))
                $total_pages = count($query_images->posts);
            $query_images_args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_status' => 'inherit', 'posts_per_page' => $records_per_page, 'offset' => $offset,);
            $query_images = new WP_Query($query_images_args);
            $images = array();
            foreach ($query_images->posts as $image) {
                $image_path = wp_get_attachment_image_src((int) $image->ID, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h")));
                ?>
                <li style="cursor:pointer"><img src="<?php echo esc_url($image_path[0]); ?>" onclick="javascript:slider('<?php echo esc_js($image->ID) ?>', 'gal-sortable-<?php echo esc_js($id); ?>')" alt="" /></li>
        <?php } ?>
        </ul>
        <br />
        <div class="pagination-cus">
            <ul>
                <?php
                if ($page_id > 1)
                    echo "<li><a href='javascript:slider_show_next(" . ($page_id - 1) . ",$total_pages)'>Prev</a></li>";
                for ($i = 1; $i <= ceil($total_pages / $records_per_page); $i++) {
                    if ($i <> $page_id)
                        echo "<li><a href='javascript:slider_show_next($i,$total_pages)'>" . $i . "</a></li> ";
                    else
                        echo "<li class='active'><a>" . $i . "</a></li>";
                }
                if ($page_id < $total_pages / $records_per_page)
                    echo "<li><a href='javascript:slider_show_next(" . ($page_id + 1) . ",$total_pages)'>Next</a></li>";
                ?>
            </ul>
        </div>
        <?php
        if (isset($_POST['action']))
            die();
    }

    add_action('wp_ajax_slider_media_pagination', 'slider_media_pagination');
}
/**
 * @Make a copy of media image for slider start
 *
 *
 */
if (!function_exists('cs_slider_clone')) {

    function cs_slider_clone() {
        global $cs_node, $cs_counter;
        if (isset($_POST['action'])) {
            $cs_node = new stdClass();
            $cs_node->cs_slider_title = '';
            $cs_node->cs_slider_description = '';
            $cs_node->cs_slider_link = '';
            $cs_node->cs_slider_link_target = '';
            $cs_node->slider_use_image_as = '';
            $cs_node->slider_video_code = '';
        }
        if (isset($_POST['counter']))
            $cs_counter = $_POST['counter'];
        if (isset($_POST['path']))
            $cs_node->cs_slider_path = $_POST['path'];
        ?>
        <li class="ui-state-default" id="<?php echo esc_attr($cs_counter) ?>">
            <div class="thumb-secs">
        <?php $image_path = wp_get_attachment_image_src((int) $cs_node->cs_slider_path, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h"))); ?>
                <img src="<?php echo esc_url($image_path[0]) ?>" alt="">
                <div class="gal-edit-opts"> 
                    <a href="javascript:slidedit(<?php echo esc_attr($cs_counter) ?>)" class="edit"></a> <a href="javascript:del_this('inside_post_thumb_slider',<?php echo esc_js($cs_counter) ?>)" class="delete"></a> </div>
            </div>
            <div class="poped-up" id="edit_<?php echo esc_attr($cs_counter) ?>">
                <div class="cs-heading-area">
                    <h5><?php _e('Edit Options', 'Lawyer'); ?></h5>
                    <a href="javascript:slideclose(<?php echo esc_js($cs_counter) ?>)" class="closeit">&nbsp;</a>
                    <div class="clear"></div>
                </div>
                <div class="cs-pbwp-content">
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Image Title', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <input type="text" name="cs_slider_title[]" value="<?php echo htmlspecialchars($cs_node->cs_slider_title) ?>" class="txtfield" />
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Image Description', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <textarea class="txtarea" name="cs_slider_description[]"><?php echo htmlspecialchars($cs_node->cs_slider_description) ?></textarea>
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Link', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <input type="text" name="cs_slider_link[]" value="<?php echo htmlspecialchars($cs_node->cs_slider_link) ?>" class="txtfield" />
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Link Target', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <select name="cs_slider_link_target[]" class="select_dropdown">
                                <option <?php if ($cs_node->link_target == "_self") echo "selected"; ?> >_self</option>
                                <option <?php if ($cs_node->link_target == "_blank") echo "selected"; ?> >_blank</option>
                            </select>
                            <p><?php _e('Please select image target', 'Lawyer'); ?></p>
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label"></li>
                        <li class="to-field">
                            <input type="hidden" name="cs_slider_path[]" value="<?php echo esc_attr($cs_node->cs_slider_path) ?>" />
                            <input type="button" value="Submit" onclick="javascript:slideclose(<?php echo esc_js($cs_counter) ?>)" class="close-submit" />
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </li>
        <?php
        if (isset($_POST['action']))
            die();
    }

    add_action('wp_ajax_slider_clone', 'cs_slider_clone');
}


/**
 * @Make a copy of media image for gallery start
 *
 *
 */
if (!function_exists('cs_gallery_clone')) {

    function cs_gallery_clone($clone_field_name = '') {

        global $cs_node, $cs_counter;
        if (isset($_POST['action'])) {
            $cs_node = new stdClass();
            $cs_node->title = "";
            $cs_node->use_image_as = "";
            $cs_node->video_code = "";
            $cs_node->link_url = "";
            $cs_node->use_image_as_db = "";
            $cs_node->link_url_db = '';
        }
        if (isset($_POST['counter']))
            $cs_counter = $_POST['counter'];
        if (isset($_POST['path']))
            $cs_node->path = $_POST['path'];
        ?>
        <li class="ui-state-default" id="<?php echo esc_attr($cs_counter); ?>">
            <div class="thumb-secs">
        <?php $image_path = wp_get_attachment_image_src((int) $cs_node->path, array(get_option("thumbnail_size_w"), get_option("thumbnail_size_h"))); ?>
                <img src="<?php echo esc_url($image_path[0]); ?>" alt="">
                <div class="gal-edit-opts"> 
                    <a href="javascript:galedit(<?php echo esc_js($cs_counter) ?>)" class="edit"></a> <a href="javascript:del_this('post_thumb_slider',<?php echo esc_js($cs_counter); ?>)" class="delete"></a> </div>
            </div>
            <div class="poped-up" id="edit_<?php echo esc_attr($cs_counter); ?>">
                <div class="cs-heading-area">
                    <h5><?php _e('Edit Options', 'Lawyer'); ?></h5>
                    <a href="javascript:galclose(<?php echo esc_attr($cs_counter); ?>)" class="closeit">&nbsp;</a> </div>
                <div class="cs-pbwp-content">
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Image Title', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <input type="text" name="<?php echo esc_attr($clone_field_name); ?>title[]" value="<?php echo htmlspecialchars($cs_node->title) ?>" class="txtfield" />
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Use Image As', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <select name="<?php echo esc_attr($clone_field_name); ?>use_image_as[]" class="select_dropdown" onchange="cs_toggle_gal(this.value, <?php echo esc_js($cs_counter) ?>)">
                                <option <?php if ($cs_node->use_image_as == "0") echo "selected"; ?> value="0"><?php _e('LightBox to current thumbnail', 'Lawyer'); ?></option>
                                <option <?php if ($cs_node->use_image_as == "1") echo "selected"; ?> value="1"><?php _e('LightBox to Video', 'Lawyer'); ?></option>
                                <option <?php if ($cs_node->use_image_as == "2") echo "selected"; ?> value="2"><?php _e('Link', 'Lawyer'); ?></option>
                            </select>
                            <p><?php _e('Please select Image link where it will go', 'Lawyer'); ?></p>
                        </li>
                    </ul>
                    <ul class="form-elements" id="video_code<?php echo esc_attr($cs_counter); ?>" <?php if ($cs_node->use_image_as == "0" or $cs_node->use_image_as == "" or $cs_node->use_image_as == "2") echo 'style="display:none"'; ?> >
                        <li class="to-label">
                            <label><?php _e('Video Url', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <input type="text" name="<?php echo esc_attr($clone_field_name); ?>video_code[]" value="<?php echo htmlspecialchars($cs_node->video_code) ?>" class="txtfield" />
                            <p><?php _e('Enter Specific Video Url Youtube or Vimeo', 'Lawyer'); ?></p>
                        </li>
                    </ul>
                    <ul class="form-elements" id="<?php echo esc_attr($clone_field_name); ?>link_url<?php echo esc_attr($cs_counter) ?>" <?php if ($cs_node->use_image_as == "0" or $cs_node->use_image_as == "" or $cs_node->use_image_as == "1") echo 'style="display:none"'; ?> >
                        <li class="to-label">
                            <label><?php _e('Link', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <input type="text" name="<?php echo esc_attr($clone_field_name); ?>link_url[]" value="<?php echo htmlspecialchars($cs_node->link_url) ?>" class="txtfield" />
                            <p><?php _e('Enter Specific Link', 'Lawyer'); ?></p>
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label"></li>
                        <li class="to-field">
                            <input type="hidden" name="<?php echo esc_attr($clone_field_name); ?>path[]" value="<?php echo esc_attr($cs_node->path); ?>" />
                            <input type="button" onclick="javascript:galclose(<?php echo esc_attr($cs_counter); ?>)" value="Submit" class="close-submit" />
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </li>
        <?php
        if (isset($_POST['action']))
            die();
    }

    add_action('wp_ajax_gallery_clone', 'cs_gallery_clone');
}
/**
 * @add Team Scoial function
 *
 *
 */
if (!function_exists('cs_add_social_to_list')) {

    function cs_add_social_to_list() {
        global $counter_social, $var_cp_title, $var_cp_image_url, $var_cp_team_text;
        foreach ($_POST as $keys => $values) {
            $$keys = $values;
        }
        ?>
        <tr id="edit_track<?php echo esc_attr($counter_social); ?>">
            <td id="album-title<?php echo esc_attr($counter_social); ?>" style="width:80%;"><?php echo esc_attr($var_cp_title); ?></td>
            <td class="centr" style="width:20%;"><a href="javascript:openpopedup('edit_track_form<?php echo esc_js($counter_social); ?>')" class="actions edit">&nbsp;</a> <a onclick="javascript:return confirm('Are you sure! You want to delete this social icon')" href="javascript:cs_div_remove('edit_track<?php echo esc_attr($counter_social); ?>')" class="actions delete">&nbsp;</a>
                <div class="poped-up" id="edit_track_form<?php echo esc_attr($counter_social); ?>">
                    <div class="cs-heading-area">
                        <h5><?php _e('Settings', 'Lawyer'); ?></h5>
                        <a href="javascript:removeoverlay('edit_track_form<?php echo esc_js($counter_social); ?>','append')" class="closeit">&nbsp;</a>
                        <div class="clear"></div>
                    </div>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Title', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <input type="text" name="var_cp_title[]" value="<?php echo htmlspecialchars($var_cp_title) ?>" id="var_cp_title<?php echo esc_attr($counter_social); ?>" />
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('icon/image Url', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <input id="var_cp_image_url<?php echo esc_attr($counter_social) ?>" name="var_cp_image_url[]" value="<?php echo htmlspecialchars($var_cp_image_url) ?>" type="text" class="small" />
                            <input id="var_cp_image_url<?php echo esc_attr($counter_social); ?>" name="var_cp_image_url<?php echo esc_attr($counter_track) ?>" type="button" class="uploadfile left" value="<?php _e('Browse', 'Lawyer'); ?>"/>
                            <p><?php _e('Put Fontawsome icon/image url. You can get fontawsome icons from', 'Lawyer'); ?> <a href="<?php _e('http://fortawesome.github.io/Font-Awesome/icons/', 'Lawyer') ?>"><?php _e('here', 'Lawyer'); ?></a></p>
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Text', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <textarea name="var_cp_team_text[]" rows="5" cols="20"><?php echo htmlspecialchars($var_cp_team_text) ?></textarea>
                        </li>
                    </ul>
                    <ul class="form-elements noborder">
                        <li class="to-label">
                            <label></label>
                        </li>
                        <li class="to-field">
                            <input type="button" value="Update Personal Information" onclick="update_title(<?php echo esc_js($counter_social); ?>);
                                            removeoverlay('edit_track_form<?php echo esc_js($counter_social); ?>', 'append')" />
                        </li>
                    </ul>
                </div></td>
        </tr>
        <?php
        if (isset($action))
            die();
    }

    add_action('wp_ajax_cs_add_social_to_list', 'cs_add_social_to_list');
}

/**
 * @Section element Size(s)
 *
 *
 */
if (!function_exists('element_size_data_array_index')) {

    function element_size_data_array_index($size) {
        if ($size == "" or $size == 100)
            return 0;
        else if ($size == 75)
            return 1;
        else if ($size == 67)
            return 2;
        else if ($size == 50)
            return 3;
        else if ($size == 33)
            return 4;
        else if ($size == 25)
            return 5;
    }

}

/**
 * @Get  all Categories of posts or Custom posts
 *
 *
 */
if (!function_exists('show_all_cats')) {

    function show_all_cats($parent, $separator, $selected = "", $taxonomy) {
        if ($parent == "") {
            global $wpdb;
            $parent = 0;
        } else
            $separator .= " &ndash; ";
        $args = array(
            'parent' => $parent,
            'hide_empty' => 0,
            'taxonomy' => $taxonomy
        );
        $categories = get_categories($args);
        foreach ($categories as $category) {
            ?>
            <option <?php if ($selected == $category->slug) echo "selected"; ?> value="<?php echo esc_attr($category->slug); ?>"><?php echo esc_attr($separator . $category->cat_name); ?></option>
            <?php
            show_all_cats($category->term_id, $separator, $selected, $taxonomy);
        }
    }

}
/**
 * @Page builder Members Shortcode 
 *
 *
 */
if (!function_exists('cs_pb_members')) {

    function cs_pb_members($die = 0) {
        global $cs_node, $post, $wp_roles;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $counter = $_POST['counter'];
        $cs_counter = $_POST['counter'];
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = 'cs_members';
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array('var_pb_members_title' => '', 'var_pb_members_profile_inks' => '', 'var_pb_members_roles' => '', 'var_pb_members_filterable' => '', 'var_pb_members_pagination' => '', 'var_pb_members_all_tab' => '', 'var_pb_members_per_page' => get_option("posts_per_page"), 'var_pb_member_view' => '', 'cs_members_class' => '', 'cs_members_animation' => '');
        if (isset($output['0']['atts']))
            $atts = $output['0']['atts'];
        else
            $atts = array();
        $members_element_size = '50';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key]))
                $$key = $atts[$key];
            else
                $$key = $values;
        }
        $name = 'cs_pb_members';
        $coloumn_class = 'column_' . $members_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        if ($var_pb_members_roles) {
            $var_pb_members_roles = explode(",", $var_pb_members_roles);
            echo '<script type="text/javascript">
					jQuery(".multiselect").multiselect();
			</script>';
        }
        ?>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/include/assets/scripts/ui_multiselect.js"></script>
        <link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/include/assets/css/jquery_ui.css" />
        <link type="text/css" rel="stylesheet"  href="<?php echo get_template_directory_uri(); ?>/include/assets/css/ui_multiselect.css" />
        <link type="text/css" rel="stylesheet"  href="<?php echo get_template_directory_uri(); ?>/include/assets/css/common.css" />
        <script type="text/javascript">
                                jQuery(function ($) {
                                    jQuery(".multiselect").multiselect();
                                });
        </script>
        <div id="<?php echo esc_attr($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="column" data="<?php echo element_size_data_array_index($members_element_size) ?>" >
        <?php cs_element_setting($name, $cs_counter, $members_element_size); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter); ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter); ?>" data-shortcode-template="[cs_members {{attributes}}]"  style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php _e('Edit Members Options', 'Lawyer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter); ?>','<?php echo esc_js($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                        <?php
                        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                            cs_shortcode_element_size();
                        }
                        ?>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Section Title', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <input type="text" name="var_pb_members_title[]" class="txtfield" value="<?php echo htmlspecialchars($var_pb_members_title) ?>" />
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Member Views', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field select-style">
                                <select class="cs_size" name="var_pb_member_view[]">
                                    <option value="default" <?php
                                            if ($var_pb_member_view == 'default') {
                                                echo 'selected="selected"';
                                            }
                                            ?>><?php _e('Number View', 'Lawyer'); ?></option>
                                    <option value="grid" <?php
                                            if ($var_pb_member_view == 'grid') {
                                                echo 'selected="selected"';
                                            }
                                            ?>><?php _e('Grid View', 'Lawyer'); ?></option>
                                </select>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Roles', 'Lawyer'); ?> </label>
                            </li>
                            <li class="to-field">
                                <select name="var_pb_members_roles[<?php echo esc_attr($cs_counter); ?>][]" multiple="multiple" class="multiselect" style="min-height:100px;">
                                    <?php
                                    foreach ($var_pb_members_roles as $role) {
                                        echo '<option value="' . $role . '" selected="selected">' . $role . '</option>';
                                    }
                                    $roles = $wp_roles->get_names();
                                    foreach ($roles as $role_key => $role) {
                                        if (!in_array($role_key, $var_pb_members_roles)) {
                                            echo '<option value="' . $role_key . '" >' . $role . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Filterable', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field select-style">
                                <select name="var_pb_members_filterable[]" onchange="cs_members_all_tab(this.value, <?php echo esc_js($cs_counter); ?>)">
                                    <option value="on" <?php if ($var_pb_members_filterable == "on") echo "selected"; ?>><?php _e('On', 'Lawyer'); ?></option>
                                    <option value="off" <?php if ($var_pb_members_filterable == "off") echo "selected"; ?>><?php _e('Off', 'Lawyer'); ?></option>
                                </select>
                            </li>
                        </ul>
                        <ul class="form-elements" id="members_all_tab<?php echo esc_attr($cs_counter); ?>" <?php
                        if ($var_pb_members_filterable == "on") {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li class="to-label">
                                <label><?php _e('Show All Tab', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field select-style">
                                <select name="var_pb_members_all_tab[]">
                                    <option value="on" <?php if ($var_pb_members_all_tab == "on") echo "selected"; ?>><?php _e('On', 'Lawyer'); ?></option>
                                    <option value="off" <?php if ($var_pb_members_all_tab == "off") echo "selected"; ?>><?php _e('Off', 'Lawyer'); ?></option>
                                </select>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Profile Link On/Off', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field select-style">
                                <select name="var_pb_members_profile_inks[]">
                                    <option value="on" <?php if ($var_pb_members_profile_inks == "on") echo "selected"; ?>><?php _e('On', 'Lawyer'); ?></option>
                                    <option value="off" <?php if ($var_pb_members_profile_inks == "off") echo "selected"; ?>><?php _e('Off', 'Lawyer'); ?></option>
                                </select>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('Pagination', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field select-style">
                                <select name="var_pb_members_pagination[]" class="dropdown" >
                                    <option <?php if ($var_pb_members_pagination == "Show Pagination") echo "selected"; ?> ><?php _e('Show Pagination', 'Lawyer'); ?></option>
                                    <option <?php if ($var_pb_members_pagination == "Single Page") echo "selected"; ?> ><?php _e('Single Page', 'Lawyer'); ?></option>
                                </select>
                            </li>
                        </ul>
                        <ul class="form-elements">
                            <li class="to-label">
                                <label><?php _e('No. of Members Per Page', 'Lawyer'); ?></label>
                            </li>
                            <li class="to-field">
                                <input type="text" name="var_pb_members_per_page[]" class="txtfield" value="<?php echo esc_attr($var_pb_members_per_page); ?>" />
                                <p><?php _e('To display all the records, leave this field blank', 'Lawyer'); ?></p>
                            </li>
                        </ul>
                        <?php
                        if (function_exists('cs_shortcode_custom_dynamic_classes')) {
                            cs_shortcode_custom_dynamic_classes($cs_members_class, $cs_members_animation, '', 'cs_members');
                        }
                        ?>
        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                            <ul class="form-elements">
                                <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('cs_pb_', '', $name); ?>', '<?php echo esc_attr($name . $cs_counter); ?>', '<?php echo esc_attr($filter_element); ?>')" ><?php _e('Insert', 'Lawyer'); ?></a> </li>
                            </ul>
                            <div id="results-shortocde"></div>
        <?php } else { ?>
                            <ul class="form-elements noborder">
                                <li class="to-label"></li>
                                <li class="to-field">
                                    <input type="hidden" name="cs_orderby[]" value="members" />
                                    <input type="hidden" name="cs_members_counter[]" value="<?php echo esc_attr($cs_counter); ?>" />
                                    <input type="button" value="Save" style="margin-right:10px;" onclick="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" />
                                </li>
                            </ul>
        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($die <> 1)
            die();
    }

    add_action('wp_ajax_cs_pb_members', 'cs_pb_members');
}

/**
 * @Add Education List
 *
 *
 */
/* if ( ! function_exists( 'cs_add_education_to_list' ) ) {
  function cs_add_education_to_list(){
  global $counter_education, $education_title,$education_description;
  foreach ($_POST as $keys=>$values) {
  $$keys = $values;
  }
  ?>
  <tr class="parentdelete" id="edit_track<?php echo esc_attr($counter_education)?>">
  <td id="subject-title<?php echo esc_attr($counter_education)?>" style="width:80%;"><?php echo 'title' .esc_attr($education_title);?></td>
  <td class="centr" style="width:20%;"><a href="javascript:_createpop('edit_track_form<?php echo esc_js($counter_education)?>','filter')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
  <td style="width:0"><div  id="edit_track_form<?php echo esc_attr($counter_education);?>" style="display: none;" class="table-form-elem">
  <div class="cs-heading-area">
  <h5 style="text-align: left;">Education Settings</h5>
  <span onclick="javascript:removeoverlay('edit_track_form<?php echo esc_js($counter_education)?>','append')" class="cs-btnclose"> <i class="icon-times"></i></span>
  <div class="clear"></div>
  </div>
  <ul class="form-elements">
  <li class="to-label">
  <label>Education Title</label>
  </li>
  <li class="to-field">
  <input type="text" name="education_title_array[]" value="<?php echo htmlspecialchars($education_title)?>" id="education_track_title<?php echo esc_attr($counter_education)?>" />
  </li>
  </ul>
  <ul class="form-elements">
  <li class="to-label">
  <label>Education Description</label>
  </li>
  <li class="to-field">
  <textarea name="education_description_array[]" rows="5"  id="education_track_description<?php echo esc_attr($counter_education);?>" cols="20"><?php echo htmlspecialchars($education_description)?></textarea>
  </li>
  </ul>
  <ul class="form-elements noborder">
  <li class="to-label">
  <label></label>
  </li>
  <li class="to-field">
  <input type="button" value="Update Education" onclick="update_title(<?php echo esc_js($counter_education);?>); removeoverlay('edit_track_form<?php echo esc_js($counter_education);?>','append')" />
  </li>
  </ul>
  </div></td>
  </tr>
  <?php
  if ( isset($action) ) die();
  }
  add_action('wp_ajax_cs_add_education_to_list', 'cs_add_education_to_list');
  } */

/**
 * @Add Social Icons
 *
 *
 */
$counter_icon = 0;
if (!function_exists('add_social_icon')) {

    function add_social_icon() {

        $template_path = get_template_directory_uri() . '/include/assets/scripts/media_upload.js';

        wp_enqueue_script('my-upload2', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
        if ($_POST['social_net_awesome']) {

            $icon_awesome = $_POST['social_net_awesome'];
        }
        $socail_network = get_option('cs_social_network');
        echo '<tr id="del_' . str_replace(' ', '-', $_POST['social_net_tooltip']) . '">
	
			<td>';
        if (isset($icon_awesome) and $icon_awesome <> '') {
            ;
            echo '<i style="color:' . $_POST['social_font_awesome_color'] . '!important;" class="' . $_POST['social_net_awesome'] . ' fa-2x"></i>';
        } else {
            ;
            echo '<img width="50" src="' . $_POST['social_net_icon_path'] . '" alt="">';
        }echo '</td> 
			
			<td>' . $_POST['social_net_tooltip'] . '</td> 
	
			<td><a href="#">' . $_POST['social_net_url'] . '</a></td> 
	
			<td class="centr"> 
				<a class="remove-btn" onclick="javascript:return confirm(\'Are you sure! You want to delete this\')" href="javascript:social_icon_del(\'' . str_replace(' ', '-', $_POST['social_net_tooltip']) . '\')"><i class="icon-times"></i></a>
				 <a href="javascript:cs_toggle(\'' . str_replace(' ', '-', $_POST['social_net_tooltip']) . '\')"><i class="icon-edit"></i></a>
			</td></tr>
	
		</tr>';

        echo '<tr id="' . str_replace(' ', '-', $_POST['social_net_tooltip']) . '" style="display:none">
				<td colspan="3"><ul class="form-elements">
				<li><a onclick="cs_toggle(\'' . str_replace(' ', '-', $_POST['social_net_tooltip']) . '\')"><img alt="" src="' . get_template_directory_uri() . '/include/assets/images/close-red.png" /></a></li>
				  <li class="to-label">
					  <label>' . __('Title', 'Lawyer') . '</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="social_net_tooltip" name="social_net_tooltip[]" value="' . $_POST['social_net_tooltip'] . '"  />
					  <p>' . __('Please enter text for icon tooltip', 'Lawyer') . '</p>
					</li>
					<li class="to-label">
					  <label>' . __('Url', 'Lawyer') . '</label>
					</li>
					<li class="to-field">
					  <input class="small" type="text" id="social_net_url" name="social_net_url[]" value="' . $_POST['social_net_url'] . '"/>
					  <p>' . __('Please enter full Url', 'Lawyer') . '</p>
					</li>
					<li class="full">&nbsp;</li>
					<li class="to-label">
					  <label>' . __('Icon Path', 'Lawyer') . '</label>
					</li>
					<li class="to-field">
					  <input id="social_net_icon_path' . $counter_icon . '" name="social_net_icon_path[]" value="' . $_POST['social_net_icon_path'] . '" type="text" class="small" />
					  <label class="browse-icon"><input id="social_net_icon_path' . $counter_icon . '" name="social_net_icon_path' . $i . '" 
					  type="button" class="uploadMedia left" value="' . __('Browse', 'Lawyer') . '"/></label>
					</li>
					
					<li style="padding: 10px 0px 20px;" class="full">
					   <ul id="cs_infobox_networks' . $counter_icon . '">
						  <li class="to-label">
							<label>' . __('Select Icon', 'Lawyer') . ':</label>
						  </li>
						  <li class="to-field">' . cs_fontawsome_theme_options($_POST['social_net_awesome'], "networks" . $counter_icon) . '
							<input id="social_net_awesome' . $counter_icon . '" type="hidden" class="cs-search-icon-hidden" name="social_net_awesome[]" value="' . $_POST['social_net_awesome'] . '">
						  </li>
					   </ul>
					  </li>
					<li class="to-label">
					  <label>' . __('Icon Color', 'Lawyer') . '<span></span></label>
					</li>
					<li class="to-field">
					  <div class="input-sec">
					  <input type="text" name="social_font_awesome_color[]" id="social_font_awesome_color" value="' . $_POST['social_font_awesome_color'] . '" class="bg_color" data-default-color="' . $_POST['social_font_awesome_color'] . '" /></div>
					  <div class="left-info">
						  <p></p>
					  </div>
					</li>
					<li class="full">&nbsp;</li>
					
				  </ul></td>
			  </tr>';
        $counter_icon++;
        die;
    }

    add_action('wp_ajax_add_social_icon', 'add_social_icon');
}

// Fontawsome icon box
if (!function_exists('cs_fontawsome_icons_box')) {

    function cs_fontawsome_icons_box($icon_value = '', $id = '', $name = '') {
        ob_start();
        ?>
        <script>
            jQuery(document).ready(function ($) {

                var e9_element = $('#e9_element_<?php echo cs_allow_special_char($id); ?>').fontIconPicker({
                    theme: 'fip-bootstrap'
                });
                // Add the event on the button
                $('#e9_buttons_<?php echo cs_allow_special_char($id); ?> button').on('click', function (e) {
                    //alert("service");
                    e.preventDefault();
                    // Show processing message
                    $(this).prop('disabled', true).html('<i class="icon-cog demo-animate-spin"></i> Please wait...');
                    $.ajax({
                        url: '<?php echo get_template_directory_uri(); ?>/include/assets/icon/js/selection.json',
                        type: 'GET',
                        dataType: 'json'
                    })
                            .done(function (response) {
                                // Get the class prefix
                                var classPrefix = response.preferences.fontPref.prefix,
                                        icomoon_json_icons = [],
                                        icomoon_json_search = [];
                                $.each(response.icons, function (i, v) {
                                    icomoon_json_icons.push(classPrefix + v.properties.name);
                                    if (v.icon && v.icon.tags && v.icon.tags.length) {
                                        icomoon_json_search.push(v.properties.name + ' ' + v.icon.tags.join(' '));
                                    } else {
                                        icomoon_json_search.push(v.properties.name);
                                    }
                                });
                                // Set new fonts on fontIconPicker
                                e9_element.setIcons(icomoon_json_icons, icomoon_json_search);
                                // Show success message and disable
                                $('#e9_buttons_<?php echo cs_allow_special_char($id); ?> button').removeClass('btn-primary').addClass('btn-success').text('Successfully loaded icons').prop('disabled', true);
                            })
                            .fail(function () {
                                // Show error message and enable
                                $('#e9_buttons_<?php echo cs_allow_special_char($id); ?> button').removeClass('btn-primary').addClass('btn-danger').text('Error: Try Again?').prop('disabled', false);
                            });
                    e.stopPropagation();
                });
                jQuery("#e9_buttons_<?php echo cs_allow_special_char($id); ?> button").click();
            });

        </script>
        <input type="text" id="e9_element_<?php echo cs_allow_special_char($id); ?>" name="<?php echo cs_allow_special_char($name); ?>[]" value="<?php echo cs_allow_special_char($icon_value); ?>"/>
        <span id="e9_buttons_<?php echo cs_allow_special_char($id); ?>" style="display:none">
            <button autocomplete="off" type="button" class="btn btn-primary">Load from IcoMoon selection.json</button>
        </span>
        <?php
        $fontawesome = ob_get_clean();
        echo cs_allow_special_char($fontawesome);
    }

}

// Fontawsome icon box for Theme Options
if (!function_exists('cs_fontawsome_theme_options')) {

    function cs_fontawsome_theme_options($icon_value = '', $id = '', $name = '') {
        ob_start();
        ?>
        <script>
            jQuery(document).ready(function ($) {

                var e9_element = $('#e9_element_<?php echo cs_allow_special_char($id); ?>').fontIconPicker({
                    theme: 'fip-bootstrap'
                });
                // Add the event on the button
                //servicesssssss
                $('#e9_buttons_<?php echo cs_allow_special_char($id); ?> button').on('click', function (e) {
                    e.preventDefault();
                    // Show processing message
                    $(this).prop('disabled', true).html('<i class="icon-cog demo-animate-spin"></i> Please wait...');
                    $.ajax({
                        url: '<?php echo get_template_directory_uri(); ?>/include/assets/icon/js/selection.json',
                        type: 'GET',
                        dataType: 'json'
                    })
                            .done(function (response) {
                                // Get the class prefix
                                var classPrefix = response.preferences.fontPref.prefix,
                                        icomoon_json_icons = [],
                                        icomoon_json_search = [];
                                $.each(response.icons, function (i, v) {
                                    icomoon_json_icons.push(classPrefix + v.properties.name);
                                    if (v.icon && v.icon.tags && v.icon.tags.length) {
                                        icomoon_json_search.push(v.properties.name + ' ' + v.icon.tags.join(' '));
                                    } else {
                                        icomoon_json_search.push(v.properties.name);
                                    }
                                });
                                // Set new fonts on fontIconPicker
                                e9_element.setIcons(icomoon_json_icons, icomoon_json_search);
                                // Show success message and disable
                                $('#e9_buttons_<?php echo cs_allow_special_char($id); ?> button').removeClass('btn-primary').addClass('btn-success').text('Successfully loaded icons').prop('disabled', true);
                            })
                            .fail(function () {
                                // Show error message and enable
                                $('#e9_buttons_<?php echo cs_allow_special_char($id); ?> button').removeClass('btn-primary').addClass('btn-danger').text('Error: Try Again?').prop('disabled', false);
                            });
                    e.stopPropagation();
                });

                jQuery("#e9_buttons_<?php echo cs_allow_special_char($id); ?> button").click();
            });


        </script>
        <input type="text" id="e9_element_<?php echo cs_allow_special_char($id); ?>" name="<?php echo cs_allow_special_char($name); ?>[]" value="<?php echo cs_allow_special_char($icon_value); ?>"/>
        <span id="e9_buttons_<?php echo cs_allow_special_char($id); ?>" style="display:none">
            <button autocomplete="off" type="button" class="btn btn-primary">Load from IcoMoon selection.json</button>
        </span>
        <?php
        $fontawesome = ob_get_clean();
        return $fontawesome;
    }

}

// Education
if (!function_exists('cs_team_education_section')) {

    function cs_team_education_section($post_id = '') {
        global $post, $cs_xmlObject, $counter_education, $directory_education_title, $directory_education_date, $directory_education_description;
        if (isset($post_id) && !empty($post_id)) {
            $counter_education = $post_id;
            $cs_directory = get_post_meta($post_id, "team", true);
            if ($cs_directory <> "") {
                $cs_xmlObject = new SimpleXMLElement($cs_directory);
            }
        } else {
            $counter_education = $post->ID;
        }
        if (!isset($cs_xmlObject))
            $cs_xmlObject = new stdClass();
        ?>
        <input type="hidden" name="dynamic_post_education" value="1" />

        <script>
            jQuery(document).ready(function ($) {
                /*$("#total_educations").sortable({
                 cancel : 'td div.table-form-elem'
                 });*/
            });
        </script>
        <ul class="form-elements">
            <li class="to-label"><?php _e('Add Education', 'Lawyer'); ?></li>
            <li class="to-button"><a href="javascript:_createpop('add_education_title','filter')" class="button"><?php _e('Add Education', 'Lawyer'); ?></a> </li>
        </ul>
        <div class="cs-list-table">
            <table class="to-table" border="0" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:80%;"><?php _e('Title', 'Lawyer'); ?></th>
                        <th style="width:80%;" class="centr"><?php _e('Actions', 'Lawyer'); ?></th>
                        <th style="width:0%;" class="centr"></th>
                    </tr>
                </thead>
                <tbody id="total_educations">
                    <?php
                    if (isset($cs_xmlObject->educations) && is_object($cs_xmlObject) && count($cs_xmlObject->educations) > 0) {
                        foreach ($cs_xmlObject->educations as $educations) {
                            $directory_education_title = $educations->education_title;
                            $directory_education_date = $educations->education_date;
                            $directory_education_description = $educations->education_description;
                            cs_add_education_to_list();
                            $counter_education++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="add_education_title" style="display: none;">
            <div class="cs-heading-area">
                <h5> <i class="icon-plus-circle"></i><?php _e('Education Settings', 'Lawyer'); ?>  </h5>
                <span class="cs-btnclose" onClick="javascript:removeoverlay('add_education_title', 'append')"> <i class="icon-times"></i></span> </div>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Title', 'Lawyer'); ?></label>
                </li>
                <li class="to-field">
                    <input type="text" id="education_title" name="education_title" value="Title" />
                </li>
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Date', 'Lawyer'); ?></label>
                </li>
                <li class="to-field">
                    <input type="text" id="education_date" name="education_date" value="Date" />
                </li>
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Education Description', 'Lawyer'); ?></label>
                </li>
                <li class="to-field">
                    <textarea name="education_description" id="education_description"></textarea>
                </li>
            </ul>
            <ul class="form-elements noborder">
                <li class="to-label"></li>
                <li class="to-field">
                    <input type="button" value="Add Education to List" onClick="add_education_to_list('<?php echo esc_js(admin_url('admin-ajax.php')); ?>', '<?php echo esc_js(get_template_directory_uri()); ?>')" />
                </li>
            </ul>
        </div>
        <?php
    }

}

/**
 * @Add Education List
 *
 *
 */
if (!function_exists('cs_add_education_to_list')) {

    function cs_add_education_to_list() {
        global $counter_education, $directory_education_title, $directory_education_date, $directory_education_description;
        foreach ($_POST as $keys => $values) {
            $$keys = $values;
        }
        ?>
        <tr class="parentdelete" id="edit_track<?php echo esc_attr($counter_education) ?>">
            <td id="subject-title<?php echo esc_attr($counter_education) ?>" style="width:80%;"><?php echo ($directory_education_title); ?></td>
            <td class="centr" style="width:20%;"><a href="javascript:_createpop('edit_track_form<?php echo esc_js($counter_education) ?>','filter')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
            <td style="width:0"><div  id="edit_track_form<?php echo esc_attr($counter_education); ?>" style="display: none;" class="table-form-elem">
                    <div class="cs-heading-area">
                        <h5 style="text-align: left;"><?php _e('Education Settings', 'Lawyer'); ?></h5>
                        <span onclick="javascript:removeoverlay('edit_track_form<?php echo esc_js($counter_education) ?>', 'append')" class="cs-btnclose"> <i class="icon-times"></i></span>
                        <div class="clear"></div>
                    </div>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Education Title', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <input type="text" name="education_title_array[]" value="<?php echo htmlspecialchars($directory_education_title) ?>" id="education_track_title<?php echo esc_attr($counter_education) ?>" />
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Education Date', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <input type="text" name="education_date_array[]" value="<?php echo ($directory_education_date) ?>" id="education_track_title<?php echo esc_attr($counter_education) ?>" />
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('Education Description', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <textarea name="education_description_array[]" rows="5"  id="education_track_description<?php echo esc_attr($counter_education); ?>" cols="20"><?php echo htmlspecialchars($directory_education_description); ?></textarea>
                        </li>
                    </ul>
                    <ul class="form-elements noborder">
                        <li class="to-label">
                            <label></label>
                        </li>
                        <li class="to-field">
                            <input type="button" value="Update Education" onclick="update_title(<?php echo esc_js($counter_education); ?>);
                                            removeoverlay('edit_track_form<?php echo esc_js($counter_education); ?>', 'append')" />
                        </li>
                    </ul>
                </div></td>
        </tr>
        <?php
        if (isset($_POST['education_title']) && isset($_POST['cs_add_education_to_list']))
            die();
    }

    add_action('wp_ajax_cs_add_education_to_list', 'cs_add_education_to_list');
}

// Team Practices List
if (!function_exists('cs_team_practice_section')) {

    function cs_team_practice_section($post_id = '') {
        global $post, $cs_xmlObject, $counter_practice, $directory_practice_title, $directory_practice_description;
        if (isset($post_id) && !empty($post_id)) {
            $counter_practice = $post_id;
            $cs_directory = get_post_meta($post_id, "team", true);
            if ($cs_directory <> "") {
                $cs_xmlObject = new SimpleXMLElement($cs_directory);
            }
        } else {
            $counter_practice = $post->ID;
        }
        if (!isset($cs_xmlObject))
            $cs_xmlObject = new stdClass();
        ?>
        <input type="hidden" name="dynamic_post_practice" value="1" />

        <script>
            jQuery(document).ready(function ($) {
                /*$("#total_practices").sortable({
                 cancel : 'td div.table-form-elem'
                 });*/
            });
        </script>
        <ul class="form-elements">
            <li class="to-label"><?php _e('Add practice', 'Lawyer'); ?></li>
            <li class="to-button"><a href="javascript:_createpop('add_practice_title','filter')" class="button"><?php _e('Add practice', 'Lawyer'); ?></a> </li>
        </ul>
        <div class="cs-list-table">
            <table class="to-table" border="0" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width:80%;"><?php _e('Title', 'Lawyer'); ?></th>
                        <th style="width:80%;" class="centr"><?php _e('Actions', 'Lawyer'); ?></th>
                        <th style="width:0%;" class="centr"></th>
                    </tr>
                </thead>
                <tbody id="total_practices">
                    <?php
                    if (isset($cs_xmlObject->practices) && is_object($cs_xmlObject) && count($cs_xmlObject->practices) > 0) {
                        foreach ($cs_xmlObject->practices as $practices) {
                            $directory_practice_title = $practices->practice_title;
                            $directory_practice_description = $practices->practice_description;
                            cs_add_practice_to_list();
                            $counter_practice++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="add_practice_title" style="display: none;">
            <div class="cs-heading-area">
                <h5> <i class="icon-plus-circle"></i> <?php _e('practice Settings', 'Lawyer'); ?> </h5>
                <span class="cs-btnclose" onClick="javascript:removeoverlay('add_practice_title', 'append')"> <i class="icon-times"></i></span> </div>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('Title', 'Lawyer'); ?></label>
                </li>
                <li class="to-field">
                    <input type="text" id="practice_title" name="practice_title" value="Title" />
                </li>
            </ul>
            <ul class="form-elements">
                <li class="to-label">
                    <label><?php _e('practice Description', 'Lawyer'); ?></label>
                </li>
                <li class="to-field">
                    <textarea name="practice_description" id="practice_description"></textarea>
                </li>
            </ul>
            <ul class="form-elements noborder">
                <li class="to-label"></li>
                <li class="to-field">
                    <input type="button" value="Add practice to List" onClick="add_practice_to_list('<?php echo esc_js(admin_url('admin-ajax.php')); ?>', '<?php echo esc_js(get_template_directory_uri()); ?>')" />
                </li>
            </ul>
        </div>
        <?php
    }

}

/**
 * @Add practice List
 *
 *
 */
if (!function_exists('cs_add_score_listz')) {

    function cs_add_practice_to_list() {
        global $counter_practice, $directory_practice_title, $directory_practice_description;
        foreach ($_POST as $keys => $values) {
            $$keys = $values;
        }
        ?>
        <tr class="parentdelete" id="edit_track<?php echo esc_attr($counter_practice) ?>">
            <td id="subject-title<?php echo esc_attr($counter_practice) ?>" style="width:80%;"><?php echo ($directory_practice_title); ?></td>
            <td class="centr" style="width:20%;"><a href="javascript:_createpop('edit_track_form<?php echo esc_js($counter_practice) ?>','filter')" class="actions edit">&nbsp;</a> <a href="#" class="delete-it btndeleteit actions delete">&nbsp;</a></td>
            <td style="width:0"><div  id="edit_track_form<?php echo esc_attr($counter_practice); ?>" style="display: none;" class="table-form-elem">
                    <div class="cs-heading-area">
                        <h5 style="text-align: left;"><?php _e('practice Settings', 'Lawyer'); ?></h5>
                        <span onclick="javascript:removeoverlay('edit_track_form<?php echo esc_js($counter_practice) ?>', 'append')" class="cs-btnclose"> <i class="icon-times"></i></span>
                        <div class="clear"></div>
                    </div>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('practice Title', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <input type="text" name="practice_title_array[]" value="<?php echo htmlspecialchars($directory_practice_title) ?>" id="practice_track_title<?php echo esc_attr($counter_practice) ?>" />
                        </li>
                    </ul>
                    <ul class="form-elements">
                        <li class="to-label">
                            <label><?php _e('practice Description', 'Lawyer'); ?></label>
                        </li>
                        <li class="to-field">
                            <textarea name="practice_description_array[]" rows="5"  id="practice_track_description<?php echo esc_attr($counter_practice); ?>" cols="20"><?php echo htmlspecialchars($directory_practice_description); ?></textarea>
                        </li>
                    </ul>
                    <ul class="form-elements noborder">
                        <li class="to-label">
                            <label></label>
                        </li>
                        <li class="to-field">
                            <input type="button" value="Update practice" onclick="update_title(<?php echo esc_js($counter_practice); ?>);
                                            removeoverlay('edit_track_form<?php echo esc_js($counter_practice); ?>', 'append')" />
                        </li>
                    </ul>
                </div></td>
        </tr>
        <?php
        if (isset($_POST['practice_title']) && isset($_POST['cs_add_practice_to_list']))
            die();
    }

    add_action('wp_ajax_cs_add_practice_to_list', 'cs_add_practice_to_list');
}

