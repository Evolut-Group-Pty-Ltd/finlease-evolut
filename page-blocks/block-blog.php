<?php
/**
 * Layout for Blog block.
 * 
 * @package Finlease
 */
$blog_title    = isset( $block['blog_title'] ) && ! empty( $block['blog_title'] ) ? $block['blog_title'] : false;
$blog_heading  = isset( $block['blog_heading'] ) && ! empty( $block['blog_heading'] ) ? $block['blog_heading'] : false;
$no_of_blogs   = isset( $block['no_of_blogs'] ) && ! empty( $block['no_of_blogs'] ) ? absint( $block['no_of_blogs'] ) : 3;
$blog_button   = isset( $block['blog_button'] ) && ! empty( $block['blog_button'] ) ? $block['blog_button'] : false;

$blog_args = array(
    'posts_per_page' => $no_of_blogs,
);

$fl_blogs = new WP_Query( $blog_args );
?>

<div class="latestnews">
    <div class="container">
        <div class="title-block">
            <?php if ( $blog_title ) { ?>
                    <span><?php echo esc_html( $blog_title ); ?></span>
            <?php } ?>

            <?php if ( $blog_heading ) { ?>
                    <h2><?php echo esc_html( $blog_heading ); ?></h2>
            <?php } ?>
        </div>

        <?php if ( $fl_blogs->have_posts() ) : ?>
                <div class="owl-carousel owl-theme latest-news-carousel">
                <?php while( $fl_blogs->have_posts() ) : $fl_blogs->the_post(); ?>
                    <div class="item">
                        <div class="latestnews__block">
	                        <a href="<?php the_permalink(); ?>" style="color: inherit;">
<!--
                            	<?php if ( has_post_thumbnail() ) { ?>
                                    <div class="image__block">
                                        <?php the_post_thumbnail( 'finlease-image-blog-listing' ); ?> 
                                    </div>
								<?php } ?>
-->
	                            <div class="content__block">
		                            <div class="date"><?php the_date(); ?></div>
		                            <h3><?php the_title(); ?></h3>
		                            <?php echo wp_strip_all_tags( finlease_limit_words( get_the_content(), 30 ) ); ?>
	                            </div>
	                        </a>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
        <?php
        else : 
            echo esc_html__( 'No Posts Found', 'finlease' );
        endif;
        ?>

        <?php 
        if ( $blog_button ) { 
            $btn_title  = isset( $blog_button['title'] ) && ! empty( $blog_button['title'] ) ? $blog_button['title'] : false;
            $btn_url    = isset( $blog_button['url'] ) && ! empty( $blog_button['url'] ) ? $blog_button['url'] : false;
            $btn_target = isset( $blog_button['target'] ) && ! empty( $blog_button['target'] ) ? $blog_button['target'] : '_self';
            if( $btn_title ) {
        ?>
            <div class="text-center explore__blog">
                <a class="btn btn--big btn--gray--outline" href="<?php echo esc_url(  $btn_url ); ?>" target="<?php echo esc_attr( $btn_target ); ?>"><?php echo esc_html( $btn_title ); ?></a> 
            </div>  
        <?php 
            }
        } 
        ?>
    </div>
</div>
