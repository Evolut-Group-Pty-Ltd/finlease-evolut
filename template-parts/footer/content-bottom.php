<div class="copy-right">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="privacy-policy">
                    <?php
                        wp_nav_menu( array(
                            'menu' => '',
                            'theme_location' => 'menu-footer',
                        ) );
                    ?>
                </div>
                <p style="margin: 5px 0;color: white;font-size: 13px;">Website by <a href="https://jaywing.com.au/" target="_blank" style="color: white;">Jaywing</a></p>
            </div>
            <div class="col-lg-6">
                <?php
                    $footer_copyright = get_field( 'fl_copyright_text', 'option' );
                    if ( ! empty( $footer_copyright ) ) {
                        $footer_tags = array(
                            '[year]'      => date('Y'),
                        );
                        $footer_copyright_text = str_replace( array_keys( $footer_tags ), $footer_tags, $footer_copyright )
                ?>
                    <div class="copy-right-right"><?php echo $footer_copyright_text; ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>