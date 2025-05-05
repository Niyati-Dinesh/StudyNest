<?php
session_start();

// Database connection variables
$uname = "root";
$pwd = "";
$server = "localhost";

// Establish connection to MySQL server
$connection = mysqli_connect($server, $uname, $pwd);

// If connection fails, stop execution
if (!$connection) {
    die("Failed to connect" . mysqli_connect_error());
}

// Create database 'snest' if it doesn't exist
$query = "CREATE DATABASE IF NOT EXISTS snest";
mysqli_query($connection, $query);

// Select the 'snest' database
mysqli_select_db($connection, "snest");

// Create 'users' table if it doesn't exist
$query = "CREATE TABLE IF NOT EXISTS users (
    uname VARCHAR(50) PRIMARY KEY,
    email VARCHAR(50),
    pwd VARCHAR(255)
)";
mysqli_query($connection, $query);

// Check if all required form fields are set
if (isset($_POST['username']) && isset($_POST['pwd']) && isset($_POST['email'])) {
    
    // Sanitize input values to prevent SQL injection
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $pass = mysqli_real_escape_string($connection, $_POST['pwd']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);

    // Check if the username already exists in the database
    $query = "SELECT uname FROM users WHERE uname = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // If username exists, alert the user and redirect back to signup
        echo "
        <script>
            alert('Username already exists, please try another username!');
            window.location.href='http://localhost/studynest/signup.html';
        </script>
        ";
        exit();
    }

    // If username is unique, hash the password for secure storage
    $hashed = password_hash($pass, PASSWORD_DEFAULT);

    // Insert new user into 'users' table
    $query = "INSERT INTO users (uname, email, pwd) VALUES ('$username', '$email', '$hashed')";
    mysqli_query($connection, $query);

    // Start session with the new username
    $_SESSION['username'] = $username;

    // Create 'users_subjects' table to store subjects per user
    $query = "
        CREATE TABLE IF NOT EXISTS users_subjects (
            uname VARCHAR(50),
            subject VARCHAR(25),
            PRIMARY KEY (uname, subject),
            FOREIGN KEY (uname) REFERENCES users(uname) ON DELETE CASCADE
        )";
    mysqli_query($connection, $query);

    // Create 'users_tasks' table to store tasks per user-subject
    $query = "CREATE TABLE IF NOT EXISTS users_tasks (
        tid INT AUTO_INCREMENT PRIMARY KEY,
        uname VARCHAR(50),
        task VARCHAR(50),
        subject VARCHAR(25),
        description TEXT DEFAULT NULL,
        deadline DATE DEFAULT '0000-00-00',
        status ENUM('pending','complete') DEFAULT 'pending',
        FOREIGN KEY (uname, subject) REFERENCES users_subjects(uname, subject) ON DELETE CASCADE
    ) AUTO_INCREMENT=1";
    mysqli_query($connection, $query);

    // Redirect user to dashboard after successful signup
    header("Location:http://localhost/studynest/dashboard.php?user=" . urlencode($username));
    exit();
}
?>
