// Array to store all added products (will be loaded from localStorage on page load)
let orderItems = [];

// Load order items from localStorage on page load
function loadOrderItems() {
    const savedOrderItems = localStorage.getItem("orderItems");
    if (savedOrderItems) {
        orderItems = JSON.parse(savedOrderItems);
    }
    updateOrderList();
}

function addOrder() {
    // Get values from the overlay form
    const prodNameElement = document.getElementById("product-name");
    const prodPriceElement = document.getElementById("product-price");
    const quantityElement = document.getElementById("quantity-display");
    const boxOptionElement = document.querySelector('input[name="option"]:checked');

    // Get the productId from the hidden input
    const productIdElement = document.querySelector('.prod-id');
    const productId = productIdElement ? productIdElement.value : null;

    console.log(productId);

    // Check if the required elements are available
    if (!prodNameElement || !prodPriceElement || !quantityElement || !boxOptionElement || !productId) {
        console.error("Missing required product details.");
        return;
    }

    // Extract values
    const prodName = prodNameElement.innerText.trim();
    const prodPrice = parseFloat(prodPriceElement.innerText.replace('₱', '').trim());
    const quantity = parseInt(quantityElement.innerText);
    const boxOption = boxOptionElement.value;

    // Validate inputs
    if (!prodName || isNaN(prodPrice) || quantity <= 0 || isNaN(quantity) || !boxOption) {
        console.error("Invalid product details.");
        return;
    }

    // Calculate price based on box selection
    let totalProductPrice = prodPrice * quantity;
    if (boxOption === "12") {
        totalProductPrice *= 2;
    }

    // Check if product already exists in orderItems
    const existingProductIndex = orderItems.findIndex(item => item.name === prodName && item.boxOption === boxOption);

    if (existingProductIndex !== -1) {
        // Update existing product
        const existingProduct = orderItems[existingProductIndex];
        existingProduct.quantity += quantity;
        existingProduct.totalPrice = existingProduct.price * existingProduct.quantity;
    } else {
        // Add new product
        const product = {
            name: prodName,
            price: prodPrice,
            quantity: quantity,
            boxOption: boxOption,
            totalPrice: totalProductPrice,
            productId: productId 
        };
        orderItems.push(product);
    }

    // Update display and save to localStorage
    updateOrderList();
    localStorage.setItem("orderItems", JSON.stringify(orderItems));

    hideOverlay();
    resetModal();
}

function updateOrderList() {
    const orderList = document.getElementById("order-list");
    orderList.innerHTML = '';

    let subTotal = 0;

    // Calculate subtotal and build the product list
    orderItems.forEach((item, index) => {
        subTotal += item.totalPrice;

        const productDiv = document.createElement("div");
        productDiv.classList.add("product-info");

        productDiv.innerHTML = `
            <div class="left-info">
                <h3>(${item.quantity}) ${item.name}</h3>
                <h4><i>Box of ${item.boxOption}</i></h4>
                <a id="edit-btn">Edit</a>
            </div>
            <div class="right-info">
                <h3>₱${item.totalPrice.toFixed(2)}</h3>
                <button onclick="removeProductFromOrder(${index})">
                    <img src="../IMG/trashcan.png" alt="Trash" width="20" height="20">
                </button>
            </div>
            <hr>
        `;

        orderList.appendChild(productDiv);
    });

    // Calculate shipping fee and total price
    const shippingFee = subTotal >= 1000 || subTotal === 0 ? 0 : 75;
    const totalWithShipping = subTotal === 0 ? 0 : subTotal + shippingFee;

    // Update the UI
    document.getElementById("sub-price").innerText = `₱${subTotal.toFixed(2)}`;
    document.getElementById("total-price").innerText = `₱${totalWithShipping.toFixed(2)}`;

    const shippingFeeElement = document.getElementById("shipping-fee");
    const shippingFeeTagElement = document.getElementById("shipping-fee-tag");
    if (subTotal === 0) {
        shippingFeeElement.style.display = "none"; // Hide shipping fee
        shippingFeeTagElement.style.display = "none"; // Hide shipping fee
    } else {
        shippingFeeElement.style.display = "block"; // Show shipping fee
        shippingFeeTagElement.style.display = "block"; // Show shipping fee
        shippingFeeElement.innerText = `₱${shippingFee.toFixed(2)}`;
        shippingFeeElement.style.color = shippingFee === 0 ? "#ff0000" : "#f730f0";
    }

    updateBasketPrice();
    updateProgress(subTotal);
}

// Function to update the progress bar and text
function updateProgress(subTotal) {
    const freeDeliveryThreshold = 1000; // Threshold for free delivery
    const progressText = document.getElementById("progress-text");
    const progressBar = document.querySelector(".progress-bar");

    // Check if elements exist
    if (!progressText || !progressBar) {
        console.error("Progress elements not found in the DOM.");
        return; // Exit the function if elements are missing
    }

    const remainingAmount = freeDeliveryThreshold - subTotal;
    if (remainingAmount > 0) {
        // Update the progress text and progress bar
        progressText.innerText = remainingAmount.toFixed(2);
        const progressPercentage = (subTotal / freeDeliveryThreshold) * 100;
        progressBar.style.width = progressPercentage + "%";
    } else {
        // Display free delivery when the threshold is met
        progressText.innerText = "0.00";
        progressBar.style.width = "100%";
    }
}



function removeProductFromOrder(index) {
    orderItems.splice(index, 1);
    updateOrderList();
    localStorage.setItem("orderItems", JSON.stringify(orderItems));
}

function updateBasketPrice() {
    const totalPrice = orderItems.reduce((sum, item) => sum + item.totalPrice, 0);
    document.getElementById("basket-price").innerText = `₱${totalPrice.toFixed(2)}`;
}

function populateAddressSelect() {
    const addressSelect = document.querySelector('#my-address');
    const addressTextArea = document.getElementById('address');
    const contactSelect = document.querySelector('#my-contact');
    const phoneInput = document.getElementById('phone');

    // Fetch addresses
    fetch('display-addresses.php')
        .then(response => response.json())
        .then(addressData => {
            addressSelect.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.textContent = 'Select Address';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            addressSelect.appendChild(defaultOption);

            addressData.forEach(address => {
                const option = document.createElement('option');
                option.textContent = address;
                addressSelect.appendChild(option);
            });

            addressSelect.addEventListener('change', () => {
                addressTextArea.value = addressSelect.value;
            });
        })
        .catch(error => console.error("Error fetching addresses:", error));

    // Fetch contacts
    fetch('display-contacts.php')
        .then(response => response.json())
        .then(contactData => {
            contactSelect.innerHTML = '';
            const defaultOption = document.createElement('option');
            defaultOption.textContent = 'Select Contact';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            contactSelect.appendChild(defaultOption);

            contactData.forEach(contact => {
                const option = document.createElement('option');
                option.textContent = contact;
                contactSelect.appendChild(option);
            });

            contactSelect.addEventListener('change', () => {
                phoneInput.value = contactSelect.value;
            });
        })
        .catch(error => console.error("Error fetching contacts:", error));
}

function resetModal() {
    document.getElementById("product-name").innerText = "Product Name";
    document.getElementById("product-price").innerText = "₱0.00";
    document.getElementById("product-image").src = "";
    document.getElementById("product-description2").innerText = "";

    document.querySelectorAll('input[type="radio"]').forEach(button => button.checked = false);
    const specialRequestTextarea = document.querySelector('textarea[name="special-request"]');
    if (specialRequestTextarea) {
        specialRequestTextarea.value = '';
    }
    document.getElementById("quantity-display").innerText = '1';
    document.getElementById("basket-price").innerText = " ₱0.00";
}

function showOverlay() {
    document.getElementById("overlay").style.display = "block";
}

function hideOverlay() {
    const overlay = document.getElementById("overlay");
    overlay.style.visibility = "hidden";
    overlay.style.opacity = 0;
}

function hideCheckoutModal() {
    document.getElementById("checkout-modal").style.display = "none";
}

function showCheckoutModal() {
    // Check if the basket is empty
    if (orderItems.length === 0) {
        alert("Your basket is empty. Add items before proceeding to checkout.");
        return; // Prevent the modal from being displayed
    }

    // If basket is not empty, display the checkout modal
    document.getElementById("checkout-modal").style.display = "flex";
}

function updatePriceOnBoxChange() {
    const prodPrice = parseFloat(document.getElementById("product-price").innerText.replace('₱', ''));
    const boxOption = document.querySelector('input[name="option"]:checked')?.value || '6';

    const newPrice = boxOption === "12" ? prodPrice * 2 : prodPrice;
    document.getElementById("basket-price").innerText = `₱${newPrice.toFixed(2)}`;
}

function confirmCheckout() {
    const address = document.getElementById("address").value; // Full concatenated address
    const contact = document.getElementById("phone").value;
    const paymentMethod = document.querySelector('input[name="payment-method"]:checked')?.value;

    if (!address || !paymentMethod || !contact) {
        alert("Please fill in all fields.");
        return;
    }

    // Gather order data
    const orderData = orderItems.map(item => ({
        product_name: item.name,  // Use product_name instead of product_id
        package: item.boxOption,
        quantity: item.quantity,
        price: item.totalPrice
    }));

    console.log("Data being sent to server: ", orderData);

    // Prepare data for backend
    const data = {
        orderItems: orderData,  // No need to stringify this since it's an array of objects
        address: address,  // Pass the concatenated address as is
        totalAmount: parseFloat(document.getElementById("total-price").innerText.replace('₱', '').trim()),
        paymentMethod: paymentMethod,
        contact: contact
    };

    // Send data to PHP backend
    fetch('save-checkout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)  // Send the data as JSON
    })
        .then(response => response.json())
        .then(responseData => {
            if (responseData.status === 'success') {
                alert(responseData.message);
                
                // Clear the basket after successful order
                orderItems = [];  // Clear the basket array
                localStorage.removeItem("orderItems");  // Remove the basket from localStorage
                updateOrderList();  // Update the order list UI to reflect the empty basket

                // Redirect to the profile page
                window.location.href = "profile.php?page=order";  // Navigate to profile.php
            } else {
                alert('Error: ' + responseData.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}



// Event listeners
window.onload = function () {
    loadOrderItems();
    populateAddressSelect();
    updatePriceOnBoxChange();

    document.querySelectorAll('input[name="option"]').forEach(option => {
        option.addEventListener("change", updatePriceOnBoxChange);
    });

    document.getElementById("add-to-basket").addEventListener("click", addOrder);
    document.getElementById("increase-quantity").addEventListener("click", () => {
        const quantityDisplay = document.getElementById("quantity-display");
        quantityDisplay.innerText = parseInt(quantityDisplay.innerText) + 1;
    });
    document.getElementById("decrease-quantity").addEventListener("click", () => {
        const quantityDisplay = document.getElementById("quantity-display");
        const quantity = parseInt(quantityDisplay.innerText);
        if (quantity > 1) {
            quantityDisplay.innerText = quantity - 1;
        }
    });
    document.querySelector(".close-button").addEventListener("click", hideCheckoutModal);
    document.getElementById("checkout").addEventListener("click", showCheckoutModal);
};
