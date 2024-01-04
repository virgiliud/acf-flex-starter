<?php
// Retrieve the unique slider ID
$slider_id = get_query_var('slider_id', 'default-slider-id');

// Get ACF values
$loop = get_sub_field('loop');
$slides_per_row = get_sub_field('slides_per_row');
$slides_per_move = get_sub_field('slides_per_move');
$pagination = get_sub_field('pagination');
$arrows = get_sub_field('arrows');
$autoplay = get_sub_field('autoplay');
$autoplay_duration = $autoplay ? get_sub_field('autoplay_duration') : '';
$pause_on_hover = $autoplay ? get_sub_field('pause_on_hover') : false;
$responsive = get_sub_field('responsive');

// Gap between slides
$gap = '1rem';

// Responsive breakpoints
$breakpoints = [];

// Check if there are any rows for responsive
if ($responsive) {
    // Loop through each row
    foreach ($responsive as $row) {
        // Add to the breakpoints array
        $breakpoints[$row['breakpoint']] = [
            'perPage' => $row['slides_per_row'],
        ];
    }
}

// Set slider options
$splideOptions = filter_empty_values([
    'type' => $loop ? 'loop' : 'slider',
    'perPage' => $slides_per_row,
    'perMove' => $slides_per_move,
    'pagination' => $pagination,
    'arrows' => $arrows,
    'autoplay' => $autoplay,
    'interval' => $autoplay_duration,
    'pauseOnHover' => $pause_on_hover,
    'gap' => $gap,
    'breakpoints' => $breakpoints
    // More Splide.js options can be added here
], ['pagination', 'arrows', 'pauseOnHover']); // Retain false values for these keys

// SVG arrow icon
$arrowSVG = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>';
?>

<section class="slider">
    <?php if (have_rows('slides')): ?>
        <!-- Replace "content-container" with your own container class if needed -->
        <div class="content-container">
            <div class="splide" data-splide='<?php echo wp_json_encode($splideOptions); ?>'>
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php 
                        // Loop through each slide
                        while (have_rows('slides')): the_row();
                            $image = get_sub_field('image');
                            $title = get_sub_field('title');
                            $description = get_sub_field('description');
                            $link = get_sub_field('link');
                            ?>
                            <li class="splide__slide">
                                <?php if ($image): ?>
                                    <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
                                <?php endif; ?>

                                <?php if ($title): ?>
                                    <h3><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php if ($description): ?>
                                    <p><?php echo esc_html($description); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($link)): ?>
                                    <?php echo get_acf_link($link, 'button'); ?>
                                <?php endif; ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
           
                <?php if ($arrows): ?>
                    <!-- Navigation Arrow -->
                    <div class="splide__arrows splide__arrows--ltr">
                        <button
                            class="splide__arrow splide__arrow--prev"
                            type="button"
                            aria-label="Previous slide"
                            aria-controls="<?php echo 'splide0' . esc_attr($slider_id) . '-track'; ?>"
                        >
                            <?php echo $arrowSVG; ?>
                        </button>
                        <button
                            class="splide__arrow splide__arrow--next"
                            type="button"
                            aria-label="Next slide"
                            aria-controls="<?php echo 'splide0' . esc_attr($slider_id) . '-track'; ?>"
                        >
                            <?php echo $arrowSVG; ?>
                        </button>
                    </div>
                <?php endif; ?>
                
                <?php if ($pagination): ?>
                    <!-- Pagination Dots -->
                    <ul class="splide__pagination"></ul>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
