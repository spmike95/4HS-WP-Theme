<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package FourHSVTwo
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'fourhsvtwo' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<img src="wp-content/themes/fourhsvtwo/images/custom-logo.gif" alt="Logo">
			<h1 class="site-title">  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle"><?php _e( 'Primary Menu', 'fourhsvtwo' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			<?php get_search_form(); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
