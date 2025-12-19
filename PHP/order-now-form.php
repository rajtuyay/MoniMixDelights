<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/order-now-form.css" type="text/css">
</head>

<body>
    <!-- second -->
    <div class="second">
        <!-- static coupon -->
        <div class="static-coupon">
            <img src="../IMG/coupon.png" alt="">
            <p>Free delivery on orders over &#8369;1000.00 </p>
        </div>
        <!-- static coupon -->

        <!-- list -->
        <div class="list">
            <div class="progress-label">
                <img src="../IMG/icon-fire.png" alt="" width="18" height="18">
                <p>Spend &#8369;<span id="progress-text">0</span> more to get free delivery!</p>
            </div>
            <div class="progress-container">
                <div class="progress-bar"></div>
            </div>

            <div id="order-list"><!-- start -->

                <div class="product-info" id="productContainer"></div>

            </div><!--end -->

        </div>
        <!-- list -->

        <!-- buttons -->
        <div class="sec-btn">
            <div id="left-total">
                <h4>Subtotal:</h4>
                <h4 id="shipping-fee-tag" style="display: none;">Shipping Fee:</h4>
                <h2>Total: </h2>
            </div>
            <div id="right-total">
                <h4><span id="sub-price"></h4>
                <h4><span id="shipping-fee"></span></h4>
                <h2><span id="total-price"></span></h2>
            </div>
            <br>
            <button type="button" id="checkout">Checkout </button>
        </div>
        <!-- buttons -->

    </div>


    <!-- Overlay Form -->
    <div id="overlay" class="overlay">
        <div class="formContainer">
            <button class="exit-button" onclick="hideOverlay()">&#10006;</button> <!-- Exit Button -->
            <form action="" id="prod-form" method="post">
                <div class="on-image">
                    <img id="product-image" src="" alt="Product Image">
                </div>
                <div class="outershell">
                    <div class="on-name-desc">
                        <input type="hidden" value >
                        <h2 id="product-name">Product Name</h2>
                        <p id="product-description2">Product Description</p>
                        <h3 id="product-price">$0.00</h3>
                    </div>
                    <div class="on-price">
                        <div class="on-choose">
                            <h2>Choose</h2>
                            <button type="button" class="requir3">Required</button>
                        </div>

                        <div class="option-container">
                            <label>
                                <?php $qeury = "SELECT * FROM tbl_order_items"; ?>
                                Box of 6
                                <input type="radio" name="option" value="6" required>
                                <span class="custom-radio"></span>
                            </label>
                        </div>
                        <div class="option-container">
                            <label>
                                Box of 12
                                <input type="radio" name="option" value="12" required>
                                <span class="custom-radio"></span>
                            </label>
                        </div>

                        <div class="on-sequest">
                            <p>Any Special Request?</p>
                            <textarea name="special-request" placeholder="Add a note here..."></textarea>
                        </div>
                    </div>
            </form>
        </div>
        <div class="form-down">
            <div class="prod-quantity">
                <button type="button" id="decrease-quantity"><img src="../IMG/icon-minus.png" alt="Minus"></button>
                <div id="product-price-display">
                    <p id="quantity-display">1</p>
                </div>
                <button type="button" id="increase-quantity"><img src="../IMG/icon-add.png" alt="Add"></button>
            </div>
            <button type="submit" class="addtobasket" id="add-to-basket" onclick="addOrder()">Add to Basket <span id="basket-price"> &#8369;0.00</span></button>
        </div>
    </div>
    <script src="../JS/order-now.js"></script>
</body>

</html>