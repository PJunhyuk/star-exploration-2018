<?php

defined('ABSPATH') or die('No direct access');

if(!function_exists('ventcamp_comment')) {
    /**
     * Custom comments function
     *
     * @param $comment Comment object
     * @param $args Custom arguments
     * @param $depth Max depth of the comments
     */
    function ventcamp_comment($comment, $args, $depth) { ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

        <div class="comment-body">

            <div class="comment-author vcard">
                <?php echo get_avatar($comment, $args['avatar_size']); ?>
                <cite class="fn base_clr_txt"><?php echo get_comment_author_link() ?></cite>
                <span class="says base_clr_txt"></span>
            </div>

            <div class="comment-meta commentmetadata">
                <?php printf(__('%1$s @ %2$s', 'ventcamp'), get_comment_date(),  get_comment_time()) ?>
                <?php edit_comment_link(__('Edit', 'ventcamp'),'  ','') ?>
            </div>

            <div class="comment-data">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php echo esc_html__('Your comment is awaiting moderation.', 'ventcamp') ?></em>
                    <br />
                <?php endif; ?>
                <?php comment_text() ?>
            </div>

            <?php if ( have_comments() ) : ?>
                <?php
                    comment_reply_link(
                        array_merge( $args,
                            array(
                                'before' =>'<div class="reply"><span class="reply-icon base_clr_txt"><i class="fa fa-comment-o"></i></span>',
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'], // Max depth of the comments
                                'after' => '</div>'
                            )
                        )
                    ) ?>
            <?php endif; // end have_comments() ?>

        </div>

    <?php }
}