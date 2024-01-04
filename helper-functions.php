<?php
/**
 * Returns a string of combined CSS class names.
 *
 * @param string ...$classes Multiple string arguments representing CSS class names.
 * @return string A space-separated string of unique CSS class names.
 */
function get_css_classes(...$classes) {
    // Remove empty values and ensure unique class names
    $classes = array_unique(array_filter($classes));

    // Sanitize class names
    $sanitized_classes = array_map('esc_attr', $classes);

    // Combine class names into a space-separated string
    return implode(' ', $sanitized_classes);
}

/**
 * Returns a link from an ACF link field.
 *
 * @param array  $link The ACF link field array containing URL, title, and target.
 * @param string $class Optional. Additional class(es) to add to the link. Default empty.
 *
 * @return string
 */
function get_acf_link($link, $class = '') {
    if (!empty($link)) {
        // Extract link attributes
        $url = esc_url($link['url']);
        $title = esc_html($link['title']);
        $target = $link['target'] ? esc_attr($link['target']) : '_self';
        $rel = $link['target'] == '_blank' ? 'noopener noreferrer' : '';

        // Format the anchor tag
        return sprintf('<a href="%s"%s target="%s"%s>%s</a>',
            $url,
            $class ? ' class="' . esc_attr($class) . '"' : '',
            $target,
            $rel ? ' rel="' . $rel . '"' : '',
            $title
        );
    }
    return '';
}

/**
 * Filters out empty strings, empty arrays, and false values from an array, except for specified keys.
 *
 * @param array $array The array to be filtered.
 * @param array $retainFalse Keys for which false values should be kept.
 * @return array The filtered array.
 */
function filter_empty_values($array, $retainFalse = []) {
    return array_filter($array, function($value, $key) use ($retainFalse) {
        if (in_array($key, $retainFalse)) {
            return true; // Retain all values for these keys
        }
        // For other keys, filter out empty strings, empty arrays, and false values
        return $value !== '' && $value !== array() && $value !== false;
    }, ARRAY_FILTER_USE_BOTH);
}

