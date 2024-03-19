<?php
/**
 * Layout for Text block with Image.
 * 
 * @package Finlease
 */
$tb_wi_title        = isset( $block['tb_wi_title'] ) && ! empty( $block['tb_wi_title'] ) ? $block['tb_wi_title'] : false;
$tb_wi_heading      = isset( $block['tb_wi_heading'] ) && ! empty( $block['tb_wi_heading'] ) ? $block['tb_wi_heading'] : false;
$tb_wi_desc         = isset( $block['tb_wi_desc'] ) && ! empty( $block['tb_wi_desc'] ) ? $block['tb_wi_desc'] : false;
$tb_wi_img          = isset( $block['tb_wi_img'] ) && ! empty( $block['tb_wi_img'] ) ? $block['tb_wi_img'] : false;
$tb_wi_img_position = isset( $block['tb_wi_img_position'] ) && ! empty( $block['tb_wi_img_position'] ) ? $block['tb_wi_img_position'] : false;
$tb_wi_button       = isset( $block['tb_wi_button'] ) && ! empty( $block['tb_wi_button'] ) ? $block['tb_wi_button'] : false;
?>

<div class="ContentImageBlock content--<?php echo esc_attr( $tb_wi_img_position ); ?>--block">
    <div class="container">
        <?php if ( $tb_wi_title ) { ?>
            <div class="title-block">
	            <?php if ( $inner_banner_title ) { ?>
                    <h2><?php echo esc_html( $tb_wi_title ); ?></h2>
               <?php }else{ ?>	            
					<h1><?php echo esc_html( $tb_wi_title ); ?></h1>
				<?php } ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-lg-6">
                <div class="content__block">
                    <?php if ( $tb_wi_heading ) { ?>
                        <h3><?php echo esc_html( $tb_wi_heading ); ?></h3>
                    <?php } ?>
					<div id="<?php echo preg_replace('/\s+/', '_', esc_html( $tb_wi_title )); ?>" ></div>
                    <?php if ( $tb_wi_desc ) { ?>
                        <div class="fl-mb-read-more">
							
                            <?php echo wp_kses_post( $tb_wi_desc ); ?>
                            <a class="btn btn--big btn--gray--outline btn__more" href="javascript:void(0)">Read More</a>
							<a class="btn btn--big btn--gray--outline btn__less" href="#<?php echo preg_replace('/\s+/', '_', esc_html( $tb_wi_title )); ?>">Read Less</a>
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
                </div>
            </div>

            <?php 
            if ( $tb_wi_img ) {
                if ( $tb_wi_img['ID']  ) {
            ?>
                    <div class="col-lg-6">
                        <div class="image__block">
	                        <?php echo wp_get_attachment_image($tb_wi_img['ID'], 'finlease-inner-banner', false, array('class' => 'img-fluid')); ?>
                        </div>
                    </div>
            <?php
                } 
            } ?>
        </div>
        
        <?php 
        if ( $tb_wi_button ) { 
            $tb_wi_btn_title  = isset( $tb_wi_button['title'] ) && ! empty( $tb_wi_button['title'] ) ? $tb_wi_button['title'] : false;
            $tb_wi_btn_url    = isset( $tb_wi_button['url'] ) && ! empty( $tb_wi_button['url'] ) ? $tb_wi_button['url'] : false;
            $tb_wi_btn_target = isset( $tb_wi_button['target'] ) && ! empty( $tb_wi_button['target'] ) ? $tb_wi_button['target'] : '_self';
            if( $tb_wi_btn_title ) {
        ?>
                <div class="content__button__blcok text-center">
                    <a class="btn btn--red--dust btn--big" href="<?php echo esc_url( $tb_wi_btn_url ); ?>" target="<?php echo esc_attr( $tb_wi_btn_target ); ?>"><?php echo esc_html( $tb_wi_btn_title ); ?></a>
                </div>
        <?php
            } 
        } ?>
    </div>
</div>
