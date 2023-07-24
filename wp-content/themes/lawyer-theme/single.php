<?php
/**
 * The template for displaying all single posts
 */
global $cs_node, $post, $cs_theme_options, $cs_counter_node;

$cs_uniq = rand(40, 9999999);
if (is_single()) {
    cs_set_post_views($post->ID);
}
$cs_node = new stdClass();
get_header();
$cs_layout = '';
$leftSidebarFlag = false;
$rightSidebarFlag = false;
?>
<!-- PageSection Start -->

<section class="page-section" style=" padding: 0; "> 
    <!-- Container -->
    <div class="container"> 
        <!-- Row -->
        <div class="row">
            <?php
            if (have_posts()):
                while (have_posts()) : the_post();
                    $cs_tags_name = 'post_tag';
                    $cs_categories_name = 'category';
                    $postname = 'post';
                    $image_url = cs_get_post_img_src($post->ID, 844, 475);

                    $post_xml = get_post_meta($post->ID, "post", true);
                    if ($post_xml <> "") {

                        $cs_xmlObject = new SimpleXMLElement($post_xml);
                        $cs_layout = $cs_xmlObject->sidebar_layout->cs_page_layout;
                        $cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_page_sidebar_left;
                        $cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_page_sidebar_right;
                        if (isset($cs_xmlObject->cs_related_post))
                            $cs_related_post = $cs_xmlObject->cs_related_post;
                        else
                            $cs_related_post = '';

                        if (isset($cs_xmlObject->cs_post_tags_show))
                            $post_tags_show = $cs_xmlObject->cs_post_tags_show;
                        else
                            $post_tags_show = '';

                        if (isset($cs_xmlObject->post_social_sharing))
                            $cs_post_social_sharing = $cs_xmlObject->post_social_sharing;
                        else
                            $cs_post_social_sharing = '';

                        if (isset($cs_xmlObject->cs_post_author_info_show))
                            $cs_post_author_info_show = $cs_xmlObject->cs_post_author_info_show;
                        else
                            $cs_post_author_info_show = '';

                        if ($cs_layout == "left") {
                            $cs_layout = "page-content blog-editor";
                            $custom_height = 408;
                            $leftSidebarFlag = true;
                        } else if ($cs_layout == "right") {
                            $cs_layout = "page-content blog-editor";
                            $custom_height = 408;
                            $rightSidebarFlag = true;
                        } else {
                            $cs_layout = "col-md-12";
                            $custom_height = 408;
                        }
                        $postname = 'post';
                    } else {
                        $cs_layout = $cs_theme_options['cs_single_post_layout'];
                        if (isset($cs_layout) && $cs_layout == "sidebar_left") {
                            $cs_layout = "page-content blog-editor";
                            $cs_sidebar_left = $cs_theme_options['cs_single_layout_sidebar'];
                            $custom_height = 408;
                            $leftSidebarFlag = true;
                        } else if (isset($cs_layout) && $cs_layout == "sidebar_right") {
                            $cs_layout = "page-content blog-editor";
                            $cs_sidebar_right = $cs_theme_options['cs_single_layout_sidebar'];
                            $custom_height = 408;
                            $rightSidebarFlag = true;
                        } else {
                            $cs_layout = "col-md-12";
                            $custom_height = 408;
                        }
                        $post_pagination_show = 'on';
                        $post_tags_show = '';
                        $cs_related_post = '';
                        $post_social_sharing = '';
                        $post_social_sharing = '';
                        $cs_post_author_info_show = '';
                        $postname = 'post';
                        $cs_post_social_sharing = '';
                    }
                    if ($post_xml <> "") {
                        $cs_xmlObject = new SimpleXMLElement($post_xml);
                        $post_view = $cs_xmlObject->post_thumb_view;
                        $inside_post_view = $cs_xmlObject->inside_post_thumb_view;
                        $post_video = $cs_xmlObject->inside_post_thumb_video;
                        $post_audio = $cs_xmlObject->inside_post_thumb_audio;
                        $post_slider = $cs_xmlObject->inside_post_thumb_slider;
                        $post_featured_image = $cs_xmlObject->inside_post_featured_image_as_thumbnail;
                        $cs_related_post = $cs_xmlObject->cs_related_post;
                        $cs_post_social_sharing = $cs_xmlObject->post_social_sharing;
                        $post_tags_show = $cs_xmlObject->post_tags_show;
                        $post_pagination_show = $cs_xmlObject->post_pagination_show;
                        $cs_post_author_info_show = $cs_xmlObject->post_author_info_show;
                        $postname = 'post';
                    } else {
                        $cs_xmlObject = new stdClass();
                        $post_view = '';
                        $post_video = '';
                        $post_audio = '';
                        $post_slider = '';
                        $post_slider_type = '';
                        $cs_related_post = '';
                        $post_pagination_show = '';
                        $image_url = '';
                        $width = 0;
                        $height = 0;
                        $image_id = 0;
                        $cs_post_author_info_show = '';
                        $postname = 'post';

                        $cs_xmlObject->post_social_sharing = '';
                    }
                    $custom_height = 408;
                    $width = 844;
                    $height = 475;
                    $image_url = cs_get_post_img_src($post->ID, $width, $height);
                    ?>
                    <!--Left Sidebar Starts-->
                    <?php if ($leftSidebarFlag == true) { ?>
                        <aside class="page-sidebar">
                            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left)) : ?>
                            <?php endif; ?>
                        </aside>
                    <?php } ?>
                    <!--Left Sidebar End--> 

                    <!-- Blog Detail Start -->
                    <div class="<?php echo esc_attr($cs_layout); ?>"> 
                        <!-- Blog Start --> 
                        <!-- Row --> 
                        <div class="col-md-12">
                            <div class="post-option-panel">
                                <ul class="post-options">
                                    <li><i class="icon-calendar4"></i><time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time></li>
                                </ul>
                                <div class="cs-section-title"><h2><?php the_title(); ?></h2></div>
                            </div>
                            <figure class="detailpost">
                                <?php
                                if (isset($inside_post_view) and $inside_post_view <> '') {
                                    if ($inside_post_view == "Slider") {
                                        cs_post_flex_slider($width, $height, get_the_id(), 'post');
                                    } else if ($inside_post_view == "Single Image" && $image_url <> '') {
                                        echo '<img src="' . $image_url . '" alt="" >';
                                    } elseif ($inside_post_view == "Video" and $post_video <> '' and $inside_post_view <> '') {
                                        $url = parse_url($post_video);
                                        if ($url['host'] == $_SERVER["SERVER_NAME"]) {
                                            ?>
                                            <?php
                                            echo do_shortcode('[video width="' . $width . '" height="' . $height . '" mp4="' . $post_video . '"][/video]');
                                        } else {
                                            $video = wp_oembed_get($post_video, array('height' => $custom_height));
                                            $search = array('webkitallowfullscreen', 'mozallowfullscreen', 'frameborder="0"');
                                            echo str_replace($search, '', $video);
                                        }
                                    } elseif ($inside_post_view == "Audio" and $inside_post_view <> '') {

                                        echo do_shortcode('[audio mp3="' . $post_audio . '"][/audio]');
                                    }
                                }
                                ?>
                            </figure>
                        </div>

                        <div class="col-md-12">
                            <ul class="admin-post">
                                <li>
                                    <?php
                                    $current_user = wp_get_current_user();
                                    $custom_image_url = get_user_meta(get_the_author_meta('ID'), 'user_avatar_display', true);
                                    $size = 55;
                                    if (isset($custom_image_url) && $custom_image_url <> '') {
                                        echo '<img src="' . esc_url($custom_image_url) . '" class="avatar photo" id="upload_media" width="' . esc_attr($size) . '" height="' . esc_attr($size) . '" alt="' . esc_attr($current_user->display_name) . '" />';
                                    } else {
                                        ?>
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                            <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('PixFill_author_bio_avatar_size', 55)); ?>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                    <span><?php esc_html_e('Posted by', 'Lawyer'); ?></span>
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a>
                                </li>
                                <li>
                                    <span><?php esc_html_e('Posted in', 'Lawyer'); ?></span>
                                    <?php
                                    if (isset($cs_blog_cat) && $cs_blog_cat != '' && $cs_blog_cat != '0') {
                                        echo '<a href="' . site_url() . '?cat=' . $row_cat->term_id . '">' . $row_cat->name . '</a>';
                                    } else {
                                        $categories_list = get_the_term_list(get_the_id(), 'category', '', '', '');
                                        if ($categories_list) {
                                            printf(__('%1$s', 'Lawyer'), $categories_list);
                                        }
                                    }
                                    ?>
                                </li>
                            </ul>
                            <div class="rich_editor_text blog-editor">
                                <?php
                                the_content();
                                wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages', 'Lawyer') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));
                                ?>
                            </div>
                        </div>

                        <?php
                        $thumb_ID = get_post_thumbnail_id($post->ID);
                        if ($images = get_children(array(
                            'post_parent' => get_the_ID(),
                            'post_type' => 'attachment',
                            'exclude' => $thumb_ID,
                                ))) {
                            ?>
                            <div class="col-md-12">
                                <div class="cs-attachment">
                                    <h5><?php esc_html_e('Blog Attachment', 'Lawyer'); ?></h5>
                                    <ul>
                                        <?php foreach ($images as $image) { ?>
                                            <li>
                                                <?php
                                                if ($image->post_mime_type == 'image/png' || $image->post_mime_type == 'image/gif' || $image->post_mime_type == 'image/jpg' || $image->post_mime_type == 'image/jpeg'
                                                ) {

                                                    $image_url = cs_attachment_image_src($image->ID, 370, 208);
                                                    ?>
                                                    <a href="<?php echo esc_url($image->guid); ?>"><img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image->post_name); ?>"></a>
                                                <?php } else if ($image->post_mime_type == 'application/zip') { ?>
                                                    <a href="<?php echo esc_url($image->guid); ?>"><i class="icon-file-zip-o"></i></a>
                                                <?php } else if ($image->post_mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') { ?>
                                                    <a href="<?php echo esc_url($image->guid); ?>"><i class="icon-file-word-o"></i></a>
                                                <?php } else if ($image->post_mime_type == 'text/plain') { ?>
                                                    <a href="<?php echo esc_url($image->guid); ?>"><i class="icon-file-text"></i></a>
                                                <?php } else if ($image->post_mime_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') { ?>
                                                    <a href="<?php echo esc_url($image->guid); ?>"><i class="icon-file-excel-o"></i></a>
                                                <?php } else { ?>
                                                    <a href="<?php echo esc_url($image->guid); ?>"><i class="icon-align-justify"></i></a>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (isset($post_tags_show) && $post_tags_show == 'on') { ?>
                            <div class="col-md-12">
                                <div class="cs-tags">
                                    <ul>
                                        <?php
                                        $categories_list = get_the_term_list(get_the_id(), 'post_tag', '<li>', '</li><li>', '</li>');
                                        if ($categories_list) {
                                            ?>
                                            <?php
                                            printf(__('%1$s', 'Lawyer'), $categories_list);
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($cs_post_social_sharing == "on") { ?>
                            <div class="col-md-12">
                                <div class="detail-post">
                                    <div class="socialmedia">
                                        <?php cs_social_share(false, true, ''); ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-12">
                            <?php
                            if (isset($post_pagination_show) && $post_pagination_show == 'on') {
                                cs_next_prev_custom_links('post');
                            }
                            ?>
                        </div>

                        <!-- Col Recent Posts Start -->
                        <?php
                        if ($cs_related_post == 'on') {
                            if (empty($cs_xmlObject->cs_related_post_title))
                                $cs_related_post_title = __('Related Posts', 'Lawyer');
                            else
                                $cs_related_post_title = $cs_xmlObject->cs_related_post_title;
                            $owlcount = rand(40, 9999999);
                            cs_owl_carousel();
                            ?>
                            <script>
                                jQuery(document).ready(function ($) {
                                    $('.cs-theme-carousel-<?php echo cs_allow_special_char($owlcount); ?>').owlCarousel({
                                        nav: true,
                                        margin: 30,
                                        navText: [
                                            "<i class=' icon-angle-left'></i>",
                                            "<i class='icon-angle-right'></i>"
                                        ],
                                        responsive: {
                                            0: {
                                                items: 1 // In this configuration 1 is enabled from 0px up to 479px screen size 
                                            },
                                            480: {
                                                items: 2, // from 480 to 677 
                                                nav: false // from 480 to max 
                                            },
                                            678: {
                                                items: 3, // from this breakpoint 678 to 959
                                                center: false // only within 678 and next - 959
                                            },
                                            960: {
                                                items: 3, // from this breakpoint 960 to 1199
                                                center: false,
                                                loop: false
                                            },
                                            1200: {
                                                items: 3
                                            }
                                        }

                                    });
                                });
                            </script>
                            <div class="col-md-12 post-recent">
                                <div class="cs-section-title">
                                    <h2><?php echo esc_attr($cs_related_post_title); ?></h2>
                                </div>
                                <div class="owl-carousel cs-theme-carousel-<?php echo cs_allow_special_char($owlcount); ?> cs-prv-next">
                                    <?php
                                    $custom_taxterms = '';
                                    $width = 360;
                                    $height = 270;
                                    $custom_taxterms = wp_get_object_terms($post->ID, array($cs_categories_name, $cs_tags_name), array('fields' => 'ids'));
                                    $args = array(
                                        'post_type' => $postname,
                                        'post_status' => 'publish',
                                        'posts_per_page' => -1,
                                        'orderby' => 'DESC',
                                        'tax_query' => array(
                                            'relation' => 'OR',
                                            array(
                                                'taxonomy' => $cs_tags_name,
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            ),
                                            array(
                                                'taxonomy' => $cs_categories_name,
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            )
                                        ),
                                        'post__not_in' => array($post->ID),
                                    );
                                    $custom_query = new WP_Query($args);
                                    ?>

                                    <?php
                                    while ($custom_query->have_posts()) : $custom_query->the_post();
                                        $image_url = cs_get_post_img_src($post->ID, $width, $height);

                                        if ($image_url == '') {
                                            $img_class = 'no-image';
                                            $image_url = get_template_directory_uri() . '/assets/images/no-image4x3.jpg';
                                        } else {
                                            $img_class = '';
                                        }
                                        ?>
                                        <div class="item">
                                            <div class="cs-blog blog-grid">
                                                <?php if ($image_url <> "") { ?>
                                                    <div class="cs-media">
                                                        <figure class="<?php echo esc_attr($img_class); ?>"><a href="<?php the_permalink(); ?>"><img alt="blog-grid" src="<?php echo esc_url($image_url); ?>"></a>
                                                        </figure>
                                                    </div>
                                                <?php } ?>
                                                <section class="blog-text">
                                                    <ul class="post-options-v1">
                                                        <li> 
                                                            <?php
                                                            if (isset($cs_blog_cat) && $cs_blog_cat != '' && $cs_blog_cat != '0') {
                                                                echo '<a href="' . site_url() . '?cat=' . $row_cat->term_id . '">' . $row_cat->name . '</a>';
                                                            } else {
                                                                $categories_list = get_the_term_list(get_the_id(), 'category', '', '', '');
                                                                if ($categories_list) {
                                                                    printf(__('%1$s', 'Lawyer'), $categories_list);
                                                                }
                                                            }
                                                            ?>
                                                        </li>
                                                    </ul>
                                                    <h2><a href="<?php echo the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                                    <ul class="post-options">
                                                        <li><i class="icon-calendar4"></i><time datetime="<?php echo date_i18n('Y-m-d', strtotime(get_the_date())); ?>"><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></time></li>
                                                    </ul>
                                                </section>
                                            </div>
                                        </div>

                                    <?php endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
        <?php } ?>
                        <!-- Col Recent Posts End --> 

                        <!-- Col Comments Start -->
        <?php comments_template('', true); ?>
                        <!-- Col Comments End --> 

                        <!-- Blog Post End --> 
                        <!-- Blog End --> 
                        <!-- Blog Detail End --> 
                        <!-- Right Sidebar Start --> 

                        <!-- Right Sidebar End -->
                    <?php
                    endwhile;
                endif;
                ?>

            </div>
                <?php if ($rightSidebarFlag == true) { ?>
                <aside class="page-sidebar">
                <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right)) : endif; ?>
                </aside>
<?php } ?>
        </div>
    </div>
</section>
<!-- PageSection End --> 
<!-- Footer -->

<?php get_footer(); ?>