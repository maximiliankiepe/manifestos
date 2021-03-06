<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GulpTheme
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

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<input class="comment_position" value=""
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();

			
			if ( 1 === $comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'gulptheme' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'gulptheme' ) ),
					number_format_i18n( $comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<?php 
		
		$comments = get_comments(array('post_id' => get_the_ID()));
				foreach($comments as $comment) :
				?>
					<?php $position = get_comment_meta($comment->comment_ID, 'position'); 

						$positions = explode(",", $position[0]);

					?>
					<div class="comment_positioned" id="comment_<?php echo $comment->comment_ID;  ?>" style="top:<?php echo $positions[1]; ?>px; left:<?php echo $positions[0]; ?>px">
					<div class="comment_content"><?php echo $comment->comment_content ;?></div>
					<div class="comment_footer"><?php echo $comment->comment_author;?>
					<?php echo $comment->comment_date ;?></div>
					
					</div>
					<scriop
					 $(".comment-respond").prependTo('.canvasWrapper');
   			<?php
				endforeach;
		?>
		<!-- .comment-list -->

		<?php the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'gulptheme' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().

	comment_form(array('title_reply' => "Leave a Commentary",
		'label_submit' => 'save',
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( '', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'));
	?>

</div><!-- #comments -->
