<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	<title>Login</title>
</head>
<body>
	<?php
	// Connect to database
	$con = mysqli_connect("localhost", "root", "", "loginWebsite");
	
	// Check if connection has failed
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected to database OK<br>";
	
	// Check for form submit
	if (isset($_POST["form_submit"])){
		echo "Button was pressed";
		// Assign POST data to variables
		$username = $_POST["username_input"];
		$password = $_POST["password_input"];
		
		// Hash password
		//$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		// Create query
		$query = "SELECT password FROM users WHERE username = '" . $username . "'";
		$result = mysqli_query($con, $query);
		$dbHash = mysqli_fetch_assoc($result)["password"];
		if (password_verify($password, $dbHash)){
			echo "<br>Login successful";
		} else {
			echo "<br>Password invalid";
		}
	}
	?>
	<div>
		<div>
			<h1>Login</h1>
			<form action="index.php" method="post" id="login_form">
				<label for="username_input">Username</label>
				<input type="text" class="login_input" name="username_input" id="username_input" placeholder="johnsmith123" required>
				<label for="password_input">Password</label>
				<input type="password" class="login_input" name="password_input" id="password_input" required>
				<button type="submit" name="form_submit" id="form_submit">Login</button>
			</form>
		</div>
	</div>
</body>
</html>