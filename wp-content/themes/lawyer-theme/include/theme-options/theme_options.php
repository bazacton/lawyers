<?php
// Theme option function
if (!function_exists('cs_options_page')) {

    function cs_options_page() {
        global $cs_theme_options, $options;
        $cs_theme_options =$cs_theme_options;
        ?>
        <div class="theme-wrap fullwidth">
            <div class="inner">
                <div class="outerwrapp-layer">
                    <div class="loading_div">
                        <i class="icon-circle-o-notch fa-spin"></i>
                        <br>
                        <?php esc_html_e('Saving changes...', 'Lawyer'); ?>
                    </div>
                    <div class="form-msg">
                        <i class="icon-check-circle-o"></i>
                        <div class="innermsg"></div>
                    </div>
                </div>
                <div class="row">   
                    <form id="frm" method="post">
                        <?php
                        $theme_options_fields = new theme_options_fields();
                        $return = $theme_options_fields->cs_fields($options);
                        ?>
                        <div class="col1">
                            <nav class="admin-navigtion">
                                <div class="logo">
                                    <a href="#" class="nav-button"><i class="icon-align-justify"></i></a>
                                    <a href="#" class="logo1"><img src="<?php echo get_template_directory_uri() ?>/include/assets/images/logo-themeoption.png" alt=""/></a>

                                </div>
                                <ul>
                                    <?php echo force_balance_tags($return[1], true); ?>
                                </ul>
                            </nav>
                        </div>
                        <div class="col2">
                            <?php echo force_balance_tags($return[0], true); /* Settings */ ?>
                        </div>
                        <div class="clear"></div>
                        <div class="footer">
                            <input type="button" id="submit_btn" name="submit_btn" class="bottom_btn_save" value="<?php _e('Save All Settings', 'Lawyer'); ?>" onclick="javascript:theme_option_save('<?php echo admin_url('admin-ajax.php') ?>', '<?php echo get_template_directory_uri(); ?>');" />
                            <input type="hidden" name="action" value="theme_option_save"  />
                            <input class="bottom_btn_reset" name="reset" type="button" value="<?php _e('Reset All Options', 'Lawyer'); ?>"  
                                   onclick="javascript:cs_rest_all_options('<?php echo esc_js(admin_url('admin-ajax.php')) ?>', '<?php echo esc_js(get_template_directory_uri()) ?>');" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <!--wrap-->
        <script type="text/javascript">
            // Sub Menus Show/hide
            jQuery(document).ready(function ($) {
                jQuery(".sub-menu").parent("li").addClass("parentIcon");
                $("a.nav-button").click(function () {
                    $(".admin-navigtion").toggleClass("navigation-small");
                });

                $("a.nav-button").click(function () {
                    $(".inner").toggleClass("shortnav");
                });

                $(".admin-navigtion > ul > li > a").click(function () {
                    var a = $(this).next('ul')
                    $(".admin-navigtion > ul > li > a").not($(this)).removeClass("changeicon")
                    $(".admin-navigtion > ul > li ul").not(a).slideUp();
                    $(this).next('.sub-menu').slideToggle();
                    $(this).toggleClass('changeicon');
                });
            });

            function show_hide(id) {
                var link = id.replace('#', '');
                jQuery('.horizontal_tab').fadeOut(0);
                jQuery('#' + link).fadeIn(400);
            }

            function toggleDiv(id) {
                jQuery('.col2').children().hide();
                jQuery(id).show();
                location.hash = id + "-show";
                var link = id.replace('#', '');
                jQuery('.categoryitems li').removeClass('active');
                jQuery(".menuheader.expandable").removeClass('openheader');
                jQuery(".categoryitems").hide();
                jQuery("." + link).addClass('active');
                jQuery("." + link).parent("ul").show().prev().addClass("openheader");
            }
            jQuery(document).ready(function () {
                jQuery(".categoryitems").hide();
                jQuery(".categoryitems:first").show();
                jQuery(".menuheader:first").addClass("openheader");
                jQuery(".menuheader").on('click', function (event) {
                    if (jQuery(this).hasClass('openheader')) {
                        jQuery(".menuheader").removeClass("openheader");
                        jQuery(this).next().slideUp(200);
                        return false;
                    }
                    jQuery(".menuheader").removeClass("openheader");
                    jQuery(this).addClass("openheader");
                    jQuery(".categoryitems").slideUp(200);
                    jQuery(this).next().slideDown(200);
                    return false;
                });

                var hash = window.location.hash.substring(1);
                var id = hash.split("-show")[0];
                if (id) {
                    jQuery('.col2').children().hide();
                    jQuery("#" + id).show();
                    jQuery('.categoryitems li').removeClass('active');
                    jQuery(".menuheader.expandable").removeClass('openheader');
                    jQuery(".categoryitems").hide();
                    jQuery("." + id).addClass('active');
                    jQuery("." + id).parent("ul").slideDown(300).prev().addClass("openheader");
                }
            });
            jQuery(function ($) {
                $("#cs_launch_date").datepicker({
                    defaultDate: "+1w",
                    dateFormat: "dd/mm/yy",
                    changeMonth: true,
                    numberOfMonths: 1,
                    onSelect: function (selectedDate) {
                        $("#cs_launch_date").datepicker("option", "minDate", selectedDate);
                    }
                });
            });
        </script>
        <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()) ?>/include/assets/css/jquery_ui_datepicker.css">
        <link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()) ?>/include/assets/css/jquery_ui_datepicker_theme.css">
        <?php
    }

}

// Background Count function
if (!function_exists('cs_bgcount')) {

    function cs_bgcount($name, $count) {
        for ($i = 0; $i <= $count; $i++) {
            $pattern['option' . $i] = $name . $i;
        }
        return $pattern;
    }

}
add_action('init', 'cs_theme_options');
if (!function_exists('cs_theme_options')) {

    function cs_theme_options() {
        global $options, $header_colors, $cs_theme_options;
        $cs_theme_options = $cs_theme_options;
        $on_off_option = array("show" => "on", "hide" => "off");
        $navigation_style = array("left" => "left", "center" => "center", "right" => "right");
        $google_fonts = array('google_font_family_name' => array('', '', ''), 'google_font_family_url' => array('', '', ''));
        $social_network = array('social_net_icon_path' => array('', '', '', '', '', ''), 'social_net_awesome' => array('fa-facebook', 'fa-twitter', 'fa-google-plus', 'fa-skype', 'fa-pinterest', 'fa-envelope-o'), 'social_net_url' => array('https://www.facebook.com/', 'https://www.twitter.com/', 'https://plus.google.com/', 'https://www.skype.com/', 'https://www.pintrest.com/', 'https://www.mail.com/'), 'social_net_tooltip' => array('Facebook', 'Twitter', 'Google Plus', 'Skype', 'Pintrest', 'Mail'), 'social_font_awesome_color' => array('#2d5faa', '#3ba3f3', '#f33b3b', '#22b6f4', '#a82626', '#f4ca22'));


        $sidebar = array('sidebar' => array('default_pages' => __('Default Pages', 'Lawyer'), 'blogs_sidebar' => __('Blogs Sidebar', 'Lawyer'), 'pages_sidebar' => __('Pages Sidebar', 'Lawyer'), 'contact' => __('Contact', 'Lawyer')));
        $menus_locations = array_flip(get_nav_menu_locations());
        $breadcrumb_option = array("option1" => "option1", "option2" => "option2", "option3" => "option3");
        $deafult_sub_header = array('breadcrumbs_sub_header' => __('Breadcrumbs Sub Header', 'Lawyer'), 'slider' => __('Revolution Slider', 'Lawyer'), 'no_header' => __('No sub Header', 'Lawyer'));
        $padding_sub_header = array('Default' => 'default', 'Custom' => 'custom');
        //Menus List
        $menu_option = get_registered_nav_menus();
        foreach ($menu_option as $key => $menu) {
            $menu_location = $key;
            $menu_locations = get_nav_menu_locations();
            $menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
            $menu_name[] = (isset($menu_object->name) ? $menu_object->name : '');
        }
        //Mailchimp List
        $mail_chimp_list[] = '';
        if (isset($cs_theme_options['cs_mailchimp_key'])) {
            $mailchimp_option = $cs_theme_options['cs_mailchimp_key'];
            if ($mailchimp_option <> '') {
                $mc_list = cs_mailchimp_list($mailchimp_option);
                if (is_array($mc_list) && isset($mc_list['data'])) {
                    foreach ($mc_list['data'] as $list) {
                        $mail_chimp_list[$list['id']] = $list['name'];
                    }
                }
            }
        }

        //google fonts array
        $g_fonts = cs_googlefont_list();

        $g_fonts_atts = cs_get_google_font_attribute();

        global $cs_theme_options;
        if (isset($cs_theme_options) and $cs_theme_options <> '') {
            if (isset($cs_theme_options['sidebar']) and count($cs_theme_options['sidebar']) > 0) {
                $cs_sidebar = array('sidebar' => $cs_theme_options['sidebar']);
            } elseif (!isset($cs_theme_options['sidebar'])) {
                $cs_sidebar = array('sidebar' => array());
            }
        } else {
            $cs_sidebar = $sidebar;
        }
        // Set the Options Array
        $options = array();
        $header_colors = cs_header_setting();
        /* general setting options */
        $options[] = array(
            "name" => __("General", "Lawyer"),
            "fontawesome" => 'icon-gear',
            "type" => "heading",
            "options" => array(
                'tab-global-setting' => __('global', 'Lawyer'),
                'tab-header-options' => __('Header', 'Lawyer'),
                'tab-sub-header-options' => __('Sub Header', 'Lawyer'),
                'tab-footer-options' => __('Footer', 'Lawyer'),
                'tab-social-setting' => __('social icons', 'Lawyer'),
                'tab-social-network' => __('social sharing', 'Lawyer'),
                'tab-custom-code' => __('custom code', 'Lawyer'),
            )
        );
        $options[] = array(
            "name" => __("color", "Lawyer"),
            "fontawesome" => 'icon-magic',
            "hint_text" => "",
            "type" => "heading",
            "options" => array(
                'tab-general-color' => __('general', 'Lawyer'),
                'tab-header-color' => __('Header', 'Lawyer'),
                'tab-footer-color' => __('Footer', 'Lawyer'),
                'tab-heading-color' => __('headings', 'Lawyer'),
            )
        );
        $options[] = array(
            "name" => __("typography / fonts", "Lawyer"),
            "fontawesome" => 'icon-font',
            "desc" => "",
            "hint_text" => "",
            "type" => "heading",
            "options" => array(
                'tab-custom-font' => __('Custom Font', 'Lawyer'),
                'tab-font-family' => __('font family', 'Lawyer'),
                'tab-font-size' => __('font size', 'Lawyer'),
            )
        );
        $options[] = array(
            "name" => __("sidebar", "Lawyer"),
            "fontawesome" => 'icon-columns',
            "id" => "tab-sidebar",
            "std" => "",
            "type" => "main-heading",
            "options" => ''
        );
        $options[] = array(
            "name" => __("Seo", "Lawyer"),
            "fontawesome" => 'icon-globe6',
            "id" => "tab-seo",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        $options[] = array(
            "name" => __("global", "Lawyer"),
            "id" => "tab-global-setting",
            "type" => "sub-heading"
        );
        $options[] = array(
            "name" => __("Layout", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Layout type", "Lawyer"),
            "id" => "cs_layout",
            "std" => "full_width",
            "options" => array(
                "boxed" => __("boxed", "Lawyer"),
                "full_width" => __("Full Width", "Lawyer"),
            ),
            "type" => "layout",
        );

        $options[] = array(
            "name" => "",
            "id" => "cs_horizontal_tab",
            "class" => "horizontal_tab",
            "type" => "horizontal_tab",
            "std" => "",
            "options" => array(__('Background', 'Lawyer') => 'background_tab', __('Pattern', 'Lawyer') => 'pattern_tab', __('Custom Image', 'Lawyer') => 'custom_image_tab')
        );

        $options[] = array(
            "name" => __("Background image", "Lawyer"),
            "desc" => "",
            "hint_text" => "Choose from Predefined Background images.",
            "id" => "cs_bg_image",
            "class" => "cs_background_",
            "path" => "background",
            "tab" => "background_tab",
            "std" => "bg1",
            "type" => "layout_body",
            "display" => "block",
            "options" => cs_bgcount('bg', '10')
        );

        $options[] = array("name" => __("Background pattern", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Choose from Predefined Pattern images.", "Lawyer"),
            "id" => "cs_bg_image",
            "class" => "cs_background_",
            "path" => "patterns",
            "tab" => "pattern_tab",
            "std" => "bg1",
            "type" => "layout_body",
            "display" => "none",
            "options" => cs_bgcount('pattern', '27')
        );
        $options[] = array(
            "name" => __("Custom image", "Lawyer"),
            "desc" => "",
            "hint_text" => __("This option can be used only with Boxed Layout.", "Lawyer"),
            "id" => "cs_custom_bgimage",
            "std" => "",
            "tab" => "custom_image_tab",
            "display" => "none",
            "type" => "upload logo"
        );
        $options[] = array("name" => __("Background image position", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Choose image position for body background", "Lawyer"),
            "id" => "cs_bgimage_position",
            "std" => "Center Repeat",
            "type" => "select",
            "options" => array(
                "option1" => "no-repeat center top",
                "option2" => "repeat center top",
                "option3" => "no-repeat center",
                "option4" => "Repeat Center",
                "option5" => "no-repeat left top",
                "option6" => "repeat left top",
                "option7" => "no-repeat fixed center",
                "option8" => "no-repeat fixed center / cover"
            )
        );
        $options[] = array("name" => __("Custom favicon", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Custom favicon for your site.", "Lawyer"),
            "id" => "cs_custom_favicon",
            "std" => get_template_directory_uri() . "/assets/images/favicon.png",
            "type" => "upload logo"
        );

        $options[] = array("name" => __("Smooth Scroll", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Lightweight Script for Page Scrolling animation", "Lawyer"),
            "id" => "cs_smooth_scroll",
            "std" => "off",
            "type" => "checkbox",
            "options" => $on_off_option
        );

        $options[] = array("name" => __("Responsive", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set responsive design layout for mobile devices On/Off here", "Lawyer"),
            "id" => "cs_responsive",
            "std" => "off",
            "type" => "checkbox",
            "options" => $on_off_option
        );

        // end global setting tab					
        // Header top strip option end
        // Header options start
        $options[] = array("name" => __("header", "Lawyer"),
            "id" => "tab-header-options",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Attention for Header Position!", "Lawyer"),
            "id" => "header_postion_attention",
            "std" => " <strong>Relative Position:</strong> The element is positioned relative to its normal position. The header is positioned above the content. <br> <strong>Absolute Position:</strong> The element is positioned relative to its first positioned. The header is positioned on the content.",
            "type" => "announcement"
        );

        $options[] = array("name" => __("Logo", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Upload your custom logo in .png .jpg .gif formats only.", "Lawyer"),
            "id" => "cs_custom_logo",
            "std" => get_template_directory_uri() . "/assets/images/logo.png",
            "type" => "upload logo"
        );
        $options[] = array("name" => __("Logo Height", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set exact logo height otherwise logo will not display normally.", "Lawyer"),
            "id" => "cs_logo_height",
            "min" => '0',
            "max" => '150',
            "std" => "54",
            "type" => "range"
        );
        $options[] = array("name" => __("logo width", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set exact logo width otherwise logo will not display normally.", "Lawyer"),
            "id" => "cs_logo_width",
            "min" => '0',
            "max" => '250',
            "std" => "200",
            "type" => "range"
        );

        $options[] = array("name" => __("Logo margin top and bottom", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Logo spacing/margin from top and bottom.", "Lawyer"),
            "id" => "cs_logo_margintb",
            "min" => '0',
            "max" => '200',
            "std" => "0",
            "type" => "range"
        );
        $options[] = array("name" => __("Logo margin left and right", "Lawyer"),
            "desc" => "",
            "hint_text" => "Logo spacing/margin from left and right.",
            "id" => "cs_logo_marginlr",
            "min" => '0',
            "max" => '200',
            "std" => "0",
            "type" => "range"
        );
        $options[] = array("name" => __("Header Styles", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Choose header style from the given options", "Lawyer"),
            "id" => "cs_header_options",
            "class" => "cs_",
            "std" => "header_2",
            "type" => "layout1",
            "options" => array(
                "header_1" => __("header_1", "Lawyer"),
                "header_2" => __("header_2", "Lawyer"),
            //"header_3"=>"header_3",
            //"header_4"=>"header_4",
            )
        );
        /* header element settings */

        $options[] = array("name" => __("Header Elements", "Lawyer"),
            "id" => "tab-header-options",
            "std" => __("Header Elements", "Lawyer"),
            "type" => "section",
            "options" => ""
        );
        $options[] = array("name" => __("Main Search", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set header search On/Off. Allow user to search site content.", "Lawyer"),
            "id" => "cs_search",
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option
        );

        $options[] = array("name" => __("WPML", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set WordPress Multi Language switcher On/Off in header", "Lawyer"),
            "id" => "cs_wpml_switch",
            "std" => "on",
            "type" => "wpml",
            "options" => $on_off_option
        );

        $options[] = array("name" => __("Sticky Header On/Off", "Lawyer"),
            "desc" => "",
            "id" => "cs_sitcky_header_switch",
            "hint_text" => __("If you enable this option , header will be fixed on top of your browser window.", "Lawyer"),
            "std" => "off",
            "type" => "checkbox",
            "options" => $on_off_option
        );

        $options[] = array("name" => __("Header Position Settings", "Lawyer"),
            "id" => "tab-header-options",
            "std" => __("Header Position Settings", "Lawyer"),
            "type" => "section",
            "options" => ""
        );
        $options[] = array("name" => __("Select Header Position", "Lawyer"),
            "desc" => "Make header position fixed as Absolute or move it",
            "hint_text" => __("Select header position as Absolute OR Relative", "Lawyer"),
            "id" => "cs_header_position",
            "std" => "relative",
            "type" => "select",
            "options" => array('absolute' => 'absolute', 'relative' => 'relative')
        );
        $options[] = array("name" => __("Header Background", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Header settings made here will be implemented on default pages.", "Lawyer"),
            "id" => "cs_headerbg_options",
            "std" => __("Default Header Background", "Lawyer"),
            "type" => "default header background",
            "options" => array('none' => 'None', 'cs_rev_slider' => 'Revolution Slider', 'cs_bg_image_color' => 'Bg Image / bg Color')
        );
        $options[] = array("name" => __("Revolution Slider", "Lawyer"),
            "desc" => "",
            "hint_text" => "<p>Please select Revolution Slider if already included in package. Otherwise buy Sliders  But its optional</p>",
            "id" => "cs_headerbg_slider",
            "std" => "",
            "type" => "headerbg slider",
            "options" => ''
        );
        $options[] = array("name" => __("Background Image", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Upload your custom background image in .png .jpg .gif formats only.", "Lawyer"),
            "id" => "cs_headerbg_image",
            "std" => "",
            "type" => "upload"
        );
        $options[] = array("name" => __("Background Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("set header background color.", "Lawyer"),
            "id" => "cs_headerbg_color",
            "std" => "",
            "type" => "color"
        );
        $options[] = array("name" => __("Header Top Strip", "Lawyer"),
            "id" => "tab-header-options",
            "std" => __("Header Top Strip", "Lawyer"),
            "type" => "section",
            "options" => ""
        );

        $options[] = array("name" => __("Header Strip", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Enable/Disable header top strip.", "Lawyer"),
            "id" => "cs_header_top_strip",
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option);

        $options[] = array("name" => __("Social Icon", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Enable/Disable social icon. Add icons from General > social icon", "Lawyer"),
            "id" => "cs_socail_icon_switch",
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option);

        $options[] = array("name" => __("Top Menu", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Menu location can be set from Appearance > Menu > Manage Menu Locations.", "Lawyer"),
            "id" => "cs_top_menu_switch",
            "std" => "on",
            "type" => "checkbox",
            "options" => $on_off_option);
        $options[] = array("name" => __("Short Text", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Write phone no, email or address for Header top strip", "Lawyer"),
            "id" => "cs_header_strip_tagline_text",
            "std" => '<p><i class="icon-briefcase"></i> Alee 167c, 10435 Berlin, Germany</p>
							<p><i class="icon-phone4"></i> +0044 123 456 789</p>
							<p><i class="icon-envelope3"></i> <a>info@wplawyer.com</a></p>',
            "type" => "textarea");
        $options[] = array("name" => __("Header add sense", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Embed Image/Google add sense Code", "Lawyer"),
            "id" => "cs_header_banner_addsense",
            "std" => '',
            "type" => "textarea");

        /* sub header element settings */
        $options[] = array("name" => __("sub header", "Lawyer"),
            "id" => "tab-sub-header-options",
            "type" => "sub-heading"
        );
        /* $options[] = array( "name" => "Announcement!",
          "id" => "sub_header_announcement",
          "std"=>"Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.",
          "type" => "announcement"
          ); */

        $options[] = array("name" => __("Default", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Sub Header settings made here will be implemented on all pages.", "Lawyer"),
            "id" => "cs_default_header",
            "std" => __("Breadcrumbs Sub Header", "Lawyer"),
            "type" => "default header",
            "options" => $deafult_sub_header
        );
        $options[] = array("name" => __("Content Padding", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Choose default or custom padding for sub header content.", "Lawyer"),
            "id" => "subheader_padding_switch",
            "std" => "Default",
            "type" => "default padding",
            "options" => $padding_sub_header
        );

        $options[] = array("name" => __("Header Border Color", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_header_border_color",
            "std" => "",
            "type" => "color"
        );

        $options[] = array("name" => __("Revolution Slider", "Lawyer"),
            "desc" => "",
            "hint_text" => "<p>Please select Revolution Slider if already included in package. Otherwise buy Sliders from <a href='http://codecanyon.net/' target='_blank'>Codecanyon</a>. But its optional</p>",
            "id" => "cs_custom_slider",
            "std" => "",
            "type" => "slider code",
            "options" => ''
        );
        $options[] = array("name" => __("Padding Top", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set custom padding for sub header content top area.", "Lawyer"),
            "id" => "cs_sh_paddingtop",
            "min" => '0',
            "max" => '200',
            "std" => "45",
            "type" => "range"
        );
        $options[] = array("name" => __("Padding Bottom", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set custom padding for sub header content bottom area.", "Lawyer"),
            "id" => "cs_sh_paddingbottom",
            "min" => '0',
            "max" => '200',
            "std" => "45",
            "type" => "range"
        );
        $options[] = array("name" => __("Content Text Align", "Lawyer"),
            "desc" => "",
            "hint_text" => __("select the text Alignment for sub header content.", "Lawyer"),
            "id" => "cs_title_align",
            "std" => "left",
            "type" => "select",
            "options" => $navigation_style
        );
        $options[] = array("name" => __("Page Title", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set page title On/Off in sub header", "Lawyer"),
            "id" => "cs_title_switch",
            "std" => "on",
            "type" => "checkbox"
        );


        $options[] = array("name" => __("Breadcrumbs", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_breadcrumbs_switch",
            "std" => "on",
            "type" => "checkbox"
        );

        $options[] = array("name" => __("Background Color", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_sub_header_bg_color",
            "std" => "#f5f5f5",
            "type" => "color"
        );
        $options[] = array("name" => __("Text Color", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_sub_header_text_color",
            "std" => "#333333",
            "type" => "color"
        );
        $options[] = array("name" => __("Border Color", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_sub_header_border_color",
            "std" => "#dddddd",
            "type" => "color"
        );
        $options[] = array("name" => __("Background", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Background Image", "Lawyer"),
            "id" => "cs_background_img",
            "std" => "",
            "type" => "upload logo"
        );

        $options[] = array("name" => __("Parallax", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_parallax_bg_switch",
            "std" => "on",
            "type" => "checkbox"
        );

        // start footer options	

        $options[] = array("name" => __("footer options", "Lawyer"),
            "id" => "tab-footer-options",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Footer section", "Lawyer"),
            "desc" => "",
            "hint_text" => __("enable/disable footer area", "Lawyer"),
            "id" => "cs_footer_switch",
            "std" => "on",
            "type" => "checkbox"
        );
        $options[] = array("name" => __("Footer Widgets", "Lawyer"),
            "desc" => "",
            "hint_text" => __("enable/disable footer widget area", "Lawyer"),
            "id" => "cs_footer_widget",
            "std" => "on",
            "type" => "checkbox"
        );


        $options[] = array("name" => __("Social Icons", "Lawyer"),
            "desc" => "",
            "hint_text" => __("enable/disable Social Icons", "Lawyer"),
            "id" => "cs_sub_footer_social_icons",
            "std" => "on",
            "type" => "checkbox");
        $options[] = array("name" => __("Footer Menu", "Lawyer"),
            "desc" => "",
            "hint_text" => __("enable/disable Footer Menu", "Lawyer"),
            "id" => "cs_sub_footer_menu",
            "std" => "on",
            "type" => "checkbox");
        /*$options[] = array("name" => __("NewsLetter Signup", "Lawyer"),
            "desc" => "",
            "hint_text" => __("enable/disable NewsLetter Signup area", "Lawyer"),
            "id" => "cs_footer_newsletter",
            "std" => "on",
            "type" => "checkbox");*/

        $options[] = array("name" => __("footer logo", "Lawyer"),
            "desc" => "",
            "hint_text" => __("set custom footer logo", "Lawyer"),
            "id" => "cs_footer_logo",
            "std" => get_template_directory_uri() . "/assets/images/footer-logo.png",
            "type" => "upload logo");

        $options[] = array("name" => __("Footer Background Image", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set custom Footer Background Image", "Lawyer"),
            "id" => "cs_footer_background_image",
            "std" => "",
            "type" => "upload logo");
        $options[] = array("name" => __("copyright text", "Lawyer"),
            "desc" => "",
            "hint_text" => __("write your own copyright text", "Lawyer"),
            "id" => "cs_copy_right",
            "std" => "&copy; 2014 Theme Options Wordpress All rights reserved.",
            "type" => "textarea"
        );

        $options[] = array("name" => __("Footer Twitter Options", "Lawyer"),
            "id" => "tab-footer-twitter-options",
            "std" => "Footer Twitter Options",
            "type" => "section",
            "options" => ""
        );

        $options[] = array("name" => __("Footer Twitter Background Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set Footer Twitter Background Color", "Lawyer"),
            "id" => "cs_footer_tweet_bgcolor",
            "std" => "#1dcaff",
            "type" => "color"
        );

        $options[] = array("name" => __("footer twitter", "Lawyer"),
            "desc" => "",
            "hint_text" => __("set footer twitter on/off", "Lawyer"),
            "id" => "cs_footer_twitter",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array(
            "name" => __("twitter username", "Lawyer"),
            "desc" => "",
            "hint_text" => __("set footer twitter username", "Lawyer"),
            "id" => "cs_footer_twitter_username",
            "std" => "",
            "type" => "text",
        );

        $options[] = array(
            "name" => __("twitter no. of tweets", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set number of tweets such as 5", "Lawyer"),
            "id" => "cs_footer_twitter_num_tweets",
            "std" => "",
            "type" => "text",
        );

        // End footer tab setting
        /* general colors */
        $options[] = array("name" => __("general colors", "Lawyer"),
            "id" => "tab-general-color",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Theme Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Choose theme skin color", "Lawyer"),
            "id" => "cs_theme_color",
            "std" => "#4b3854",
            "type" => "color"
        );

        $options[] = array("name" => __("Background Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Choose Body Background Color", "Lawyer"),
            "id" => "cs_bg_color",
            "std" => "#eff2f5",
            "type" => "color"
        );

        $options[] = array("name" => __("Body Text Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Choose text color", "Lawyer"),
            "id" => "cs_text_color",
            "std" => "#999",
            "type" => "color"
        );

        // start top strip tab options
        $options[] = array("name" => __("header colors", "Lawyer"),
            "id" => "tab-header-color",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("top strip colors", "Lawyer"),
            "id" => "tab-top-strip-color",
            "std" => __("Top Strip", "Lawyer"),
            "type" => "section",
            "options" => ""
        );
        $options[] = array("name" => __("Background Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Change Top Strip background color", "Lawyer"),
            "id" => "cs_topstrip_bgcolor",
            "std" => "#262626",
            "type" => "color"
        );

        $options[] = array("name" => __("Text Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Change Top Strip text color", "Lawyer"),
            "id" => "cs_topstrip_text_color",
            "std" => "#999999",
            "type" => "color"
        );

        $options[] = array("name" => __("Link Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Change Top Strip link color", "Lawyer"),
            "id" => "cs_topstrip_link_color",
            "std" => "#999999",
            "type" => "color"
        );


        // end top stirp tab options
        // start header color tab options
        $options[] = array("name" => __("Header Colors", "Lawyer"),
            "id" => "tab-header-color",
            "std" => __("Header Colors", "Lawyer"),
            "type" => "section",
            "options" => ""
        );
        $options[] = array("name" => __("Background Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Change Header background color", "Lawyer"),
            "id" => "cs_header_bgcolor",
            "std" => "",
            "type" => "color"
        );
        $options[] = array("name" => __("Navigation Background Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Change Header Navigation Background color", "Lawyer"),
            "id" => "cs_nav_bgcolor",
            "std" => "#ffffff",
            "type" => "color"
        );



        $options[] = array("name" => __("Menu Link color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Change Header Menu Link color", "Lawyer"),
            "id" => "cs_menu_color",
            "std" => "#999999",
            "type" => "color"
        );

        $options[] = array("name" => __("Menu Active Link color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Change Header Menu Active Link color", "Lawyer"),
            "id" => "cs_menu_active_color",
            "std" => "#4b3854",
            "type" => "color"
        );


        $options[] = array("name" => __("Submenu Background", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Change Submenu Background color", "Lawyer"),
            "id" => "cs_submenu_bgcolor",
            "std" => "#262626",
            "type" => "color",
        );

        $options[] = array("name" => __("Submenu Link Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Change Submenu Link color", "Lawyer"),
            "id" => "cs_submenu_color",
            "std" => "#fff",
            "type" => "color"
        );

        $options[] = array("name" => __("Submenu Hover Link Color", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Change Submenu Hover Link color", "Lawyer"),
            "id" => "cs_submenu_hover_color",
            "std" => "#fff",
            "type" => "color"
        );



        /* footer colors */
        $options[] = array("name" => __("footer colors", "Lawyer"),
            "id" => "tab-footer-color",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Footer Background Color", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_footerbg_color",
            "std" => "#0c0d14",
            "type" => "color"
        );

        $options[] = array("name" => __("Footer Title Color", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_title_color",
            "std" => "#fff",
            "type" => "color"
        );

        $options[] = array("name" => __("Footer Text Color", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_footer_text_color",
            "std" => "#fff",
            "type" => "color"
        );

        $options[] = array("name" => __("Footer Link Color", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_link_color",
            "std" => "#fff",
            "type" => "color"
        );

        $options[] = array("name" => __("Footer Widget Background Color", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_sub_footerbg_color",
            "std" => "#171a24",
            "type" => "color"
        );

        $options[] = array("name" => __("Copyright Text", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_copyright_text_color",
            "std" => "#fff",
            "type" => "color"
        );

        /* heading colors */
        $options[] = array("name" => __("heading colors", "Lawyer"),
            "id" => "tab-heading-color",
            "type" => "sub-heading"
        );
        $options[] = array("name" => "heading h1",
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h1_color",
            "std" => "#262626",
            "type" => "color"
        );

        $options[] = array("name" => "heading h2",
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h2_color",
            "std" => "#262626",
            "type" => "color"
        );

        $options[] = array("name" => "heading h3",
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h3_color",
            "std" => "#262626",
            "type" => "color"
        );

        $options[] = array("name" => "heading h4",
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h4_color",
            "std" => "#262626",
            "type" => "color"
        );

        $options[] = array("name" => "heading h5",
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h5_color",
            "std" => "#262626",
            "type" => "color"
        );

        $options[] = array("name" => "heading h6",
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_h6_color",
            "std" => "#262626",
            "type" => "color"
        );

        // end header color tab options	

        /* start custom font family */
        $options[] = array("name" => __("Custom Fonts", "Lawyer"),
            "id" => "tab-custom-font",
            "type" => "sub-heading"
        );

        $options[] = array("name" => __("Custom Font .woff", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Custom font for your site upload .woff format file.", "Lawyer"),
            "id" => "cs_custom_font_woff",
            "std" => "",
            "type" => "upload font"
        );

        $options[] = array("name" => __("Custom Font .ttf", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Custom font for your site upload .ttf format file.", "Lawyer"),
            "id" => "cs_custom_font_ttf",
            "std" => "",
            "type" => "upload font"
        );

        $options[] = array("name" => __("Custom Font .svg", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Custom font for your site upload .svg format file.", "Lawyer"),
            "id" => "cs_custom_font_svg",
            "std" => "",
            "type" => "upload font"
        );

        $options[] = array("name" => __("Custom Font .eot", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Custom font for your site upload .eot format file.", "Lawyer"),
            "id" => "cs_custom_font_eot",
            "std" => "",
            "type" => "upload font"
        );

        /* start font family */
        $options[] = array("name" => __("font family", "Lawyer"),
            "id" => "tab-font-family",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Content Font", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set fonts for Body text", "Lawyer"),
            "id" => "cs_content_font",
            "std" => "Source Sans Pro",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $options[] = array("name" => __("Content Font Attribute", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set Font Attribute", "Lawyer"),
            "id" => "cs_content_font_att",
            "std" => "Regular",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $options[] = array("name" => __("Main Menu Font", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set font for main Menu. It will be applied to sub menu as well", "Lawyer"),
            "id" => "cs_mainmenu_font",
            "std" => "Source Sans Pro",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $options[] = array("name" => __("Main Menu Font Attribute", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set Font Attribute", "Lawyer"),
            "id" => "cs_mainmenu_font_att",
            "std" => "Regular",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $options[] = array("name" => __("Headings Font", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Select font for Headings. It will apply on all posts and pages headings", "Lawyer"),
            "id" => "cs_heading_font",
            "std" => "Vidaloka",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $options[] = array("name" => __("Headings Font Attribute", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set Font Attribute", "Lawyer"),
            "id" => "cs_heading_font_att",
            "std" => "Regular",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        $options[] = array("name" => __("Widget Headings Font", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set font for Widget Headings", "Lawyer"),
            "id" => "cs_widget_heading_font",
            "std" => "Vidaloka",
            "type" => "gfont_select",
            "options" => $g_fonts
        );
        $options[] = array("name" => __("Widget Headings Font Attribute", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set Font Attribute", "Lawyer"),
            "id" => "cs_widget_heading_font_att",
            "std" => "Regular",
            "type" => "gfont_att_select",
            "options" => $g_fonts_atts
        );
        /* start font size */
        $options[] = array("name" => __("Font size", "Lawyer"),
            "id" => "tab-font-size",
            "type" => "sub-heading"
        );

        $options[] = array("name" => __("Content", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_content_size",
            "min" => '6',
            "max" => '50',
            "std" => "14",
            "type" => "range"
        );
        $options[] = array("name" => __("Main Menu", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_mainmenu_size",
            "min" => '6',
            "max" => '50',
            "std" => "12",
            "type" => "range"
        );

        $options[] = array("name" => __("Section Title", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_section_title_size",
            "min" => '6',
            "max" => '50',
            "std" => "24",
            "type" => "range"
        );

        $options[] = array("name" => __("Heading 1", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_1_size",
            "min" => '6',
            "max" => '50',
            "std" => "32",
            "type" => "range"
        );
        $options[] = array("name" => __("Heading 2", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_2_size",
            "min" => '6',
            "max" => '50',
            "std" => "20",
            "type" => "range"
        );
        $options[] = array("name" => __("Heading 3", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_3_size",
            "min" => '6',
            "max" => '50',
            "std" => "18",
            "type" => "range"
        );
        $options[] = array("name" => __("Heading 4", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_4_size",
            "min" => '6',
            "max" => '50',
            "std" => "16",
            "type" => "range"
        );
        $options[] = array("name" => __("Heading 5", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_5_size",
            "min" => '6',
            "max" => '50',
            "std" => "14",
            "type" => "range"
        );
        $options[] = array("name" => __("Heading 6", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_heading_6_size",
            "min" => '6',
            "max" => '50',
            "std" => "12",
            "type" => "range"
        );

        $options[] = array("name" => __("Widget Heading", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_widget_heading_size",
            "min" => '6',
            "max" => '50',
            "std" => "15",
            "type" => "range"
        );

        /* social icons setting */
        $options[] = array("name" => __("social icons", "Lawyer"),
            "id" => "tab-social-setting",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Social Network", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_social_network",
            "std" => "",
            "type" => "networks",
            "options" => $social_network
        );
        /* social icons end */
        /* social Network setting */

        $options[] = array("name" => __("social Sharing", "Lawyer"),
            "id" => "tab-social-network",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Facebook", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_facebook_share",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("Twitter", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_twitter_share",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("Google Plus", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_google_plus_share",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("Pinterest", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_pintrest_share",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("Tumblr", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_tumblr_share",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("Dribbble", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_dribbble_share",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("Instagram", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_instagram_share",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("StumbleUpon", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_stumbleupon_share",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("youtube", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_youtube_share",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("share more", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_share_share",
            "std" => "on",
            "type" => "checkbox");

        /* social network end */



        /* custom code setting */
        $options[] = array("name" => __("custom code", "Lawyer"),
            "id" => "tab-custom-code",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Custom Css", "Lawyer"),
            "desc" => "",
            "hint_text" => __("write you custom css without style tag", "Lawyer"),
            "id" => "cs_custom_css",
            "std" => "",
            "type" => "textarea"
        );

        $options[] = array("name" => __("Custom JavaScript", "Lawyer"),
            "desc" => "",
            "hint_text" => __("write you custom js without script tag", "Lawyer"),
            "id" => "cs_custom_js",
            "std" => "",
            "type" => "textarea"
        );

        /* sidebar tab */
        $options[] = array("name" => __("sidebar", "Lawyer"),
            "id" => "tab-sidebar",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Sidebar", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Select a sidebar from the list already given", "Lawyer"),
            "id" => "cs_sidebar",
            "std" => $sidebar,
            "type" => "sidebar",
            "options" => $sidebar
        );

        $options[] = array("name" => __("post layout", "Lawyer"),
            "id" => "cs_non_metapost_layout",
            "std" => __("single post layout", "Lawyer"),
            "type" => "section",
            "options" => ""
        );
        $options[] = array("name" => __("Single Post Layout", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Use this option to set default layout. It will be applied to all posts created in other theme", "Lawyer"),
            "id" => "cs_single_post_layout",
            "std" => "sidebar_right",
            "type" => "layout",
            "options" => array(
                "no_sidebar" => __("full width", "Lawyer"),
                "sidebar_left" => __("sidebar left", "Lawyer"),
                "sidebar_right" => __("sidebar right", "Lawyer"),
            )
        );

        $options[] = array("name" => __("Single Layout Sidebar", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Select Single Post Layout of your choice for sidebar layout. You cannot select it for full width layout", "Lawyer"),
            "id" => "cs_single_layout_sidebar",
            "std" => "Blogs Sidebar",
            "type" => "select_sidebar",
            "options" => $cs_sidebar
        );

        $options[] = array("name" => __("default pages", "Lawyer"),
            "id" => "default_pages",
            "std" => __("default pages", "Lawyer"),
            "type" => "section",
            "options" => ""
        );
        $options[] = array("name" => __("Default Pages Layout", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set Sidebar for all pages like Search, Author Archive, Category Archive etc", "Lawyer"),
            "id" => "cs_default_page_layout",
            "std" => "sidebar_right",
            "type" => "layout",
            "options" => array(
                "no_sidebar" => __("full width", "Lawyer"),
                "sidebar_left" => __("sidebar left", "Lawyer"),
                "sidebar_right" => __("sidebar right", "Lawyer"),
            )
        );
        $options[] = array("name" => __("Sidebar", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Select pre-made sidebars for default pages on sidebar layout. Full width layout cannot have sidebars", "Lawyer"),
            "id" => "cs_default_layout_sidebar",
            "std" => "Blogs Sidebar",
            "type" => "select_sidebar",
            "options" => $cs_sidebar
        );
        $options[] = array("name" => __("Excerpt", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Set excerpt length/limit from here. It controls text limit for post's content", "Lawyer"),
            "id" => "cs_excerpt_length",
            "std" => "255",
            "type" => "text"
        );

        /* seo */
        $options[] = array("name" => __("Seo", "Lawyer"),
            "id" => "tab-seo",
            "type" => "sub-heading"
        );
        $options[] = array("name" => '<b>' . __("<b>Attention for External Seo Plugins!", "Lawyer") . '</b>',
            "id" => "header_postion_attention",
            "std" => __("If you are using any external Seo plugin, Turn Off these options", "Lawyer"),
            "type" => "announcement"
        );

        $options[] = array("name" => __("Built-in Seo fields", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Turn Seo options On/Off", "Lawyer"),
            "id" => "cs_builtin_seo_fields",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("Meta Description", "Lawyer"),
            "desc" => "",
            "hint_text" => __("HTML attributes that explain the contents of web pages commonly used on search engine result pages (SERPs) for pages snippets", "Lawyer"),
            "id" => "cs_meta_description",
            "std" => "",
            "type" => "text"
        );

        $options[] = array("name" => __("Meta Keywords", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Attributes of meta tags, a list of comma-separated words included in the HTML of a Web page that describe the topic of that page", "Lawyer"),
            "id" => "cs_meta_keywords",
            "std" => "",
            "type" => "text"
        );

        $options[] = array("name" => __("Google Analytics", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Google Analytics is a service offered by Google that generates detailed statistics about a website's traffic, traffic sources, measures conversions and sales. Paste Google Analytics code here", "Lawyer"),
            "id" => "cs_google_analytics",
            "std" => "",
            "type" => "textarea"
        );

        /* maintenance mode */
        $options[] = array("name" => __("Maintenance Mode", "Lawyer"),
            "fontawesome" => 'icon-tasks',
            "id" => "tab-maintenace-mode",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        $options[] = array("name" => __("Maintenance Mode", "Lawyer"),
            "id" => "tab-maintenace-mode",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Maintenace Page", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Users will see Maintenance page & logged in Admin will see normal site.", "Lawyer"),
            "id" => "cs_maintenance_page_switch",
            "std" => "off",
            "type" => "checkbox");

        $options[] = array("name" => __("Show Logo", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Show/Hide logo on Maintenance. Logo can be uploaded from General > Header in CS Theme options.", "Lawyer"),
            "id" => "cs_maintenance_logo_switch",
            "std" => "on",
            "type" => "checkbox");

        $options[] = array("name" => __("Maintenance Text", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Text for Maintenance page. Insert some basic HTML or use shortcodes here.", "Lawyer"),
            "id" => "cs_maintenance_text",
            "std" => "<h1>__('Sorry, We are down for maintenance','Lawyer') </h1><p>__('We are currently under maintenance, if all goes as planned we will be back in','Lawyer')</p>",
            "type" => "textarea"
        );

        $options[] = array("name" => __("Launch Date", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Estimated date for completion of site on Maintenance page.", "Lawyer"),
            "id" => "cs_launch_date",
            "std" => gmdate("dd/mm/yy"),
            "type" => "text"
        );

        /* api options tab */
        $options[] = array("name" => __("api settings", "Lawyer"),
            "fontawesome" => 'icon-chain',
            "id" => "tab-api-options",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        //Start Twitter Api	
        $options[] = array("name" => __("all api settings", "Lawyer"),
            "id" => "tab-api-options",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Twitter", "Lawyer"),
            "id" => "Twitter",
            "std" => __("Twitter", "Lawyer"),
            "type" => "section",
            "options" => ""
        );
        $options[] = array("name" => __("Attention for API Settings!", "Lawyer"),
            "id" => "header_postion_attention",
            "std" => __("API Settings allows admin of the site to show their activity on site semi-automatically. Set your social account API once, it will be update your social activity automatically on your site.", "Lawyer"),
            "type" => "announcement"
        );
        $options[] = array("name" => __("Show Twitter", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Turn Twitter option On/Off", "Lawyer"),
            "id" => "cs_twitter_api_switch",
            "std" => "off",
            "type" => "checkbox");
		$options[] = array("name" => __("Cache Time Limit", 'dir'),
            "desc" => "",
            "hint_text" => "Please enter the time limit in minutes for refresh cache",
            "id" => "cs_cache_limit_time",
            "std" => "",
            "type" => "text");
        
        $options[] = array("name" => __("Number of tweet", 'dir'),
            "desc" => "",
            "hint_text" => "Please enter number of tweet that you get from twitter for chache file.",
            "id" => "cs_tweet_num_post",
            "std" => "",
            "type" => "text");

        $options[] = array("name" => __("Date Time Formate", 'dir'),
            "desc" => "",
            "hint_text" => __("Select date time formate for every tweet.", 'dir'),
            "id" => "cs_twitter_datetime_formate",
            "std" => "",
            "type" => "select_values",
            "options" => array(
                'default' => __('Displays November 06 2012', 'dir'),
                'eng_suff' => __('Displays 6th November', 'dir'),
                'ddmm' => __('Displays 06 Nov', 'dir'),
                'ddmmyy' => __('Displays 06 Nov 2012', 'dir'),
                'full_date' => __('Displays Tues 06 Nov 2012', 'dir'),
                'time_since' => __('Displays in hours, minutes etc', 'dir'),                
            )
        );
        $options[] = array("name" => __("Consumer Key", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_consumer_key",
            "std" => "",
            "type" => "text");
		
        $options[] = array("name" => __("Consumer Secret", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Insert consumer key. To get your account key, <a href='https://dev.twitter.com/' target='_blank'>Click Here </a>", "Lawyer"),
            "id" => "cs_consumer_secret",
            "std" => "",
            "type" => "text");

        $options[] = array("name" => __("Access Token", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Insert Twitter Access Token for permissions. When you create your Twitter App, you get this Token", "Lawyer"),
            "id" => "cs_access_token",
            "std" => "",
            "type" => "text");

        $options[] = array("name" => __("Access Token Secret", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Insert Twitter Access Token Secret here. When you create your Twitter App, you get this Token", "Lawyer"),
            "id" => "cs_access_token_secret",
            "std" => "",
            "type" => "text");
        //end Twitter Api
      
        //start google api
        $options[] = array("name" => __("Google", "Lawyer"),
            "id" => "Google",
            "std" => __("Google+", "Lawyer"),
            "type" => "section",
            "options" => ""
        );
        $options[] = array("name" => __("Google+ Login On/Off", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Turn Google+ Login On/Off", "Lawyer"),
            "id" => "cs_google_login_switch",
            "std" => "off",
            "type" => "checkbox",
            "options" => $on_off_option);

        $options[] = array("name" => __("Google+ Client Id", "Lawyer"),
            "desc" => "",
            "hint_text" => __("Type your Google Login information here", "Lawyer"),
            "id" => "cs_google_client_id",
            "std" => "",
            "type" => "text");

        $options[] = array("name" => __("Google+ Client Secret", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_google_client_secret",
            "std" => "",
            "type" => "text");

        $options[] = array("name" => __("Google+ API key", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_google_api_key",
            "std" => "",
            "type" => "text");

        $options[] = array("name" => __("Fixed redirect url for login", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_google_login_redirect_url",
            "std" => "",
            "type" => "text");

        //end google api
        //start mailChimp api
        $options[] = array("name" => __("Mail Chimp", "Lawyer"),
            "id" => "mailchimp",
            "std" => __("Mail Chimp", "Lawyer"),
            "type" => "section",
            "options" => ""
        );
        $options[] = array("name" => __("Mail Chimp Key", "Lawyer"),
            "desc" => __("Enter a valid Mail Chimp API key here to get started. Once you've done that, you can use the Mail Chimp Widget from the Widgets menu. You will need to have at least Mail Chimp list set up before the using the widget. You can get your mail chimp activation key", "Lawyer"),
            "hint_text" => __("Get your mail chimp key by <a href='https://login.mailchimp.com/' target='_blank'>Clicking Here </a>", "Lawyer"),
            "id" => "cs_mailchimp_key",
            "std" => "90f86a57314446ddbe87c57acc930ce8-us2",
            "type" => "text"
        );

        $options[] = array("name" => __("Mail Chimp List", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "cs_mailchimp_list",
            "std" => "on",
            "type" => "mailchimp",
            "options" => $mail_chimp_list
        );

        $options[] = array("name" => __("Flickr API Setting", "Lawyer"),
            "id" => "flickr_api_setting",
            "std" => __("Flickr API Setting", "Lawyer"),
            "type" => "section",
            "options" => ""
        );
        $options[] = array("name" => __("Flickr key", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "flickr_key",
            "std" => "",
            "type" => "text");
        $options[] = array("name" => __("Flickr secret", "Lawyer"),
            "desc" => "",
            "hint_text" => "",
            "id" => "flickr_secret",
            "std" => "",
            "type" => "text");

        /* Cause Plugin options tab */
        if (class_exists('wp_causes')) {


            $options[] = array("name" => __("Cause settings", "Lawyer"),
                "fontawesome" => 'icon-chain-broken',
                "id" => "tab-cause-options",
                "std" => "",
                "type" => "main-heading",
                "options" => ""
            );
            $options[] = array("name" => __("Cause settings", "Lawyer"),
                "id" => "tab-cause-options",
                "type" => "sub-heading"
            );
            $options[] = array("name" => __("User Profile Page", "Lawyer"),
                "desc" => "",
                "hint_text" => __("Select page for user profile here", "Lawyer"),
                "id" => "cs_dashboard",
                "std" => "",
                "type" => "select_dashboard",
                "options" => ''
            );
            $options[] = array("name" => __("Allow Campaigns From Frontend", "Lawyer"),
                "desc" => "",
                "hint_text" => __("Allow Non Admins to Create Campaigns From Frontend", "Lawyer"),
                "id" => "cs_cause_campaigns_allow",
                "std" => "on",
                "type" => "checkbox",
                "options" => $on_off_option
            );
            $options[] = array("name" => __("New Campaigns Status", "Lawyer"),
                "desc" => "",
                "hint_text" => __("New Campaigns Visibility. You can set default status of user Campaigns", "Lawyer"),
                "id" => "cs_campaigns_visibility",
                "std" => "publish",
                "type" => "select",
                "options" => array(
                    "publish" => "Publish",
                    "private" => "Private",
                )
            );
            $options[] = array("name" => __("Campaigns Description", "Lawyer"),
                "desc" => "",
                "hint_text" => __("It will display on User Campaigns Listing", "Lawyer"),
                "id" => "cs_compaigns_text",
                "std" => __("Campaigns help you organize people to achieve a common goal. Follow these simple steps and start campaigning for what you care about Get people interested with a short description of what yo are trying to do.", "Lawyer"),
                "type" => "textarea"
            );
            $options[] = array("name" => __("Add New Campaigns Text", "Lawyer"),
                "desc" => "",
                "hint_text" => __("It will display on Add Campaigns Page", "Lawyer"),
                "id" => "cs_add_compaigns_text",
                "std" => __("An event happening at a certain time and location, such as a concert, lecture, or festival.", "Lawyer"),
                "type" => "textarea"
            );
            $options[] = array("name" => __("Campaigns Terms & Conditions", "Lawyer"),
                "desc" => "",
                "hint_text" => __("write your own copyright text", "Lawyer"),
                "id" => "cs_compaigns_terms_text",
                "std" => __("Asome decently militantly versus that a enormous less treacherous genially well upon until fishy audaciously where fabulously underneath toucan armadillo far toward illustratively flawlessly shark much a emoted hey tersely pointedly much that hey quetzal up trenchant abundant made alas wildebeest overate overhung during busily burst as jeez much because more added on some thrust out.", "Lawyer"),
                "type" => "textarea"
            );


            //cs_compaigns_terms_text									
            $options[] = array("name" => __("Paypal Sandbox", "Lawyer"),
                "desc" => "",
                "hint_text" => __("Paypal Sandbox On/Off", "Lawyer"),
                "id" => "cs_paypal_sandbox",
                "std" => "on",
                "type" => "checkbox",
                "options" => $on_off_option
            );
            $options[] = array("name" => __("Donor Registeration", "Lawyer"),
                "desc" => "",
                "hint_text" => __("User Registeration For Donation On/Off", "Lawyer"),
                "id" => "cs_donation_user_register",
                "std" => "on",
                "type" => "checkbox",
                "options" => $on_off_option
            );
            $options[] = array("name" => __("Paypal Email", "Lawyer"),
                "desc" => "",
                "hint_text" => "",
                "id" => "paypal_email",
                "std" => "",
                "type" => "text");
            $ipn_url = wp_causes::plugin_url() . 'causes/ipn.php';
            $options[] = array("name" => __("Paypal Ipn Url", "Lawyer"),
                "desc" => $ipn_url,
                "hint_text" => "",
                "id" => "paypal_ipn_url",
                "std" => $ipn_url,
                "type" => "text");
            $options[] = array("name" => __("Paypal Payments", "Lawyer"),
                "desc" => "",
                "hint_text" => "",
                "id" => "paypal_payments",
                "std" => "10,15,20,50,100.500,1000",
                "type" => "text");
            $currency_array = array('U.S. Dollar' => 'USD', 'Australian Dollar' => 'AUD', 'Brazilian Real' => 'BRL', 'Canadian Dollar' => 'CAD', 'Czech Koruna' => 'CZK', 'Danish Krone' => 'DKK', 'Euro' => 'EUR', 'Hong Kong Dollar' => 'HKD', 'Hungarian Forint' => 'HUF', 'Israeli New Sheqel' => 'ILS', 'Japanese Yen' => 'JPY', 'Malaysian Ringgit' => 'MYR', 'Mexican Peso' => 'MXN', 'Norwegian Krone' => 'NOK', 'New Zealand Dollar' => 'NZD', 'Philippine Peso' => 'PHP', 'Polish Zloty' => 'PLN', 'Pound Sterling' => 'GBP', 'Singapore Dollar' => 'SGD', 'Swedish Krona' => 'SEK', 'Swiss Franc' => 'CHF', 'Taiwan New Dollar' => 'TWD', 'Thai Baht' => 'THB', 'Turkish Lira' => 'TRY');
            $options[] = array("name" => __("Currency", "Lawyer"),
                "desc" => "",
                "hint_text" => __("Currency Code", "Lawyer"),
                "id" => "paypal_currency",
                "std" => "publish",
                "type" => "select",
                "options" => $currency_array
            );
            $options[] = array("name" => __("Currency Sign", "Lawyer"),
                "desc" => "",
                "hint_text" => "Use Currency Sign eg: &pound;,&yen;",
                "id" => "paypal_currency_sign",
                "std" => "$",
                "type" => "text");
        }


        // import and export theme options tab
        $options[] = array("name" => __("import & export", "Lawyer"),
            "fontawesome" => 'icon-database',
            "id" => "tab-import-export-options",
            "std" => "",
            "type" => "main-heading",
            "options" => ""
        );
        $options[] = array("name" => __("import & export", "Lawyer"),
            "id" => "tab-import-export-options",
            "type" => "sub-heading"
        );
        $options[] = array("name" => __("Export", "Lawyer"),
            "desc" => "",
            "hint_text" => __("If you want to make changes in your site or want to preserve your current settings, Export them code by saving this code with you. You can restore your settings by pasting this code in Import section below", "Lawyer"),
            "id" => "cs_export_theme_options",
            "std" => "",
            "type" => "export"
        );

        $options[] = array("name" => __("Import", "Lawyer"),
            "desc" => "Import theme options",
            "hint_text" => __("To Import your settings, paste the code that you got in above area and saved it with you", "Lawyer"),
            "id" => "cs_import_theme_options",
            "std" => "",
            "type" => "import"
        );

        update_option('cs_theme_data', $options);
        //update_option('cs_theme_options',$options); 					  
    }

}

// saving all the theme options start
/**
 *
 *
 * Header Colors Setting
 */
function cs_header_setting() {
    global $header_colors;
    $header_colors = array();
    $header_colors['header_colors'] = array(
        'header_2' => array(
            'color' => array(
                'cs_topstrip_bgcolor' => '#262626',
                'cs_topstrip_text_color' => '#999999',
                'cs_topstrip_link_color' => '#999999',
                'cs_header_bgcolor' => '',
                'cs_nav_bgcolor' => '#ffffff',
                'cs_menu_color' => '#999',
                'cs_menu_active_color' => '#4b3854',
                'cs_submenu_bgcolor' => '#262626',
                'cs_submenu_color' => '#fff',
                'cs_submenu_hover_color' => '#fff',
            ),
            'logo' => array(
                'cs_logo_with' => '200',
                'cs_logo_height' => '54',
                'cs_logo_margintb' => '0',
                'cs_logo_marginlr' => '0',
            )
        ),
    );

    return $header_colors;
}
