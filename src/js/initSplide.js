/*
 * Splide Initialization
 */
export function initSplide() {
    document.addEventListener('DOMContentLoaded', function () {
        // Query all sliders
        var splideElements = document.querySelectorAll('.splide');
        
        // Initialize each slider instance
        splideElements.forEach(function (el) {
            // Retrieve the options from the data-splide attribute
            var options = el.dataset.splide ? JSON.parse(el.dataset.splide) : {};
            
            // Initialize slider with the options
            new Splide(el, options).mount();
        });
    });
} 