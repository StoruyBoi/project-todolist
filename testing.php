<?php
// Connect to MySQL database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if login form is submitted
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Query database for user with matching credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User found, redirect to dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        // Invalid credentials, display error message
        echo "Invalid username or password.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password">
        <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>
