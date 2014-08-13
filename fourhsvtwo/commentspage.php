<?php
/**
 * Template Name: Comments Page
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
$comments = get_comments($args);
foreach($comments as $comment) :
	$userurl = site_url() . "/author/" . $comment->comment_author;
	$postnumber = $comment->comment_post_ID;
	$posttitle = get_the_title($postnumber);
	$postlink = get_permalink($postnumber);
	$datetime = $comment->comment_date;

	//echo $datetime;
	//echo $userurl;
	//echo "<a href=" . $userurl . ">" . $comment->comment_author . "</a>";
	echo("<a href=" . $userurl . ">" . $comment->comment_author . "</a>" . " on <a href=" . $postlink .">" . $posttitle . "</a> at " . $datetime .'<br />'); 
	echo($comment->comment_content . '<br /> <br />');
endforeach;
?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


			