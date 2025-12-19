<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            color: rgb(247, 48, 240);
            font-family: 'Open Sans', sans-serif;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        html {
            overflow-x: hidden;
        }

        /* Overlay Style */
        .overlay {
            background-color: rgba(0, 0, 0, 0.8);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1002;
            visibility: hidden;
            opacity: 0;
            cursor: pointer;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .formContainer {
            background-color: white;
            border-radius: 1vw;
            max-width: 40vw;
            height: 95vh;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            overflow-x: hidden;
            overflow-y: hidden;
            position: relative;
        }

        .formContainer::-webkit-scrollbar {
            display: none;
        }

        .formContainer .on-image {
            height: 45vh;
            overflow: hidden;
        }

        .formContainer img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .exit-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: white;
            border: none;
            color: rgb(247, 48, 240);
            font-size: 20px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .outershell {
            padding: 10px;
        }

        .formContainer .on-name-desc {
            padding: 3vh 1.5vh 4vh 1.5vh;
            border-bottom: 1px solid #facee9;
        }

        .formContainer .on-name-desc h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #B91EB3;
        }

        .formContainer .on-name-desc p {
            color: #d134ccef;
            font-size: 1rem;
            text-align: justify;
            margin-top: 0.5vh;
        }

        .formContainer .on-name-desc h3 {
            color: #B91EB3;
            font-weight: 500;
            font-size: 1.1rem;
            margin-top: 1.5vh;
        }

        #prod-form {
            width: 100%;
            max-height: calc(100% - 9%);
            height: calc(100% - 5%);
            overflow-y: auto;
        }

        #prod-form::-webkit-scrollbar {
            display: none;
        }

        .on-choose {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 3vh 1.5vh 2vh 1.5vh;
        }

        .on-choose h2 {
            font-size: 1.1rem;
            color: #B91EB3;
        }

        .on-choose button {
            justify-content: center;
            border-radius: 1vh;
            font-size: 0.9rem;
            padding: 5px 10px;
            color: #B91EB3;
            background-color: #facee9;
            font-weight: 500;
        }

        input[type="radio"] {
            display: none;
            /* Hide the default radio button */
        }

        .custom-radio {
            margin-right: 10px;
            display: inline-block;
            width: 5vh;
            /* Inner circle size */
            height: 5vh;
            /* Size of the custom radio button */
            border: 2px solid rgb(248, 52, 176);
            /* Border color */
            border-radius: 50%;
            /* Make it circular */
            /* Positioning for the inner circle */
            /* Space between radio and label */
            cursor: pointer;
            /* Change cursor to pointer */
            transition: background-color 0.3s;
            /* Smooth transition for background */
        }

        /* Inner circle when checked */
        input[type="radio"]:checked+.custom-radio::after {
            content: '';
            top: 50%;
            /* Center vertically */
            left: 50%;
            /* Center horizontally */
            width: 25px;
            /* Size of the inner circle */
            height: 25px;
            /* Size of the inner circle */
            background-color: rgb(248, 52, 176);
            /* Color of the inner circle */
            border-radius: 50%;
            /* Make it circular */
            transform: translate(-50%, -50%);
            /* Center the inner circle */
        }

        label {
            font-size: 16px;
            /* Font size for the label */
            cursor: pointer;
            /* Change cursor to pointer */
            display: flex;
            /* Use flexbox for alignment */
            justify-content: space-between;
            /* Space between label text and radio button */
            align-items: center;
            /* Center vertically */
        }

        .form-down {
            display: flex;
            width: calc(40vw - 5px);
            height: 10%;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            bottom: 2.6%;
            background-color: #fff;
            border-bottom-left-radius: 1vw;
            border-bottom-right-radius: 1vw;
            padding-left: 2vh;
        }

        .form-down button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            color: white;
            font-size: 1.1rem;
            padding: 1.5vh;
            cursor: pointer;
            border: 1.5px solid #B91EB3;
            transition: background-color 0.3s;
            border-radius: 25px;
            transition: 0.3s ease-in-out;
        }

        .form-down button:active{
            transform: scale(0.95);
        }

        .form-down button img {
            width: 15px;
            height: 15px;
        }

        .prod-quantity {
            display: flex;
            padding-right: 2vh;
            flex: 1;
        }

        .form-down .addtobasket {
            background-color: #facee9;
            border: none;
            color: #d134ccef;
            flex: 3;
            font-size: 0.9rem;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        #product-price-display {
            font-size: 1rem;
            font-weight: 500;
            color: #B91EB3;
            padding: 0;
            margin: 0 3vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .requir3 {
            text-decoration: none;
            border: none;
            padding: 10px 20px;
            color: rgb(195, 186, 186);
            border-radius: 20px;
            font-weight: bold;
        }

        .option-container {
            display: flex;
            justify-content: space-between;
            /* Space between label and radio button */
            align-items: center;
            /* Center vertically */
            padding: 2vh 1.5vh;
            border-bottom: 1px solid #facee9;
        }

        .option-container label {
            width: 100%;
            /* Allow label to take full width */
            display: flex;
            /* Use flexbox for alignment */
            justify-content: space-between;
            /* Space between text and radio button */
            align-items: center;
            /* Center vertically */
        }

        .option-container .custom-radio {
            margin-left: auto;
            /* Push the radio button to the right */
        }

        .on-sequest {
            padding: 1.5vh;
        }

        .on-sequest p {
            margin: 1vh 0;
            font-size: 0.9rem;
        }

        .on-sequest textarea {
            width: 100%;
            border-color: #facee9;
            text-decoration: none;
            border-radius: 1vh;
            padding: 2vh;
            resize: none;
            outline: none;
            font-size: 1rem;
        }

        .on-sequest textarea::-webkit-scrollbar {
            width: 10px;
            height: 10vh;
        }

        .on-sequest textarea::-webkit-scrollbar-thumb {
            background: #f9afdd;
            border-radius: 5px;
            border-left: 1px solid #d090b7;
            border-right: 1px solid #d090b7;
        }

        .on-sequest textarea::-webkit-scrollbar-track {
            border: 1px solid #d090b7;
            border-radius: 5px;
        }


        .on-sequest textarea::placeholder {
            color: #d134cccf;
        }
    </style>
</head>

<body>
    <!-- Overlay Form -->
    <div id="overlay" class="overlay">
        <div class="formContainer">
            <button class="exit-button" onclick="hideOverlay()">✖</button> <!-- Exit Button -->
            <form action="" id="prod-form" method="post">
                <div class="on-image">
                    <img id="product-image" src="" alt="Product Image">
                </div>
                <div class="outershell">
                    <div class="on-name-desc">
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
                                Box of 6
                                <input type="radio" name="option" value="option1" required>
                                <span class="custom-radio"></span>
                            </label>
                        </div>
                        <div class="option-container">
                            <label>
                                Box of 12
                                <input type="radio" name="option" value="option2" required>
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
                <button type="button"><img src="../IMG/icon-minus.png" alt="Minus"></button>
                <div id="product-price-display"><p>1</p></div>
                <button type="button"><img src="../IMG/icon-add.png" alt="Add"></button>
            </div>
            <button type="submit" class="addtobasket">Add to Basket ₱120.00</button>
        </div>
    </div>
    </div>

    <script>
        // JavaScript to handle overlay visibility and price updates
        const overlay = document.getElementById('overlay');

        function showOverlay() {
            overlay.classList.add('active');
        }

        function hideOverlay() {
            overlay.classList.remove('active');
        }

        // Example function to update product details
        function updateProductDetails(image, name, description, price) {
            document.getElementById('product-image').src = image;
            document.getElementById('product-name').innerText = name;
            document.getElementById('product-description2').innerText = description;
            document.getElementById('product-price').innerText = price;
            document.getElementById('product-price-display').innerText = price;
        }
    </script>
</body>

</html>