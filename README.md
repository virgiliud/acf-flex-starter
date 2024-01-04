# ACF Flexible Content Layouts Starter Kit

A starter kit for Advanced Custom Fields (ACF) Flexible Content, providing essential layouts commonly used in WordPress themes. The kit uses minimal CSS Flexbox-based layouts and adaptable ACF configurations, making it easy to implement and modify. Additionaly, it includes Webpack and npm for easy compilation and minification of assets.

## ACF Starter Layouts

The available ACF Flexible Content layouts and their options.

### Media & Text

A two-column layout for image and text, with drag-and-drop reordering. If no image is added, the layout automatically adjusts to display the text content in full width.

**Options**:

  - Columns (Repeater)
    - Content Type (Image or Text)
    - For "Image" Content Type
      - Image
    - For "Text" Content Type
      - Heading (Text Field)
      - Text (WYSIWYG Editor)
      - Link
  - Image & Text Alignment (Top, Center, Bottom)
  - Mobile Order (Default, Image First, Text First)

---

### Features

Ideal for showcasing features of products or services in multiple columns in a row.

**Options**:

  - Features (Repeater)
    - Image
    - Title (Text Field)
    - Description (Textarea)
    - Link
  - Columns (1 to 6)
  - Alignment (Top, Center, Bottom)

---

### Call to Action

A layout for call-to-action sections, with an optional background image and overlay opacity setting.

**Options**:

  - Headline (Text Field)
  - Text (Textarea)
  - Link
  - Background Image
  - Overlay Opacity (0 to 100)

---

### Slider

A responsive and accessible slider using [Splide.js](https://splidejs.com/), a lightweight and modern JavaScript library for creating sliders and carousels.

**Options**:

  - Slides (Repeater)
    - Image
    - Title (Text Field)
    - Description (Textarea)
    - Link
  - Slides Per Row (1 to 6)
  - Slides Per Move (1 to 6)
  - Pagination (True/False)
  - Arrows (True/False)
  - Loop (True/False)
  - Autoplay (True/False)
  - Autoplay Duration (Number Field)
  - Pause On Hover (True/False)
  - Responsive (Repeater)
    - Breakpoint (Number Field)
    - Slides Per Row (Number Field)

# Adding the Starter Kit to Your Theme

## File Structure

Below is the file structure of the ACF Flexible Content Starter Kit:

- `/src` - JavaScript and SCSS source files.
- `/build` - Compiled and minified JavaScript and CSS files.
- `/imports` - ACF JSON files for importing.
- `/layouts` - Individual PHP files for each ACF layout.
- `helper-functions.php` - PHP functions used to output and format the ACF fields.
- `flexible-content-loop.php` - Main loop file used to output the ACF Flexible Content fields in your theme.
- `webpack.config.js` - Configuration file for Webpack, used to define how scripts and styles are compiled and bundled.
- `package.json` - NPM package dependencies and scripts for the project.

## Import ACF Flexible Content Layouts

1. Locate the provided JSON file (`acf-layouts.json`) in `/acf-flex-starter/imports/`.

2. In your WordPress dashboard, go to `ACF` > `Tools`.

3. Under `Import Field Groups`, upload the `acf-layouts.json` file and click `Import File`.

4. Modify the field group's location as needed (default setting is "page").

This will add all the predefined layouts and configurations to your WordPress site.

## Include Helper Functions 

The `helper-functions.php` file must be included in your theme's `functions.php` as it contains essential functions used by the ACF layouts. Add the following line to include it:

```php
include(get_template_directory() . '/acf-flex-starter/helper-functions.php');
```

## Include the Flexible Content Loop
1. To integrate the flexible content layouts, include the `flexible-content-loop.php` file in your template. Add the following line to your PHP file where you want the layouts to appear:
```php
include(get_template_directory() . '/acf-flex-starter/flexible-content-loop.php');
```
2. Make sure the ACF flexible content field is named "layouts", or modify the `have_rows('layouts')` in the loop to match your field name.
3. You can create additional layout files within the `/acf-flex-starter/layouts/` directory. Name them after each layout, for example, `your_custom_layout.php`. These files will be automatically included and processed in the loop.

## Include CSS and JavaScript
To include the CSS and JavaScript files, add the following lines to your theme's `functions.php` file.

Enqueue the CSS:
```php
wp_enqueue_style('acf-flex-starter-style', get_template_directory_uri() . '/acf-flex-starter/build/css/style.min.css', array(), '1.0.0');
```

Enqueue Splide CSS and JS for sliders:
```php
wp_enqueue_style('splide-style', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css', array(), '4.1.4');

wp_enqueue_script('splide-main', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', array(), '4.1.4', true);
```

Enqueue the main JS file with `splide-main` as a dependency:
```php
wp_enqueue_script('acf-flex-starter-main', get_template_directory_uri() . '/acf-flex-starter/build/js/main.min.js', array('splide-main'), '1.0.0', true);
```

## Customize SCSS Settings

### SCSS Variables
Update the `_variables.scss` file in `acf-flex-starter/src/scss/` to fit your theme's design:
- Update the `$container` variable to match your theme's container class. Ensure to also update the container class name in the layout files located in `acf-flex-starter/layouts/`.
- Adjust the `$container-width` and breakpoint variables (`$screen-sm`, `$screen-md`, `$screen-lg`, `$screen-xl`) to fit your theme's design across various device sizes.

### SCSS Mixins for Responsive Design
Utilize the provided mixins for breakpoints in your SCSS files as follows:

```scss
@include max-screen(md) {
    // Styles for medium screens and below go here
}

@include min-screen(lg) {
    // Styles for large screens and above go here
}

// Use any of the size variables (sm, md, lg, xl) defined in the "_variables.scss" file.
```

## Build Instructions

### Setup
To work with the SCSS and JS files, you'll need to have Node.js installed. 

Run the following command in the `acf-flex-starter` directory to install the necessary packages:

```bash
npm install
```

### Compile and Minify SCSS and JavaScript

To watch for changes in SCSS and JavaScript files and automatically recompile (for development):
```bash
npm run watch-scss
```

To compile and minify both SCSS and JavaScript files once (for production):
```bash
npm run build
```
