<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <?php
        $logo = get_field( 'fl_header_logo', 'option' );
        if ( ! empty( $logo ) && isset( $logo['url'] ) ) {
        ?>
            <a class="navbar-brand d-lg-none" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_html( $logo['alt'] ); ?>"></a>
        <?php } ?>
        
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php
            wp_nav_menu( array(
	            'menu' => 'Mobile Nav',
                'theme_location' => 'menu-mega',
                'depth' => 0,
                'menu_class'  => 'navbar-nav',
                'walker'  => new BootstrapNavMenuWalker()
                ) );
            ?>
        </div>      
    </div>
</nav>
