<?php
session_start();
if (!isset($_SESSION['username'])){
    http_response_code(401);
    exit();
}

header('Content-Type: application/json');

$username = $_SESSION['username'];
$server = 'localhost';
$suser = 'root';
$spwd = '';
$sdb = 'snest';
$connection = mysqli_connect($server, $suser, $spwd, $sdb);

if (!$connection) {
    die("Failed: " . mysqli_connect_error());
}

$tid = $_POST['tasks']; // Get the task ID from the POST request

// Prepare the query to delete the task
$query = "DELETE FROM users_tasks WHERE tid = '$tid'";

// Check if the query was successful
if (mysqli_query($connection, $query)) {
    // Check if any tasks are remaining for this user
    
    $query = "SELECT tid FROM users_tasks WHERE uname = '$username'";
    $result = mysqli_query($connection, $query);
    $allCleared = (mysqli_num_rows($result) == 0); // All tasks cleared

    // Return success response with allCleared flag
    echo json_encode(['success' => true, 'allCleared' => $allCleared]);
    http_response_code(200);
} else {
    http_response_code(500); // Error in deletion
    echo json_encode(['success' => false, 'error' => 'Failed to delete task']);
}
?>
