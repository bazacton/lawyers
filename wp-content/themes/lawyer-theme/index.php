<?php
/**
 * The template for Home page

 */
get_header();
global $cs_node, $cs_theme_options, $cs_counter_node;

if (isset($cs_theme_options['cs_excerpt_length']) && $cs_theme_options['cs_excerpt_length'] <> '') {
    $default_excerpt_length = $cs_theme_options['cs_excerpt_length'];
} else {
    $default_excerpt_length = '255';
};

$cs_layout = $cs_theme_options['cs_default_page_layout'];
if (isset($cs_layout) && $cs_layout == "sidebar_left") {
    $cs_layout = "content-right col-md-9";
    $custom_height = 390;
} else if (isset($cs_layout) && $cs_layout == "sidebar_right") {
    $cs_layout = "content-left col-md-9";
    $custom_height = 390;
} else {
    $cs_layout = "col-md-12";
    $custom_height = 390;
}
$cs_sidebar = $cs_theme_options['cs_default_layout_sidebar'];

$cs_tags_name = 'post_tag';
$cs_categories_name = 'category';
?>   
<section class="page-section" style="padding:0;">
    <!-- Container -->
    <div class="container">
        <!-- Row -->
        <div class="row">     
            <!--Left Sidebar Starts-->
            <?php if ($cs_layout == 'content-right col-md-9') { ?>
                <div class="content-lt col-md-3"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar)) : ?><?php endif; ?></div>
            <?php } ?>
            <!--Left Sidebar End-->

            <!-- Page Detail Start -->
            <div class="row">
                <div class="<?php echo esc_attr($cs_layout); ?>">

                    <?php if (have_posts()) : ?>
                        <?php
                        /* The loop */
                        if (empty($_GET['page_id_all']))
                            $_GET['page_id_all'] = 1;
                        if (!isset($_GET["s"])) {
                            $_GET["s"] = '';
                        }

                        while (have_posts()) : the_post();
                            $width = '274';
                            $height = '274';
                            $title_limit = 1000;
                            $thumbnail = cs_get_post_img_src($post->ID, $width, $height);
                            $description = 'yes';
                            $excerpt = '255';
                            $post_thumb_view = 'Single Image';
                            $post_xml = get_post_meta(get_the_id(), "post", true);
                            if ($post_xml <> "") {
                                $cs_xmlObject = new SimpleXMLElement($post_xml);
                                $post_thumb_view = $cs_xmlObject->post_thumb_view;
                            }
                            ?>

                            <div class="col-md-12">
                                <article class="cs-blog blog-medium">
                                    <?php
                                    if ($post_thumb_view == 'Single Image') {
                                        if (isset($thumbnail) && $thumbnail != '') {
                                            ?>
                                            <div class="cs-media">
                                                <figure>

                                                    <a href="<?php echo the_permalink(); ?>"><img alt="blog-grid" src="<?php echo esc_url($thumbnail); ?>"></a>

                                                </figure>
                                            </div>
                                            <?php
                                        }
                                    } else if ($post_thumb_view == 'Slider') {
                                        echo '<figure>';
                                        cs_post_flex_slider($width, $height, get_the_id(), 'post-list');
                                        echo '</figure>';
                                    }
                                    ?>
                                    <section class="blog-text">
                                        <ul class="post-options-v1">
                                            <?php
                                            /* Get All Tags */
                                            $categories_list = get_the_term_list(get_the_id(), 'category', '', ', ', '');
                                            if ($categories_list) {
                                                echo '<li> <i class="icon-bars"></i>';
                                                printf(__('%1$s', 'Lawyer'), $categories_list);
                                                echo ' </li>';
                                            }
                                            // End if Tags 
                                            ?>
                                        </ul>
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <ul class="post-options">
                                            <li><i class="icon-calendar4"></i><?php echo date_i18n(get_option('date_format'), strtotime(get_the_date())); ?></li>
                                            <?php cs_featured(); ?>

                                        </ul>
                                        <div class="cs-seprator"><div class="devider1"></div></div>
                                        <p><?php echo cs_get_the_excerpt(255, 'false', ''); ?></p> 
                                        <a href="<?php the_permalink(); ?>" class="readmore-btn"><?php _e('Read More', 'Lawyer') ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-icon.png" alt="read_more"></a>
                                        <ul class="post-option-btn">
                                            <li><a href="<?php comments_link(); ?>"><i class="icon-comment-o"></i><?php echo comments_number(__('0', 'Lawyer'), __('1', 'Lawyer'), __('%', 'Lawyer')); ?> </a></li>
                                        </ul>
                                    </section>
                                </article>

                            </div>
                            <?php
                        endwhile;
                    else:
                        if (function_exists('fnc_no_result_found')) {
                            fnc_no_result_found();
                        }
                    endif;
                    ?>

                    <?php
                    $qrystr = '';
                    if (isset($_GET['page_id']))
                        $qrystr .= "&page_id=" . $_GET['page_id'];
                    if ($wp_query->found_posts > get_option('posts_per_page')) {
                        if (function_exists('cs_pagination')) {
                            echo cs_pagination(wp_count_posts()->publish, get_option('posts_per_page'), $qrystr);
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Page Detail End -->

            <!-- Right Sidebar Start -->
            <?php if ($cs_layout == 'content-left col-md-9') { ?>
                <div class="content-rt col-md-3"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar)) : ?><?php endif; ?></div>
            <?php } ?>
            <!-- Right Sidebar End -->
        </div> 	
    </div>
</section>
<?php get_footer(); ?>