<?php
// Start a session to maintain the logged-in user state
session_start();

// Check if the user is logged in, if not, send a 401 unauthorized response
if (!isset($_SESSION['username'])){
    http_response_code(401); // Unauthorized status code
    exit();
}

// Set the content type to JSON for proper parsing on the client-side
header('Content-Type: application/json'); // 🚨 Required for JSON parsing

// Retrieve the logged-in user's username
$username = $_SESSION['username'];

// Database connection parameters
$server = 'localhost';
$suser = 'root';
$spwd = '';
$sdb = 'snest';

// Establish a connection to the database
$connection = mysqli_connect($server, $suser, $spwd, $sdb);

// Check if the database connection is successful
if (!$connection) {
    http_response_code(500); // Internal Server Error status code
    echo json_encode(['success' => false, 'error' => 'Database connection failed']); // Send error message as JSON
    exit(); // Exit the script
}

// Get the subject ID from the POST request
$sid = $_POST['subs']; // Correct variable name!

// SQL query to delete the subject from the 'users_subjects' table
$query = "DELETE FROM users_subjects WHERE subject = '$sid' and uname='$username'";

// Execute the query
if (mysqli_query($connection, $query)) {
    // If successful, check if the user has any remaining subjects
    $query = "SELECT subject FROM users_subjects WHERE uname = '$username'";
    $result = mysqli_query($connection, $query);
    
    // If the user has no remaining subjects, mark it as 'allCleared'
    $allCleared = (mysqli_num_rows($result) == 0);

    // Respond with success and the 'allCleared' status
    echo json_encode(['success' => true, 'allCleared' => $allCleared]);
    http_response_code(200); // Success status code
} else {
    // If the query failed, send a 500 response with an error message
    http_response_code(500); // Internal Server Error status code
    echo json_encode(['success' => false, 'error' => 'Failed to delete subject']);
}
?>
