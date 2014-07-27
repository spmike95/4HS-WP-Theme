<?php
/**
 * @package FourHSVTwo
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php print_post_title() ?>

		<div class="entry-meta">
			<?php fourhsvtwo_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<?php //the_content(); ?>


		<!-- next line replaces post content with the url linked to if there is one exists -->

			<?php if (get_post_meta($post->ID, 'url_title', true)){

			echo "<a href=\"", get_post_meta($post->ID, 'url_title', true), "\">", get_post_meta($post->ID, 'url_title', true), "</a>";}

			else {
				the_content();
			} ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'fourhsvtwo' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'fourhsvtwo' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'fourhsvtwo' ) );

			//Steven - commented out to remove "posted in..."

			//if ( ! fourhsvtwo_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				//if ( '' != $tag_list ) {
				//	$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'fourhsvtwo' );
				//} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'fourhsvtwo' );
				//}

			//} else {
				// But this blog has loads of categories so we should probably display them here
			//	if ( '' != $tag_list ) {
			//		$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'fourhsvtwo' );
			//	} else {
			//		$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'fourhsvtwo' );
			//	}

			//} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'fourhsvtwo' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
