<style>
    * {
        font-family: 'Open Sans';
        color: #B91EB3;
        box-sizing: border-box;
    }

    html {
        overflow: hidden;
    }

    #mother-div {
        width: 100%;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        padding-top: 7vh;
    }

    #customers-nav {
        width: 25%;
        max-height: 93vh;
        height: 93vh;
        overflow-x: hidden;
        overflow-y: auto;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;
        background-color: #fff6fc;
        box-shadow: 5px 0 6px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    #add-show {
        position: fixed;
        background-color: #e333dd20;
        border: 1px solid #B91EB3;
        border-radius: 50%;
        bottom: 3vh;
        padding: 5px;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    #add-show:hover {
        background-color: #ffc7e9;
    }

    #add-show img {
        width: 35px;
        height: 35px;
        padding: 0;
        margin: 0;
    }

    #customers-nav::-webkit-scrollbar {
        width: 10px;
        height: 10vh;
    }

    #customers-nav::-webkit-scrollbar-thumb {
        background: #f9afdd;
        border-radius: 5px;
        border-left: 1px solid #d090b7;
        border-right: 1px solid #d090b7;
    }

    #customers-nav::-webkit-scrollbar-track {
        border: 1px solid #d090b7;
        border-radius: 5px;
    }

    #customers-nav #search-query {
        width: 100%;
        padding: 2vh;
        font-size: 1rem;
        border: none;
    }

    #customers-nav #search-query::placeholder {
        color: #da9bc1;
    }

    #customers-nav #search-query:focus {
        border: 1px solid #f95cba;
        outline: none;
    }

    #tag-queries {
        width: 100%;
        padding: 15px 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background-color: #f1c3f0;
        cursor: default;
        color: #f95cba;
        text-transform: uppercase;
        user-select: none;
    }

    .notif {
        width: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 17px;
        font-weight: 600;
        font-size: 0.8rem;
        border-radius: 15%;
        color: white;
        background-color: #B91EB3;
    }

    .customer-id {
        width: 100%;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        background-color: transparent;
        border: none;
        border-bottom: 1px solid #e333dd20;
        cursor: pointer;
        color: #B91EB3;
        transition: opacity 0.3s ease, transform 0.3s ease;
        transform: scale(1);
    }

    .customer-id:hover {
        background-color: #e333dd10;
    }

    .customer-id.active {
        border-left: 3px solid rgb(250, 139, 206);
        background: linear-gradient(to right, rgb(254, 248, 251) 0%, rgb(254, 227, 243) 100%);
    }

    .customer-id.active h3 {
        color: #f95cba;
    }

    .customer-id img {
        width: 50px;
        height: 40px;
        border: 1px solid #B91EB3;
        border-radius: 1vh;
    }

    .customer-id #icon-all {
        width: 40px;
        height: 40px;
        border: none;
    }

    .customer-id h3 {
        font-weight: 500;
    }

    #chat-box {
        width: 75%;
        max-height: 93vh;
        height: 93vh;
        overflow-y: auto;
        padding-top: 2vh;
        padding-bottom: 2vh;
    }

    #content {
        width: 95%;
        height: auto;
        margin: auto;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        flex-wrap: wrap;
        flex-direction: column;
        overflow-x: auto;
    }

    #order-list {
        width: 100%;
        border-radius: 10px;
        border: none;
        border-collapse: collapse;
        /* Ensures borders are collapsed */
        border-spacing: 0;
    }

    #row-heads {
        background-color: #FA8BCE;
        border: 1px solid #FA8BCE;
    }

    #row-heads th {
        color: white;
        font-weight: 600;
        text-align: center;
        padding: 10px 5px;
    }

    #row-orders td {
        color: #B91EB3;
        font-size: 0.9rem;
        border: 1px solid #FA8BCE;
        font-weight: 400;
        text-align: center;
        padding: 0;
        margin: 0;
    }

    #row-orders #td-action {
        padding: 4px 0;
        vertical-align: middle;
    }

    #row-orders #td-action button {
        box-sizing: border-box;
        color: white;
        background-color: #B91EB3;
        display: block;
        border: none;
        width: 70%;
        margin: 3px auto;
        padding: 2px 0;
        user-select: none;
        cursor: pointer;
        border-radius: 0.5vh;
    }

    #row-orders #td-action button:hover {
        background-color: #941a90;
    }

    /* Modal container */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1006;
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
        width: 700px;
        max-height: 80%;
        overflow-y: auto;
    }

    .modal-content::-webkit-scrollbar {
        width: 10px;
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

    #addProductForm,
    #addCategoryForm,
    #editProductForm {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    #addProductButton,
    #addCategoryButton,
    #editProductButton {
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

    #addProductButton:hover,
    #addCategoryButton:hover,
    #editProductButton:hover {
        background-color: #f95cba;
    }

    #addProductForm input,
    #addProductForm select,
    #addProductForm textarea,
    #addCategoryForm input,
    #addCategoryForm select,
    #addCategoryForm textarea,
    #editProductForm input,
    #editProductForm select,
    #editProductForm textarea {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #FA8BCE;
        border-radius: 4px;
    }

    #addProductForm input::placeholder,
    #addProductForm select::placeholder,
    #addProductForm textarea::placeholder,
    #addCategoryForm input::placeholder,
    #addCategoryForm select::placeholder,
    #addCategoryForm textarea::placeholder,
    #editProductForm input::placeholder,
    #editProductForm select::placeholder,
    #editProductForm textarea::placeholder {
        color: #f1c3f0;
    }

    #addProductForm textarea,
    #addCategoryForm textarea,
    #editProductForm textarea {
        resize: none;
        height: 100px;
    }

    #show-btn {
        display: none;
        position: fixed;
        bottom: 70px;
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        z-index: 9999;
        transform: translateY(20%);
        opacity: 0;
        transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        pointer-events: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        background-color: transparent;
        cursor: pointer;
    }

    #show-btn button {
        width: 100%;
        padding: 5px;
        border-radius: 1vh;
        border: 1px solid #B91EB3;
        cursor: pointer;
        background-color: #f1c3f0;
    }

    #show-btn button:hover {
        background-color: #ffc7e9;
    }

    #show-btn button:active {
        background-color: #B91EB3;
        color: white;
    }
</style>
<div id="mother-div">
    <div id="customers-nav">
        <div id="tag-queries">
            <h3 style="color: #B91EB3;">Categories</h3>
            <?php
            // Count the total number of unique users who have queries
            $query = "SELECT COUNT(DISTINCT tbl_categories.category_id) AS user_count FROM tbl_categories";
            $result = mysqli_query($connection, $query);

            $userCount = 0; // Default to 0 in case the query fails
            if ($result && $row = mysqli_fetch_assoc($result)) {
                $userCount = $row['user_count'];
            }
            ?>
            <p class="notif"><?php echo $userCount; ?></p>
        </div>
        <input type="text" name="search" id="search-query" placeholder="Search..." onInput="filterCategories(this.value)">
        <!-- All Products Button -->
        <button id="all-products-btn" class="customer-id active" data-category="all">
            <img id="icon-all" src="../IMG/icon-all.png" alt="All">
            <h3>All Products</h3>
        </button>
        <?php
        $query = "SELECT * FROM tbl_categories";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $imgURL = '../IMG/Categories/' . $row['category_image'];
        ?>
            <button class="customer-id" data-category="<?php echo $row['category_id']; ?>" data-name="<?php echo strtolower($row['category_name']); ?>">
                <img src="<?php echo $imgURL ?>" alt="<?php echo $row['category_name']; ?>">
                <h3><?php echo $row['category_name']; ?></h3>
            </button>
        <?php } ?>
        <div id="show-btn" style="display: none;">
            <button id="add-category">ADD CATEGORY</button>
            <button id="add-product">ADD PRODUCT</button>
        </div>
        <button id="add-show"><img src="../IMG/icon-add.png" alt=""></button>
    </div>

    <div id="chat-box">
        <div id="content">
            <table id="order-list">
                <!-- Content Here -->
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".customer-id");
        const productsDisplay = document.getElementById("order-list");

        // Function to load products based on category
        function loadProducts(categoryId) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `fetch-products-admin.php?category=${categoryId}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    productsDisplay.innerHTML = xhr.responseText; // Populate products
                } else {
                    productsDisplay.innerHTML = "<p>Error loading products.</p>";
                }
            };
            xhr.send();
        }

        // Default: Load all products on page load
        loadProducts("all");

        // Add click event to each button
        buttons.forEach((button) => {
            button.addEventListener("click", function() {
                // Remove active class from all buttons
                buttons.forEach((btn) => btn.classList.remove("active"));
                // Add active class to the clicked button
                this.classList.add("active");
                // Load products based on the clicked category
                const categoryId = this.getAttribute("data-category");
                loadProducts(categoryId);
            });
        });

        const button = document.getElementById('add-show');
        const div = document.getElementById('show-btn');
        const parentDiv = document.getElementById('customers-nav'); // Your specific div

        // Get parent div's dimensions
        const divRect = parentDiv.getBoundingClientRect();
        const buttonWidth = button.offsetWidth;
        const divWidth = div.offsetWidth;
        // Center the button in the parent div horizontally
        button.style.left = `${(divRect.left + divRect.width / 2) - (buttonWidth / 2)}px`;
        div.style.left = `${(divRect.left + divRect.width / 2) - 66.28}px`;
    });

    function filterCategories(searchQuery) {
        const buttons = document.querySelectorAll(".customer-id");
        const query = searchQuery.toLowerCase().trim();

        buttons.forEach((button) => {
            // Exclude the "All Products" button from search filtering
            if (button.id === "all-products-btn") {
                button.style.display = "flex"; // Always show the "All Products" button
                return;
            }

            // Get the category name from the data attribute
            const categoryName = button.getAttribute("data-name");

            // Show/hide button based on match
            if (categoryName.includes(query)) {
                button.style.display = "flex";
            } else {
                button.style.display = "none";
            }
        });
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const productTable = document.getElementById('order-list'); // The parent container (e.g., table body)

        productTable.addEventListener('click', function(event) {
            // Check if the clicked element is an "Edit" button
            if (event.target && event.target.classList.contains('btn-edit')) {
                const productId = event.target.getAttribute('data-id'); // Get the product ID

                const modal = document.getElementById('editProductModal'); // Adjust this if there are multiple modals
                const form = modal.querySelector('#editProductForm'); // Scope to the form inside the modal

                // Fetch product data via AJAX and populate fields
                fetch(`get-product.php?id=${productId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Populate inputs using scoped query selectors
                        form.querySelector('#productId').value = productId;
                        form.querySelector('#productName').value = data.prod_name;
                        form.querySelector('#productDescription').value = data.product_description;
                        form.querySelector('#productPrice').value = data.prod_price;
                        form.querySelector('#productStock').value = data.stock_quantity;
                        form.querySelector('#productStatus').value = data.status;
                        form.querySelector('#productCategory').value = data.category_id;
                    });

                // Show the modal
                modal.style.display = 'block';

                // Set the productId in the hidden field of the form
            }
        });

        document.querySelectorAll('.close-btn').forEach(button => {
            button.addEventListener("click", function() {
                // Find the closest modal for this close button
                const modal = this.closest('.modal');
                if (modal) {
                    modal.style.display = 'none';
                }
            });
        });

        // Close the modal when clicking outside of the modal content
        window.addEventListener("click", function(event) {
            if (event.target === document.getElementById('editProductModal')) {
                document.getElementById('editProductModal').style.display = 'none';
            }
        });
    });
</script>

<script>
    // Open modal
    document.getElementById("add-product").addEventListener("click", function() {
        const modal = document.getElementById("addProductModal");
        modal.style.display = "block";
    });

    document.getElementById("add-category").addEventListener("click", function() {
        const modal = document.getElementById("addCategoryModal");
        modal.style.display = "block";
    });

    document.addEventListener("DOMContentLoaded", function() {
        const addShowBtn = document.getElementById("add-show");
        const showBtnDiv = document.getElementById("show-btn");
        let isClicked = false;

        // Show the button container when hovering
        addShowBtn.addEventListener("mouseenter", function() {
            if (!isClicked) {
                showBtnDiv.style.display = "flex";
                setTimeout(() => {
                    showBtnDiv.style.transform = "translateY(0)"; // Slide in
                    showBtnDiv.style.opacity = "1"; // Fade in
                    showBtnDiv.style.pointerEvents = 'all';
                }, 10);
            }
        });

        // Show the button container when clicked
        addShowBtn.addEventListener("click", function() {
            event.stopPropagation();
            if (!isClicked) {
                showBtnDiv.style.display = "flex";
                setTimeout(() => {
                    showBtnDiv.style.transform = "translateY(0)"; // Slide in
                    showBtnDiv.style.opacity = "1"; // Fade in
                    showBtnDiv.style.pointerEvents = 'all';
                }, 10);
                isClicked = true; // Set flag to indicate that it's clicked
            } else {
                showBtnDiv.style.transform = "translateY(20%)"; // Slide down
                showBtnDiv.style.opacity = "0"; // Fade out
                isClicked = false;
                setTimeout(() => {
                    showBtnDiv.style.display = "none";
                    showBtnDiv.style.pointerEvents = "none";
                }, 300); // Match the transition duration
                isClicked = false;
            }
        });

        document.addEventListener("click", function(event) {
            if (!showBtnDiv.contains(event.target) && event.target !== addShowBtn) {
                showBtnDiv.style.transform = "translateY(20%)"; // Slide down
                showBtnDiv.style.opacity = "0"; // Fade out
                isClicked = false;
                setTimeout(() => {
                    showBtnDiv.style.display = "none";
                    showBtnDiv.style.pointerEvents = "none";
                }, 300); // Match the transition duration
            }
        });

        // Hide the button container if the mouse leaves the add-show button, unless clicked
        addShowBtn.addEventListener("mouseleave", function() {
            if (!isClicked) {
                setTimeout(() => {
                    showBtnDiv.style.transform = "translateY(20%)"; // Slide down
                    showBtnDiv.style.opacity = "0"; // Fade out
                    showBtnDiv.style.pointerEvents = 'none';
                }, 10);
            }
        });
    });
</script>