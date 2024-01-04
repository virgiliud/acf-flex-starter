<?php
/**
 * Flexible Content Loop for ACF
 * 
 * Use this file to display ACF flexible content layouts.
 *
 * Instructions:
 * 1. Include in your template file using include(get_template_directory() . '/acf-flex-starter/flexible-content-loop.php');
 * 2. Ensure your ACF flexible content field is named 'layouts' or modify have_rows('layouts') accordingly.
 * 3. Add additional layout files in '/acf-flex-starter/layouts/' (e.g., 'your_custom_layout.php') for automatic inclusion.
 */

// Check if the flexible content field has rows of data
if (have_rows('layouts')):

    // Slider counter (required for aria-control)
    $slider_counter = 0;

    // Loop through the rows of data
    while (have_rows('layouts')): the_row();

        // Get layout
        $layout = get_row_layout();

        // Increment the counter for each slider
        if ($layout == 'slider') {
            $slider_counter++;
            set_query_var('slider_id', 'slider-' . $slider_counter);
        }

        // Define the layout file path
        $layout_file = get_template_directory() . '/acf-flex-starter/layouts/' . $layout . '.php';

        // Check if the layout file exists and include it
        if (file_exists($layout_file)) {
            include($layout_file);
        }

    endwhile;

endif;
?>
