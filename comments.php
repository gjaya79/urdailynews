<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Bad Weather
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

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', BW_THEME ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', BW_THEME ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', BW_THEME ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', BW_THEME ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 64
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', BW_THEME ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', BW_THEME ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', BW_THEME ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', BW_THEME ); ?></p>
	<?php endif; ?>

	<?php 
	
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$comment_args = array(
		'<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'title_reply'=>'Post a new comment',
		'fields' => apply_filters( 'comment_form_default_fields', 
			array(
				'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Name', BW_THEME ) . ( $req ? ' *' : '' ) . '"></p>',   
				'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Email', BW_THEME ) . ( $req ? ' *' : '' ) . '"></p>',
				'url'    => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30"' . $aria_req . ' placeholder="' . __( 'Website', BW_THEME ) . '"></p>'
			)
		),
		'comment_field' => '<p><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __( 'Message', BW_THEME ) . '"></textarea></p>',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'label_submit' => __( 'Post Comment', BW_THEME ),
		'title_reply_to' => __( 'Leave a reply', BW_THEME ),
		'cancel_reply_link' => __( 'Cancel', BW_THEME ),
	);
	
	comment_form($comment_args); ?>

</div><!-- #comments -->
