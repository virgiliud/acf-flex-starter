<?php
// Get ACF values
$headline = get_sub_field('headline');
$text = get_sub_field('text');
$link = get_sub_field('link');
$overlay_opacity = get_sub_field('overlay_opacity');
$background_image = get_sub_field('background_image');
?>

<section class="cta">
    <!-- Replace "content-container" with your own container class -->
    <div class="content-container">
        <?php if ($headline): ?>
            <h2><?php echo esc_html($headline); ?></h2>
        <?php endif; ?>

        <?php if ($text): ?>
            <p><?php echo esc_html($text); ?></p>
        <?php endif; ?>

        <?php if ($link): ?>
            <?php echo get_acf_link($link, 'button'); ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($background_image)): ?>
        <div class="cta__background">
            <?php if ($overlay_opacity > 0): ?>
                <div class="cta__overlay" style="opacity: <?php echo esc_attr($overlay_opacity / 100); ?>;"></div>
            <?php endif; ?>
            <?php echo wp_get_attachment_image($background_image['ID'], 'full'); ?>
        </div>
    <?php endif; ?>
</section>
