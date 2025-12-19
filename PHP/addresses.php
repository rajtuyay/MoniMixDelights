<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Open Sans';
        }

        /* Modal container */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Dark background */
            z-index: 9999;
            /* Ensure modal is on top */
        }

        /* Modal content */
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* Center the modal */
            width: 700px;
            /* Fixed width */
            max-height: 80%;
            /* Max height to prevent overflow */
            overflow-y: scroll;
            /* Scroll if content is too tall */
        }

        .modal-content::-webkit-scrollbar {
            width: 10px;
            height: 10vh;
        }

        .modal-content::-webkit-scrollbar-thumb {
            background: #f9afdd;
            border-radius: 5px;
            border-left: 1px solid #d090b7;
            border-right: 1px solid #d090b7;
        }

        .modal-content::-webkit-scrollbar-track {
            border: 1px solid #d090b7;
            border-radius: 5px;
        }

        /* Close button */
        .close-btn {
            font-weight: 700;
            background-color: #ff5c5c;
            font-size: 14px;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            margin-top: -10px;
            margin-right: -10px;
        }

        .close-btn:hover {
            background-color: #ff3b3b;
        }

        #addForm,
        #editForm {
            display: flex;
            flex-direction: column;
            gap: 10px;
            /* Space between form fields */
        }

        /* Flexbox for Address Fields */
        .address-fields {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .address-fields select,
        .address-fields input {
            width: 100%;
            /* Make inputs and select fill their container */
        }

        /* Make sure select inputs are full width in their container */
        .address-column {
            flex: 1;
            /* Each column will take equal space */
        }

        /* Add button styles */
        #addButton,
        #editButton,
        #openAddModalBtn {
            font-family: 'Open Sans';
            font-size: 14px;
            margin-top: 20px;
            padding: 10px;
            background-color: #FA8BCE;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Add button hover effect */
        #addButton:hover,
        #editButton,
        #openAddModalBtn:hover {
            background-color: #f95cba;
        }

        #myAddresses {
            display: flex;
            flex-wrap: wrap;
            /* Allow wrapping of elements into multiple lines */
            gap: 20px;
            /* Space between the address blocks */
        }

        .my-addresses {
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* Distribute items in the container */
            width: 80%;
            margin: auto;
            /* Set initial width to 100%, will adjust based on screen size */
            max-width: 600px;
            /* Max width for each address block */
            border: 1px solid #FA8BCE;
            /* Add a border for better visibility */
            padding: 10px;
            /* Add padding inside each address block */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Add shadow for a more polished look */
        }

        .address-img {
            flex: 0 0 10%;
            /* The image takes 30% of the width */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .address-text {
            font-family: 'Open Sans';
            text-align: left;
            flex: 0 0 80%;
            /* The text takes 50% of the width */
            padding: 0 10px;
            /* Add some padding between image and text */
        }

        .address-button {
            flex: 0 0 10%;
            /* The button takes 20% of the width */
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        #recipientName,
        #street,
        #location {
            font-family: 'Open Sans';
            font-size: 15px;
            margin: 0;
        }

        #recipientName {
            font-size: 16px;
        }

        button.edit-address {
            font-family: 'Open Sans';
            color: #f95cba;
            font-weight: 700;
            background-color: transparent;
            border: none;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="gradient-bg">
        <div id="title">
            <div class="img-holder"><img src="../IMG/icon-big-address.png"></div>
            <div id="text-holder">
                <p id="h1">Address Book</p>
                <p id="p">An Address Book is a simple tool to save and organize all your important addresses for quick and easy access.</p>
            </div>
        </div><br>

        <div id="myAddresses">
            <?php
            $query = "SELECT * FROM tbl_addresses";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="my-addresses">
                    <div class="address-img">
                        <img src="../IMG/icon-map.png" alt="Map" width="35" height="35">
                    </div>
                    <div class="address-text">
                        <b>
                            <h3 id="recipientName"><?php echo $row['recipient_name']; ?></h3>
                        </b>
                        <p id="street"><?php echo $row['street']; ?></p>
                        <p id="location"><?php echo "{$row['province']}, {$row['city']}, {$row['barangay']}"; ?></p>
                    </div>
                    <div class="address-button">
                        <button class="edit-address" data-id="<?php echo $row['address_id']; ?>">Edit</button>
                    </div>
                </div>
            <?php } ?>
        </div>

        <button id="openAddModalBtn">Add New Address</button>

        <!-- Add Address Modal structure -->
        <div id="addAddressModal" class="modal">
            <div class="modal-content">
                <button class="close-btn" id="closeModalBtn">&times;</button>
                <h2>Add New Address</h2>
                <form id="addForm" action="save-address.php" method="post">
                    <label for="name">Recipient's Name:</label>
                    <input type="text" id="name" name="name" placeholder="Ex: Juan Dela Cruz" required>

                    <label for="province">Select Province:</label>
                    <select id="province" name="province" required>
                        <option value="" disabled selected>--Select Province--</option>
                        <option value="Bulacan">Bulacan</option>
                        <option value="Pampanga">Pampanga</option>
                    </select>

                    <div class="address-fields">
                        <div class="address-column">
                            <label for="city">Select City:</label>
                            <select id="city" name="city" required>
                                <option value="" disabled selected>--Select City--</option>
                            </select>
                        </div>

                        <div class="address-column">
                            <label for="barangay">Select Barangay:</label>
                            <select id="barangay" name="barangay" required>
                                <option value="" disabled selected>--Select Barangay--</option>
                            </select>
                        </div>
                    </div>

                    <label for="street">Street/Building Name:</label>
                    <input type="text" id="street" name="street" placeholder="Ex: Purok 2" required>

                    <label for="addInfo">Additional Info (Optional):</label>
                    <input type="text" id="addInfo" name="addInfo" placeholder="Ex: Near the Church">

                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="contact" name="contact"
                        placeholder="09XX-XXX-XXXX"
                        pattern="^(09\d{2}-?\d{3}-?\d{4}|(\+639)\d{2}-?\d{3}-?\d{4})$"
                        title="Please enter a valid mobile number (e.g., 0912-345-6789 or +63912-345-6789)"
                        required>

                    <button id="addButton" type="submit">Save Changes</button>
                </form>
            </div>
        </div>

        <script>
            // Modal elements
            const addModal = document.getElementById('addAddressModal');
            const addOpenBtn = document.getElementById('openAddModalBtn');
            const addCloseBtn = addModal.querySelector('.close-btn');
            const addProvinceSelect = document.getElementById('province');
            const addCitySelect = document.getElementById('city');
            const addBarangaySelect = document.getElementById('barangay');

            // City-Barangay data
            const cityBarangayData = {
                "Bulacan": {
                    "Calumpit": [
                        "Buguion", "Bulusan", "Calizon", "Calumpang", "Caniogan", "Corazon", "Frances", "Gatbuca", "Gugo", "Iba Este", "Iba O'Este", "Longos", "Meysulao", "Meyto", "Palimbang", "Panducot", "Pio Cruzcosa", "Poblacion", "Pungo", "San Jose", "San Marcos", "San Miguel", "Santa Lucia", "Santo Nino", "Sapang Bayan", "Sergio Bayan", "Sucol"
                    ],
                    "Hagonoy": [
                        "Abulalas", "Carillo", "Iba", "Iba-Ibayo", "Mercado", "Palapat", "Pugad", "Sagrada Familia", "San Agustin", "San Isidro", "San Jose", "San Juan", "San Miguel", "San Nicolas", "San Pablo", "San Pascual", "San Pedro", "San Roque", "San Sebastian", "Santa Cruz", "Santa Elena", "Santa Monica", "Santo Nino (Pob.)", "Santo Rosario", "Tampok", "Tibaguin"
                    ]
                },

                "Pampanga": {
                    "Apalit": [
                        "Balucuc", "Calantipe", "Cansinala", "Capalangan", "Colgante", "Paligui", "Sampaloc", "San Juan (Pob.)", "San Vicente", "Sucad", "Sulipan", "Tabuyuc (Santo Rosario)"
                    ],
                    "Macabebe": [
                        "Batasan", "Caduang Tete", "Candelaria", "Castuli", "Consuelo", "Dalayap", "Mataguiti", "San Esteban", "San Francisco", "San Gabriel (Pob.)", "San Isidro", "San Jose", "San Juan", "San Rafael", "San Roque", "Santa Cruz (Pob.)", "Santa Lutgarda", "Santa Maria", "Santa Rita (Pob.)", "Santo Nino", "Santo Rosario (Pob.)", "San Vicente", "Saplad David", "Tacasan", "Telacsan"
                    ],
                    "Masantol": [
                        "Alauli", "Bagang", "Balibago", "Bebe Anac", "Bebe Matua", "Bulacus", "Cambasi", "Malauli", "Nigui", "Palimpe", "Puti", "Sagrada (Tibagin)", "San Agustin (Caingin)", "San Isidro Anac", "San Isidro Matua (Pob.)", "San Nicolas (Pob.)", "San Pedro", "Santa Cruz", "Santa Lucia Anac (Pob.)", "Santa Lucia Matua", "Santa Lucia Paguiba", "Santa Lucia Wakas", "Santa Monica (Caingin)", "Santo Nino", "Sapang Kawayan", "Sua"
                    ]
                }
            };

            // Show the Add Modal
            addOpenBtn.addEventListener('click', () => {
                addModal.style.display = 'flex';
            });

            // Hide the Add Modal
            addCloseBtn.addEventListener('click', () => {
                addModal.style.display = 'none';
            });

            closeModalBtn.addEventListener('click', function() {
                addModal.style.display = 'none';
            });

            // Close modal when clicking outside of it
            window.addEventListener('click', (event) => {
                if (event.target === addModal) {
                    addModal.style.display = 'none';
                }
            });

            // Populate cities when a province is selected
            addProvinceSelect.addEventListener('change', () => {
                const selectedProvince = addProvinceSelect.value;
                addCitySelect.innerHTML = '<option value="" disabled selected>--Select City--</option>';
                addBarangaySelect.innerHTML = '<option value="" disabled selected>--Select Barangay--</option>';

                if (selectedProvince) {
                    const cities = Object.keys(cityBarangayData[selectedProvince] || {});
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city;
                        option.textContent = city;
                        addCitySelect.appendChild(option);
                    });
                }
            });

            // Populate barangays when a city is selected
            addCitySelect.addEventListener('change', () => {
                const selectedProvince = addProvinceSelect.value;
                const selectedCity = addCitySelect.value;
                addBarangaySelect.innerHTML = '<option value="" disabled selected>--Select Barangay--</option>';

                if (selectedCity) {
                    const barangays = cityBarangayData[selectedProvince]?.[selectedCity] || [];
                    barangays.forEach(barangay => {
                        const option = document.createElement('option');
                        option.value = barangay;
                        option.textContent = barangay;
                        addBarangaySelect.appendChild(option);
                    });
                }
            });
        </script>


        <!-- Update Address Modal structure -->
        <div id="editAddressModal" class="modal">
            <div class="modal-content">
                <button class="close-btn" id="closeModalBtn">&times;</button>
                <h2>Edit Address</h2>
                <form id="editForm" action="update-address.php" method="post">
                    <input type="hidden" id="addressId" name="addressId">

                    <label for="name">Recipient's Name:</label>
                    <input type="text" id="name" name="name" placeholder="Ex: Juan Dela Cruz" required>

                    <label for="province">Select Province:</label>
                    <select id="province" name="province" class="province" required>
                        <option value="" disabled selected>--Select Province--</option>
                        <option value="Bulacan">Bulacan</option>
                        <option value="Pampanga">Pampanga</option>
                        <!-- Add more provinces here -->
                    </select>

                    <div class="address-fields">
                        <div class="address-column">
                            <label for="city">Select City:</label>
                            <select id="city" name="city" class="city" required>
                                <option value="" disabled selected>--Select City--</option>
                            </select>
                        </div>

                        <div class="address-column">
                            <label for="barangay">Select Barangay:</label>
                            <select id="barangay" name="barangay" class="barangay" required>
                                <option value="" disabled selected>--Select Barangay--</option>
                            </select>
                        </div>
                    </div>

                    <label for="street">Street/Building Name:</label>
                    <input type="text" id="street" name="street" placeholder="Ex: Purok 2" required>

                    <label for="addInfo">Additional Info (Optional):</label>
                    <input type="text" id="addInfo" name="addInfo" placeholder="Ex: Near the Church">

                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="contact" name="contact"
                        placeholder="09XX-XXX-XXXX"
                        pattern="^(09\d{2}-?\d{3}-?\d{4}|(\+639)\d{2}-?\d{3}-?\d{4})$"
                        title="Please enter a valid mobile number (e.g., 0912-345-6789 or +63912-345-6789)"
                        required>
                    <button id="editButton" type="submit">Update Address</button>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editButtons = document.querySelectorAll('.edit-address');
                const editModal = document.getElementById('editAddressModal');
                const closeModalBtn = editModal.querySelector('.close-btn');
                const form = document.getElementById('editForm');
                const editProvinceSelect = document.querySelector('.province');
                const editCitySelect = document.querySelector('.city');
                const editBarangaySelect = document.querySelector('.barangay');

                const editCityBarangayData = {
                    "Bulacan": {
                        "Calumpit": ["Buguion", "Bulusan", "Calizon", "Calumpang", "Caniogan", "Corazon", "Frances", "Gatbuca", "Gugo", "Iba Este", "Iba O'Este", "Longos", "Meysulao", "Meyto", "Palimbang", "Panducot", "Pio Cruzcosa", "Poblacion", "Pungo", "San Jose", "San Marcos", "San Miguel", "Santa Lucia", "Santo Nino", "Sapang Bayan", "Sergio Bayan", "Sucol"],
                        "Hagonoy": ["Abulalas", "Carillo", "Iba", "Iba-Ibayo", "Mercado", "Palapat", "Pugad", "Sagrada Familia", "San Agustin", "San Isidro", "San Jose", "San Juan", "San Miguel", "San Nicolas", "San Pablo", "San Pascual", "San Pedro", "San Roque", "San Sebastian", "Santa Cruz", "Santa Elena", "Santa Monica", "Santo Nino (Pob.)", "Santo Rosario", "Tampok", "Tibaguin"]
                    },
                    "Pampanga": {
                        "Apalit": ["Balucuc", "Calantipe", "Cansinala", "Capalangan", "Colgante", "Paligui", "Sampaloc", "San Juan (Pob.)", "San Vicente", "Sucad", "Sulipan", "Tabuyuc (Santo Rosario)"],
                        "Macabebe": ["Batasan", "Caduang Tete", "Candelaria", "Castuli", "Consuelo", "Dalayap", "Mataguiti", "San Esteban", "San Francisco", "San Gabriel (Pob.)", "San Isidro", "San Jose", "San Juan", "San Rafael", "San Roque", "Santa Cruz (Pob.)", "Santa Lutgarda", "Santa Maria", "Santa Rita (Pob.)", "Santo Nino", "Santo Rosario (Pob.)", "San Vicente", "Saplad David", "Tacasan", "Telacsan"],
                        "Masantol": ["Alauli", "Bagang", "Balibago", "Bebe Anac", "Bebe Matua", "Bulacus", "Cambasi", "Malauli", "Nigui", "Palimpe", "Puti", "Sagrada (Tibagin)", "San Agustin (Caingin)", "San Isidro Anac", "San Isidro Matua (Pob.)", "San Nicolas (Pob.)", "San Pedro", "Santa Cruz", "Santa Lucia Anac (Pob.)", "Santa Lucia Matua", "Santa Lucia Paguiba", "Santa Lucia Wakas", "Santa Monica (Caingin)", "Santo Nino", "Sapang Kawayan", "Sua"]
                    }
                };

                // Open modal and fetch address data
                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const addressId = this.getAttribute('data-id'); // Get the address ID from the button

                        // Fetch address data
                        fetch('get-address.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: `address_id=${addressId}`
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log('Fetched Address Data:', data);
                                    // Populate modal form fields
                                    form.querySelector('#addressId').value = data.address_id;
                                    form.querySelector('#name').value = data.recipient_name;
                                    form.querySelector('#street').value = data.street;
                                    editProvinceSelect.value = data.province;

                                    // Update city and barangay dropdowns
                                    updateCityOptions(data.province, data.city); // Update city dropdown
                                    updateBarangayOptions(data.province, data.city, data.barangay); // Update barangay dropdown

                                    form.querySelector('#addInfo').value = data.addInfo;
                                    form.querySelector('#contact').value = data.phone_number;

                                    // Show modal
                                    editModal.style.display = 'block';
                                } else {
                                    alert('Failed to load address data.');
                                }
                            })
                            .catch(error => console.error('Error fetching address data:', error));
                    });
                });

                // Close modal on close button click
                closeModalBtn.addEventListener('click', function() {
                    resetForm(); // Reset the form
                    editModal.style.display = 'none';
                });

                // Close modal if clicking outside of modal content
                window.addEventListener('click', function(event) {
                    if (event.target === editModal) {
                        resetForm(); // Reset the form
                        editModal.style.display = 'none';
                    }
                });

                // Reset form fields and dropdowns
                function resetForm() {
                    form.reset(); // Reset all form fields to their default state
                    editProvinceSelect.value = '';
                    editCitySelect.innerHTML = '<option value="" disabled selected>--Select City--</option>';
                    editBarangaySelect.innerHTML = '<option value="" disabled selected>--Select Barangay--</option>';
                }

                // Populate cities and barangays when province or city changes
                function updateCityOptions(province, selectedCity = null) {
                    console.log('Updating city options for province:', province); // Debugging log
                    editCitySelect.innerHTML = '<option value="" disabled selected>--Select City--</option>';
                    if (province && editCityBarangayData[province]) {
                        const cities = Object.keys(editCityBarangayData[province]);
                        cities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city;
                            option.textContent = city;
                            if (city === selectedCity) {
                                option.selected = true; // Preselect the city if applicable
                            }
                            editCitySelect.appendChild(option);
                        });
                    } else {
                        console.log('No cities available for this province'); // Debugging log
                    }
                }

                function updateBarangayOptions(province, city, selectedBarangay = null) {
                    console.log('Updating barangay options for city:', city); // Debugging log
                    editBarangaySelect.innerHTML = '<option value="" disabled selected>--Select Barangay--</option>';
                    if (province && city && editCityBarangayData[province] && editCityBarangayData[province][city]) {
                        const barangays = editCityBarangayData[province][city];
                        barangays.forEach(barangay => {
                            const option = document.createElement('option');
                            option.value = barangay;
                            option.textContent = barangay;
                            if (barangay === selectedBarangay) {
                                option.selected = true; // Preselect the barangay if applicable
                            }
                            editBarangaySelect.appendChild(option);
                        });
                    } else {
                        console.log('No barangays available for this city'); // Debugging log
                    }
                }

                // Update city and barangay options when province or city is changed
                editProvinceSelect.addEventListener('change', () => {
                    const selectedProvince = editProvinceSelect.value;
                    console.log('Selected Province:', selectedProvince); // Debugging log
                    updateCityOptions(selectedProvince);
                    editBarangaySelect.innerHTML = '<option value="" disabled selected>--Select Barangay--</option>';
                });

                editCitySelect.addEventListener('change', () => {
                    const selectedProvince = editProvinceSelect.value;
                    const selectedCity = editCitySelect.value;
                    console.log('Selected City:', selectedCity); // Debugging log
                    updateBarangayOptions(selectedProvince, selectedCity);
                });
            });
        </script>
    </div>
</body>

</html>