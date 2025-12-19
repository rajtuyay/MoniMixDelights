<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/font.css">
    <style>
        * {
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
        }

        body {
            width: 100%;
            margin: 0;
        }

        .header {
            width: 100%;
            height: 100px;
            display: flex;
            top: 0;
            grid-template-rows: auto;
            background-color: white;
            position: sticky;
            z-index: 1000;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header .nav-left,
        .header .nav-center,
        .header .nav-right {
            display: flex;
            height: 100%;
            align-items: center;
        }

        .header .nav-left {
            width: 14%;
            justify-content: start;
        }

        .header .nav-center {
            width: 66%;
            justify-content: center;
            /* Center the content inside the center nav */
        }

        .nav1:hover .nav2 {
            color: black;
        }

        .header .nav-right {
            width: 20%;
            padding-right: 20px;
            text-align: right;
            justify-content: flex-end;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header img,
        li,
        ul,
        #orderNow,
        .nav-center ul li a {
            display: inline-block;
            vertical-align: middle;
        }

        .nav-center ul {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .header img {
            margin-left: 30px;
        }

        #searchIcon {
            width: 25px;
            height: 25px;
            background-color: transparent;
            background-image: url('../IMG/search-icon.png');
            background-size: cover;
            text-align: right;
            border: none;
            cursor: pointer;
        }

        #burgerIcon {
            width: 35px;
            height: 35px;
            display: none;
            right: 0;
            background-color: transparent;
            background-image: url('../IMG/burger-icon.png');
            background-size: cover;
            text-align: right;
            border: none;
            cursor: pointer;
        }

        #orderNow {
            font-family: 'Open Sans';
            background-color: #FA8BCE;
            color: white;
            text-decoration: none;
            letter-spacing: 1px;
            border: none;
            border-radius: 50px;
            padding: 13px 20px;
        }

        #orderNow:hover {
            background-color: #f95cba;
        }

        .header ul li a {
            color: #B91EB3;
            text-decoration: none;
            font-family: 'Apricots', sans-serif;
            display: block;
            text-transform: uppercase;
            padding: 20px 10px;
        }

        .header button {
            font-family: arial;
        }

        .submit-form {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 180px 0 0;
            pointer-events: none;
        }

        .search-input {
            display: none;
            font-family: 'Open Sans';
            font-size: 0.9rem;
            position: absolute;
            width: calc(100% - 26vw);
            padding: 15px;
            border: 1px solid #B91EB3;
            border-radius: 10px;
            outline: none;
            color: #B91EB3;
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 99;
            pointer-events: auto;
        }

        #searchInput.show {
            display: block;
            /* Make it visible */
            opacity: 1;
            /* Fully visible */
            transform: scale(1);
            /* Normal size */
        }


        /* ICON :>*/
        .search-icon,
        .burger-icon {
            position: relative;
            cursor: pointer;
            z-index: 1000;
        }

        .search-icon:active,
        #burgerIcon:active {
            transform: scale(1.1);
        }

        .search-icon:hover+.search-input {
            display: block;
        }

        #searchResults {
            position: absolute;
            padding-top: 8px;
            text-align: left;
            /* Ensure it matches the width of the input field */
            background-color: white;
            border: 1px solid #feeaf7;
            border-radius: 0 0 5px 5px;
            max-height: 200px;
            overflow-x: hidden;
            overflow-y: auto;
            z-index: 10;
            display: none;
            font-family: 'Open Sans';
            color: #B91EB3;
            pointer-events: auto;
        }

        #searchResults::-webkit-scrollbar {
            width: 10px;
        }

        #searchResults::-webkit-scrollbar-thumb {
            background: #fa8bce;
            border-left: 1px solid #d090b7;
            border-right: 1px solid #d090b7;
        }

        #searchResults::-webkit-scrollbar-track {
            background: #f0f0f0;
            border: 1px solid #d090b7;
        }

        #searchResults>* {
            width: 100%;
            display: block;
            padding: 10px;
            cursor: pointer;
            color: #B91EB3;
            text-decoration: none;
        }

        #searchResults>*:hover {
            background-color: #feeaf7;
        }

        @media (max-width: 1200px) {

            .search-input,
            #searchResults {
                width: calc(100% - 25vw);
                /* Adjust for large screens like laptops */
            }

            #burgerIcon {
                display: none;
            }
        }

        @media (max-width: 1100px) {
            .submit-form {
                padding: 0 23px 0 0;
            }

            .search-input,
            #searchResults {
                width: calc(100% - 20vh);
                padding: 10px;
                display: block;
            }

            #searchResults {
                display: none;
                padding: 8px 0 0 0;
            }

            #searchResults>* {
                font-size: 0.8rem;
            }

            #burgerIcon {
                display: block;
            }

            .nav-center ul,
            #orderNow {
                display: none;
            }

            #searchIcon {
                width: 20px;
                height: 20px;
            }

            .header {
                height: 70px;
            }

            .brand-name {
                width: 100px;
                height: 40px;
            }
        }

        @media (max-width: 796px) {
            .submit-form {
                padding: 0;
                padding-right: calc(10% - 20vh);
            }

            .search-input,
            #searchResults {
                width: calc(100% - 25vh);
                padding: 10px;
                margin-right: 35px;
                display: block;
                /* Adjust for tablets */
            }

            #searchResults {
                display: none;
                padding: 8px 0 0 0;
            }

            #searchIcon {
                width: 20px;
                height: 20px;
            }

            .header {
                height: 70px;
            }

            .brand-name {
                width: 100px;
                height: 40px;
            }
        }

        @media (max-width: 480px) {
            .header .nav-center {
                width: 56%;
            }

            .header .nav-right {
                width: 30%;
            }

            .submit-form {
                padding: 0;
                padding-right: calc(10% - 20vh);
                ;
            }

            .search-input,
            #searchResults {
                width: calc(100% - 27vh);
                margin-right: 45px;
                padding: 8px;
                display: block;
                /* Adjust for mobile screens */
            }

            #searchResults {
                display: none;
                padding: 9px 0 0 0;
            }

            .header img {
                margin-left: 20px;
            }
        }

        @media (max-width: 380px) {
            .submit-form {
                padding: 0;
                padding-right: calc(10% - 20vh);
                ;
            }

            .search-input,
            #searchResults {
                width: calc(100% - 27vh);
                /* Adjust for mobile screens */
                margin-right: 50px;
            }

            #searchResults {
                display: none;
            }
        }
    </style>

</head>

<body>
    <div class="header">
        <form id="searchForm" class="submit-form" method="GET" action="product-details.php">
            <input type="hidden" id="productIdInput" name="id" value=""> <!-- Hidden field for product ID -->
            <input type="text" id="searchInput" name="search" class="search-input" placeholder="Search..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                autocomplete="off" oninput="showSuggestions()">
            <div id="searchResults"></div>
        </form>
        <div class="nav-left">
            <a href="admin-index.php"><img src="../IMG/brand-name-monimix-nobg.png" class="brand-name" width="130px" height="60px"></a>
        </div>
        <div class="nav-center">
            <ul>
                <li><a href="index.php" id="nav0">home</a></li>
                <li><a href="products.php" id="nav1">products</a></li>
                <li><a href="history.php" id="nav2">history</a></li>
                <li><a href="about.php" id="nav3">about</a></li>
                <li><a href="profile.php" id="nav4">profile</a></li>
            </ul>
        </div>
        <script src="../JS/nav-opacity.js"></script>
        <div class="nav-right">
            <button type="button" id="searchIcon" class="search-icon"></button>
            <button type="submit" id="burgerIcon" class="burger-icon"></button>
            <a href="order-now.php" id="orderNow"> ORDER NOW </a>
        </div>
    </div>
    <script src="../JS/search-engine.js"></script>

    <script>
        // Show suggestions as the user types
        function showSuggestions() {
            const query = document.getElementById('searchInput').value;
            const resultsContainer = document.getElementById('searchResults');

            // If query is empty, hide the suggestions
            if (query === '') {
                resultsContainer.style.display = 'none';
                return;
            }

            // Make an AJAX request to get suggestions from the server
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'search-suggestions.php?query=' + encodeURIComponent(query), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const suggestions = JSON.parse(xhr.responseText);

                    // Clear previous suggestions
                    resultsContainer.innerHTML = '';

                    if (suggestions.length > 0) {
                        // Populate the results container with suggestions
                        suggestions.forEach(function(suggestion) {
                            const suggestionItem = document.createElement('a');
                            suggestionItem.textContent = suggestion.name;
                            suggestionItem.href = "#"; // Prevent default link behavior
                            suggestionItem.onclick = function() {
                                document.getElementById('searchInput').value = suggestion.name;
                                document.getElementById('productIdInput').value = suggestion.id;
                                document.getElementById('searchForm').submit(); // Submit the form
                                resultsContainer.style.display = 'none';
                                return false; // Prevent default link behavior
                            };
                            resultsContainer.appendChild(suggestionItem);
                        });
                        resultsContainer.style.display = 'block';
                    } else {
                        resultsContainer.style.display = 'none';
                    }
                }
            };
            xhr.send();
        }
    </script>
</body>

</html>
</body>

</html>