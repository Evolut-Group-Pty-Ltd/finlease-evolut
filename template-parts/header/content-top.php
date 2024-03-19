<header class="header">
    <div class="container">
        <div class="inner-header-wrapper">
            <div class="row align-items-center">
                <div class="col-lg-4 header-menu-container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggle-icon"></span>
                        <span class="toggle-icon"></span>
                        <span class="toggle-icon"></span>
                    </button>
                    <div class="header-menu">
                    <?php
                        wp_nav_menu( array(
                            'menu' => '',
                            'theme_location' => 'menu-primary',
                        ) );
                    ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php
                    $logo = get_field( 'fl_header_logo', 'option' );
                    if ( ! empty( $logo ) && isset( $logo['url'] ) ) {
                    ?>
                        <div class="header-logo">
                            <a class="" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_html( $logo['alt'] ); ?>"></a>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-lg-4">
                    <div class="header-right-menu">
                        <ul>
                            <?php
                            $contact_num = get_field( 'fl_contact_num', 'option' );
                            if ( ! empty( $contact_num ) && isset( $contact_num ) ) {
                                $ph_number = preg_replace("/[^0-9]/", "", $contact_num);
                            ?>
                                <li><a href="tel:<?php echo $ph_number; ?>"><img src="<?php echo FL_TAU; ?>/images/icon-phone.svg" alt="phone icon"><?php echo $contact_num; ?></a></li>
                            <?php } ?>

                            <?php 
                            $button_header = get_field( 'fl_button_header', 'option' );
                            if ( isset( $button_header ) ) {
                                $button_title   = isset( $button_header['title'] ) && ! empty($button_header['title'] ) ? $button_header['title'] : false;

                                $button_link    = isset( $button_header['url'] ) && ! empty( $button_header['url'] ) ? $button_header['url'] : false;

                                $button_target  = isset( $button_header['target'] ) && ! empty( $button_header['target'] ) ? $button_header['target'] : '_self';
                                if ( $button_title ) {
                            ?>
                                    <li><a href="<?php echo esc_url( $button_link ); ?>" class="btn btn--outline btn--outline--red--dust" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_title ); ?></a></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
