document.addEventListener('DOMContentLoaded', function () {
    console.log('Script Loaded');

    const editButton = document.getElementById('editButton');
    const cancelButton = document.getElementById('cancelButton');
    const allInputs = document.querySelectorAll('#myForm input, #myForm select');
    const myForm = document.getElementById('myForm');

    // Function to enable or disable inputs (except ID field)
    function toggleInputs(disable) {
        console.log('Toggling inputs - disable: ' + disable);
        allInputs.forEach(input => {
            // Skip the ID field, it stays permanently disabled
            if (!input.classList.contains('id')) {
                input.disabled = disable;
                console.log(input.name + ' disabled status: ' + input.disabled);
            }
        });
    }

    // Function to reset form (to 'Edit' state)
    function resetForm() {
        console.log('Resetting form to Edit state');
        toggleInputs(true); // Disable all inputs except the ID field
        editButton.innerText = 'Edit'; // Change "Save" back to "Edit"
        cancelButton.style.display = 'none'; // Hide Cancel button
    }

    // Add event listener to the Edit button
    editButton.addEventListener('click', function () {
        console.log("Edit button clicked");

        if (editButton.textContent === 'Edit') {
            console.log('Enabling inputs');
            toggleInputs(false); // Enable inputs
            editButton.textContent = 'Save'; // Change "Edit" to "Save"
            cancelButton.style.display = 'inline-block'; // Show Cancel button
        } else if (editButton.textContent === 'Save') {
            console.log('Saving changes');

            // Create a FormData object from the form
            const formData = new FormData(myForm);

            // Send the data to the server using fetch
            fetch('../PHP/update-personal-info.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => {
                    console.log('Response status:', response.status);  // Log the response status

                    return response.text();  // Ensure you're reading the response body as text
                })
                .then(data => {
                    console.log('Server Response:', data);  // Log the full server response
                    if (data.trim() === 'success') {  // Trim any extra spaces or newlines
                        alert('Update successful!');
                        setTimeout(function() {
                            window.location.href = 'profile.php';  // Redirect to reset.php
                        }, 100);
                        resetForm();  // Reset form to 'Edit' state
                    } else {
                        alert('Failed to update. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }
    });

    // Add event listener to the Cancel button
    cancelButton.addEventListener('click', function () {
        console.log('Cancel button clicked');
        resetForm(); // Reset to 'Edit' state when Cancel is clicked
    });
});
