<?php
if (!isset($_SESSION['user'])) {
    header('location:login.php');
} else {
    $user_id = $_SESSION['user'];
    $query = "SELECT username, email, password
                  FROM tbl_user 
                  WHERE user_id = '$user_id'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $newPassword = "";
    $confirmPassword = "";
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

        .password,
        .newPassword,
        .confirmPassword {
            display: none;
        }

        #changePasswordButton {
            width: 100%;
            padding: 15px;
            margin-top: 10px;
            border-radius: 7px;
            background-color: #FA8BCE;
            border: 1px solid #FA8BCE;
            color: white;
            font-family: 'Open Sans';
        }

        #changePasswordButton:hover {
            background-color: #f95cba;
            border: 1px solid #f95cba;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="gradient-bg">
        <div id="title">
            <div class="img-holder"><img src="../IMG/icon-big-security.png"></div>
            <div id="text-holder">
                <p id="h1">Security</p>
                <p id="p">Security in usernames, emails, and passwords protects user data through strong identifiers and encryption.</p>
            </div>
        </div>

        <form action="change-password.php" id="myForm" method="post" onsubmit="return validatePassword()">
            <p>Change Information</p>
            <label for="id">Username</label>
            <input type="text" class="username" name="username" placeholder="Enter username" value="<?php echo $username ?>" disabled>
            <label for="age">Email</label>
            <input type="email" class="email" name="email" value="<?php echo $email ?>" placeholder="Ex: monimixdelights@gmail.com" disabled>

            <div class="buttons">
                <button type="button" id="editButton">Edit</button>
                <button type="button" id="cancelButton" style="display:none;">Cancel</button>
                <script src="../JS/edit-security.js"></script>
            </div>
            
            <p>Change Password</p>
            <label class="password">Current Password</label>
            <input type="password" class="password" name="password" placeholder="Enter Password">
            <div class="name">
                <div class="col-name">
                    <label class="newPassword">New Password</label>
                    <input type="password" class="newPassword" name="newPassword" placeholder="Enter New Password" title="Password must be at least 8 characters long, include upper/lowercase letters, a number, and a special character.">
                </div>
                <div class="col-name">
                    <label class="confirmPassword">Confirm Password</label>
                    <input type="password" class="confirmPassword" name="confirmPassword" placeholder="Confirm your Password">
                </div>
            </div>
            <div id="passwordInfo" style="display: none; font-size: 12px; color: gray;">Min. 8 characters, 1 uppercase, 1 number, 1 special char</div>
            <button type="submit" id="changePasswordButton">Change</button>
        </form>
    </div>

    <script>
        document.getElementById('changePasswordButton').addEventListener('click', function(event) {
            // Prevent form submission on the first click
            event.preventDefault();

            // Select specific input fields by their class names
            const inputs = document.querySelectorAll('.password, .newPassword, .confirmPassword');
            const passMsg = document.getElementById('passwordInfo');

            // Check if the inputs are already visible
            let allVisible = true;
            inputs.forEach(input => {
                if (input.style.display === 'none' || input.style.display === '') {
                    allVisible = false; // If any input is hidden, break the loop
                }
                if (passMsg.style.display === 'none' || passMsg.style.display === '') {
                    allVisible = false; // If any passMsg is hidden, break the loop
                }
            });

            if (!allVisible) {
                // Show the inputs
                inputs.forEach(input => {
                    input.style.display = 'block';
                    passMsg.style.display = 'block';
                });
            } else {
                // Submit the form if the inputs are already visible
                document.getElementById('myForm').submit();
            }

            // Password validation function
            function validatePassword() {
                var password = document.getElementById('newPassword').value;
                var confirmPassword = document.getElementById('confirmPassword').value;
                var message = document.getElementById('passwordInfo');
                var isValid = true;

                // Check for at least 8 characters
                if (password.length < 8) {
                    message.innerHTML = "Password must be at least 8 characters.";
                    message.style.color = "red";
                    isValid = false;
                }
                // Check for uppercase, lowercase, and numbers
                else if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/[0-9]/.test(password)) {
                    message.innerHTML = "Password must contain uppercase, lowercase, and numbers.";
                    message.style.color = "red";
                    isValid = false;
                }
                // Check for special characters
                else if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                    message.innerHTML = "Password must contain at least one special character.";
                    message.style.color = "red";
                    isValid = false;
                }
                // Check if new password matches confirm password
                else if (password !== confirmPassword) {
                    message.innerHTML = "Passwords do not match.";
                    message.style.color = "red";
                    isValid = false;
                } else {
                    message.innerHTML = "Password is valid.";
                    message.style.color = "green";
                }

                return isValid;
            }
        });
    </script>
</body>

</html>