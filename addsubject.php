<?php
// ==================== Session Initialization ====================
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

// ==================== Database Connection ====================
$server = 'localhost';
$sqluser = 'root';
$sqlpwd = '';
$sqldb = 'snest';

$connection = mysqli_connect($server, $sqluser, $sqlpwd, $sqldb);

if (!$connection) {
    die("Failed to connect: " . mysqli_connect_error());
}

// ==================== Table Creation ====================
$query = "
    CREATE TABLE IF NOT EXISTS users_subjects (
        uname VARCHAR(50),
        subject VARCHAR(25),
        PRIMARY KEY (uname, subject),
        FOREIGN KEY (uname) REFERENCES users(uname) ON DELETE CASCADE
    )
";
mysqli_query($connection, $query);

// ==================== Form Submission Handler ====================
if (isset($_POST['subject'])) {
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);

    // Check if the subject already exists for this user
    $checkquery = "SELECT * FROM users_subjects WHERE uname='$username' AND subject='$subject'";
    $result = mysqli_query($connection, $checkquery);

    if (mysqli_num_rows($result) === 0) {
        // Insert subject if it's new
        $insertQuery = "INSERT INTO users_subjects VALUES('$username', '$subject')";
        mysqli_query($connection, $insertQuery);

        // Redirect with success message
        header("Location: addsub.php?status=success");
        exit();
    } else {
        // Redirect with duplicate warning
        header("Location: addsub.php?status=exists");
        exit();
    }
} else {
    // Redirect if no subject was provided
    header("Location: addsub.php?status=empty");
    exit();
}
?>
