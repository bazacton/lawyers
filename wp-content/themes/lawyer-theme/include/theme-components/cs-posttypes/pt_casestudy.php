<?php
require_once 'pt_functions.php';

//adding columns start
add_filter('manage_casestudy_posts_columns', 'casestudy_columns_add');

function casestudy_columns_add($columns) {
    $columns['author'] = 'Author';
    return $columns;
}

add_action('manage_casestudy_posts_custom_column', 'casestudy_columns');

function casestudy_columns($name) {
    global $post;
    switch ($name) {
        case 'author':
            echo get_the_author();
            break;
    }
}

//adding columns end
if (!function_exists('cs_casestudy_register')) {

    function cs_casestudy_register() {
        $labels = array(
            'name' => __('Case Studies', 'Lawyer'),
            'all_items' => __('Case Studies', 'Lawyer'),
            'add_new_item' => __('Add New CaseStudy', 'Lawyer'),
            'edit_item' => __('Edit Case Study', 'Lawyer'),
            'new_item' => __('New Case Study Item', 'Lawyer'),
            'add_new' => __('Add New Case Study', 'Lawyer'),
            'view_item' => __('View Case Study Item', 'Lawyer'),
            'search_items' => __('Search CaseStudy', 'Lawyer'),
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
        register_post_type('casestudy', $args);
    }

    add_action('init', 'cs_casestudy_register');
}

// adding cat start
$labels = array(
    'name' => __('Case Study Categories', 'Lawyer'),
    'search_items' => __('Search CaseStudy Categories', 'Lawyer'),
    'edit_item' => __('Edit Case Study Category', 'Lawyer'),
    'update_item' => __('Update CaseStudy Category', 'Lawyer'),
    'add_new_item' => __('Add New Category', 'Lawyer'),
    'menu_name' => 'Categories',
);
register_taxonomy('casestudy-category', array('casestudy'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'casestudy-category'),
));

// adding CaseStudy meta info start
add_action('add_meta_boxes', 'cs_meta_casestudy_add');

function cs_meta_casestudy_add() {
    add_meta_box('cs_meta_casestudy', __('CaseStudy Options', 'Lawyer'), 'cs_meta_casestudy', 'casestudy', 'normal', 'high');
}

function cs_meta_casestudy($post) {
    global $post, $cs_xmlObject,$cs_theme_options;
    $cs_theme_options =$cs_theme_options;
    $cs_builtin_seo_fields = $cs_theme_options['cs_builtin_seo_fields'];
    $cs_header_position = $cs_theme_options['cs_header_position'];
    $cs_casestudy = get_post_meta($post->ID, "casestudy", true);
    if ($cs_casestudy <> "") {
        $cs_xmlObject = new SimpleXMLElement($cs_casestudy);
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
        $cs_casestudy_rich_editor_title = __('Description', 'Lawyer');
        $cs_casestudy_case_charge_title = __('Case Charge', 'Lawyer');
        $cs_casestudy_verdict_title = __('The Verdict', 'Lawyer');
        $cs_casestudy_team_title = __('Our Team', 'Lawyer');

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
                                <li><a data-toggle="tab" href="#tab-casestudys-settings-cs-casestudys"><i class="icon-user"></i><?php _e('Case Study Options', 'Lawyer'); ?></a></li>
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
                            <div id="tab-casestudys-settings-cs-casestudys" class="tab-pane fade">
                                <div class="clear"></div>

                                <ul class="form-elements" style="border-bottom:none !important;">
                                    <li class="to-label">
                                        <label><?php _e('Description Title', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_casestudy_rich_editor_title" name="cs_casestudy_rich_editor_title" value="<?php if (isset($cs_casestudy_rich_editor_title) && $cs_casestudy_rich_editor_title <> '') echo cs_allow_special_char($cs_casestudy_rich_editor_title) ?>" />
                                    </li>
                                </ul>

                                <ul class="form-elements" style="border-bottom:none !important;">
                                    <li class="to-label">
                                        <label><?php _e('Case Charge Title', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_casestudy_case_charge_title" name="cs_casestudy_case_charge_title" value="<?php if (isset($cs_casestudy_case_charge_title) && $cs_casestudy_case_charge_title <> '') echo cs_allow_special_char($cs_casestudy_case_charge_title) ?>" />
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Description', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <textarea type="text" id="cs_casestudy_case_charge" name="cs_casestudy_case_charge"><?php if (isset($cs_casestudy_case_charge) && $cs_casestudy_case_charge <> '') echo cs_allow_special_char($cs_casestudy_case_charge) ?></textarea>
                                    </li>
                                </ul>

                                <ul class="form-elements" style="border-bottom:none !important;">
                                    <li class="to-label">
                                        <label><?php _e('The Verdict Title', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_casestudy_verdict_title" name="cs_casestudy_verdict_title" value="<?php if (isset($cs_casestudy_verdict_title) && $cs_casestudy_verdict_title <> '') echo cs_allow_special_char($cs_casestudy_verdict_title) ?>" />
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Description', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <textarea type="text" id="cs_casestudy_verdict" name="cs_casestudy_verdict"><?php if (isset($cs_casestudy_verdict) && $cs_casestudy_verdict <> '') echo cs_allow_special_char($cs_casestudy_verdict) ?></textarea>
                                    </li>
                                </ul>

                                <ul class="form-elements" style="border-bottom:none !important;">
                                    <li class="to-label">
                                        <label><?php _e('Team Title', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_casestudy_team_title" name="cs_casestudy_team_title" value="<?php if (isset($cs_casestudy_team_title) && $cs_casestudy_team_title <> '') echo cs_allow_special_char($cs_casestudy_team_title) ?>" />
                                    </li>
                                </ul>
                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Select Teams', 'Lawyer'); ?></label>
                                    </li>
                                    <?php
                                    if (!empty($cs_casestudy_team)) {
                                        $cs_casestudy_team = json_decode(json_encode($cs_casestudy_team), true);
                                        $cs_casestudy_team = explode(',', $cs_casestudy_team[0]);
                                    }
                                    ?>
                                    <li class="to-field short-field" style="min-height:200px !important;">

                                        <select name="cs_casestudy_team[]" id="cs_casestudy_team" multiple="multiple" style="height:200px !important;">
                                            <option value=""><?php _e('---Select Team---', 'Lawyer'); ?></option>
                                            <?php
                                            query_posts(array('showposts' => "-1", 'post_status' => 'publish', 'post_type' => 'team'));
                                            while (have_posts()) : the_post();

                                                $cs_team_id = get_the_id();
                                                if (!empty($cs_casestudy_team)) {

                                                    if (in_array($cs_team_id, $cs_casestudy_team)) {
                                                        $team_selected = ' selected="selected"';
                                                    } else {
                                                        $team_selected = '';
                                                    }
                                                } else {
                                                    $team_selected = '';
                                                }
                                                ?>
                                                <option value="<?php echo cs_allow_special_char($cs_team_id); ?>"<?php echo cs_allow_special_char($team_selected); ?>><?php the_title(); ?></option>

                                                <?php
                                            endwhile;
                                            wp_reset_query();
                                            wp_reset_postdata();
                                            echo '</select>';
                                            ?>
                                    </li>
                                </ul>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="cscasestudy_meta_form" value="1" />
        </div>
    </div>
    <div class="clear"></div>
    <?php
}

// Course Meta option save
if (isset($_POST['cscasestudy_meta_form']) and $_POST['cscasestudy_meta_form'] == 1) {

    add_action('save_post', 'cs_meta_casestudy_save');

    function cs_meta_casestudy_save($post_id) {
        $sxe = new SimpleXMLElement("<casestudy></casestudy>");
        if (empty($_POST['cs_casestudy_case_charge'])) {
            $_POST['cs_casestudy_case_charge'] = '';
        }
        if (empty($_POST['cs_casestudy_verdict'])) {
            $_POST['cs_casestudy_verdict'] = '';
        }
        if (empty($_POST['cs_casestudy_team'])) {
            $_POST['cs_casestudy_team'] = '';
        }
        if (empty($_POST['cs_casestudy_case_charge_title'])) {
            $_POST['cs_casestudy_case_charge_title'] = '';
        }
        if (empty($_POST['cs_casestudy_verdict_title'])) {
            $_POST['cs_casestudy_verdict_title'] = '';
        }
        if (empty($_POST['cs_casestudy_team_title'])) {
            $_POST['cs_casestudy_team_title'] = '';
        }
        if (empty($_POST['cs_casestudy_rich_editor_title'])) {
            $_POST['cs_casestudy_rich_editor_title'] = '';
        }

        $sxe->addChild('cs_casestudy_case_charge', $_POST['cs_casestudy_case_charge']);
        $sxe->addChild('cs_casestudy_verdict', $_POST['cs_casestudy_verdict']);
        //$sxe->addChild('cs_casestudy_team', implode(',',$_POST['cs_casestudy_team']));

        if (!empty($_POST['cs_casestudy_team']) and $_POST['cs_casestudy_team'][0] <> '') {

            $sxe->addChild('cs_casestudy_team', implode(',', $_POST['cs_casestudy_team']));
        } else {
            
        }

        $sxe->addChild('cs_casestudy_case_charge_title', $_POST['cs_casestudy_case_charge_title']);
        $sxe->addChild('cs_casestudy_verdict_title', $_POST['cs_casestudy_verdict_title']);
        $sxe->addChild('cs_casestudy_team_title', $_POST['cs_casestudy_team_title']);
        $sxe->addChild('cs_casestudy_rich_editor_title', $_POST['cs_casestudy_rich_editor_title']);

        $sxe = cs_page_options_save_xml($sxe);

        update_post_meta($post_id, 'casestudy', $sxe->asXML());
    }

}
// adding CaseStudy meta info end
?>