<?php
/**
 * @package FourHSVTwo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php print_post_title() ?>


		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php fourhsvtwo_posted_on(); ?>

			<?php print(" | "); ?>

			<!-- added to create a more "forum" look -->

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'fourhsvtwo' ), __( '1 Comment', 'fourhsvtwo' ), __( '% Comments', 'fourhsvtwo' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'fourhsvtwo' ), '<span class="edit-link">', '</span>' ); ?>

		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<!-- commented out next line to remove content in home page -->
		<?php //the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'fourhsvtwo' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'fourhsvtwo' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<!-- commenting out footer because it is uneccesary for forum look

		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'fourhsvtwo' ) );
				if ( $categories_list && fourhsvtwo_categorized_blog() ) :
			?>
			 
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'fourhsvtwo' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'fourhsvtwo' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>
		
		<!-- moving to header to appear after "posted on..."
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'fourhsvtwo' ), __( '1 Comment', 'fourhsvtwo' ), __( '% Comments', 'fourhsvtwo' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'fourhsvtwo' ), '<span class="edit-link">', '</span>' ); ?>
		-->
	 
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->