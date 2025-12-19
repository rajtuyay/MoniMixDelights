    <?php
    if (!isset($_SESSION['user'])) {
        header('location:login.php');
    } else {
    }
    $user_id = $_SESSION['user'];

    ?>
    <?php
    // SQL query to fetch order details
    $querypending = "SELECT  tbl_products.prod_image, tbl_products.prod_name, tbl_categories.category_name,
                            tbl_order_items.quantity, tbl_order_items.price, tbl_orders.total_amount,
                            tbl_orders.status, tbl_orders.order_date, tbl_orders.user_id, tbl_orders.order_id
                    FROM tbl_products
                    INNER JOIN tbl_categories ON tbl_products.category_id = tbl_categories.category_id
                    INNER JOIN tbl_order_items ON tbl_products.prod_id = tbl_order_items.prod_id
                    INNER JOIN tbl_orders ON tbl_order_items.order_id = tbl_orders.order_id
                    WHERE tbl_orders.status = 'Pending' AND tbl_orders.user_id = '$user_id'
                    ORDER BY tbl_orders.order_date DESC";

    $resultcashin = mysqli_query($connection, $querypending);

    // CANCEL
    $queryCancelled = "SELECT  tbl_products.prod_image, tbl_products.prod_name, tbl_categories.category_name,
                            tbl_order_items.quantity, tbl_order_items.price, tbl_orders.total_amount,
                            tbl_orders.status, tbl_orders.order_date, tbl_orders.user_id
                    FROM tbl_products
                    INNER JOIN tbl_categories ON tbl_products.category_id = tbl_categories.category_id
                    INNER JOIN tbl_order_items ON tbl_products.prod_id = tbl_order_items.prod_id
                    INNER JOIN tbl_orders ON tbl_order_items.order_id = tbl_orders.order_id
                    WHERE tbl_orders.status = 'Cancelled' AND tbl_orders.user_id = '$user_id'
                    ORDER BY tbl_orders.order_date DESC";

    $resultCancelled = mysqli_query($connection, $queryCancelled);

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/order.css">
        <title>My Orders</title>
    </head>

    <body>

        <div class="gradient-bg">
            <div id="title">
                <div class="img-holder"><img src="../IMG/icon-big-order.png"></div>
                <div id="text-holder">
                    <p id="h1">My Orders</p>
                    <p id="p">Your orders show the details of items currently being delivered or those that were cancelled.</p>
                </div>
            </div>
            <br>
            <div class="tab-links">
                <button id="btn1" class="active" onclick="showTab('cashIn', event)" style="flex: 1;">Pending</button>
                <button id="btn2" onclick="showTab('cancel', event)" style="flex: 1;">Cancelled</button>
            </div>

            <!-- Pending Orders Tab -->
            <div id="cashIn" class="tab-content active">
                <?php
                if ($resultcashin && mysqli_num_rows($resultcashin) > 0) {
                    while ($row = mysqli_fetch_assoc($resultcashin)) {
                ?>
                        <form class="cancelOrderForms" id="cancelOrderForm-<?php echo $row['order_id']; ?>" method="post">
                            <div class="card" id="card1">
                                <div class="photo">
                                    <img src="../IMG/Products/<?php echo $row['prod_image']; ?>" id="imgCard" alt="Product Image">
                                </div>
                                <div class="details">
                                    <h2><?php echo $row['prod_name'] ?></h2>
                                    <p>Category: <?php echo $row['category_name'] ?></p>
                                    <p>QTY: <?php echo $row['quantity'] ?></p>
                                </div>
                                <div id="bottom_text">
                                    <p id="subTotal">&#8369; <?php echo $row['price'] ?></p>
                                    <p id="total">&#8369; <?php echo $row['total_amount'] ?></p>
                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                    <button type="submit" class="addcceld" id="cancelling" name="submit" onclick="cancelOrder(event, '<?php echo $row['order_id']; ?>')">Cancel Order</button>
                                </div>
                            </div><!-- card -->
                        </form>
                <?php
                    }
                } else {
                    echo "<p style='border:1px solid #FA8BCE; margin: 0; padding: 2vh;'>No Pending Orders.</p>";
                }
                ?>
            </div><!-- cash in -->

            <!-- Cancelled Orders Tab -->
            <div id="cancel" class="tab-content">
                <!-- Example order card -->

                <?php
                // Check if query was successful
                if ($resultCancelled && mysqli_num_rows($resultCancelled) > 0) {
                    while ($row = mysqli_fetch_assoc($resultCancelled)) {
                ?>
                        <div id="myForm">
                            <div class="card">
                                <div class="photo">
                                    <img src="../IMG/Products/<?php echo $row['prod_image']; ?>" id="imgCard" alt="Product Image">
                                </div>
                                <div class="details">
                                    <h2><?php echo $row['prod_name'] ?></h2>
                                    <p>Category: <?php echo $row['category_name'] ?></p>
                                    <p>QTY: <?php echo $row['quantity'] ?></p>
                                </div>
                                <div id="bottom_text">
                                    <p id="subTotal">&#8369; <?php echo $row['price'] ?></p>
                                    <p id="total">&#8369; <?php echo $row['total_amount'] ?></p>
                                    <div id="cancelled_order" class="addcceld"> Cancelled</div>
                                </div>
                            </div><!-- card -->
                        </div>

                <?php
                    }
                } else {
                    echo "<br><hr style='border:1px solid #FA8BCE;'>";
                    echo "<p>No Cancelled Orders.</p>";
                }

                // Free result and close connection
                mysqli_close($connection);
                ?>

            </div>
        </div><!-- gradient -->
        <script>
            function cancelOrder(event, orderId) {
                event.preventDefault(); // Prevent the default form submission

                // Show confirmation dialog
                const userConfirmed = confirm("Are you sure you want to cancel your order?");

                if (!userConfirmed) {
                    return; // If the user cancels, do nothing
                }

                // Proceed with the cancellation if the user confirms
                fetch('cancel_order.php', { // Endpoint to your PHP file
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            order_id: orderId,
                            action: 'cancelOrder'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Order has been cancelled');
                            location.reload();
                            // Remove the canceled order from the DOM
                            const orderCard = document.getElementById(`cancelOrderForm-${orderId}`);
                            orderCard.parentNode.removeChild(orderCard);
                        } else {
                            alert('Error updating record: ' + data.error);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            function showTab(tabName, event) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tab-content");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].classList.remove("active");
                }

                tablinks = document.querySelectorAll(".tab-links button");
                tablinks.forEach(function(btn) {
                    btn.classList.remove("active");
                });

                document.getElementById(tabName).classList.add("active");
                event.currentTarget.classList.add("active");
            }
        </script>

    </body>

    </html>