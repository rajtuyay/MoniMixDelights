<?php session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} else {
    include "../Database/db.php";
}
$user_id = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/history.css">
    <link rel="stylesheet" href="../CSS/font.css">
    <link rel="icon" type="image/png" href="../IMG/logo-monimix.png">
</head>

<body>
    <?php include "header.php" ?>
    <div id="description">
        <p id="h1">Order History</p>
        <p id="p">Your order history lets you view all your past purchases and their details, like items and status.</p>
    </div>
    <div id="container">
        <?php
        // SQL query to fetch order details



        $query = "SELECT  
                tbl_orders.order_id,
                tbl_orders.order_date,
                tbl_orders.total_amount,
                tbl_orders.status,

                tbl_order_items.order_id,
                tbl_order_items.prod_id,
                tbl_order_items.quantity,
                tbl_order_items.price,

                tbl_products.prod_id,
                tbl_products.category_id,
                tbl_products.prod_name,
                tbl_products.prod_image,

                tbl_categories.category_id,
                tbl_categories.category_name,

                tbl_user.user_id
                FROM tbl_orders 
                 INNER JOIN tbl_user ON tbl_user.user_id = tbl_orders.user_id
                 INNER JOIN tbl_order_items ON tbl_orders.order_id = tbl_order_items.order_id  
                INNER JOIN tbl_products ON tbl_order_items.prod_id = tbl_products.prod_id
                INNER JOIN tbl_categories ON tbl_products.category_id = tbl_categories.category_id
                

                WHERE tbl_orders.status = 'Delivered' AND tbl_user.user_id = '$user_id'
                ORDER BY tbl_orders.order_date DESC 
                 ";

        $result = mysqli_query($connection, $query);
        // Check if query was successful
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Generate a unique ID for each popup
                $uniqueId = uniqid('popup_');
        ?>
                <div class="card">
                    <div class="photo">
                        <div class="imgCard" data-popup-id="<?php echo $uniqueId; ?>">
                            <img src="../IMG/Products/<?php echo $row['prod_image']; ?>" alt="Product Image">
                            <div id="overlay">
                                <p>See Photo</p>
                            </div>
                        </div>
                        <div class="popup-image" id="<?php echo $uniqueId; ?>">
                            <span class="close-btn">&times;</span> <!-- Close button -->
                            <img class="proimage" src="../IMG/Products/<?php echo $row['prod_image']; ?>">
                        </div>
                    </div>
                    <div class="details">
                        <h2><?php echo $row['prod_name'] ?></h2>
                        <p>Category: <?php echo $row['category_name']; ?></p>
                        <p>QTY: <?php echo $row['quantity']; ?></p>
                    </div>
                    <div id="bottom_text">
                        <p id="subTotal">&#8369;<?php echo $row['price']; ?></p>
                        <p id="total">&#8369;<?php echo $row['total_amount']; ?></p>
                        <button id="deliveredBtn"><?php echo $row['status']; ?></button>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p style='width: 100%; text-align: center; color: #B91EB3'>No Delivered Orders.</p>";
        }

        // Free result and close connection

        mysqli_close($connection);
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imgCards = document.querySelectorAll('.imgCard');
            const popups = document.querySelectorAll('.popup-image');

            imgCards.forEach(imgCard => {
                imgCard.addEventListener('click', function() {
                    const popupId = imgCard.getAttribute('data-popup-id'); // Get the associated popup ID
                    const popup = document.getElementById(popupId); // Find the popup by ID
                    if (popup) {
                        popup.style.display = 'block';
                    }
                });
            });

            popups.forEach(popup => {
                const closeBtn = popup.querySelector('.close-btn');
                closeBtn.addEventListener('click', function() {
                    popup.style.display = 'none';
                });
            });
        });
    </script>

    <?php include "footer.php" ?>
</body>

</html>