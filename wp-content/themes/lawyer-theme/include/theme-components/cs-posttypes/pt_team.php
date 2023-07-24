<?php
require_once 'pt_functions.php';

//adding columns start
add_filter('manage_team_posts_columns', 'team_columns_add');

function team_columns_add($columns) {
    $columns['author'] = 'Author';
    return $columns;
}

add_action('manage_team_posts_custom_column', 'team_columns');

function team_columns($name) {
    global $post;
    switch ($name) {
        case 'author':
            echo get_the_author();
            break;
    }
}

//adding columns end
if (!function_exists('cs_team_register')) {

    function cs_team_register() {
        $labels = array(
            'name' => __('Teams', 'Lawyer'),
            'all_items' => __('Teams', 'Lawyer'),
            'add_new_item' => __('Add New Team', 'Lawyer'),
            'edit_item' => __('Edit Team', 'Lawyer'),
            'new_item' => __('New Team Item', 'Lawyer'),
            'add_new' => __('Add New Team', 'Lawyer'),
            'view_item' => __('View Team Item', 'Lawyer'),
            'search_items' => __('Search Team', 'Lawyer'),
            'not_found' => __('Nothing found', 'Lawyer'),
            'not_found_in_trash' => __('Nothing found in Trash', 'Lawyer'),
            'parent_item_colon' => ''
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'menu_icon' => 'dashicons-book',
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => false,
            'map_meta_cap' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'thumbnail', 'comments')
        );
        register_post_type('team', $args);
    }

    add_action('init', 'cs_team_register');
}

// adding cat start
$labels = array(
    'name' => __('Team Categories', 'Lawyer'),
    'search_items' => __('Search Team Categories', 'Lawyer'),
    'edit_item' => __('Edit Team Category', 'Lawyer'),
    'update_item' => __('Update Team Category', 'Lawyer'),
    'add_new_item' => __('Add New Category', 'Lawyer'),
    'menu_name' => __('Categories', 'Lawyer'),
);
register_taxonomy('team-category', array('team'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'team-category'),
));

// adding Team meta info start
add_action('add_meta_boxes', 'cs_meta_team_add');

function cs_meta_team_add() {
    add_meta_box('cs_meta_team', __('Team Options', 'Lawyer'), 'cs_meta_team', 'team', 'normal', 'high');
}

function cs_meta_team($post) {
    global $post, $cs_xmlObject,$cs_theme_options;
    $cs_theme_options =$cs_theme_options;
    $cs_builtin_seo_fields = $cs_theme_options['cs_builtin_seo_fields'];
    $cs_header_position = $cs_theme_options['cs_header_position'];
    $cs_team = get_post_meta($post->ID, "team", true);
    if ($cs_team <> "") {
        $cs_xmlObject = new SimpleXMLElement($cs_team);
        $cs_team_phone_num = $cs_xmlObject->cs_team_phone_num;
        $cs_team_fax_num = $cs_xmlObject->cs_team_fax_num;
        $cs_team_email = $cs_xmlObject->cs_team_email;
        $cs_team_subtitle = $cs_xmlObject->cs_team_subtitle;
        $cs_team_admissions_title = $cs_xmlObject->cs_team_admissions_title;
        $cs_team_certifications_title = $cs_xmlObject->cs_team_certifications_title;
        $cs_team_admissions = $cs_xmlObject->cs_team_admissions;
        $cs_team_certifications = $cs_xmlObject->cs_team_certifications;
        $cs_team_eval_form = $cs_xmlObject->cs_team_eval_form;
        $cs_team_eval_form_title = $cs_xmlObject->cs_team_eval_form_title;
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
        $cs_team_admissions_title = __('Bar Admissions', 'Lawyer');
        $cs_team_certifications_title = __('Certifications &amp; Membership', 'Lawyer');
        $cs_team_eval_form = 'on';
        $cs_team_eval_form_title = __('Free Case Evaluation', 'Lawyer');
        $cs_team_facebook = '';
        $cs_team_twitter = '';
        $cs_team_google_plus = '';
        $cs_team_linked_in = '';
        $cs_team_vcard = '';
        $cs_team_education_title = '';
        $cs_team_practices_title = '';
        $cs_team_rich_edit_title = __('Professional Experience', 'Lawyer');

        if (!isset($cs_xmlObject))
            $cs_xmlObject = new stdClass();
    }
    ?>	

    <div class="page-wrap page-opts left" style="overflow:hidden; position:relative; height: 1432px;">
        <div class="option-sec" style="margin-bottom:0;">
            <div class="opt-conts">
                <div class="elementhidden">
                    <div class="tabs vertical">
                        <nav class="admin-navigtion">
                            <ul id="myTab" class="nav nav-tabs">
                                <li class="active"><a href="#tab-general-settings" data-toggle="tab"><i class="icon-cog"></i><?php _e('General', 'Lawyer'); ?></a></li>
                                <li><a href="#tab-subheader-options" data-toggle="tab"><i class="icon-indent"></i><?php _e('Sub Header', 'Lawyer'); ?></a></li>
                                <?php if ($cs_header_position == 'absolute') { ?>
                                    <li><a href="#tab-header-position-settings" data-toggle="tab"><i class="icon-forward"></i><?php _e('Header Absolute', 'Lawyer'); ?></a></li>
                                <?php } ?>
                                <?php if ($cs_builtin_seo_fields == 'on') { ?>
                                    <li><a href="#tab-seo-advance-settings" data-toggle="tab"><i class="icon-dribbble"></i><?php _e('Seo Options', 'Lawyer'); ?></a></li>
                                <?php } ?>
                                <li><a data-toggle="tab" href="#tab-teams-settings-cs-teams"><i class="icon-user"></i><?php _e('Team Options', 'Lawyer'); ?></a></li>
                                <li><a data-toggle="tab" href="#tab-teams-edu-settings-cs-teams"><i class="icon-user"></i><?php _e('Education Options', 'Lawyer'); ?></a></li>
                                <li><a data-toggle="tab" href="#tab-teams-practice-settings-cs-teams"><i class="icon-user"></i><?php _e('Practices Options', 'Lawyer'); ?></a></li>
                            </ul>
                        </nav>
                        <div class="tab-content">
                            <div id="tab-subheader-options" class="tab-pane fade">
                                <?php cs_subheader_element(); ?>
                            </div>
                            <div id="tab-general-settings" class="tab-pane fade active in">
                                <?php
                                cs_general_settings_element();
                                cs_sidebar_layout_options();
                                ?>
                            </div>
                            <?php if ($cs_builtin_seo_fields == 'on') { ?>
                                <div id="tab-seo-advance-settings" class="tab-pane fade">
                                    <?php cs_seo_settitngs_element(); ?>
                                </div>
                            <?php
                            }
                            if ($cs_header_position == 'absolute') {
                                ?>
                                <div id="tab-header-position-settings" class="tab-pane fade">
                                <?php cs_header_postition_element(); ?>
                                </div>
    <?php } ?>
                            <div id="tab-teams-settings-cs-teams" class="tab-pane fade">
                                <div class="clear"></div>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Evaluation Form', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field has_input">
                                        <label class="pbwp-checkbox">
                                            <input type="hidden" name="cs_team_eval_form" value="" />
                                            <input type="checkbox" name="cs_team_eval_form" value="on" class="myClass" <?php if (isset($cs_team_eval_form) && $cs_team_eval_form == 'on') echo "checked" ?> />
                                            <span class="pbwp-box"></span> </label>
                                        <input type="text" name="cs_team_eval_form_title" value="<?php echo cs_allow_special_char($cs_team_eval_form_title); ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Sub Title', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_subtitle" name="cs_team_subtitle" value="<?php if (isset($cs_team_subtitle) && $cs_team_subtitle <> '') echo cs_allow_special_char($cs_team_subtitle) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Description Title', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_rich_edit_title" name="cs_team_rich_edit_title" value="<?php if (isset($cs_team_rich_edit_title) && $cs_team_rich_edit_title <> '') echo cs_allow_special_char($cs_team_rich_edit_title) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Phone Number', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_phone_num" name="cs_team_phone_num" value="<?php if (isset($cs_team_phone_num) && $cs_team_phone_num <> '') echo cs_allow_special_char($cs_team_phone_num) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Fax Number', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_fax_num" name="cs_team_fax_num" value="<?php if (isset($cs_team_fax_num) && $cs_team_fax_num <> '') echo cs_allow_special_char($cs_team_fax_num) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Email', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_email" name="cs_team_email" value="<?php if (isset($cs_team_email) && $cs_team_email <> '') echo cs_allow_special_char($cs_team_email) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Facebook', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_facebook" name="cs_team_facebook" value="<?php if (isset($cs_team_facebook) && $cs_team_facebook <> '') echo cs_allow_special_char($cs_team_facebook) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Twitter', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_twitter" name="cs_team_twitter" value="<?php if (isset($cs_team_twitter) && $cs_team_twitter <> '') echo cs_allow_special_char($cs_team_twitter) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Google Plus', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_google_plus" name="cs_team_google_plus" value="<?php if (isset($cs_team_google_plus) && $cs_team_google_plus <> '') echo cs_allow_special_char($cs_team_google_plus) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Linkedin', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_linked_in" name="cs_team_linked_in" value="<?php if (isset($cs_team_linked_in) && $cs_team_linked_in <> '') echo cs_allow_special_char($cs_team_linked_in) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Vcard Download Link', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_vcard" name="cs_team_vcard" value="<?php if (isset($cs_team_vcard) && $cs_team_vcard <> '') echo cs_allow_special_char($cs_team_vcard) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements" style="border-bottom:none !important;">
                                    <li class="to-label">
                                        <label><?php _e('Feature 1', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_admissions_title" name="cs_team_admissions_title" value="<?php if (isset($cs_team_admissions_title) && $cs_team_admissions_title <> '') echo cs_allow_special_char($cs_team_admissions_title) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Description', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <textarea type="text" id="cs_team_admissions" name="cs_team_admissions"><?php if (isset($cs_team_admissions) && $cs_team_admissions <> '') echo cs_allow_special_char($cs_team_admissions) ?></textarea>
                                    </li>
                                </ul>

                                <ul class="form-elements" style="border-bottom:none !important;">
                                    <li class="to-label">
                                        <label><?php _e('Feature 2', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_certifications_title" name="cs_team_certifications_title" value="<?php if (isset($cs_team_certifications_title) && $cs_team_certifications_title <> '') echo cs_allow_special_char($cs_team_certifications_title) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Description', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <textarea type="text" id="cs_team_certifications" name="cs_team_certifications"><?php if (isset($cs_team_certifications) && $cs_team_certifications <> '') echo cs_allow_special_char($cs_team_certifications) ?></textarea>
                                    </li>
                                </ul>

                            </div>

                            <div id="tab-teams-edu-settings-cs-teams" class="tab-pane fade">
                                <!-- Team Education End-->
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Section Title', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_education_title" name="cs_team_education_title" value="<?php if (isset($cs_team_education_title) && $cs_team_education_title <> '') echo cs_allow_special_char($cs_team_education_title) ?>" />
                                    </li>
                                </ul>  
    <?php cs_team_education_section(); ?>

                                <!-- Team Education End-->
                            </div>

                            <div id="tab-teams-practice-settings-cs-teams" class="tab-pane fade">
                                <!-- Team practice End-->
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Section Title', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_team_practices_title" name="cs_team_practices_title" value="<?php if (isset($cs_team_practices_title) && $cs_team_practices_title <> '') echo cs_allow_special_char($cs_team_practices_title) ?>" />
                                    </li>
                                </ul> 
    <?php cs_team_practice_section(); ?>

                                <!-- Team practice End-->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="csteam_meta_form" value="1" />
        </div>
    </div>
    <div class="clear"></div>
    <?php
}

// Course Meta option save
if (isset($_POST['csteam_meta_form']) and $_POST['csteam_meta_form'] == 1) {
    add_action('save_post', 'cs_meta_team_save');

    function cs_meta_team_save($post_id) {
        $sxe = new SimpleXMLElement("<team></team>");
        if (empty($_POST['cs_team_phone_num'])) {
            $_POST['cs_team_phone_num'] = '';
        }
        if (empty($_POST['cs_team_fax_num'])) {
            $_POST['cs_team_fax_num'] = '';
        }
        if (empty($_POST['cs_team_email'])) {
            $_POST['cs_team_email'] = '';
        }
        if (empty($_POST['cs_team_subtitle'])) {
            $_POST['cs_team_subtitle'] = '';
        }
        if (empty($_POST['cs_team_admissions_title'])) {
            $_POST['cs_team_admissions_title'] = '';
        }
        if (empty($_POST['cs_team_certifications_title'])) {
            $_POST['cs_team_certifications_title'] = '';
        }
        if (empty($_POST['cs_team_admissions'])) {
            $_POST['cs_team_admissions'] = '';
        }
        if (empty($_POST['cs_team_certifications'])) {
            $_POST['cs_team_certifications'] = '';
        }
        if (empty($_POST['cs_team_eval_form'])) {
            $_POST['cs_team_eval_form'] = '';
        }
        if (empty($_POST['cs_team_eval_form_title'])) {
            $_POST['cs_team_eval_form_title'] = '';
        }
        if (empty($_POST['cs_team_facebook'])) {
            $_POST['cs_team_facebook'] = '';
        }
        if (empty($_POST['cs_team_twitter'])) {
            $_POST['cs_team_twitter'] = '';
        }
        if (empty($_POST['cs_team_google_plus'])) {
            $_POST['cs_team_google_plus'] = '';
        }
        if (empty($_POST['cs_team_linked_in'])) {
            $_POST['cs_team_eval_form_title'] = '';
        }
        if (empty($_POST['cs_team_vcard'])) {
            $_POST['cs_team_vcard'] = '';
        }
        if (empty($_POST['cs_team_education_title'])) {
            $_POST['cs_team_education_title'] = '';
        }
        if (empty($_POST['cs_team_practices_title'])) {
            $_POST['cs_team_practices_title'] = '';
        }
        if (empty($_POST['cs_team_rich_edit_title'])) {
            $_POST['cs_team_rich_edit_title'] = '';
        }

        $sxe->addChild('cs_team_phone_num', $_POST['cs_team_phone_num']);
        $sxe->addChild('cs_team_fax_num', $_POST['cs_team_fax_num']);
        $sxe->addChild('cs_team_email', $_POST['cs_team_email']);
        $sxe->addChild('cs_team_subtitle', htmlspecialchars($_POST['cs_team_subtitle']));
        $sxe->addChild('cs_team_admissions_title', htmlspecialchars($_POST['cs_team_admissions_title']));
        $sxe->addChild('cs_team_certifications_title', htmlspecialchars($_POST['cs_team_certifications_title']));
        $sxe->addChild('cs_team_admissions', htmlspecialchars($_POST['cs_team_admissions']));
        $sxe->addChild('cs_team_certifications', htmlspecialchars($_POST['cs_team_certifications']));
        $sxe->addChild('cs_team_eval_form', $_POST['cs_team_eval_form']);
        $sxe->addChild('cs_team_eval_form_title', $_POST['cs_team_eval_form_title']);
        $sxe->addChild('cs_team_facebook', $_POST['cs_team_facebook']);
        $sxe->addChild('cs_team_twitter', $_POST['cs_team_twitter']);
        $sxe->addChild('cs_team_google_plus', $_POST['cs_team_google_plus']);
        $sxe->addChild('cs_team_linked_in', $_POST['cs_team_linked_in']);
        $sxe->addChild('cs_team_vcard', $_POST['cs_team_vcard']);
        $sxe->addChild('cs_team_education_title', $_POST['cs_team_education_title']);
        $sxe->addChild('cs_team_practices_title', $_POST['cs_team_practices_title']);
        $sxe->addChild('cs_team_rich_edit_title', $_POST['cs_team_rich_edit_title']);

        $education_counter = 0;
        if (isset($_POST['dynamic_post_education']) && $_POST['dynamic_post_education'] == '1' && isset($_POST['education_title_array']) && is_array($_POST['education_title_array'])) {
            foreach ($_POST['education_title_array'] as $type) {
                $education_list = $sxe->addChild('educations');
                $education_list->addChild('education_title', htmlspecialchars($_POST['education_title_array'][$education_counter]));
                $education_list->addChild('education_date', htmlspecialchars($_POST['education_date_array'][$education_counter]));
                $education_list->addChild('education_description', htmlspecialchars($_POST['education_description_array'][$education_counter]));
                $education_counter++;
            }
        }

        $practice_counter = 0;
        if (isset($_POST['dynamic_post_practice']) && $_POST['dynamic_post_practice'] == '1' && isset($_POST['practice_title_array']) && is_array($_POST['practice_title_array'])) {
            foreach ($_POST['practice_title_array'] as $type) {
                $practice_list = $sxe->addChild('practices');
                $practice_list->addChild('practice_title', htmlspecialchars($_POST['practice_title_array'][$practice_counter]));
                $practice_list->addChild('practice_description', htmlspecialchars($_POST['practice_description_array'][$practice_counter]));
                $practice_counter++;
            }
        }


        $sxe = cs_page_options_save_xml($sxe);

        update_post_meta($post_id, 'team', $sxe->asXML());
    }

}
// adding Team meta info end
?>