<?php
/*
    Template Name: Landing Page
    Template Post Type: page
*/
global $header_type;
$header_type = 'landing';

$intro = get_field('intro');
$blocks = get_field('page_flexible_content');

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="landing-page">
                <?php if ($intro && $intro = $intro[0]): ?>
                    <?php
                    $image = $intro['image']['url'];
                    $title = $intro['title'];
                    $paragraph = $intro['paragraph'];
                    $form_title = $intro['form_title'];
                    $form_shortcode = $intro['form_shortcode'];
                    ?>
                    <div class="intro intro--<?php echo $intro['theme']; ?>"
                         <?php if ($image) { ?>style="background: url('<?php echo $image ?>') center no-repeat;background-size: cover;" <?php } ?>>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <?php if ($title) { ?>
                                        <h1 class="title"><?php echo $title ?></h1>
                                    <?php } ?>
                                    <?php echo $paragraph ?>
                                </div>
                                <div class="col-lg-7">
                                    <div class="mini-form" id="get-a-quote">
                                        <div class="heading">
                                            <?php echo $form_title ?>
                                        </div>
                                        <div class="pages">
                                            <?php echo do_shortcode($form_shortcode) ?>
                                        </div>
                                        <div class="form-pagination">
                                            <span class="dot active" data-page="1">&nbsp;</span>
                                            <span class="dot" data-page="2">&nbsp;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <?php if (!empty($blocks)):
                    foreach ($blocks as $key => $block) {
                        $block_name = isset($block['acf_fc_layout']) && !empty($block['acf_fc_layout']) ? $block['acf_fc_layout'] : false;

                        if ($block_name == 'calculator') {
                            $block_name = 'calculator-landing';
                        } else if ($block_name == 'testimonial') {
                            $block_name = 'testimonial-landing';
                        }

                        $template_path = locate_template('page-blocks/block-' . $block_name . '.php', false, false);
                        if ($block_name && !empty($template_path)) :
                            // Include the template file.
                            include($template_path);

                        endif;
                    }
                endif; ?>
            </div>
        </main>
    </div>

<?php
get_footer('reduced');