<?php

//=====================================================================
// Adding Video & Sound Cloud Shortcode start
//=====================================================================
if (!function_exists('cs_video_shortcode')) {

    function cs_video_shortcode($atts, $content = "") {
        $defaults = array('column_size' => '', 'cs_video_section_title' => '', 'video_url' => '', 'video_width' => '500', 'video_height' => '300', 'cs_video_custom_class' => '', 'cs_video_custom_animation' => 'slide', 'cs_video_custom_animation_duration' => '');

        extract(shortcode_atts($defaults, $atts));
        $column_class = cs_custom_column_class($column_size);

        $CustomId = '';
        if (isset($cs_video_custom_class) && $cs_video_custom_class) {
            $CustomId = 'id="' . $cs_video_custom_class . '"';
        }

        if (trim($cs_video_custom_animation) != '') {
            $cs_video_custom_animation = 'wow' . ' ' . $cs_video_custom_animation;
        } else {
            $cs_video_custom_animation = '';
        }
		
		$url = array();
		$array_url = array();
		$video_url = isset($video_url) ? $video_url : '';
		$url = parse_url($video_url);
		if ($url["host"] == 'www.youtube.com') { 
			$array_url = explode("=",$url['query']);
			$video = '<div class="cs-holder">';
			$video .= '<div class="cs-section-title">';
			$video .= '<div class="section-inner"><h4>' . $cs_video_section_title . '</h4></div>';
			$video .= '<figure>';
			$video .= '<iframe title="YouTube video player" class="youtube-player" type="text/html" 
			width="640" height="390" src="http://www.youtube.com/embed/'.$array_url[1].'"
			frameborder="0" allowFullScreen></iframe>';
			$video .= '</figure>';
			$video .= '</div>';
			$video .= '</div>';
			$search = '';
		}else {
		
			$column_class = cs_custom_column_class($column_size);
			$section_title = '';
			if ($cs_video_section_title && trim($cs_video_section_title) != '') {
			$section_title = '<div class="cs-section-title"><h2>' . cs_allow_special_char($cs_video_section_title) . '</h2></div>';
			}
			$video = '<div ' . $CustomId . ' class="' . $column_class . ' ' . $cs_video_custom_class . ' ' . $cs_video_custom_animation . '" style=" animation-duration: ' . $cs_video_custom_animation_duration . 's;">' . $section_title . ' ' . wp_oembed_get($video_url, array('width' => $video_width, 'height' => $video_height)) . '</div>';
			
			$search = array('webkitallowfullscreen', 'mozallowfullscreen', 'frameborder="0"');
		}
		
		return str_replace($search, '', $video);
    }

    add_shortcode('cs_video', 'cs_video_shortcode');
}
// Adding Video & Sound Cloud Shortcode end
//=====================================================================
// Adding image Shortcode start
//=====================================================================
if (!function_exists('cs_image_shortcode')) {

    function cs_image_shortcode($atts, $content = "") {
        $defaults = array('column_size' => '', 'cs_image_section_title' => '', 'image_style' => '', 'cs_image_url' => '#', 'cs_image_title' => '', 'cs_image_caption' => '', 'cs_image_custom_class' => '', 'cs_image_custom_animation' => '');
        extract(shortcode_atts($defaults, $atts));
        $column_class = cs_custom_column_class($column_size);

        $CustomId = '';
        if (isset($cs_image_custom_class) && $cs_image_custom_class) {
            $CustomId = 'id="' . $cs_image_custom_class . '"';
        }

        if (trim($cs_image_custom_animation) != '') {
            $cs_custom_animation = 'wow' . ' ' . $cs_image_custom_animation;
        } else {
            $cs_custom_animation = '';
        }
        $html = '';
        $section_title = '';

        if ($cs_image_section_title && trim($cs_image_section_title) != '') {
            $section_title = '<div class="cs-section-title"><h2>' . $cs_image_section_title . '</h2></div>';
        }

        $column_class = cs_custom_column_class($column_size);
        cs_prettyphoto_enqueue();
        $html .= '<div ' . $CustomId . ' class="image-frame ' . $image_style . ' ' . $cs_custom_animation . ' light-box">';
        $html.= $section_title;
        if (isset($cs_image_url) && $cs_image_url != '') {
            $html .= '<a data-title="' . $cs_image_title . '"  href="' . $cs_image_url . '" rel="prettyPhoto">';
            $html .= '<figure><img alt="" src="' . esc_url($cs_image_url) . '"></figure>';
            $html .= '</a>';
        }

        $html .= '<section>';

        if (isset($cs_image_title) && $cs_image_title != '') {
            $html .= '<h4>' . $cs_image_title . '</h4>';
        }

        if (isset($content) && $content != '') {
            $html .= '<p>' . do_shortcode($content) . '</p>';
        }

        $html .= '</section>';
        $html .= '</div>';

        return do_shortcode($html);
    }

    add_shortcode('cs_image', 'cs_image_shortcode');
}
// Adding image Shortcode   End
//=====================================================================
// Adding Promobox Shortcode Start
//=====================================================================
if (!function_exists('cs_promobox_shortcode')) {

    function cs_promobox_shortcode($atts, $content = "") {
        $defaults = array('cs_promobox_section_title' => '', 'cs_promo_image_url' => '', 'cs_promobox_title' => '', 'cs_promobox_contents' => '', 'cs_promobox_btn_bg_color' => '', 'cs_promobox_title_color' => '', 'cs_promobox_content_color' => '', 'cs_link_title' => 'Read More', 'text_align' => '', 'cs_link' => '#', 'cs_promobox_class' => '', 'cs_promobox_animation' => '', 'bg_repeat' => '', 'text_align' => '', 'target' => '_self');

        extract(shortcode_atts($defaults, $atts));

        if (trim($cs_promobox_animation) != '') {
            $cs_promobox_animation = 'wow' . ' ' . $cs_promobox_animation;
        } else {
            $cs_promobox_animation = '';
        }

        if (isset($bg_repeat) && $bg_repeat == "yes") {
            $repeat = '';
        } else {
            $repeat = 'no-repeat';
        }

        $html = '';
        $section_title = '';
        $background = '';

        if ($cs_promobox_section_title && trim($cs_promobox_section_title) != '') {
            $section_title = '<div class="cs-section-title"><h2>' . cs_allow_special_char($cs_promobox_section_title) . '</h2></div>';
        }

        if (isset($cs_promo_image_url) && $cs_promo_image_url != "") {
            $background = 'style="background:url(' . $cs_promo_image_url . ') ' . $repeat . ';"';
        }

        $html .= '<div class="col-md-12 ' . $cs_promobox_animation . '">';
        $html .= $section_title;
        $html .= '<div class="promo-box ' . $text_align . '" ' . $background . '>';
        $html .= '<section>';

        if (isset($cs_promobox_title) && $cs_promobox_title != "") {
            $html .= '<h4 style="color:' . $cs_promobox_title_color . ' !important;">' . cs_allow_special_char($cs_promobox_title) . '</h4>';
        }

        if (isset($content) && $content != "") {
            $html .= '<p style="color:' . $cs_promobox_content_color . ' !important;">' . do_shortcode($content) . '</p>';
        }

        if (isset($cs_link) && $cs_link <> '') {
            $html .= '<a style="background-color:' . $cs_promobox_btn_bg_color . ';" href="' . $cs_link . '" target="' . $target . '" class="strock small-btn">' . cs_allow_special_char($cs_link_title) . '</a>';
        }

        $html .= '</section>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    add_shortcode('cs_promobox', 'cs_promobox_shortcode');
}
// Adding Promobox Shortcode End
//=====================================================================
// Adding Slider ShortCode Start
//=====================================================================
if (!function_exists('cs_slider_shortcode')) {

    function cs_slider_shortcode($atts) {
        $defaults = array('column_size' => '1/1', 'cs_slider_header_title' => '', 'cs_slider_id' => '');
        extract(shortcode_atts($defaults, $atts));
        $column_class = cs_custom_column_class($column_size);
        ob_start();

        $html = '';

        if (isset($cs_slider_header_title) && $cs_slider_header_title <> '') {
            $html .= '<div class="col-md-12"><div class="cs-section-title"><h2>' . $cs_slider_header_title . '</h2></div></div>';
        }
        $html .= do_shortcode('[rev_slider ' . $cs_slider_id . ']');
        return $html;
    }

    add_shortcode('cs_slider', 'cs_slider_shortcode');
}
// Adding Slider ShortCode  End
//=====================================================================
// Adding image Gallery Shortcode start
//=====================================================================
if (!function_exists('cs_gallery_shortcode')) {

    function cs_gallery_shortcode($atts, $content = "") {
        global $cs_node, $cs_counter_node;
        $defaults = array('column_size' => '', 'cs_gallery_section_title' => '', 'cs_gal_header_title' => '', 'cs_gal_layout' => '', 'cs_gal_album' => '', 'cs_gal_pagination' => '', 'cs_gal_media_per_page' => '', 'cs_gallery_class' => '', 'cs_gallery_animation' => '', 'cs_custom_animation_duration' => '');
        extract(shortcode_atts($defaults, $atts));
        $column_class = cs_custom_column_class($column_size);

        $CustomId = '';
        if (isset($cs_gallery_class) && $cs_gallery_class) {
            $CustomId = 'id="' . $cs_gallery_class . '"';
        }

        $html = '';
        if (!empty($cs_gal_album)) {
            cs_prettyphoto_enqueue();
            $count_post = 0;
            $section_title = '';
            if ($cs_gallery_section_title && trim($cs_gallery_section_title) != '') {
                $section_title = '<div class="cs-section-title"><h2>' . $cs_gallery_section_title . '</h2></div>';
            }
            // galery slug to get id start

            $args = array(
                'name' => (string) $cs_gal_album,
                'post_type' => 'cs_gallery',
                'post_status' => 'publish',
                'showposts' => 1,
            );
            $get_posts = get_posts($args);
            if ($get_posts) {
                $gal_album_db = $get_posts[0]->ID;
            }
            // galery slug to get id end
            $cs_meta_gallery_options = get_post_meta((int) $gal_album_db, "cs_meta_gallery_options", true);
            if (empty($_GET['page_id_all']))
                $_GET['page_id_all'] = 1;
            // pagination start
            if ($cs_meta_gallery_options <> "") {
                $cs_xmlObject = new SimpleXMLElement($cs_meta_gallery_options);
                if ($cs_gal_media_per_page > 0) {
                    $limit_start = $cs_gal_media_per_page * ($_GET['page_id_all'] - 1);
                    $limit_end = $limit_start + $cs_gal_media_per_page;
                    $count_post = count($cs_xmlObject);
                    if ($limit_end > count($cs_xmlObject))
                        $limit_end = count($cs_xmlObject);
                } else {
                    $limit_start = 0;
                    $limit_end = count($cs_xmlObject);
                    $count_post = count($cs_xmlObject);
                }
            }

            $column_class = cs_custom_column_class($column_size);
            $html .= '<div ' . $CustomId . ' class="' . $column_class . ' ' . $cs_gallery_class . ' ' . $cs_gallery_animation . '" style=" animation-duration: ' . $cs_custom_animation_duration . 's;">';
            $html .= $section_title;
            if ($cs_gal_layout == 'gallery-slider') {
                $html .= '<div class="flexslider ' . $cs_gallery_class . ' ' . $cs_gallery_animation . '" style=" animation-duration: ' . $cs_custom_animation_duration . 's;">';
                $html .= '<ul class="slides">';
                if ($cs_meta_gallery_options <> "") {
                    for ($i = $limit_start; $i < $limit_end; $i++) {
                        $path = $cs_xmlObject->gallery[$i]->path;
                        $title = $cs_xmlObject->gallery[$i]->title;
                        $social_network = $cs_xmlObject->gallery[$i]->social_network;
                        $use_image_as = $cs_xmlObject->gallery[$i]->use_image_as;
                        $video_code = $cs_xmlObject->gallery[$i]->video_code;
                        $link_url = $cs_xmlObject->gallery[$i]->link_url;
                        $image_url_full = cs_attachment_image_src($path, 0, 0);
                        $id = trim($path);
                        $image_title = get_the_title($id);
                        if (isset($image_url_full) && $image_url_full != "") {
                            $html .= '<li data-thumb="' . $image_url_full . '"><img src="' . $image_url_full . '" alt=' . $image_title . '></li>';
                        }
                    }
                }
                $html .= '</ul>';
                $html .= '</div>';
                //==Pagination Start
                if ($cs_gal_pagination == "Show Pagination" and $count_post > $cs_gal_media_per_page and $cs_gal_media_per_page > 0) {
                    $qrystr = '';
                    if (isset($_GET['page_id']))
                        $qrystr = "&page_id=" . $_GET['page_id'];
                    $html .= cs_pagination($count_post, $cs_gal_media_per_page, $qrystr, 'Show Pagination');
                }
                //==Pagination End
            } else if ($cs_gal_layout == 'gallery-four-col') {
                $html .= '<div class="gallerylist js-isotope row lightbox clearfix ' . $cs_gallery_class . ' ' . $cs_gallery_animation . '" style=" animation-duration: ' . $cs_custom_animation_duration . 's;" id="containerth">';
                if ($cs_meta_gallery_options <> "") {
                    for ($i = $limit_start; $i < $limit_end; $i++) {
                        $path = $cs_xmlObject->gallery[$i]->path;
                        $title = $cs_xmlObject->gallery[$i]->title;
                        $social_network = $cs_xmlObject->gallery[$i]->social_network;
                        $use_image_as = $cs_xmlObject->gallery[$i]->use_image_as;
                        $video_code = $cs_xmlObject->gallery[$i]->video_code;
                        $link_url = $cs_xmlObject->gallery[$i]->link_url;
                        $image_url_full = cs_attachment_image_src($path, 0, 0);
                        $id = trim($path);
                        $image_title = get_the_title($id);

                        if (isset($image_url_full) && $image_url_full != "") {
                            $html .= '<article class="item col-md-3 has_border">';
                            $html .= '<figure>';
                            $html .= '<a data-rel="prettyPhoto[gallery-four-col]>" data-title="' . $image_title . '"  href="' . $image_url_full . '">' . "<img src='" . $image_url_full . "' data-alt='" . $image_title . "' alt='" . $image_title . "' />" . '</a>';
                            if (isset($image_title) && $image_title != "") {
                                $html .= '<figcaption>';
                                $html .= '<a href="javascript:;">' . $image_title . '</a>';
                                $html .= '</figcaption>';
                            }
                            $html .= '</figure>';
                            $html .= '</article>';
                        }
                    }
                }
                $html .= '</div>';
                //==Pagination Start
                if ($cs_gal_pagination == "Show Pagination" and $count_post > $cs_gal_media_per_page and $cs_gal_media_per_page > 0) {
                    $qrystr = '';
                    if (isset($_GET['page_id']))
                        $qrystr = "&page_id=" . $_GET['page_id'];
                    $html .= cs_pagination($count_post, $cs_gal_media_per_page, $qrystr, 'Show Pagination');
                }
                //==Pagination End
            } else if ($cs_gal_layout == 'gallery-wordpress') {
                $html .= '<div class="gallerylist js-isotope row galthumbnail lightbox clearfix ' . $cs_gallery_class . ' ' . $cs_gallery_animation . '" style=" animation-duration: ' . $cs_custom_animation_duration . 's;" id="containertw">';
                if ($cs_meta_gallery_options <> "") {
                    for ($i = $limit_start; $i < $limit_end; $i++) {
                        $path = $cs_xmlObject->gallery[$i]->path;
                        $title = $cs_xmlObject->gallery[$i]->title;
                        $social_network = $cs_xmlObject->gallery[$i]->social_network;
                        $use_image_as = $cs_xmlObject->gallery[$i]->use_image_as;
                        $video_code = $cs_xmlObject->gallery[$i]->video_code;
                        $link_url = $cs_xmlObject->gallery[$i]->link_url;
                        $image_url_full = cs_attachment_image_src($path, 0, 0);
                        $id = trim($path);
                        $image_title = get_the_title($id);

                        if (isset($image_url_full) && $image_url_full != "") {
                            $html .= '<article class="item col-md-1">';
                            $html .= '<figure>';
                            $html .= '<a data-rel="prettyPhoto[gallery-wordpress]>" data-title="' . $image_title . '"  href="' . $image_url_full . '">' . "<img src='" . $image_url_full . "' data-alt='" . $image_title . "' alt='" . $image_title . "' />" . '</a>';

                            if (isset($image_title) && $image_title != "") {
                                $html .= '<figcaption>';
                                $html .= '<a href="javascript:;">' . $image_title . '</a>';
                                $html .= '</figcaption>';
                            }

                            $html .= '</figure>';
                            $html .= '</article>';
                        }
                    }
                }

                $html .= '</div>';

                //==Pagination Start
                if ($cs_gal_pagination == "Show Pagination" and $count_post > $cs_gal_media_per_page and $cs_gal_media_per_page > 0) {
                    $qrystr = '';
                    if (isset($_GET['page_id']))
                        $qrystr = "&page_id=" . $_GET['page_id'];
                    $html .= cs_pagination($count_post, $cs_gal_media_per_page, $qrystr, 'Show Pagination');
                }
                //==Pagination End
            } else if ($cs_gal_layout == 'gallery-masonry') {


                $html .= '<div class="gallerylist js-isotope row lightbox clearfix ' . $cs_gallery_class . ' ' . $cs_gallery_animation . '" style=" animation-duration: ' . $cs_custom_animation_duration . 's;" id="containeron">';

                if ($cs_meta_gallery_options <> "") {

                    for ($i = $limit_start; $i < $limit_end; $i++) {

                        $path = $cs_xmlObject->gallery[$i]->path;
                        $title = $cs_xmlObject->gallery[$i]->title;
                        $social_network = $cs_xmlObject->gallery[$i]->social_network;
                        $use_image_as = $cs_xmlObject->gallery[$i]->use_image_as;
                        $video_code = $cs_xmlObject->gallery[$i]->video_code;
                        $link_url = $cs_xmlObject->gallery[$i]->link_url;
                        $image_url_full = cs_attachment_image_src($path, 0, 0);
                        $id = trim($path);
                        $image_title = get_the_title($id);

                        if (isset($image_url_full) && $image_url_full != "") {
                            $html .= '<article class="item col-md-3 has_border">';
                            $html .= '<figure>';
                            $html .= '<a data-rel="prettyPhoto[gallery-masonry]>" target="" data-title="' . $image_title . '"  href="' . $image_url_full . '">' . "<img src='" . $image_url_full . "' data-alt='" . $image_title . "' alt='" . $image_title . "' />" . '</a>';

                            if (isset($image_title) && $image_title != "") {
                                $html .= '<figcaption>';
                                $html .= '<a href="javascript:;">' . $image_title . '</a>';
                                $html .= '</figcaption>';
                            }

                            $html .= '</figure>';
                            $html .= '</article>';
                        }
                    }
                }

                $html .= '</div>';

                //==Pagination Start
                if ($cs_gal_pagination == "Show Pagination" and $count_post > $cs_gal_media_per_page and $cs_gal_media_per_page > 0) {
                    $qrystr = '';
                    if (isset($_GET['page_id']))
                        $qrystr = "&page_id=" . $_GET['page_id'];
                    $html .= cs_pagination($count_post, $cs_gal_media_per_page, $qrystr, 'Show Pagination');
                }
                //==Pagination End	
            }
            $html .= '</div>';
        }
        return $html;
    }

    add_shortcode('cs_gallery', 'cs_gallery_shortcode');
}
// Adding image Gallery Shortcode End
//=====================================================================
// Adding List Item start
//=====================================================================
if (!function_exists('cs_album_item_shortcode')) {

    function cs_album_item_shortcode($atts, $content = "") {
        $defaults = array('cs_album_track_title' => '', 'cs_album_track_mp3_url' => '');

        extract(shortcode_atts($defaults, $atts));

        $html = '';
        if (isset($cs_album_track_mp3_url) && !empty($cs_album_track_mp3_url)) {

            $html .= '<source src="' . $cs_album_track_mp3_url . '" title="' . $cs_album_track_title . '">';
        }

        return $html;
    }

    add_shortcode('album_item', 'cs_album_item_shortcode');
}
// adding list item end