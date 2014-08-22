<?php
/**
 * Template Name: Trending Page
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>


<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package FourHSVTwo
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


		<?php

		//displays 10 most recent comments
		//not sure how to induce pagination
$args = array(
	'number' => '10',
	//'post_id' => 1, // use post_id, not post_ID
);

$postarray = array();


$comments = get_comments($args);
foreach($comments as $comment) :

	//use usernum instead of userurl if default links are in place
	$postnumber = $comment->comment_post_ID;
	$authurl = site_url() . "/author/" . get_the_author_meta( 'display_name', get_post_field( 'post_author', $postnumber ));
	$authnum = site_url() . "/?author=" . get_post_field( 'post_author', $postnumber );
	$auth = get_the_author_meta( 'display_name', get_post_field( 'post_author', $postnumber ));
	$posttitle = get_the_title($postnumber);
	$postlink = get_permalink($postnumber);
	$datetime = get_post_field( 'post_date', $postnumber);
	$newdatetime = datetime_convert($datetime);

	if (! in_array($postnumber, $postarray)) {

		array_push($postarray, $postnumber);
		//entry header
		$idpost = "post-" . $postnumber;
		$fullclass = "\"trending post-" . $postnumber . " post type-post status-publish format-standard hentry category-uncategorized\"";
		echo "<article id=$idpost class=$fullclass>";
		echo "<header class=\"entry-header\">";
		echo "<h1>";
	
		echo( "<a href=" . $postlink .">" . $posttitle . "</a>");


		echo "</h1>";

		echo "<div class=\"entry-meta\">";

		echo "Posted on <a href=" . $postlink . ">" . $newdatetime . "</a> by <a href=" . $authnum . ">" . $auth . "</a>";
		echo " | ";

		if ( ! post_password_required($postnumber) && ( comments_open($postnumber) || '0' != (int) get_post_field( 'comment_count', $postnumber ) ) ) :

			$numcoms = (int) get_post_field( 'comment_count', $postnumber );
			$respondlink = $postlink . "#respond";
			$commentlink = $postlink . "#comments";
			
			
			switch ($numcoms) {
				case '0':
					echo "<a href=" . $respondlink . ">Leave a comment</a>";
					break;

				case '1':
					echo "<a href=" . $commentlink . ">1 Comment</a>";
					break;
				
				default:
					echo "<a href=" . $commentlink . ">" . (string) $numcoms . " Comments</a>";
					break;
			} 
		endif; 

		echo "</div><!-- .entry-meta -->";
		echo "</header>";

		echo "</article><!-- #post-## -->";

	}
endforeach;
?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>


