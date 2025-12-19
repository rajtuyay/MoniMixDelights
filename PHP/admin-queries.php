<style>
    * {
        font-family: 'Open Sans';
        color: #B91EB3;
    }

    html {
        overflow: hidden;
    }

    #mother-div {
        width: 100%;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        padding-top: 7vh;
    }

    #customers-nav {
        width: 35%;
        max-height: 93vh;
        height: 93vh;
        overflow-y: auto;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;
        background-color: #fff6fc;
        box-shadow: 5px 0 6px rgba(0, 0, 0, 0.1);
    }

    #customers-nav::-webkit-scrollbar {
        width: 10px;
        height: 10vh;
    }

    #customers-nav::-webkit-scrollbar-thumb {
        background: #f9afdd;
        border-radius: 5px;
        border-left: 1px solid #d090b7;
        border-right: 1px solid #d090b7;
    }

    #customers-nav::-webkit-scrollbar-track {
        border: 1px solid #d090b7;
        border-radius: 5px;
    }

    #customers-nav #search-query {
        width: 100%;
        padding: 2vh;
        font-size: 1rem;
        border: none;
    }

    #customers-nav #search-query::placeholder {
        color: #da9bc1;
    }

    #customers-nav #search-query:focus {
        border: 1px solid #f95cba;
        outline: none;
    }

    #tag-queries {
        width: 100%;
        padding: 15px 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background-color: #f1c3f0;
        cursor: default;
        color: #f95cba;
        text-transform: uppercase;
        user-select: none;
    }

    .notif {
        width: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 17px;
        font-weight: 600;
        font-size: 0.8rem;
        border-radius: 15%;
        color: white;
        background-color: #B91EB3;
    }

    #customer-id {
        width: 100%;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        background-color: transparent;
        border: none;
        border-bottom: 1px solid #e333dd20;
        cursor: pointer;
        color: #B91EB3;
    }

    #customer-id:hover {
        background-color: #e333dd10;
    }

    #customer-id img {
        width: 35px;
        height: 35px;
        border: 1px solid #B91EB3;
        border-radius: 1vh;
    }

    #customer-id h3 {
        font-weight: 500;
    }

    #chat-box {
        width: 65%;
        max-height: 93vh;
        height: 93vh;
        position: relative;
        overflow-x: hidden;
        overflow-y: auto;
    }

    #content {
        width: 95%;
        height: auto;
        margin: auto;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        flex-wrap: wrap;
        flex-direction: column;
    }

    .subject {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 15px;
        border-bottom: 2px solid #e333dd3d;
    }

    .subject h2 {
        font-size: 1.2rem;
        font-weight: 400;
        color: #e333de;
    }

    .subject img {
        cursor: pointer;
    }

    .dropdown.rotated {
        transform: rotate(180deg);
    }

    .message {
        width: 100%;
        display: flex;
        justify-content: start;
        flex-direction: column;
        flex-wrap: wrap;
        align-items: start;
        padding: 8px 15px;
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
        transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }

    .message1 {
        width: 100%;
        display: flex;
        justify-content: start;
        flex-direction: column;
        flex-wrap: wrap;
        align-items: end;
        padding: 8px 15px;
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
        transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }

    .message.hidden,
    .message1.hidden {
        transform: translateY(-20%);
        opacity: 0;
        visibility: hidden;
    }

    .message h2 {
        font-size: 0.95rem;
        font-weight: 400;
        color: #b61eb1;
        padding-left: 4.5vw;
    }

    .message1 h2 {
        font-size: 0.95rem;
        font-weight: 400;
        color: #b61eb1;
        padding-right: 4.5vw;
    }

    .message .msg-content {
        width: 100%;
        display: flex;
        justify-content: start;
        align-items: start;
        gap: 10px;
        padding: 8px 0;
        transition: 0.3s ease-in-out;
    }

    .message1 .msg-content {
        width: 100%;
        display: flex;
        justify-content: end;
        align-items: start;
        gap: 10px;
        padding: 8px 0;
        transition: 0.3s ease-in-out;
    }

    .message .msg-content img,
    .message1 .msg-content img {
        width: 35px;
        height: 35px;
        border: 1px solid #B91EB3;
        border-radius: 50vw;
    }

    .message .msg-content p,
    .message1 .msg-content p {
        padding: 15px 25px;
        border-radius: 1vw;
        background-color: #e333dd20;
        text-align: justify;
        font-size: 0.9rem;
        color: #e333de;
    }

    .admin-reply {
        position: absolute;
        width: calc(100% - 20px);
        height: auto;
        bottom: 8px;
        right: 10px;
    }

    .admin-reply form {
        width: 100%;
        display: flex;
        height: auto;
    }

    .response {
        width: 100%;
        resize: none;
        border: 1px solid #f95cba;
        border-radius: 25px;
        font-size: 0.9rem;
        outline: none;
        padding: 2vh 2vh;
        box-sizing: border-box;
        overflow-y: hidden;
    }

    .response::placeholder {
        color: #da9bc1;
    }

    #reply-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background-color: transparent;
        cursor: pointer;
    }

    #reply-btn img {
        width: 25px;
        height: 25px;
    }
</style>
<div id="mother-div">
    <!-- Navigation Section -->
    <div id="customers-nav">
        <div id="tag-queries">
            <h3 style="color: #B91EB3;">Queries</h3>
            <?php
            // Count the total number of unique users who have queries
            $query = "SELECT COUNT(DISTINCT tbl_queries.query_id) AS user_count FROM tbl_user JOIN tbl_queries ON tbl_user.user_id = tbl_queries.user_id";
            $result = mysqli_query($connection, $query);

            $userCount = 0; // Default to 0 in case the query fails
            if ($result && $row = mysqli_fetch_assoc($result)) {
                $userCount = $row['user_count'];
            }
            ?>
            <p class="notif"><?php echo $userCount; ?></p>
        </div>
        <input type="text" name="search" id="search-query" placeholder="Search..." onInput="filterCategories(this.value)">
        <?php
        $query = "SELECT * FROM tbl_user JOIN tbl_queries ON tbl_user.user_id = tbl_queries.user_id ORDER BY tbl_queries.query_id DESC";
        $result = mysqli_query($connection, $query);

        // Initialize variables for default display
        $firstUserQueryId = null;
        $firstUserOutput = '';

        while ($row = mysqli_fetch_assoc($result)) {
            // Set first user data for default display
            if ($firstUserQueryId === null) {
                $firstUserQueryId = $row['query_id'];
                $firstUserOutput = '<div id="content">
                        <div class="subject">
                            <h2>' . htmlspecialchars($row['subject']) . '</h2>
                            <img src="../IMG/icon-dropdown.png" class="dropdown" alt="Dropdown" width="15" height="15">
                        </div>
                        <div class="message">
                            <h2>' . htmlspecialchars($row['firstname'] . " " . $row['lastname']) . '</h2>
                            <div class="msg-content">
                                <img src="' . "../IMG/Profile-Image/" . htmlspecialchars($row['display_photo']) . '" alt="User">
                                <p>' . htmlspecialchars($row['query_text']) . '</p>
                            </div>
                        </div>
                    </div>';
            }
        ?>
            <button id="customer-id" class="customer-id <?php echo $firstUserQueryId === $row['query_id'] ? 'active' : ''; ?>"
                data-query="<?php echo $row['query_id']; ?>"
                data-name="<?php echo strtolower($row['firstname'] . " " . $row['lastname']); ?>">
                <img src="<?php echo "../IMG/Profile-Image/" . htmlspecialchars($row['display_photo']); ?>" alt="User">
                <h3><?php echo htmlspecialchars($row['firstname'] . " " . $row['lastname']); ?></h3>
            </button>
        <?php
        }
        ?>
    </div>

    <!-- Chat Box Section -->
    <div id="chat-box">
        <?php echo $firstUserOutput; ?>
    </div>
</div>

<script>
    const dropdownIcons = document.querySelectorAll('.dropdown');

    dropdownIcons.forEach(function(dropdownIcon) {
        const messagePnl = document.querySelectorAll('.message');

        let isMessageVisible = true; // Initially visible

        // Dropdown functionality
        dropdownIcon.addEventListener('click', function() {
            if (isMessageVisible) {
                messagePnl.classList.add('hidden'); // Slide up to hide
                dropdownIcon.classList.add('rotated'); // Rotate the icon
                isMessageVisible = false;
                console.log('HUHHU');
            } else {
                messagePnl.classList.remove('hidden'); // Slide down to show
                dropdownIcon.classList.remove('rotated'); // Reset the rotation
                isMessageVisible = true;
            }
        });
    });

    // Adjust textarea height based on content
    const textareas = document.querySelectorAll('.response');

    textareas.forEach(function(textarea) {
        textarea.addEventListener('input', function() {
            console.log('HUHHU');
            this.style.height = 'auto'; // Reset height to auto to get the scrollHeight
            this.style.height = (this.scrollHeight) + 'px'; // Adjust height to scrollHeight
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".customer-id");
        const productsDisplay = document.getElementById("content");
        
        // Function to load queries based on query ID
        function loadProducts(queryId) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `fetch-queries-admin.php?query=${queryId}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    productsDisplay.innerHTML = xhr.responseText; // Populate products
                } else {
                    productsDisplay.innerHTML = "<p>Error loading queries.</p>";
                }
            };
            xhr.send();
        }

        // Default: Activate the first user and load their data
        if (buttons.length > 0) {
            buttons[0].classList.add("active");
            const firstQueryId = buttons[0].getAttribute("data-query");
            loadProducts(firstQueryId);
        }

        // Add click event to each button
        buttons.forEach((button) => {
            button.addEventListener("click", function() {
                // Remove active class from all buttons
                buttons.forEach((btn) => btn.classList.remove("active"));
                // Add active class to the clicked button
                this.classList.add("active");
                // Load data based on the clicked user
                const queryId = this.getAttribute("data-query");
                loadProducts(queryId);
            });
        });
    });

    function filterCategories(searchQuery) {
        const buttons = document.querySelectorAll(".customer-id");
        const query = searchQuery.toLowerCase().trim();

        buttons.forEach((button) => {
            // Get the user name or ID from the data attribute
            const categoryName = button.getAttribute("data-name");

            // Show/hide button based on match
            if (categoryName.includes(query)) {
                button.style.display = "flex";
            } else {
                button.style.display = "none";
            }
        });
    }
</script>