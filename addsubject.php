
<!--Adds the subject passed through POST method from addsub.php to users_subject table
users_subject table contains uname(references=users) and subject which forms a composite primary key-->


<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

$server = 'localhost';
$sqluser = 'root';
$sqlpwd = '';
$sqldb = 'snest';

$connection = mysqli_connect($server, $sqluser, $sqlpwd, $sqldb);

if (!$connection) {
    die("Failed to connect: " . mysqli_connect_error());
}

// Create table if not exists
$query = "
    CREATE TABLE IF NOT EXISTS users_subjects (
        uname VARCHAR(50),
        subject VARCHAR(25),
        PRIMARY KEY (uname, subject),
        FOREIGN KEY (uname) REFERENCES users(uname) ON DELETE CASCADE
    )";
mysqli_query($connection, $query);

// Check if form submitted
if (isset($_POST['subject'])) {
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);

    // Check for duplicates
    $checkquery = "SELECT * FROM users_subjects WHERE uname='$username' AND subject='$subject'";
    $result = mysqli_query($connection, $checkquery);

    if (mysqli_num_rows($result) === 0) {
        // Insert new subject
        $insertQuery = "INSERT INTO users_subjects VALUES('$username', '$subject')";
        mysqli_query($connection, $insertQuery);
        echo "<script>alert('Subject added!'); window.location.href = 'addsub.php'</script>";
        header("Location: addsub.php");
        exit();
    } else {
        echo "<script>alert('Subject already exists!'); window.location.href = 'addsub.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Please enter a subject!'); window.location.href = 'addsub.php';</script>";
    exit();
}
