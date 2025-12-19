<?php session_start();
include "../Database/db.php";
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['submit'])) {
		$myemail = $_POST['email'];
		$password = $_POST['password'];

		// Query to fetch user information based on email
		$query = "SELECT user_id, password FROM tbl_user WHERE email = ?";

		// Prepare and bind the query
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, "s", $myemail);
		mysqli_stmt_execute($stmt);

		// Store the result to fetch data
		mysqli_stmt_store_result($stmt);

		// Check if user exists
		if (mysqli_stmt_num_rows($stmt) > 0) {
			// Bind result variables
			mysqli_stmt_bind_result($stmt, $user_id, $hashed_password);
			mysqli_stmt_fetch($stmt);

			// Verify the password
			if (password_verify($password, $hashed_password)) {
				// Store information in session
				$_SESSION['email'] = $myemail;
				$_SESSION['user'] = $user_id;

				// Redirect to the homepage
				header('Location: index.php');
				exit();
			} else {
				$message = "Invalid Credentials. Please try again.";
			}
		} else {
			$message = "No account found with this email.";
		}

		// Close the statement
		mysqli_stmt_close($stmt);
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/userAuth.css" type="text/css">
	<link rel="stylesheet" href="../CSS/font.css" type="text/css">
	<title>Login</title>
</head>

<body id="login">
	<div class="mobile-picture">
		<div class="imgs">
			<img src="../IMG/logo-monimix.png" width="50" height="50" style="margin-top: 10px;">
			<img src="../IMG/brand-name-monimix-nobg.png" width="90" height="45" style="padding-bottom: 10px;">
		</div>
	</div>
	<div class="container" id="container">
		<div class="form-container ">

			<!-- WAG MONA GAGALAWIN TO MAGUGULO HAHAH -->
		</div>
		<div class="form-container sign-in-container">
			<form action="#" class="form-login" method="post">
				<h1 style="text-align: center;">Welcome!</h1>

				<h2>Sign In</h2>
				<center style="color: red;"><?php echo $message; ?></center>
				<label>Email</label>
				<input type="text" name="email" placeholder="Enter email" required />
				<label>Password</label>
				<input type="password" name="password" placeholder="Enter password" required />
				<button type="submit" name="submit">Login</button>
				<center>
					<p>Don't have an account? <a href="register.php" style="color: #B91EB3">Register Here</a></p>
				</center>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<!--
					<!- WAG MONA DIN GAGALAWIN TO MAGUGULO HAHAH -->
				</div>
				<div class="overlay-panel overlay-right">



				</div>
			</div>
		</div>
	</div>
</body>

</html>