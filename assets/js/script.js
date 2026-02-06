document.addEventListener("DOMContentLoaded", function() {
    // Select all sliders on the page (supports multiple modules)
    const sliders = document.querySelectorAll('.br-simple-slider-container');

    sliders.forEach(slider => {
        const slides = slider.querySelectorAll('.br-slide');
        const intervalTime = parseInt(slider.getAttribute('data-interval'));
        
        // If there is only 1 image, do nothing
        if (slides.length <= 1) return;

        let currentSlide = 0;

        const nextSlide = () => {
            // 1. Remove active class from current
            slides[currentSlide].classList.remove('active');

            // 2. Calculate next index (loop back to 0 at the end)
            currentSlide = (currentSlide + 1) % slides.length;

            // 3. Add active class to next
            slides[currentSlide].classList.add('active');
        };

        // Start the loop
        setInterval(nextSlide, intervalTime);
    });
});