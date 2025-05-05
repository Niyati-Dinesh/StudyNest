<?php
// Start a session to keep track of the logged-in user
session_start();

// Check if the user is logged in, if not, send a 401 Unauthorized response
if (!isset($_SESSION['username'])){
    http_response_code(401); // Unauthorized status code
    exit(); // Exit the script if not authorized
}

// Set the content type of the response to JSON for proper client-side handling
header('Content-Type: application/json');

// Retrieve the logged-in user's username from the session
$username = $_SESSION['username'];

// Database connection parameters
$server = 'localhost';
$suser = 'root';
$spwd = '';
$sdb = 'snest';

// Establish a connection to the database
$connection = mysqli_connect($server, $suser, $spwd, $sdb);

// If the connection fails, terminate with an error message
if (!$connection) {
    die("Failed: " . mysqli_connect_error()); // Connection error message
}

// Retrieve the task ID from the POST request
$tid = $_POST['tasks']; // Get the task ID from the POST request

// Prepare the SQL query to delete the task from the database
$query = "DELETE FROM users_tasks WHERE tid = '$tid'";

// Execute the query and check if it was successful
if (mysqli_query($connection, $query)) {
    // If the task is deleted, check if the user has any remaining tasks
    $query = "SELECT tid FROM users_tasks WHERE uname = '$username'";
    $result = mysqli_query($connection, $query);
    
    // If there are no tasks remaining, set 'allCleared' to true
    $allCleared = (mysqli_num_rows($result) == 0); // All tasks cleared

    // Respond with a JSON object containing the success status and the 'allCleared' flag
    echo json_encode(['success' => true, 'allCleared' => $allCleared]);
    http_response_code(200); // OK status code
} else {
    // If task deletion failed, respond with an error message and a 500 Internal Server Error code
    http_response_code(500); // Internal Server Error status code
    echo json_encode(['success' => false, 'error' => 'Failed to delete task']);
}
?>
