<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
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
            <div id="order-list">
                <div class="product-info">
                    <div class="left-info">
                        <h3>2x High Quality Special Puto</h3>
                        <h4><i>Box of 6</i></h4>
                        <p id="edit-btn">Edit</p>
                    </div>
                    <div class="right-info">
                        <h3>&#8369;120.00</h3>
                        <button id="trash"><img src="../IMG/trashcan.png" alt="Trash" width="20"
                                height="20"></button>
                    </div>
                    <hr>
                </div>

            </div>
        </div>
        <!-- list -->

        <!-- buttons -->
        <div class="sec-btn">
            <div id="left-total">
                <h4>Subtotal:</h4>
                <h2>Total:</h2>
            </div>
            <div id="right-total">
                <h4>&#8369;240.00</h4>
                <h2>&#8369;240.00</h2>
            </div>
            <br>
            <button>Checkout</button>
        </div>
        <!-- buttons -->
    </div>

    <script>//PROGRESS BAR
         // Initialize total and current progress
            const total = 100; // Set your total value
            let currentProgress = 0; // Initial progress

            const progressBar = document.querySelector('.progress-bar');
            const progressText = document.getElementById('progress-text');

            // Function to update progress
            function updateProgress(value) {
                currentProgress += value;
                if (currentProgress > total) currentProgress = total; // Cap at total
                if (currentProgress < 0) currentProgress = 0; // Prevent negative progress

                const percentage = (currentProgress / total) * 100;
                progressBar.style.width = `${percentage}%`;
                progressText.textContent = Math.round(percentage);
            }

            // Simulate updates
            setInterval(() => {
                updateProgress(10); // Increment progress by 10
            }, 1000); // Every second
        </script>
</body>

</html>