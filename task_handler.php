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

// Handle form submission
if (isset($_POST['taskname']) && isset($_POST['subject'])) {
    $task = mysqli_real_escape_string($connection, $_POST['taskname']);
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $deadline = mysqli_real_escape_string($connection, $_POST['deadline']);

    $insertQuery = "INSERT INTO users_tasks (uname, task, subject, description, deadline) 
                    VALUES ('$username', '$task', '$subject', '$description', '$deadline')";
    
    if (mysqli_query($connection, $insertQuery)) {
        echo "<script>alert('Task added successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error adding task: " . mysqli_error($connection) . "'); window.location.href='addtask.php';</script>";
    }

} else {
    echo "<script>alert('Task name or subject missing!'); window.location.href='addtask.php';</script>";
}
?>
