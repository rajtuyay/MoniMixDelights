document.addEventListener("DOMContentLoaded", function () {
    const avatar = document.getElementById("avatar");
    const imageModal = document.getElementById("uploadImageModal");
    const editButton = document.getElementById("editProfile");
    const closeButton = document.getElementById('closeModalBtn');

    editButton.addEventListener('click', () => {
        imageModal.style.display = 'flex';
    });

    closeButton.addEventListener('click', () => {
        imageModal.style.display = 'none';
    });

    // Close modal when clicking outside of it
    window.addEventListener('click', (event) => {
        if (event.target === imageModal) {
            imageModal.style.display = 'none';
        }
    });

    // Get the avatar's position and dimensions
    const avatarRect = avatar.getBoundingClientRect();

    // Set the offset for positioning the button
    const offset = 10; // Distance in pixels from the bottom-right corner

    editButton.style.left = `${(avatarRect.right - (avatarRect.width / 4)) + offset}px`; // Right edge with offset
    editButton.style.top = `${(avatarRect.bottom - (avatarRect.height / 4)) + offset * 1.5}px`; // Bottom edge with offset

    const inputFile = document.getElementById("inputFile");
    const fileNameDisplay = document.getElementById("fileName");

    // Display the selected file name
    inputFile.addEventListener("change", () => {
        const fileName = inputFile.files[0]?.name || "No file selected";
        fileNameDisplay.textContent = fileName;
    });
});
