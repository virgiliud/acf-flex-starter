<?php
// Get ACF values
$alignment_class = get_sub_field('image_text_alignment');
$mobile_order = get_sub_field('mobile_order');
?>

<section class="media-text">
    <!-- Replace 'content-container' with your own container class -->
    <div class="<?php echo get_css_classes('content-container', $alignment_class); ?>">
        <?php if (have_rows('columns')):
            while (have_rows('columns')): the_row();
                // Get image or text content type
                $content_type = get_sub_field('content_type');

                // Class for mobile ordering
                $mobile_order_class = ($content_type === $mobile_order) ? 'mobile-order-first' : '';

                // If content type image
                if ($content_type === 'image'):
                    $image = get_sub_field('image');

                    if (!empty($image)): ?>
                        <div class="<?php echo get_css_classes('media-text__block media-text__block--image', $mobile_order_class); ?>">
                            <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
                        </div>
                    <?php endif;

                // If content type test
                elseif ($content_type === 'text'):
                    $heading = get_sub_field('heading');
                    $text = get_sub_field('text');
                    $link = get_sub_field('link');
                    ?>
                    
                    <div class="<?php echo get_css_classes('media-text__block media-text__block--text', $mobile_order_class); ?>">
                        <?php if (!empty($heading)): ?>
                            <h2><?php echo esc_html($heading); ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($text)): ?>
                            <div>
                                <?php echo $text; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($link)): ?>
                            <?php echo get_acf_link($link, 'button'); ?>
                        <?php endif; ?>
                    </div>
                <?php endif;
            endwhile;
        endif; ?>
    </div>
</section>
