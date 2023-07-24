<?php
require_once 'pt_functions.php';

//adding columns start
add_filter('manage_practice_posts_columns', 'practice_columns_add');

function practice_columns_add($columns) {
    $columns['author'] = 'Author';
    return $columns;
}

add_action('manage_practice_posts_custom_column', 'practice_columns');

function practice_columns($name) {
    global $post;
    switch ($name) {
        case 'author':
            echo get_the_author();
            break;
    }
}

//adding columns end
if (!function_exists('cs_practice_register')) {

    function cs_practice_register() {
        $labels = array(
            'name' => __('Practices', 'Lawyer'),
            'all_items' => __('Practices', 'Lawyer'),
            'add_new_item' => __('Add New Practice', 'Lawyer'),
            'edit_item' => __('Edit Practice', 'Lawyer'),
            'new_item' => __('New Practice Item', 'Lawyer'),
            'add_new' => __('Add New Practice', 'Lawyer'),
            'view_item' => __('View Practice Item', 'Lawyer'),
            'search_items' => __('Search Practice', 'Lawyer'),
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
        register_post_type('practice', $args);
    }

    add_action('init', 'cs_practice_register');
}

// adding cat start
$labels = array(
    'name' => __('Practice Categories', 'Lawyer'),
    'search_items' => __('Search Practice Categories', 'Lawyer'),
    'edit_item' => __('Edit Practice Category', 'Lawyer'),
    'update_item' => __('Update Practice Category', 'Lawyer'),
    'add_new_item' => __('Add New Category', 'Lawyer'),
    'menu_name' => __('Categories', 'Lawyer'),
);
register_taxonomy('practice-category', array('practice'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'practice-category'),
));

// adding Practice meta info start
add_action('add_meta_boxes', 'cs_meta_practice_add');

function cs_meta_practice_add() {
    add_meta_box('cs_meta_practice', __('Practice Options', 'Lawyer'), 'cs_meta_practice', 'practice', 'normal', 'high');
}

function cs_meta_practice($post) {
    global $post, $cs_xmlObject, $cs_theme_options;
    $cs_theme_options = $cs_theme_options;
    $cs_builtin_seo_fields = $cs_theme_options['cs_builtin_seo_fields'];
    $cs_header_position = $cs_theme_options['cs_header_position'];
    $cs_practice = get_post_meta($post->ID, "practice", true);
    if ($cs_practice <> "") {
        $cs_xmlObject = new SimpleXMLElement($cs_practice);
        $cs_practice_subtitle = isset($cs_xmlObject->cs_practice_subtitle) ? $cs_xmlObject->cs_practice_subtitle : '';
        $cs_practice_icon = isset($cs_xmlObject->cs_practice_icon) ? $cs_xmlObject->cs_practice_icon : '';
        $cs_practice_team = isset($cs_xmlObject->cs_practice_team) ? $cs_xmlObject->cs_practice_team : '';
    } else {
        $cs_practice_subtitle = '';
        $cs_practice_icon = '';
        $cs_practice_team = '';

        if (!isset($cs_xmlObject))
            $cs_xmlObject = new stdClass();
    }

    $rand_id = rand(34, 435);
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
                                <li><a data-toggle="tab" href="#tab-practices-settings-cs-practices"><i class="icon-user"></i><?php _e('Practice Options', 'Lawyer'); ?></a></li>
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
                            <div id="tab-practices-settings-cs-practices" class="tab-pane fade">
                                <div class="clear"></div>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('Sub Title', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field short-field">
                                        <input type="text" id="cs_practice_subtitle" name="cs_practice_subtitle" value="<?php if (isset($cs_practice_subtitle) && $cs_practice_subtitle <> '') echo cs_allow_special_char($cs_practice_subtitle) ?>" />
                                    </li>
                                </ul>

                                <ul class='form-elements' id="cs_infobox_<?php echo cs_allow_special_char($rand_id); ?>">
                                    <li class='to-label'>
                                        <label><?php _e('Select Icon', 'Lawyer'); ?></label>
                                    </li>
                                    <li class="to-field">

                                        <?php cs_fontawsome_icons_box($cs_practice_icon, $rand_id, 'cs_practice_icon'); ?>
                                    </li>
                                </ul>

                                <ul class="form-elements">
                                    <li class="to-label">
                                        <label><?php _e('---Select Team---', 'Lawyer'); ?></label>
                                    </li>
                                    <?php
                                    if (!empty($cs_practice_team)) {
                                        $cs_practice_team = json_decode(json_encode($cs_practice_team), true);
                                        $cs_practice_team = explode(',', $cs_practice_team[0]);
                                    }
                                    ?>
                                    <li class="to-field short-field" style="min-height:200px !important;">

                                        <select name="cs_practice_team[]" id="cs_practice_team" multiple="multiple" style="height:200px !important;">
                                            <option value=""><?php _e('---Select Team---', 'Lawyer'); ?></option>
                                            <?php
                                            query_posts(array('showposts' => "-1", 'post_status' => 'publish', 'post_type' => 'team'));
                                            while (have_posts()) : the_post();

                                                $cs_team_id = get_the_id();
                                                if (!empty($cs_practice_team)) {

                                                    if (in_array($cs_team_id, $cs_practice_team)) {
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
            <input type="hidden" name="cspractice_meta_form" value="1" />
        </div>
    </div>
    <div class="clear"></div>
    <?php
}

// Course Meta option save
if (isset($_POST['cspractice_meta_form']) and $_POST['cspractice_meta_form'] == 1) {

    add_action('save_post', 'cs_meta_practice_save');

    function cs_meta_practice_save($post_id) {
        $sxe = new SimpleXMLElement("<practice></practice>");
        if (empty($_POST['cs_practice_subtitle'])) {
            $_POST['cs_practice_subtitle'] = '';
        }
        if (empty($_POST['cs_practice_icon'])) {
            $_POST['cs_practice_icon'][0] = '';
        }
        if (empty($_POST['cs_practice_team'])) {
            $_POST['cs_practice_team'] = '';
        }

        $sxe->addChild('cs_practice_subtitle', $_POST['cs_practice_subtitle']);
        $sxe->addChild('cs_practice_icon', $_POST['cs_practice_icon']);

        if (!empty($_POST['cs_practice_icon']) and $_POST['cs_practice_icon'][0] <> '') {

            $sxe->addChild('cs_practice_icon', $_POST['cs_practice_icon'][0]);
        }
        if (!empty($_POST['cs_practice_team']) and $_POST['cs_practice_team'][0] <> '') {

            $sxe->addChild('cs_practice_team', implode(',', $_POST['cs_practice_team']));
        }

        $sxe = cs_page_options_save_xml($sxe);

        update_post_meta($post_id, 'practice', $sxe->asXML());
    }

}
// adding Practice meta info end
?>