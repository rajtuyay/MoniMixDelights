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
        -webkit-overflow-scrolling: touch;
    }

    #content::-webkit-scrollbar {
        width: 2vh;
        height: 10px;
    }

    #content::-webkit-scrollbar-thumb {
        background: #f9afdd;
        border-top: 1px solid #d090b7;
        border-bottom: 1px solid #d090b7;
    }

    #content::-webkit-scrollbar-track {
        border: 1px solid #d090b7;
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
        vertical-align: top;
        padding: 0;
        margin: 0;
        padding: 10px 10px;
    }

    #row-orders td p {
        color: #f95cba;
        font-weight: 600;
    }

    #row-orders #td-action,
    #row-orders #td-reply {
        padding: 4px 0;
        vertical-align: top;
    }

    #row-orders #td-review {
        text-align: justify;
        word-wrap: break-word;
        white-space: normal;
        padding: 10px 10px;
        max-width: 30vw;
    }

    #row-orders #td-action button,
    #row-orders #td-reply button {
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

    #row-orders #td-action button:hover,
    #row-orders #td-reply button:hover {
        background-color: #941a90;
    }

    .star {
        width: 20px;
        height: 20px;
        background-color: gold;
        display: inline-block;
        clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
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

    #replyForm {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    #replyButton {
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

    #replyButton:hover {
        background-color: #f95cba;
    }

    #replyForm textarea {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #FA8BCE;
        border-radius: 4px;
    }

    #replyForm textarea::placeholder {
        color: #f1c3f0;
    }

    #replyForm textarea {
        resize: none;
        height: 100px;
    }
</style>
<div id="mother-div">
    <div id="customers-nav">
        <div id="tag-queries">
            <h3 style="color: #B91EB3;">Reviews</h3>
            <?php
            // Count the total number of unique users who have queries
            $query = "SELECT COUNT(DISTINCT tbl_reviews.review_id) AS user_count FROM tbl_reviews";
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
        <button id="all-products-btn" class="customer-id active" data-review="all">
            <img id="icon-all" src="../IMG/icon-all.png" alt="All">
            <h3>All Reviews</h3>
        </button>
        <?php
        $query = "SELECT prod_id, prod_name, prod_image FROM tbl_products"; // Fetch only necessary fields
        $result = mysqli_query($connection, $query);

        if (!$result) {
            error_log("Error fetching products: " . mysqli_error($connection));
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                // Ensure data is sanitized and correctly formatted
                $prodId = htmlspecialchars($row['prod_id']);
                $prodName = htmlspecialchars(strtolower($row['prod_name']));
                $imgURL = '../IMG/Products/' . htmlspecialchars($row['prod_image']);
        ?>
                <button class="customer-id"
                    data-review="<?php echo $prodId; ?>"
                    data-name="<?php echo $prodName; ?>">
                    <img src="<?php echo $imgURL ?>" alt="<?php echo htmlspecialchars($row['prod_name']); ?>">
                    <h3><?php echo htmlspecialchars($row['prod_name']); ?></h3>
                </button>
        <?php
            }
        }
        ?>
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
        const reviewTable = document.getElementById('order-list'); // The parent container (e.g., table body)

        reviewTable.addEventListener('click', function(event) {
            // Check if the clicked element is an "Edit" button
            if (event.target && event.target.classList.contains('btn-reply')) {
                const reviewId = event.target.getAttribute('data-id'); // Get the product ID
                console.log(reviewId);
                const modal = document.getElementById('replyModal'); // Adjust this if there are multiple modals
                const form = document.getElementById('replyForm'); // Scope to the form inside the modal

                // Fetch product data via AJAX and populate fields
                fetch(`get-reviews.php?id=${reviewId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Populate inputs using scoped query selectors
                        form.querySelector('#reviewId').value = reviewId;
                        form.querySelector('#reviewText').value = data.review_text;
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
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".customer-id");
        const productsDisplay = document.getElementById("order-list");

        function loadProducts(productId) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `fetch-reviews-admin.php?product=${productId}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    productsDisplay.innerHTML = xhr.responseText; // Populate products
                } else {
                    productsDisplay.innerHTML = "<p>Error loading products.</p>";
                }
            };
            xhr.send();
        }

        loadProducts("all");

        // Add click event to each button
        buttons.forEach((button) => {
            button.addEventListener("click", function() {
                buttons.forEach((btn) => btn.classList.remove("active"));
                this.classList.add("active");
                const reviewId = this.getAttribute("data-review");
                loadProducts(reviewId);
            });
        });

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
            const reviewName = button.getAttribute("data-name");

            // Show/hide button based on match
            if (reviewName.includes(query)) {
                button.style.display = "flex";
            } else {
                button.style.display = "none";
            }
        });
    }
</script>