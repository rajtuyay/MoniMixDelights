document.addEventListener('DOMContentLoaded', function () {
    const burgerIcon = document.getElementById('burgerIcon');
    const navigation = document.getElementById('navigation');
    const container = document.getElementById('container');
    const header = document.getElementById('search');

    // Check if there's a saved state in localStorage (either 'true' or 'false')
    let isNavigationVisible = localStorage.getItem('isNavigationVisible') === 'true'; // Retrieve saved state

    // Set the initial state based on localStorage
    if (isNavigationVisible) {
        // Navigation is visible on load
        navigation.style.width = '20%';
        navigation.style.transition = '0.3s ease-in-out';
        header.style.transition = '0.3s ease-in-out';
        container.style.width = '80%';
        header.style.width = '80%';
    } else {
        // Navigation is hidden on load
        navigation.style.width = '0%';
        navigation.style.transition = 'none';
        header.style.transition = 'none';
        container.style.width = '100%';
        header.style.width = '100%';
    }

    // Add event listener to the burger icon
    burgerIcon.addEventListener('click', function () {
        if (isNavigationVisible) {
            // Hide the navigation
            navigation.style.width = '0%'; // Slide out navigation
            navigation.style.transition = '0.3s ease-in-out';
            header.style.transition = '0.3s ease-in-out';
            container.style.width = '100%'; // Expand the container
            header.style.width = '100%'; // Expand the header
            isNavigationVisible = false; // Update the state
            setTimeout(function() {
                location.reload(); // Reload the page after the transition
            }, 200);
        } else {
            // Show the navigation
            navigation.style.width = '20%'; // Slide in navigation
            navigation.style.transition = '0.3s ease-in-out';
            header.style.transition = '0.3s ease-in-out';
            container.style.width = '80%'; // Shrink the container
            header.style.width = '80%'; // Shrink the header
            isNavigationVisible = true; // Update the state
            setTimeout(function() {
                location.reload(); // Reload the page after the transition
            }, 200);
        }

        // Save the state in localStorage
        localStorage.setItem('isNavigationVisible', isNavigationVisible.toString());
    });
});
