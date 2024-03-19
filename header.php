<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Finlease
 */

	global $header_type;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<?php // if( get_field('website_schema') ): ?>
		<?php // the_field('website_schema'); ?>
	<?php // endif; ?>	

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-M944KT2');</script>
	<!-- End Google Tag Manager -->

	<meta name="facebook-domain-verification" content="vd5vtc2w7kgxjeq67r32wprh0wf5vy" />

</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M944KT2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php if ( !is_page_template( 'page-templates/template-3rd-party-calculator.php' ) ) : ?>
	<?php if ($header_type == 'landing'): ?>
	
		<div class="header-wrapper">
			<?php get_template_part( 'template-parts/header/landing' ); ?>
		</div>
	
	<?php else: ?>
	
		<div class="header-wrapper">
			<?php get_template_part( 'template-parts/header/content', 'top' ); ?>
			<?php get_template_part( 'template-parts/header/content', 'menu' ); ?>
			<div class="new-menu">
				<div class="container">
					<?php 
						// Somewhere in your header.php add this. container_class and menu_class should match the CSS main class.
						wp_nav_menu( array( 'menu' => 'Secondary Menu', 'container_class' => 'nav-menu', 'menu_class' => 'nav-menu' ) ); 
					?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	
	<?php endif ?>
<?php endif; ?>