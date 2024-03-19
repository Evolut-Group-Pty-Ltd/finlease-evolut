<div class="footer-menu">
    <div class="row">
        <?php
        if ( is_active_sidebar( 'fl-footer-widget' ) ) :
            dynamic_sidebar( 'fl-footer-widget' );
        endif; ?>
    </div>
</div>