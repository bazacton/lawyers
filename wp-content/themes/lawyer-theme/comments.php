<?php
/**
 * The template for displaying Comment form
 */
global $cs_theme_options;
if (comments_open()) {
    if (post_password_required())
        return;
}
?>
<?php if (have_comments()) : ?>
    <div class="col-md-12">
        <div id="cs-comments">

            <div class="cs-section-title"><h2><?php echo comments_number(__('No Comments', 'Lawyer'), __('1 Comment', 'Lawyer'), __('% Comments', 'Lawyer')); ?></h2></div>
            <ul>
                <?php wp_list_comments(array('callback' => 'cs_comment')); ?>
            </ul>
            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
                <div class="navigation">
                    <div class="nav-previous"><?php previous_comments_link(__('<span class="meta-nav">&larr;</span> Older Comments', 'Lawyer')); ?></div>
                    <div class="nav-next"><?php next_comments_link(__('Newer Comments <span class="meta-nav">&rarr;</span>', 'Lawyer')); ?></div>
                </div> <!-- .navigation -->
            <?php endif; // check for comment navigation ?>

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
                <div class="navigation">
                    <div class="nav-previous"><?php previous_comments_link(__('<span class="meta-nav">&larr;</span> Older Comments', 'Lawyer')); ?></div>
                    <div class="nav-next"><?php next_comments_link(__('Newer Comments <span class="meta-nav">&rarr;</span>', 'Lawyer')); ?></div>
                </div><!-- .navigation -->
            <?php endif; ?>
        </div>
    </div>
<?php endif; // end have_comments() ?>
<div class="col-md-12">
    <div class="cs-plain-form cs_form_styling">
        <?php
        global $post_id;
        $you_may_use = __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'Lawyer');
        $must_login = __('You must be <a href="%s">logged in</a> to post a comment.', 'Lawyer');
        $logged_in_as = __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'Lawyer');
        $required_fields_mark = ' ' . __('Required fields are marked %s', 'Lawyer');
        $required_text = sprintf($required_fields_mark, '<span class="required">*</span>');

        $defaults = array('fields' => apply_filters('comment_form_default_fields', array(
                'notes' => '',
                'author' => '<p class="comment-form-author">' .
                '<label>' . __('Name', 'Lawyer') . '</label>' . __('', 'Lawyer') .
                '' . ( $req ? __('', 'Lawyer') : '' ) . '<input id="author"  name="author" class="nameinput" type="text" value=""' .
                esc_attr($commenter['comment_author']) . ' tabindex="1">' .
                '</p><!-- #form-section-author .form-section -->',
                'email' => '<p class="comment-form-email">' .
                '<label>' . __('Email', 'Lawyer') . '</label>' . __('', 'Lawyer') .
                '' . ( $req ? __('', 'Lawyer') : '' ) . '' .
                '<input id="email"  name="email" class="emailinput" type="text"  value=""' .
                esc_attr($commenter['comment_author_email']) . ' size="30" tabindex="2">' .
                '</p><!-- #form-section-email .form-section -->',
                'url' => '<p class="comment-form-phone">' .
                '<label>' . __('Website', 'Lawyer') . '</label>' . __('', 'Lawyer') . '' .
                '<input id="url" name="url" type="text" class="websiteinput"  value="" size="30" tabindex="3">' .
                '</p><!-- #<span class="hiddenSpellError" pre="">form-section-url</span> .form-section -->')),
            'comment_field' => '<p class="comment-form-comment">' .
            '' . __('', 'Lawyer') . '' . ( $req ? __('', 'Lawyer') : '' ) . '' .
            '<label>' . __('Message', 'Lawyer') . '</label><textarea id="comment_mes" name="comment"  class="commenttextarea" rows="4" cols="39"></textarea>' .
            '</p><!-- #form-section-comment .form-section -->',
            'must_log_in' => '<p class="form-submit">' . sprintf($must_login, wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</p>',
            'logged_in_as' => '<p class="form-submit">' . sprintf($logged_in_as, admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))),
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'class_form' => 'form-style',
            'id_form' => 'contact_formnLb',
            'class_submit' => 'form-style',
            'id_submit' => 'cs-bg-color',
            'title_reply' => __('Leave us a reply', 'Lawyer'),
            'title_reply_to' => __('<div class="cs-section-title"><h2>Leave a Reply to %s </h2></div>', 'Lawyer'),
            'cancel_reply_link' => __('Cancel Reply', 'Lawyer'),
            'label_submit' => __('Submit', 'Lawyer'),);
        comment_form($defaults, $post_id);
        ?>
    </div>
</div>

<!-- Col Start -->