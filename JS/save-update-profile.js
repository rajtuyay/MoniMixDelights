// Add Address Modal Elements
const addModal = document.getElementById('addAddressModal');
const addOpenBtn = document.getElementById('openAddModalBtn');
const addCloseBtn = addModal.querySelector('.close-btn');
const addProvinceSelect = addModal.querySelector('#province');
const addCitySelect = addModal.querySelector('#city');
const addBarangaySelect = addModal.querySelector('#barangay');

// Edit Address Modal Elements
const editModal = document.getElementById('editAddressModal');
const editCloseBtn = editModal.querySelector('.close-btn');
const editProvinceSelect = editModal.querySelector('#province');
const editCitySelect = editModal.querySelector('#city');
const editBarangaySelect = editModal.querySelector('#barangay');

// Shared Data for City and Barangay
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

// Modal Display Functions
function showModal(modal) {
    modal.style.display = 'flex';
}

function hideModal(modal) {
    modal.style.display = 'none';
}

// Add Modal Event Listeners
if (addOpenBtn) {
    addOpenBtn.addEventListener('click', () => showModal(addModal));
}

addCloseBtn.addEventListener('click', () => hideModal(addModal));

// Edit Modal Event Listeners
editCloseBtn.addEventListener('click', () => hideModal(editModal));

// Province Change Handler
function handleProvinceChange(provinceSelect, citySelect, barangaySelect) {
    const selectedProvince = provinceSelect.value;
    citySelect.innerHTML = '<option value="" disabled selected>--Select City--</option>';
    barangaySelect.innerHTML = '<option value="" disabled selected>--Select Barangay--</option>';

    if (selectedProvince && cityBarangayData[selectedProvince]) {
        const cities = Object.keys(cityBarangayData[selectedProvince]);
        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        });
    }
}

// City Change Handler
function handleCityChange(citySelect, barangaySelect, selectedProvince) {
    const selectedCity = citySelect.value;
    barangaySelect.innerHTML = '<option value="" disabled selected>--Select Barangay--</option>';

    if (selectedProvince && selectedCity && cityBarangayData[selectedProvince][selectedCity]) {
        const barangays = cityBarangayData[selectedProvince][selectedCity];
        barangays.forEach(barangay => {
            const option = document.createElement('option');
            option.value = barangay;
            option.textContent = barangay;
            barangaySelect.appendChild(option);
        });
    }
}

// Add Modal Province and City Event Listeners
addProvinceSelect.addEventListener('change', () =>
    handleProvinceChange(addProvinceSelect, addCitySelect, addBarangaySelect)
);

addCitySelect.addEventListener('change', () =>
    handleCityChange(addCitySelect, addBarangaySelect, addProvinceSelect.value)
);

// Edit Modal Province and City Event Listeners
editProvinceSelect.addEventListener('change', () =>
    handleProvinceChange(editProvinceSelect, editCitySelect, editBarangaySelect)
);

editCitySelect.addEventListener('change', () =>
    handleCityChange(editCitySelect, editBarangaySelect, editProvinceSelect.value)
);

// Example Prefill Function for Edit Modal
function populateEditForm(data) {
    const { name, province, city, barangay, street, addInfo, contact } = data;
    document.getElementById('editName').value = name;
    editProvinceSelect.value = province;

    handleProvinceChange(editProvinceSelect, editCitySelect, editBarangaySelect);
    editCitySelect.value = city;

    handleCityChange(editCitySelect, editBarangaySelect, province);
    editBarangaySelect.value = barangay;

    document.getElementById('editStreet').value = street;
    document.getElementById('editAddInfo').value = addInfo;
    document.getElementById('editContact').value = contact;
}
