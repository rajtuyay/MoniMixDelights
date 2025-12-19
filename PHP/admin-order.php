<style>
    * {
        font-family: 'Open Sans';
        color: #B91EB3;
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
        width: 40px;
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

    .row-orders td {
        color: #B91EB3;
        font-size: 0.9rem;
        border: 1px solid #FA8BCE;
        font-weight: 400;
        text-align: center;
        padding: 0;
        margin: 0;
    }

    .row-orders #td-action {
        padding: 4px 0;
        vertical-align: middle;
    }

    .row-orders #td-action .btn-accept, .row-orders #td-action .btn-cancel {
        box-sizing: border-box;
        color: white;
        background-color: #B91EB3;
        border: none;
        width: 70%;
        margin: 3px 0;
        padding: 2px 0;
        user-select: none;
        cursor: pointer;
        border-radius: 0.5vh;
    }

    .row-orders #td-action .btn-accept:hover, .row-orders #td-action .btn-cancel:hover {
        background-color: #941a90;
    }
</style>
<div id="mother-div">
    <div id="customers-nav">
        <div id="tag-queries">
            <h3 style="color: #B91EB3;">Orders</h3>
            <?php
            // Count the total number of unique users who have queries
            $query = "SELECT COUNT(DISTINCT tbl_orders.order_id) AS user_count FROM tbl_orders";
            $result = mysqli_query($connection, $query);

            $userCount = 0; // Default to 0 in case the query fails
            if ($result && $row = mysqli_fetch_assoc($result)) {
                $userCount = $row['user_count'];
            }
            ?>
            <p class="notif"><?php echo $userCount; ?></p>
        </div>
        <input type="text" name="search" id="search-query" placeholder="Search..." onInput="filterProducts(this.value)">
        <!-- All Products Button -->
        <button id="all-products-btn" class="customer-id active" data-product="all">
            <img id="icon-all" src="../IMG/icon-all.png" alt="All">
            <h3>All Orders</h3>
        </button>
        <?php
        $query = "SELECT * FROM tbl_products";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <button class="customer-id" data-product="<?php echo $row['prod_id']; ?>" data-name="<?php echo strtolower($row['prod_name']); ?>">
                <img src="<?php echo "../IMG/Products/" . $row['prod_image'] ?>" alt="User">
                <h3><?php echo $row['prod_name'] ?></h3>
            </button>
        <?php } ?>
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

        // Function to load products based on product
        function loadProducts(productId) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `fetch-orders-admin.php?product=${productId}`, true);
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
                // Load products based on the clicked product
                const productId = this.getAttribute("data-product");
                loadProducts(productId);
            });
        });

    });

    function filterProducts(searchQuery) {
        const buttons = document.querySelectorAll(".customer-id");
        const query = searchQuery.toLowerCase().trim();

        buttons.forEach((button) => {
            // Exclude the "All Products" button from search filtering
            if (button.id === "all-products-btn") {
                button.style.display = "flex"; // Always show the "All Products" button
                return;
            }

            // Get the product name from the data attribute
            const productName = button.getAttribute("data-name");

            // Show/hide button based on match
            if (productName.includes(query)) {
                button.style.display = "flex";
            } else {
                button.style.display = "none";
            }
        });
    }
</script>