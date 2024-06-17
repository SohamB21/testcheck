<!-- <!DOCTYPE html>
<html>
<head>
    <title>Simple Form</title>
</head>
<body>

<h2>Simple HTML Form</h2>
<form action="submit.php" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html> -->


<!DOCTYPE html>
<html>
<head>
    <title>Simple Form</title>
</head>
<body>
	<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$errorMsg = "";

		// username validation
		if (!isset($_POST["username"]) || empty($_POST["username"])) {
			$errorMsg .= "<p>Please enter your name.</p>";
		}
		else if(!preg_match("/^[a-zA-Z ]*$/", $_POST["username"])){
			$errorMsg .= "<p>Name is not in correct sequence.</p>";
		}

		// email validation
		if (!isset($_POST["email"]) || empty($_POST["email"])) {
			$errorMsg .= "<p>Please enter your email.</p>";
		}
		else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$errorMsg .= "<p>Email is not in correct sequence.</p>";
		}

		// password validation
		if (!isset($_POST["password"]) && empty($_POST["password"])) {
			$errorMsg .= "<p>Please enter your password.</p>";
		}
		else if (!isset($_POST["cpassword"]) && empty($_POST["cpassword"])) {
			$errorMsg .= "<p>Please enter your confirm password.</p>";
		}
		else if ($_POST["password"] != $_POST["cpassword"]) {
			$errorMsg .= "<p>Passwords do not match.</p>";
		}
		else if(strlen($_POST["password"]) <= 4) {
			$errorMsg .= "<p>Password should have atleast 5 characters.</p>";
		}
		else if (!preg_match("/[a-z]/", $_POST["password"])) {
			$errorMsg .= "<p>Password should have 1 lowercase alphabet.</p>";
		}
		else if (!preg_match("/[A-Z]/", $_POST["password"])) {
			$errorMsg .= "<p>Password should have 1 uppercase alphabet.</p>";
		}
		else if (!preg_match("/[0-9]/", $_POST["password"])) {
			$errorMsg .= "<p>Password should have 1 numeric digit.</p>";
		}
		else if (!preg_match("/[@$!%*?&]/", $_POST["password"])) {
			$errorMsg .= "<p>Password should have 1 special character.</p>";
		}

		if(!empty($errorMsg))
			echo $errorMsg;
		else{
			$u = htmlspecialchars($_POST["username"]);
			$e = htmlspecialchars($_POST["email"]);
			$p = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT);

			include 'db_connect.php';

			$sql_edge_case = "SELECT * FROM submissions WHERE email = '$e'";
			$result = $conn->query($sql_edge_case);

			if($result->num_rows == 0){
				$sql = "INSERT INTO submissions (name, email, password) VALUES('$u', '$e', '$p')";

				if($conn->query($sql) === TRUE)
					echo "Form Is Submitted!!";
				else
					echo "Form Is Not Submitted Because: " . $conn->error;
			}
			else
				echo "User with email " . $e . " already exists!";
		}
	}
	 ?>
    <h1>Simple Form</h1>
    <form action="index.php" method="post">
        <label for="username">Enter Your Name:</label>
        <input type="text" name="username" required><br><br>
        <label for="email">Enter Your Email:</label>
        <input type="email" name="email" required><br><br>
        <label for="password">Enter Your Password:</label>
        <input type="password" name="password" required><br><br>
        <label for="cpassword">Confirm Your Password:</label>
        <input type="password" name="cpassword" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>