const slider = document.querySelector('.slider');
const sliderItems = document.querySelectorAll('.image-container');

// Function to center images based on screen size
function centerImages() {
    const itemWidth = sliderItems[0].offsetWidth; // Width of one image
    let offset;

    if (window.innerWidth <= 686) {
        // Center only the 2nd image
        offset = itemWidth * 1 - slider.offsetWidth / 2 + itemWidth / 2;
    
    } else {
        // Center the 2nd and 3rd images
        const combinedWidth = itemWidth * 2; // Combined width of images 2 and 3
        offset = itemWidth * 1 - slider.offsetWidth / 2 + combinedWidth / 2;
    }

    slider.scrollLeft = offset;
}

// Call the function on page load
window.onload = centerImages;

// Call the function on resize to adjust dynamically
window.addEventListener('resize', centerImages);

let isDown = false;
let startX;
let scrollLeft;

// Mouse Events
slider.addEventListener('mousedown', (e) => {
    isDown = true;
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});

slider.addEventListener('mouseleave', () => {
    isDown = false;
});

slider.addEventListener('mouseup', () => {
    isDown = false;
});

slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 3;
    slider.scrollLeft = scrollLeft - walk;
});

// Touch Events
slider.addEventListener('touchstart', (e) => {
    isDown = true;
    startX = e.touches[0].pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});

slider.addEventListener('touchend', () => {
    isDown = false;
});

slider.addEventListener('touchmove', (e) => {
    if (!isDown) return;
    const x = e.touches[0].pageX - slider.offsetLeft;
    const walk = (x - startX) * 3;
    slider.scrollLeft = scrollLeft - walk;
});
