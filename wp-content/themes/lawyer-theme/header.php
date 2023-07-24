<?php
/**
 * The template for displaying header
 */
global $options, $cs_theme_options, $cs_position, $cs_page_builder, $cs_meta_page, $cs_node, $cs_xmlObject, $options, $page_option, $post, $page_colors;
$slider_position = '';
$header_style = '';
$global_var_set = 0;
if (is_page()) {
    $cs_page_bulider = get_post_meta($post->ID, "cs_page_builder", true);
    $cs_xmlData = new stdClass();
    if (isset($cs_page_bulider) && $cs_page_bulider <> '') {
        $cs_xmlData = new SimpleXMLElement($cs_page_bulider);
        $slider_position = (!empty($cs_xmlData->slider_position)) ? $cs_xmlData->slider_position : '';
        $header_style = (!empty($cs_xmlData->header_banner_style)) ? $cs_xmlData->header_banner_style : '';
    }
    $cs_page_options = (!empty($cs_xmlData->cs_page_options)) ? $cs_xmlData->cs_page_options : '';
    if (isset($cs_page_options) and $cs_page_options != 'default' and $cs_page_options <> '') {
        $cs_page_options = trim($cs_page_options);
        $settings = $page_option['theme_options'][$cs_page_options]['theme_option'];
        $page_setting = unserialize(base64_decode($settings));
        $cs_theme_options = $page_setting;
        $global_var_set = 1;
    }
}
// assign un assigned variables with empty string again
include (get_template_directory() . '/include/theme-components/theme_gobal.php');
/* theme unit testing code start */

if (!get_option('cs_theme_options')) {
    $activation_data = cs_reset_data();
    $cs_theme_options = $activation_data;
    $cs_theme_options['cs_default_layout_sidebar'] = 'sidebar-1';
    $cs_theme_options['cs_footer_widget'] = 'off';
}

/* theme unit testing code end */
$cs_builtin_seo_fields = isset($cs_theme_options['cs_builtin_seo_fields']) ? $cs_theme_options['cs_builtin_seo_fields'] : '';
$cs_site_layout = isset($cs_theme_options['cs_layout']) ? $cs_theme_options['cs_layout'] : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <?php
        $cs_builtin_seo_fields = $cs_theme_options['cs_builtin_seo_fields'];
        $cs_seo_title = '';
        if (isset($cs_builtin_seo_fields) && $cs_builtin_seo_fields == 'on') {
            $post_type = get_post_type(get_the_ID());
            if (is_page()) {
                $meta_element = 'cs_page_builder';
            } else {
                $meta_element = 'post';
            }
            $post_meta = get_post_meta(get_the_ID(), "$meta_element", true);
            if ($post_meta <> "") {
                $cs_seo_xmlObject = new SimpleXMLElement($post_meta);
            }
            $cs_seo_title = isset($cs_seo_xmlObject->seosettings->cs_seo_title) ? $cs_seo_xmlObject->seosettings->cs_seo_title : '';
            $cs_seo_description = isset($cs_seo_xmlObject->seosettings->cs_seo_description) ? $cs_seo_xmlObject->seosettings->cs_seo_description : $cs_theme_options['cs_meta_description'];
            $cs_seo_keywords = isset($cs_seo_xmlObject->seosettings->cs_seo_keywords) ? $cs_seo_xmlObject->seosettings->cs_seo_keywords : $cs_theme_options['cs_meta_keywords'];
            if (empty($cs_seo_xmlObject->slider_position))
                $cs_slider_position = "";
            else
                $cs_slider_position = htmlspecialchars($cs_seo_xmlObject->slider_position);
            if (empty($cs_seo_xmlObject->header_banner_style))
                $cs_header_style = "";
            else
                $cs_header_style = $cs_seo_xmlObject->header_banner_style;
            ?>
            <meta name="title" content="<?php echo esc_attr($cs_seo_title) ?>">
            <meta name="keywords" content="<?php echo esc_attr($cs_seo_keywords) ?>">
            <meta name="description" content="<?php echo esc_attr($cs_seo_description) ?>">
        <?php } ?>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <!--[if lt IE 9]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
        <?php
        if (isset($cs_theme_options['cs_custom_css']) and $cs_theme_options['cs_custom_css'] <> '') {
            echo '<style type="text/css">
						' . $cs_theme_options['cs_custom_css'] . '
				  </style> ';
        }
        if (isset($cs_theme_options['cs_custom_js']) and $cs_theme_options['cs_custom_js'] <> '') {
            echo '<script type="text/javascript">
   			' . $cs_theme_options['cs_custom_js'] . '
		</script> ';
        }
        if (function_exists('cs_header_settings')) {
            cs_header_settings();
        }

        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');
        //=====================================================================
        // Header Colors
        //=====================================================================
        if (function_exists('cs_header_color')) {
            cs_header_color();
        }

        //=====================================================================
        // Theme Colors
        //=====================================================================
        if (function_exists('cs_footer_color')) {
            cs_footer_color();
        }
        if (function_exists('cs_theme_colors')) {
            cs_theme_colors();
        }

        wp_head();
        ?>
    </head>
    <?php flush(); ?>
    <body <?php
    body_class();
    if ($cs_site_layout != 'full_width') {
        if (function_exists('cs_bg_image')) {
            echo cs_bg_image();
        }
    }
    ?>  <?php if (isset($cs_theme_options['cs_smooth_scroll']) and $cs_theme_options['cs_smooth_scroll'] == 'on') { ?>style="overflow: hidden;"<?php } ?>>
        <?php
        if (function_exists('cs_under_construction')) {
            cs_under_construction();
        }
        ?>
        <!-- Wrapper Start -->
        <div class="wrapper <?php
        if (function_exists('cs_header_postion_class')) {
            echo cs_header_postion_class();
        }
        ?> wrapper_<?php
             if (function_exists('cs_wrapper_class')) {
                 cs_wrapper_class();
             }
             ?>">
            <!-- Header Start -->
            <?php
            if ($header_style == 'custom_slider' && $slider_position == 'above') {
                if (function_exists('cs_subheader_style')) {
                    cs_subheader_style();
                }
                if (function_exists('cs_get_headers')) {
                    cs_get_headers();
                }
                if (isset($cs_theme_options['cs_smooth_scroll']) and $cs_theme_options['cs_smooth_scroll'] == 'on') {
                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function ($) {
                            cs_nicescroll();
                        });
                    </script>
                    <?php
                }
                if (isset($cs_theme_options['cs_sitcky_header_switch']) and $cs_theme_options['cs_sitcky_header_switch'] == "on") {
                    cs_scrolltofix();
                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function () {
                            jQuery('.main-navbar').scrollToFixed();
                        });
                    </script>
                <?php } ?>
                <div class="clear"></div>
                <?php
            } else {
                if (function_exists('cs_get_headers')) {
                    cs_get_headers();
                }
                if (isset($cs_theme_options['cs_smooth_scroll']) and $cs_theme_options['cs_smooth_scroll'] == 'on') {
                    cs_scrolltofix();
                    ?>

                    <script type="text/javascript">
                        jQuery(document).ready(function ($) {
                            cs_nicescroll();
                        });
                    </script>
                    <?php
                }
                if (isset($cs_theme_options['cs_sitcky_header_switch']) and $cs_theme_options['cs_sitcky_header_switch'] == "on") {
                    cs_scrolltofix();
                    ?>
                    <script type="text/javascript">
                        jQuery(document).ready(function () {
                            jQuery('.main-navbar').scrollToFixed();
                        });
                    </script>
                <?php } ?>
                <div class="clear"></div>
                <?php
                cs_header_position_settings();
                ?>
                <!-- Breadcrumb SecTion -->
                <?php
                if (function_exists('cs_subheader_style')) {
                    cs_subheader_style();
                }
            }
            ?>
            <!-- Breadcrumb SecTion -->
            <!-- Main Content Section -->
            <main id="main-content">
                <!-- Main Section Start -->
                <div class="main-section">