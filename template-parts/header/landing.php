<header class="header">
    <div class="container">
        <div class="inner-header-wrapper d-flex align-items-center justify-content-between">
            <?php
            $logo = get_field('fl_header_logo', 'option');
            if (!empty($logo) && isset($logo['url'])) {
                ?>
                <div class="header-logo">
                    <a class="" href="<?php echo esc_url(home_url()); ?>"><img
                                src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_html($logo['alt']); ?>"></a>
                </div>
            <?php } ?>
            <div class="header-right-menu">
                <ul>
                <?php
                $contact_num = get_field('fl_contact_num', 'option');
                if (!empty($contact_num) && isset($contact_num)) {
                    $ph_number = preg_replace("/[^0-9]/", "", $contact_num);
                    ?>
                    <li><a class="header-tel" href="tel:<?php echo $ph_number; ?>"><img
                                src="<?php echo FL_TAU; ?>/images/icon-phone.svg"
                                alt="phone icon"><?php echo $contact_num; ?></a></li>
                <?php } ?>
                <!--<li><a href="#get-a-quote" class="header-cta btn btn--outline btn--outline--red--dust">Get a free quote</a></li>-->
                </ul>
            </div>
        </div>
    </div>
</header>
