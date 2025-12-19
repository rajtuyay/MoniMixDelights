<?php
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Open Sans';
        }

        #cash-option, #wallet-option , #card-option{
            display: flex;
            align-items: center;
            gap: 10px;
            border: 2px solid #FA8BCE;
            border-radius: 10px;
            cursor: default;
        }

        #img-payment{
            width: 40px;
            height: 40px;
            margin-left: 10px;
        }

        #tag-payment{
            font-size: 20px;
            text-align: left;
        }

        #msg{
            color: #da9bc1;
        }
    </style>
</head>

<body>
    <div class="gradient-bg">
        <div id="title">
            <div class="img-holder"><img src="../IMG/icon-big-payment-method.png"></div>
            <div id="text-holder">
                <p id="h1">Payment Options</p>
                <p id="p">Payment options are the methods people use to pay, such as cards, e-wallets, or cash.</p>
            </div>
        </div>
        <br>
        <form id="myForm">
            <p id="tag-payment">Cash Payment</p>
            <div id="cash-option">
                <img src="../IMG/icon-cod.png" alt="COD" id="img-payment">
                <p>Cash On Delivery</p>
            </div>
            
            <p id="tag-payment">Online Payment</p>
            <div id="wallet-option">
                <img src="../IMG/icon-moni-wallet.png" alt="Moni-Wallet" id="img-payment">
                <p>Moni-Wallet</p>
            </div>

            <p id="tag-payment">Card Payment</p>
            <div id="card-option">
                <img src="../IMG/icon-card.png" alt="Card" id="img-payment">
                <p>Credit Card  <span id="msg">(Coming Soon)</span></p>
            </div>
        </form>
    </div>
</body>

</html>