<?php

if (!isset($_SESSION['user'])) {
    header('location:login.php');
    exit();
}

$user_id = $_SESSION['user'];


// Fetch user balance
$query1 = "SELECT top_up_amount, wallet_id FROM tbl_top_up";

$query = "SELECT balance FROM tbl_wallet WHERE user_id = $user_id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $amount = $_POST['amount'];

        // Ensure the amount is a valid number
        if (is_numeric($amount) && $amount > 0) {
            // Sanitize the input to prevent SQL injection
            $amount = mysqli_real_escape_string($connection, $amount);
            $user_id = mysqli_real_escape_string($connection, $user_id);

            $queryaddcash = "UPDATE tbl_wallet 
                             SET balance = balance + $amount 
                             WHERE user_id = $user_id";

            if (mysqli_query($connection, $queryaddcash)) {
                $queryRecharge = "INSERT INTO tbl_top_up (user_id, top_up_amount, wallet_id, recharge_date) 
                                  VALUES ('$user_id', '$amount', (SELECT wallet_id FROM tbl_wallet WHERE user_id = '$user_id'), NOW())";
                $resultqueryrecharge = mysqli_query($connection, $queryRecharge);

                $_SESSION['success_message'] = "Cash-in successful! Your new balance is ₱" . ($row['balance'] + $amount);
                echo '<meta http-equiv="refresh" content="0;url=profile.php">';
                exit();
            }
        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
    } else {
        echo "Invalid amount.";
    }
}


mysqli_close($connection); // Close the connection
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/cashin.css" type="text/css">
    <title>Cash in</title>
    <style>

    </style>
</head>

<body>
    <div id="balance">
        <div>
            <p id="txtBalance">Total Balance:</p>
            <p id="txtWallet">₱<?php echo $row['balance']; ?></p>
        </div>
        <button id="cashInBtn" style="border-radius:50%;">
            <b>Top Up</b>
            <img id="imgCashIn" src="../IMG/icon-wallet.png" alt="" width="35" height="35">
        </button>
    </div>

    <div id="cashInForm">
        <form action="" method="POST">
            <button id="closeForm" type="button">&times;</button>
            <h2>Select or Enter Amount</h2>
            <input type="number" id="amount" name="amount" min="1" placeholder="Enter Amount" required value="0">
            <div class="btnamounts">
                <button type="button" data-value="100">₱100</button>
                <button type="button" data-value="200">₱200</button>
                <button type="button" data-value="500">₱500</button>
                <button type="button" data-value="1000">₱1000</button>
                <button type="button" data-value="2000">₱2000</button>
                <button type="button" data-value="5000">₱5000</button>
            </div>
            <button type="submit" name="submit">Confirm</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cashInBtn = document.getElementById('cashInBtn');
            const cashInForm = document.getElementById('cashInForm');
            const closeForm = document.getElementById('closeForm');
            const amountInput = document.getElementById('amount');
            const amountButtons = document.querySelectorAll('.btnamounts button');

            cashInBtn.addEventListener('click', function() {
                cashInForm.style.display = 'flex';
            });

            closeForm.addEventListener('click', function() {
                cashInForm.style.display = 'none';
                amountInput.value = 0;
            });

            amountButtons.forEach(button => {
                button.addEventListener('click', function() {
                    amountInput.value = this.getAttribute('data-value');
                });
            });

            amountInput.addEventListener('input', function() {
                this.value = this.value.replace(/^0+/, ''); // Remove leading zeros
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6); // Only allow numeric input
            });
        });
    </script>
</body>

</html>