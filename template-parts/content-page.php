<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Finlease
 */
?>
<div class="defaul-ttitle-block">
	<div class="title-block">
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>
</div>
<?php
if ( class_exists( 'ACF' ) ) {
	$page_blocks = get_field( 'page_flexible_content' );
	if ( ! empty( $page_blocks ) && is_array( $page_blocks ) ) {
		foreach ( $page_blocks as $key => $block ){
			$block_name    = isset( $block['acf_fc_layout'] ) && ! empty( $block['acf_fc_layout'] ) ? $block['acf_fc_layout'] : false;
			$template_path = locate_template( 'page-blocks/block-' . $block_name . '.php' , false, false );
			if ( $block_name && ! empty( $template_path ) ) :
				// Include the template file.
				include( $template_path );
			
			endif;
		}
	}
}
?>
