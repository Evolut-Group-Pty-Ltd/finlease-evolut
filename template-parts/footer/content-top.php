<div class="footer-media">
    <div class="row">
        <div class="col-md-6">
            <?php
            $footer_logo = get_field( 'fl_footer_logo', 'option' );
            if ( isset( $footer_logo ) && !empty( $footer_logo['url'] ) ) {
                ?>
                <div class="footer-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $footer_logo['url'] ); ?>" alt="<?php echo esc_attr( $footer_logo['alt'] ); ?>"></a>
                </div>
            <?php } ?>
        </div>

        <div class="col-md-6">
            <?php
            $social_links = get_field( 'fl_social_links', 'option' );
            if ( ! empty( $social_links ) ) {
                ?>
                <ul>
                    <?php foreach( $social_links as $social_link ) {
                        $link_url       = $social_link['fl_social_url'];
                        $icon_class     = $social_link['fl_icon_class'];
                        $link_target    = $social_link['fl_social_link_target'];
                        ?>
                        <li><a href="<?php echo ( !empty( $link_url ) ) ? esc_url( $link_url ) : '#'; ?>" <?php echo ( !empty( $link_target ) ) ? "target='_blank'" : ''; ?>><i class="fa <?php echo ( !empty ( $icon_class ) ) ? esc_attr( $icon_class ) : ''; ?>"></i></a></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>