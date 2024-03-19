<?php
/**
 * Layout for Text block.
 * 
 * @package Finlease
 */
$tb_style         = isset( $block['tb_style'] ) ? $block['tb_style'] : false;
$tb_section_title = isset( $block['tb_section_title'] ) && ! empty( $block['tb_section_title'] ) ? $block['tb_section_title'] : false;
$tb_heading       = isset( $block['tb_heading'] ) && ! empty( $block['tb_heading'] ) ? $block['tb_heading'] : false;
$tb_sub_heading   = isset( $block['tb_sub_heading'] ) && ! empty( $block['tb_sub_heading'] ) ? $block['tb_sub_heading'] : false;
$tb_description   = isset( $block['tb_description'] ) && ! empty( $block['tb_description'] ) ? $block['tb_description'] : false;
$tb_button        = isset( $block['tb_button'] ) && ! empty( $block['tb_button'] ) ? $block['tb_button'] : false;
?>
<?php if(!empty($block['unique_id'])): ?>
<div style="height: 5vh;">
	<a name="<?php echo $block['unique_id']; ?>"></a>
</div>
<?php endif; ?>

<div class="fullwidth-block Light--Slate--Grey <?php echo ( $tb_style ) ? 'fullwidth--two--col' : ''; ?> <?php echo ( !$tb_heading ) ? 'full--width--big' : ''; ?>">
	
	
    <div class="container">
        <div class="fullwidth--wrapper text-center">
            <?php
            if ( $tb_style ) {
                ?>
                <div class="row">
                    <div class="col-lg-5">
                <?php
            } 
            ?>
                    <div class="title-block">
                        <?php if ( $tb_section_title ) { ?>
                            <span><?php echo esc_html( $tb_section_title ); ?></span>
                        <?php } ?>

                        <?php if ( $tb_heading ) { ?>
                            <h2><?php echo esc_html( $tb_heading ); ?></h2>
                        <?php } ?>
                    </div>
            <?php
            if ( $tb_style ) {
                ?>
                </div>
                <div class="col-lg-6 offset-lg-1">
                <?php
            } ?>
                <?php if ( $tb_sub_heading ) { ?>
                    <h3><?php echo esc_html( $tb_sub_heading ); ?></h3>
                <?php } ?>
				<div id="<?php echo preg_replace('/\s+/', '_', esc_html( $tb_heading )); ?>" ></div>
                <?php if ( $tb_description ) {
                    ?>
                    <div class="fl-mb-read-more">
						
                        <?php echo wp_kses_post( $tb_description ); ?>
                        <a class="btn btn--big btn--gray--outline btn__more" href="javascript:void(0)">Read More</a>
						<a class="btn btn--big btn--gray--outline btn__less" href="#<?php echo preg_replace('/\s+/', '_', esc_html( $tb_heading )); ?>">Read Less</a>
                    </div>
					<div class="action__wrap">
						<?php if(!empty($block['buttons'])): ?>
						<?php foreach ( $block['buttons'] as $data ) : ?>
						<a class="btn btn--red--dust btn--big btn--aircraft" href="<?php echo $data['button_link']; ?>"><?php echo $data['button_name']; ?></a>
						<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<div class="logos__wrap">
						<?php if(!empty($block['logos'])): ?>
						<?php foreach ( $block['logos'] as $data ) : ?>
						<img class="aligncenter size-full wp-image-4898 img-fluid" src="<?php echo $data['image'];  ?>" alt="" width="150" height="81">
						<?php endforeach; ?>
						<?php endif; ?>
					</div>
                    <?php
                } ?>
					
            <?php
            if ( $tb_style ) {
                ?>
                </div>
            </div>
            <?php } ?>
            <?php 
            if ( $tb_button ) { 
                $tb_btn_title  = isset( $tb_button['title'] ) && ! empty( $tb_button['title'] ) ? $tb_button['title'] : false;
                $tb_btn_url    = isset( $tb_button['url'] ) && ! empty( $tb_button['url'] ) ? $tb_button['url'] : false;
                $tb_btn_target = isset( $tb_button['target'] ) && ! empty( $tb_button['target'] ) ? $tb_button['target'] : '_self';
                if( $tb_btn_title ) {
            ?>
                    <a href="<?php echo esc_url(  $tb_btn_url ); ?>" class="btn btn--red--dust btn--big" target="<?php echo esc_attr( $tb_btn_target ); ?>"><?php echo esc_html( $tb_btn_title ); ?></a>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
