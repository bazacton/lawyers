<?php
/**
 * The template for displaying Footer
 */
global $wpdb, $cs_theme_options;
?>
<!-- Main Section End -->
</div>
</main>
<!-- Main Content Section -->
<div class="clear"></div>
<!-- Footer Start -->
<?php
$footer_twitter = '';

$cs_footer_switch = '';
if (isset($cs_theme_options['cs_footer_switch']) && $cs_theme_options['cs_footer_switch'] <> '')
    $cs_footer_switch = $cs_theme_options['cs_footer_switch'];
if (isset($cs_footer_switch) and $cs_footer_switch == 'on') {

    $cs_footer_widget = $cs_theme_options['cs_footer_widget'];
    if (isset($cs_footer_widget) and $cs_footer_widget == 'on') {
        ?>
        <footer id="footer-sec">
            <div class="container">
                <div class="row">
                    <?php
                    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget-1')) : endif;
                    ?>
                </div>
            </div>
        </footer>
        <!-- Footer End -->
    <?php } ?>

    <!-- Bottom Section -->
    <section id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    if (function_exists('cs_footer_logo')) {
                        cs_footer_logo();
                    }
                    ?>
                    <p><?php
                        $cs_copy_right = $cs_theme_options['cs_copy_right'];
                        if (isset($cs_copy_right) and $cs_copy_right <> '') {
                            echo do_shortcode(htmlspecialchars_decode($cs_copy_right));
                        } else {
                            echo '&copy;' . gmdate("Y") . " " . get_option("blogname") . " Wordpress All rights reserved.";
                        }
                        ?> 
                    </p>
                </div>
                <?php $cs_sub_footer_social_icons = $cs_theme_options['cs_sub_footer_social_icons']; ?>
                <div class="col-md-6">
                    <?php if ($cs_sub_footer_social_icons == 'on') { ?>
                        <div class="social-media">
                            <?php
                            if (function_exists('cs_social_network')) {
                                cs_social_network();
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
                <!--row--> 
            </div>
        </div>
    </section>
<?php } ?>
</div>
<!-- Wrapper End -->
<?php
if (isset($cs_theme_options['cs_google_analytics']) and $cs_theme_options['cs_google_analytics'] <> '') {
    echo '<script type="text/javascript">
   					' . htmlspecialchars_decode($cs_theme_options['cs_google_analytics']) . '
			  </script>';
}
wp_footer();
?>
</body>
</html>