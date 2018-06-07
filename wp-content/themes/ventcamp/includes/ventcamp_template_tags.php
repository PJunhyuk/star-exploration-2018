<?php
defined('ABSPATH') or die('No direct access');

if ( ! function_exists( 'ventcamp_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time, category and author.
 */
function ventcamp_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	/*
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}
	*/

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
		//esc_attr( get_the_modified_date( 'c' ) ),
		//esc_html( get_the_modified_date() )
	);

	//Get post date
	$posted_on = sprintf(
		esc_html_x( ' %s', 'post date', 'ventcamp' ),
		//'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		'' . $time_string . ''
	);

	//Get post author
	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'ventcamp' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

    $post_taxonomies = ventcamp_post_taxonomies();

    echo '<a href="' . esc_url( get_permalink() ) . '" class="posted-on">' . $posted_on . '</a> | ' . $post_taxonomies . ' | <span class="post-comments"> <a class="url fn n" href="' . esc_url( get_permalink() ) . '#comments">' . get_comments_number() . ' ' . esc_html__('Comments', 'ventcamp') . '</a></span>'; // WPCS: XSS OK.
	
}
endif;

if ( !function_exists('ventcamp_post_taxonomies') ) {
    /**
     * Helper function used inside the post loop, returns the list of categories and tags
     *
     * @return string List of categories and links
     */
    function ventcamp_post_taxonomies () {
        // Get the comma-separated category list
        $categories_list = get_the_category_list( __( ', ', 'ventcamp' ) );

        // Get the comma-separated tag list
        $tag_list = get_the_tag_list( '', __( ', ', 'ventcamp' ) );

        // If tag list is not empty, add it to the list
        if ( $tag_list != '' ) {
            $post_taxonomies = '<span class="post-cats">' . $categories_list . '</span> | <span class="post-tags">' . __('Tagged under: ', 'ventcamp') . $tag_list . '</span>';
        } else {
            $post_taxonomies = '<span class="post-cats">' . $categories_list . '</span>';
        }

        return $post_taxonomies;
    }
}

if ( ! function_exists( 'ventcamp_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function ventcamp_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'ventcamp' ) );
		if ( $categories_list && ventcamp_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'ventcamp' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'ventcamp' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ventcamp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'ventcamp' ), esc_html__( '1 Comment', 'ventcamp' ), esc_html__( '% Comments', 'ventcamp' ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'ventcamp' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'ventcamp_categorized_blog' ) ) {
	function ventcamp_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'ventcamp_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'ventcamp_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so ventcamp_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so ventcamp_categorized_blog should return false.
			return false;
		}
	}
}

/**
 * Flush out the transients used in ventcamp_categorized_blog.
 */
if ( ! function_exists( 'ventcamp_category_transient_flusher' ) ) {
	function ventcamp_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'ventcamp_categories' );
	}
}
add_action( 'edit_category', 'ventcamp_category_transient_flusher' );
add_action( 'save_post',     'ventcamp_category_transient_flusher' );
