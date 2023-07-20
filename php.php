<?php

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
  header('Location: index.php');
  exit;
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Sanitize the user input
  $username = sanitize_input($_POST['username']);
  $password = sanitize_input($_POST['password']);

  // Check if the username and password are correct
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // The user is logged in
    $_SESSION['username'] = $username;
    header('Location: index.php');
    exit;
  } else {
    // The username and password are incorrect
    echo "The username and password are incorrect.";
  }
}

// Display the login form
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<h1>Login</h1>
<form action="login.php" method="post">
<label for="username">Username:</label>
<input type="text" name="username" id="username">
<br>
<label for="password">Password:</label>
<input type="password" name="password" id="password">
<br>
<input type="submit" value="Login">
</form>
<p>Not a member? <a href="register.php">Register here</a></p>
<p>Forgot your password? <a href="forgot-password.php">Reset password</a></p>
</div>
</body>
</html>
