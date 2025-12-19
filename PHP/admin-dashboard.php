<style>
    #container #dashboard {
        width: 90%;
        height: auto;
        display: flex;
        align-items: start;
        justify-content: start;
        top: 5%;
        flex-wrap: wrap;
        color: #B91EB3;
        position: relative;
    }

    #container #left-db {
        width: 65%;
        display: flex;
        justify-content: center;
        gap: 10px;
        align-items: flex-start;
        flex-wrap: wrap;
        height: 100%;
        padding-bottom: 20px;
    }

    #container #dashboard #left-db #weekSelect,
    #container #dashboard #left-db #yearSelect {
        width: 100%;
        display: flex;
        justify-content: start;
        z-index: 1;
    }

    #container #dashboard #left-db #weekSelect h4 {
        margin: 0;
        flex: 3;
        left: 0;
        font-size: 1.1rem;
    }

    #container #dashboard #left-db #weekSelect input {
        flex: 1;
        right: 0;
        color: #B91EB3;
        padding: 3px 5px;
        border: 1px solid #9b1c97;
        border-radius: 3px;
    }

    #container #dashboard #left-db #weekSelect input::placeholder {
        color: #ed63e8;
    }

    #container #search img {
        text-align: center;
        margin-right: 60px;
    }

    svg {
        width: 100%;
        height: 100%;
    }

    #left-db hr {
        width: 100%;
        margin: auto;
        border-top: 1px solid #fbc8e8;
    }

    #left-db #chart {
        width: 100%;
        height: 52vh;
        border: 1px solid #B91EB3;
        color: #9b1c97;
    }

    #container #dashboard #left-db #card-holder {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 30px;
        justify-content: center;
        flex-wrap: wrap;
        border-radius: 10px;
    }

    #container #dashboard #left-db #card-holder #card {
        width: 40%;
        height: 23vh;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        align-items: center;
        background-color: #FA8BCE;
        margin-bottom: 10px;
    }

    #container #dashboard #left-db #card-holder #card #txt-card {
        width: 100%;
        height: 50%;
        background-color: #FA8BCE;
        border-radius: 10px;
        display: flex;
        align-items: end;
        justify-content: space-between;
        padding: 0 1rem 1rem 1rem;
    }

    #container #dashboard #left-db #card-holder #card #txt-card p {
        font-weight: 500;
        color: white;
        font-size: 1rem;
    }

    #container #dashboard #left-db #card-holder #card #txt-card h3 {
        font-weight: 600;
        color: white;
        font-size: 1.3rem;
        letter-spacing: 1px;
    }

    #container #dashboard #left-db #card-holder #card #img-card {
        width: 100%;
        height: 50%;
        margin: 5px 5px 0 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .year-picker-container {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .year-picker-container h4 {
        flex: 3;
    }

    .year-picker-container input {
        flex: 1;
    }

    .year-picker-container label {
        flex: 1;
        text-align: right;
        margin-right: 5px;
        font-size: 0.95rem;
    }

    #yearInput,
    #monthDropdown,
    #targetRevenue {
        width: 20%;
        font-size: 0.9rem;
        cursor: pointer;
        border: 1px solid #B91EB3;
        text-align: center;
        border-radius: 3px;
        color: #891585;
    }

    #monthDropdown {
        width: 50%;
        margin-bottom: 1vh;
    }

    #targetRevenue {
        width: 60%;
    }

    #targetRevenue::placeholder {
        color: #ed63e8;
    }

    #targetRevenue::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #yearInput::placeholder {
        color: #ed63e8;
    }

    .year-picker-popup {
        position: absolute;
        top: 4vh;
        right: 0;
        width: 20%;
        max-height: 200px;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow-y: auto;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        display: none;
        color: #B91EB3;
        z-index: 100;
    }

    .year-picker-popup.active {
        display: block;
    }

    .year-list {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .year-item {
        padding: 7px;
        font-size: 0.9rem;
        text-align: center;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.2s ease-in-out;
    }

    .year-item:hover {
        background-color: #f8dded;
    }

    #container #dashboard #left-db #revenueTable {
        width: 100%;
        border-radius: 10px;
        border: none;
        border-collapse: collapse;
        /* Ensures borders are collapsed */
        border-spacing: 0;
    }

    #container #dashboard #left-db #revenueTable th {
        background-color: #B91EB3;
        color: white;
        border: 1px solid #FA8BCE;
        padding: 10px 0;
        text-align: center;
        margin: 0;
    }

    #container #dashboard #left-db #revenueTable td {
        border: 1px solid #FA8BCE;
        text-align: center;
        padding: 7px 0;
        margin: 0;
    }

    #container #dashboard #left-db #revenueTable tr {
        border: 1px solid #FA8BCE;
        margin: 0;
    }

    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange,
    .flatpickr-day.selected.inRange,
    .flatpickr-day.startRange.inRange,
    .flatpickr-day.endRange.inRange,
    .flatpickr-day.selected:focus,
    .flatpickr-day.startRange:focus,
    .flatpickr-day.endRange:focus,
    .flatpickr-day.selected:hover,
    .flatpickr-day.startRange:hover,
    .flatpickr-day.endRange:hover,
    .flatpickr-day.selected.prevMonthDay,
    .flatpickr-day.startRange.prevMonthDay,
    .flatpickr-day.endRange.prevMonthDay,
    .flatpickr-day.selected.nextMonthDay,
    .flatpickr-day.startRange.nextMonthDay,
    .flatpickr-day.endRange.nextMonthDay {
        background-color: #FA8CBE !important;
    }

    #container #right-db {
        width: 35%;
        height: 100%;
        padding-bottom: 20px;
    }

    #container #dashboard #right-db #card-holder {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
        border-radius: 5px;
    }

    #container #dashboard #right-db #card-holder #card {
        width: 80%;
        height: 19vh;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        align-items: center;
        background-color: #f95cba;
    }

    #container #dashboard #right-db #card-holder #card #txt-card {
        width: 60%;
        height: 80%;
        background-color: #f95cba;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        align-items: start;
        justify-content: space-between;
        padding: 0.7rem 0 1.9rem 0.7rem;
    }

    #container #dashboard #right-db #card-holder #card #txt-card p {
        font-weight: 500;
        color: white;
        font-size: 0.9rem;
    }

    #container #dashboard #right-db #card-holder #card #txt-card h3 {
        font-weight: 600;
        color: white;
        font-size: 1.1rem;
        letter-spacing: 1px;
    }

    #container #dashboard #right-db #card-holder #card #img-card {
        width: 40%;
        height: 80%;
        display: flex;
        align-items: flex-start;
        justify-content: flex-end;
        background-color: #f95cba;
        border-radius: 5px;
    }

    #container #dashboard #right-db #card-holder #card #img-card img {
        margin: 0.7rem 0.7rem 0 0;
        width: 30px;
        height: 30px;
    }

    #container #dashboard #right-db #card-holder #card a {
        text-decoration: none;
        color: white;
        font-size: 0.85rem;
        width: 100%;
        height: 20%;
        text-align: center;
        background-color: #df54a8;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        padding-top: 2px;
    }

    #container #dashboard #right-db #card-holder #card a:hover {
        background-color: #cd4e9a;
    }

    .progress-container {
        width: 70%;
        height: auto;
        margin: auto;
        border: 2px solid #f95cba;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        padding-bottom: 10px;
    }

    .progress-ring {
        width: 80%;
    }

    .progress-circle {
        position: relative;
        fill: none;
        stroke: #f95cba;
        stroke-width: 10;
        margin: auto;
        transition: stroke-dashoffset 1s;
        stroke-dasharray: 440;
        stroke-dashoffset: 440;
        transform: rotate(-90deg);
        transform-origin: center;
    }

    .progress-text {
        font-size: 1.2em;
        position: absolute;
        font-weight: bold;
    }

    .revenue-info {
        text-align: center;
        margin-top: 10px;
        font-size: 1rem;
    }

    #recentActivities {
        width: 100%;
        height: auto;
        padding-bottom: 10vh;
    }

    #order-list {
        width: 100%;
        margin-top: 1vh;
        border-radius: 10px;
        border: 2px solid #f95cba;
        border-collapse: collapse;
        /* Ensures borders are collapsed */
        border-spacing: 0;
    }

    #row-heads {
        background-color: #f95cba;
        border: 1px solid #f95cba;
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
        border: none;
        font-weight: 400;
        text-align: center;
        padding: 5vh 0;
        margin: 0;
    }

    .star {
        width: 20px;
        height: 20px;
        background-color: gold;
        display: inline-block;
        clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
    }
</style>
<div id="dashboard">
    <div id="left-db">
        <div id="weekSelect">
            <h4>Daily Sales of the Week</h4>
            <input id="week-select" placeholder="Select a week">
        </div>
        <div id="chart"></div>
        <br>
        <hr>
        <div id="card-holder">
            <p style="width: 100%; font-size: 1.1rem; text-align:center; font-weight: bold;">Stock & Users</p>
            <div id="card">
                <div id="img-card">
                    <img src="../IMG/icon-stock.png" width="45" height="45" alt="Stock">
                </div>
                <div id="txt-card">
                    <p>Total Stocks</p>
                    <?php
                    // Calculate the total sum of stocks in tbl_products
                    $query = "SELECT SUM(stock_quantity) AS total_stock FROM tbl_products";
                    $result = mysqli_query($connection, $query);

                    $totalStock = 0; // Default to 0 in case the query fails
                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $totalStock = $row['total_stock'];
                    }
                    ?>
                    <h3>
                        <?php echo $totalStock; ?>
                    </h3>

                </div>
            </div>

            <div id="card">
                <div id="img-card">
                    <img src="../IMG/icon-user.png" width="45" height="45" alt="Stock">
                </div>
                <div id="txt-card">
                    <p>Total Users</p>
                    <?php
                    // Calculate the total sum of stocks in tbl_products
                    $query = "SELECT COUNT(DISTINCT tbl_user.user_id) AS user_count FROM tbl_user";
                    $result = mysqli_query($connection, $query);

                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $totalUsers = $row['user_count'];
                    }
                    ?>
                    <h3>
                        <?php echo $totalUsers; ?>
                    </h3>

                </div>
            </div>
        </div>
        <br>
        <hr>
        <div id="yearPicker" class="year-picker-container">
            <h4>Monthly Sales Performance</h4>
            <label>Year:</label>
            <input type="number" id="yearInput" placeholder="Select Year" min="2024" max="2050"
                value="${new Date().getFullYear()}" readonly>
            <div class="year-picker-popup" id="yearPickerPopup">
                <div class="year-list" id="yearList">
                    <!-- Years will be populated dynamically -->
                </div>
            </div>
        </div>
        <table id="revenueTable" border="1">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Total Revenue (₱)</th>
                    <th>Growth (%)</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table rows will be added dynamically here -->
            </tbody>
        </table>
        <div id="recent-activities"></div>
    </div>

    <div id="right-db">
        <div id="card-holder">
            <div id="card">
                <div id="txt-card">
                    <?php
                    // Count the total number of unique users who have queries
                    $query = "SELECT COUNT(DISTINCT tbl_order_items.order_item_id) AS user_count FROM tbl_order_items JOIN tbl_orders ON tbl_order_items.order_id = tbl_orders.order_id WHERE tbl_orders.status = 'Pending'";
                    $result = mysqli_query($connection, $query);

                    $userCount = 0; // Default to 0 in case the query fails
                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $userCount = $row['user_count'];
                    }
                    ?>
                    <h3>
                        <?php echo $userCount; ?>
                    </h3>
                    <p>Pending Orders</p>
                </div>
                <div id="img-card">
                    <img src="../IMG/icon-pending-white.png" alt="Pending">
                </div>
                <a href="admin-index.php?page=admin-pending">View Details</a>
            </div>
            <div id="card">
                <div id="txt-card">
                    <?php
                    // Count the total number of unique users who have queries
                    $query = "SELECT COUNT(DISTINCT tbl_order_items.order_item_id) AS user_count FROM tbl_order_items JOIN tbl_orders ON tbl_order_items.order_id = tbl_orders.order_id WHERE tbl_orders.status = 'Delivered'";
                    $result = mysqli_query($connection, $query);

                    $userCount = 0; // Default to 0 in case the query fails
                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $userCount = $row['user_count'];
                    }
                    ?>
                    <h3>
                        <?php echo $userCount; ?>
                    </h3>
                    <p>Delivered Orders</p>
                </div>
                <div id="img-card">
                    <img src="../IMG/icon-delivered-white.png" alt="Delivered">
                </div>
                <a href="admin-index.php?page=admin-delivered">View Details</a>
            </div>
            <div id="card">
                <div id="txt-card">
                    <?php
                    // Count the total number of unique users who have queries
                    $query = "SELECT COUNT(DISTINCT tbl_order_items.order_item_id) AS user_count FROM tbl_order_items JOIN tbl_orders ON tbl_order_items.order_id = tbl_orders.order_id WHERE tbl_orders.status = 'Cancelled'";
                    $result = mysqli_query($connection, $query);

                    $userCount = 0; // Default to 0 in case the query fails
                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $userCount = $row['user_count'];
                    }
                    ?>
                    <h3>
                        <?php echo $userCount; ?>
                    </h3>
                    <p>Cancelled Orders</p>
                </div>
                <div id="img-card">
                    <img src="../IMG/icon-cancel-white.png" alt="Cancelled">
                </div>
                <a href="admin-index.php?page=admin-cancelled">View Details</a>
            </div>
            <div id="card">
                <div id="txt-card">
                    <?php
                    // Count the total number of unique users who have queries
                    $query = "SELECT COUNT(DISTINCT tbl_queries.query_id) AS user_count FROM tbl_queries";
                    $result = mysqli_query($connection, $query);

                    $userCount = 0; // Default to 0 in case the query fails
                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $userCount = $row['user_count'];
                    }
                    ?>
                    <h3>
                        <?php echo $userCount; ?>
                    </h3>
                    <p>Queries</p>
                </div>
                <div id="img-card">
                    <img src="../IMG/icon-queries-white.png" alt="Queries">
                </div>
                <a href="admin-index.php?page=admin-queries">View Details</a>
            </div>
            <div id="card">
                <div id="txt-card">
                    <?php
                    // Count the total number of unique users who have queries
                    $query = "SELECT COUNT(DISTINCT tbl_reviews.review_id) AS user_count FROM tbl_reviews";
                    $result = mysqli_query($connection, $query);

                    $userCount = 0; // Default to 0 in case the query fails
                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $userCount = $row['user_count'];
                    }
                    ?>
                    <h3>
                        <?php echo $userCount; ?>
                    </h3>
                    <p>Reviews</p>
                </div>
                <div id="img-card">
                    <img src="../IMG/icon-review-white.png" alt="Reviews">
                </div>
                <a href="admin-index.php?page=admin-reviews">View Details</a>
            </div>
        </div>
        <br>
        <center>
            <label>Month:</label>
            <select id="monthDropdown" onchange="updateMonthName()"></select>
            <input type="hidden" id="monthName">
        </center>

        <div class="progress-container">
            <div class="revenue-info">
                <p>Total Revenue: <span id="totalRevenue">₱0</span></p>
                <p>Target: <span><input type="number" id="targetRevenue" min="0" max="1000000" placeholder="Enter target"></span></p>
            </div>
            <svg class="progress-ring">
                <circle class="progress-circle">
                </circle>
                <text class="progress-text" x="50%" y="50%" text-anchor="middle" dy="0.35em" fill="#B91EB3"
                    font-size="20">0%</text>
            </svg>
        </div>
    </div>
    <div id="recentActivities">
        <h4>Recent Pending Order:</h4>
        <table id="order-list">
            <?php
            $query = "SELECT 
            DATE(tbl_orders.order_date) AS order_date, 
            tbl_products.prod_name, 
            tbl_user.firstname, 
            tbl_user.lastname, 
            tbl_order_items.quantity, 
            tbl_orders.total_amount, 
            tbl_orders.status,
            tbl_orders.order_id
          FROM tbl_products 
          JOIN tbl_order_items ON tbl_products.prod_id = tbl_order_items.prod_id
          JOIN tbl_orders ON tbl_order_items.order_id = tbl_orders.order_id 
          JOIN tbl_user ON tbl_orders.user_id = tbl_user.user_id WHERE tbl_orders.status = 'Pending'
          ORDER BY tbl_orders.order_date DESC LIMIT 1";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
            ?>
                <tr id="row-heads">
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Username</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr class="row-orders" data-status="<?php echo $row['status'] ?>">
                        <td><?php echo $row['order_id'] ?></td>
                        <td><?php echo $row['prod_name'] ?></td>
                        <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
                        <td>₱<?php echo $row['total_amount'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td><?php echo $row['order_date'] ?></td>
                    </tr><?php
                        }
                    } else {
                        echo '<tr id="row-heads"><th>PENDING ORDERS</th></tr>
                              <tr class="row-orders"><td style="display:block; text-align: center;">No pending orders found.</td></tr>';
                    }
                            ?>
        </table>
        <br><br>
        <h4>Recent Delivered Order:</h4>
        <table id="order-list">
            <?php
            $query = "SELECT 
            DATE(tbl_orders.order_date) AS order_date, 
            tbl_products.prod_name, 
            tbl_user.firstname, 
            tbl_user.lastname, 
            tbl_order_items.quantity, 
            tbl_orders.total_amount, 
            tbl_orders.status,
            tbl_orders.order_id
          FROM tbl_products 
          JOIN tbl_order_items ON tbl_products.prod_id = tbl_order_items.prod_id
          JOIN tbl_orders ON tbl_order_items.order_id = tbl_orders.order_id 
          JOIN tbl_user ON tbl_orders.user_id = tbl_user.user_id WHERE tbl_orders.status = 'Delivered'
          ORDER BY tbl_orders.order_date DESC LIMIT 1";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
            ?>
                <tr id="row-heads">
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Username</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr class="row-orders" data-status="<?php echo $row['status'] ?>">
                        <td><?php echo $row['order_id'] ?></td>
                        <td><?php echo $row['prod_name'] ?></td>
                        <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
                        <td>₱<?php echo $row['total_amount'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td><?php echo $row['order_date'] ?></td>
                    </tr><?php
                        }
                    } else {
                        echo '<tr id="row-heads"><th>DELIVERED ORDERS</th></tr>
                              <tr class="row-orders"><td style="display:block; text-align: center;">No delivered orders found.</td></tr>';
                    }
                            ?>
        </table>
        <br><br>
        <h4>Recent Cancelled Order:</h4>
        <table id="order-list">
            <?php
            $query = "SELECT 
            DATE(tbl_orders.order_date) AS order_date, 
            tbl_products.prod_name, 
            tbl_user.firstname, 
            tbl_user.lastname, 
            tbl_order_items.quantity, 
            tbl_orders.total_amount, 
            tbl_orders.status,
            tbl_orders.order_id
          FROM tbl_products 
          JOIN tbl_order_items ON tbl_products.prod_id = tbl_order_items.prod_id
          JOIN tbl_orders ON tbl_order_items.order_id = tbl_orders.order_id 
          JOIN tbl_user ON tbl_orders.user_id = tbl_user.user_id WHERE tbl_orders.status = 'Cancelled'
          ORDER BY tbl_orders.order_date DESC LIMIT 1";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
            ?>
                <tr id="row-heads">
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Username</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr class="row-orders" data-status="<?php echo $row['status'] ?>">
                        <td><?php echo $row['order_id'] ?></td>
                        <td><?php echo $row['prod_name'] ?></td>
                        <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
                        <td>₱<?php echo $row['total_amount'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td><?php echo $row['order_date'] ?></td>
                    </tr><?php
                        }
                    } else {
                        echo '<tr id="row-heads"><th>CANCELLED ORDERS</th></tr>
                              <tr class="row-orders"><td style="display:block; text-align: center;">No cancelled orders found.</td></tr>';
                    }
                            ?>
        </table>
        <br><br>
        <h4>Recent Reviews:</h4>
        <table id="order-list" style="table-layout: fixed;">
            <?php
            $query = "SELECT 
        DATE(tbl_reviews.created_at) AS created_at, 
        tbl_products.prod_name, 
        tbl_user.firstname, 
        tbl_user.lastname, 
        tbl_reviews.rating, 
        tbl_reviews.review_id,
        tbl_reviews.review_text
        FROM tbl_products 
        JOIN tbl_reviews ON tbl_products.prod_id = tbl_reviews.prod_id
        JOIN tbl_user ON tbl_reviews.user_id = tbl_user.user_id ORDER BY tbl_reviews.created_at DESC LIMIT 1";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
            ?><tr id="row-heads">
                    <th>Review ID</th>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Date</th>
                </tr><?php
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <tr class="row-orders">
                        <td><?php echo $row['review_id'] ?></td>
                        <td><?php echo $row['prod_name'] ?></td>
                        <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
                        <td>
                            <?php
                            $rate = $row['rating'];
                            for ($i = 0; $i < $rate; $i++) {
                            ?><span class="star"></span><?php
                                                    }
                                                        ?>
                        </td>
                        <td style="text-align: justify;"><?php echo $row['review_text'] ?></td>
                        <td><?php echo $row['created_at'] ?></td>
                    </tr><?php
                        }
                    } else {
                        echo '<tr id="row-heads"><th>REVIEWS</th></tr>
                              <tr class="row-orders"><td style="display:block; text-align: center;">No reviews found.</td></tr>';
                    }
                            ?>
        </table>
    </div>
    <script src="../JS/revenue-stats.js"></script>
</div>