const searchIcon = document.querySelector('.search-icon');
const searchInput = document.getElementById('searchInput');
const searchResult = document.getElementById('searchResults');
const navBar = document.querySelector('.header');
let isSearchVisible = false;  // Track the visibility of the search input
let clickCount = 0;  // Track the number of clicks on the search icon

function updateSearchResultsWidth() {
    // Ensure the input field exists and is visible
    if (searchInput) {
        const inputRect = searchInput.getBoundingClientRect();

        // Apply the width and position of the search results container
        searchResults.style.width = `${inputRect.width}px`;
        searchResults.style.top = `${(inputRect.bottom + window.scrollY) - 8}px`; // Below input
        searchResults.style.left = `${inputRect.left + window.scrollX}px`;  // Align left
    }
}

function centerSearchInput() {
    const navHeight = navBar.offsetHeight;
    const inputHeight = navHeight * 0.5; // Set input height as a percentage of nav height
    searchInput.style.height = `${inputHeight}px`;

    // Center the input vertically
    searchInput.style.top = `${(navHeight - inputHeight) / 2}px`;
}

// Recalculate position on resize
window.addEventListener('resize', centerSearchInput);

// Ensure it centers on load
centerSearchInput();


// Trigger on input focus and during typing
searchInput.addEventListener('focus', updateSearchResultsWidth);
searchInput.addEventListener('input', updateSearchResultsWidth);

// Adjust on window resize or orientation change
window.addEventListener('resize', updateSearchResultsWidth);

// Function to enable the search toggle functionality
function enableSearchToggle() {
    searchInput.style.display = 'none'; // Start hidden when toggle functionality is enabled
    searchIcon.addEventListener('click', toggleSearchInput);
    document.addEventListener('click', closeSearchInputOnClickOutside);
}

// Function to disable the search toggle functionality
function disableSearchToggle() {
    searchIcon.removeEventListener('click', toggleSearchInput);
    document.removeEventListener('click', closeSearchInputOnClickOutside);
    searchInput.style.display = 'block'; // Ensure input is always visible
    searchInput.style.opacity = '1'; // Ensure input is always visible
    searchInput.classList.remove('show'); // Remove animation-related class
    searchInput.value = ''; // Clear the input value
}

// Function to toggle the search input display and handle form submission
function toggleSearchInput(event) {
    event.stopPropagation(); // Prevent the click event from bubbling up to the document

    clickCount++;

    if (searchInput.value === '') {
        if (clickCount % 2 !== 0) {
            // Odd click: Show the search input
            searchInput.style.display = 'block';
            setTimeout(() => {
                searchInput.classList.add('show'); // Add class for animation
            }, 10); // Delay to allow display to take effect
            searchInput.focus(); // Focus on the input

        } else {
            // Even click: Hide the search input
            searchInput.classList.remove('show'); // Remove animation class
            setTimeout(() => {
                searchInput.style.display = 'none';
            }, 300); // Match this timeout to the CSS transition duration
        }
    } else if (searchInput.value !== '') {
        // Submit the form on the second click
        document.querySelector('form').submit();
        clickCount = 0; // Reset click count after submitting the form
    }
}

// Function to close the search input when clicking outside of it
function closeSearchInputOnClickOutside(event) {
    if (!searchIcon.contains(event.target) && !searchInput.contains(event.target) && !searchResult.contains(event.target)) {
        searchInput.classList.remove('show'); // Remove animation class
        searchResult.style.display = 'none'; // Hide input after animation
        setTimeout(() => {
            searchInput.style.display = 'none'; // Hide input after animation
        }, 300); // Match CSS transition duration
        searchInput.value = ''; // Clear the input value
        isSearchVisible = false; // Mark the search input as hidden
        clickCount = 0; // Reset click count when clicking outside
    }
}

// Use matchMedia to determine if the script should run
const mediaQuery = window.matchMedia('(min-width: 1100px)');

// Handle changes in screen size
function handleMediaChange(e) {
    if (e.matches) {
        // If the screen width is larger than 1100px, enable toggle functionality
        enableSearchToggle();
    } else {
        // If the screen width is 1100px or smaller, disable toggle functionality
        disableSearchToggle();
    }
}

// Initial check
handleMediaChange(mediaQuery);

// Listen for changes in the viewport size
mediaQuery.addEventListener('change', handleMediaChange);
