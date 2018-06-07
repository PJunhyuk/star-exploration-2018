<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h5 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( '<span class="number">One comment</span> <span class="description">on &ldquo;%s&rdquo;</span>', 'comments title', 'ventcamp' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'<span class="number">%1$s comment</span> <span class="description">on &ldquo;%2$s&rdquo;</span>',
							'<span class="number">%1$s comments</span> <span class="description">on &ldquo;%2$s&rdquo;</span>',
							$comments_number,
							'comments title',
							'ventcamp'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h5>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments('type=comment&avatar_size=42&callback=ventcamp_comment');
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'ventcamp' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply_before' => '<h5 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h5>',
			'class_submit'  => 'btn btn-sm submit-button',
		) );
	?>

</div><!-- .comments-area -->
