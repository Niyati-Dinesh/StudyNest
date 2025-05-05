<?php
session_start(); // Start the session to access user session variables

// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username']; // Fetch the logged-in username

// ---------- DATABASE CONNECTION SETUP ---------- //
$server = 'localhost';
$sqluser = 'root';
$sqlpwd = '';
$sqldb = 'snest';

// Establish MySQL database connection
$connection = mysqli_connect($server, $sqluser, $sqlpwd, $sqldb);

// Handle failed connection
if (!$connection) {
    die("Failed to connect: " . mysqli_connect_error());
}

// ---------- CREATE TASK TABLE IF NOT EXISTS ---------- //
// This table stores tasks for each user under their respective subjects
$query = "CREATE TABLE IF NOT EXISTS users_tasks (
    tid INT AUTO_INCREMENT PRIMARY KEY,                          -- Task ID (unique)
    uname VARCHAR(50),                                           -- Username
    task VARCHAR(50),                                            -- Task title
    subject VARCHAR(25),                                         -- Subject name
    description TEXT DEFAULT NULL,                               -- Optional task description
    deadline DATE DEFAULT '0000-00-00',                          -- Deadline (optional)
    status ENUM('pending', 'complete') DEFAULT 'pending',       -- Task status
    FOREIGN KEY (uname, subject) REFERENCES users_subjects(uname, subject) ON DELETE CASCADE
    -- Cascade delete if the subject is removed for that user
) AUTO_INCREMENT=1";

// Execute table creation query
mysqli_query($connection, $query);

// ---------- HANDLE TASK SUBMISSION FROM FORM ---------- //
if (isset($_POST['taskname']) && isset($_POST['subject'])) {
    // Escape form input to prevent SQL injection
    $task = mysqli_real_escape_string($connection, $_POST['taskname']);
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $deadline = mysqli_real_escape_string($connection, $_POST['deadline']);

    // Insert the new task into the database
    $insertQuery = "INSERT INTO users_tasks (uname, task, subject, description, deadline) 
                    VALUES ('$username', '$task', '$subject', '$description', '$deadline')";
    
    // Redirect or alert based on success or error
    if (mysqli_query($connection, $insertQuery)) {
        echo "<script> window.location.href='addtask.php';</script>";
    } else {
        echo "<script>alert('Error adding task: " . mysqli_error($connection) . "'); window.location.href='addtask.php';</script>";
    }

} else {
    // If task name or subject is missing in POST data
    echo "<script>alert('Task name or subject missing!'); window.location.href='addtask.php';</script>";
}
?>
