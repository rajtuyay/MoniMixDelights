<?php
// Start session and check if user is logged in

if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}

// Fetching data for Cash In (tbl_top_up)   
$user_id = $_SESSION['user']; // Assuming the user ID is stored in the session
$queryTopup = "SELECT recharge_date, top_up_amount
               FROM tbl_top_up 
               WHERE user_id = '$user_id' 
               ORDER BY recharge_date DESC";

$resultTopup = mysqli_query($connection, $queryTopup);

// Fetching data for Payments (tbl_payments)

$queryPayments = "SELECT 
                    tbl_payments.payment_date,
                    tbl_payments.amount,
                    tbl_products.prod_name,

                    tbl_order_items.quantity

                  FROM tbl_payments 
                  INNER JOIN tbl_products
                    ON tbl_payments.prod_id = tbl_products.prod_id /* para sa name ng products */
                  
                  INNER JOIN tbl_orders
                  ON tbl_orders.order_id = tbl_payments.order_id /* para sa user id */

                  INNER JOIN tbl_order_items
                  ON tbl_order_items.order_id = tbl_orders.order_id /* para sa quantity */

                  WHERE tbl_payments.payment_method = 'Moni-Wallet' 
                  AND tbl_orders.user_id = '$user_id'
                  AND tbl_orders.status = 'Delivered'
                  ORDER BY tbl_payments.payment_date DESC";



$resultPayments = mysqli_query($connection, $queryPayments);

// Fetch balance from tbl_wallet
$queryBalance = "SELECT balance FROM tbl_wallet WHERE user_id='$user_id'";
$resultBalance = mysqli_query($connection, $queryBalance);

// Check if balance was retrieved successfully  
if (mysqli_num_rows($resultBalance) > 0) {
    // Fetch the row containing the balance
    $rowBalance = mysqli_fetch_assoc($resultBalance);
    $balance = $rowBalance['balance'];
} else {
    // Set a default balance if no record is found
    $balance = 0.00;
}


?>
<style>

</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/wallet.css" type="text/css">
    <link rel="stylesheet" href="../CSS/font.css">

</head>

<body>
    <div class="gradient-bg">
        <div id="title">
            <div class="img-holder"><img src="../IMG/icon-moni-wallet.png"></div>
            <div id="text-holder">
                <p id="h1">Moni-Wallet</p>
                <p id="p">Moni-Wallet is a simple, secure digital wallet for easy payments and managing your money.</p>
            </div>
        </div>

        <div id="myForm">
            <?php include 'cashin.php' ?>

            <div class="tab-container">
                <div class="tab-links">
                    <button id="btn1" class="active" onclick="showTab('cashIn')" style="flex: 1;">Recharge</button>
                    <button id="btn2" onclick="showTab('payment')" style="flex: 1;">Payment</button>
                </div>

                <div id="cashIn" class="tab-content active">
                    <div class="table-container">
                        <table id="cashInTable" >
                            <tr id="th">
                                <th id="t1">Date</th>
                                <th id="t2">Time</th>
                                <th id="t3">Amount</th>
                            </tr>
                        </table>
                        <table class="c_recharge">

                            <?php
                            if (mysqli_num_rows($resultTopup) > 0) {
                                while ($row = mysqli_fetch_assoc($resultTopup)) { ?>
                                    <tr id="first">
                                        <td id="t1"><?php echo date('m/d/Y', strtotime($row['recharge_date'])); ?></td>
                                        <td id="t2"><?php echo date('g:i A', strtotime($row['recharge_date'])); ?></td><!-- H:i -->
                                        <td id="t3">₱<?php echo number_format($row['top_up_amount'], 2); ?></td>
                                    </tr>
                                <?php }
                            } else { ?>

                                <div id="nofound">
                                    No recharge Found
                                </div>
                                <style>
                                    #cashInTable {
                                        display: none;
                                    }
                                </style>
                            <?php } ?>

                        </table>
                    </div>
                </div>

                <div id="payment" class="tab-content">
                    <div class="table-container">
                        <table id="paymentTable">
                            <tr id="th">
                                <th id="h1">Date</th>
                                <th id="h2">Time</th>
                                <th id="h3">Item</th>
                                <th id="h4">Amount</th>
                            </tr>
                        </table>
                        <table class="c_payment">

                            <?php
                            if (mysqli_num_rows($resultPayments) > 0) {
                                // Display all fetched payment rows
                                while ($row = mysqli_fetch_assoc($resultPayments)) { ?>
                                    <tr id="second">
                                        <td id="h1"><?php echo date('m/d/Y', strtotime($row['payment_date'])); ?></td>
                                        <td id="h2"><?php echo date('g:i A', strtotime($row['payment_date'])); ?></td>
                                        <td id="h3"><?php echo $row['prod_name']; ?> (<?php echo $row['quantity'] ?>)</td>
                                        <td id="h4">- ₱<?php echo number_format($row['amount'], 2); ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <!-- Display a single row indicating no payments if no data exists -->

                                <div id="nofound">
                                    No Payment Found
                                </div>
                                <style>
                                    #paymentTable {
                                        display: none;
                                    }
                                </style>

                            <?php } ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
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

        const button = document.getElementById('cashInBtn');
        const img = document.getElementById('imgCashIn');

        button.addEventListener('mouseenter', () => {
            img.src = '../IMG/icon-wallet-2.png';
        });

        button.addEventListener('mouseleave', () => {
            img.src = '../IMG/icon-wallet.png';
        });
    </script>
</body>

</html>