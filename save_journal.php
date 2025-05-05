<?php
// Start the session to track the logged-in user
session_start();

// Check if the user is logged in, if not send a 401 Unauthorized response
if (!isset($_SESSION['username'])) {
    // Respond with a JSON indicating the failure reason and redirect to the login page
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    header("Location:login.html"); // Redirect to the login page
    exit(); // Exit the script to prevent further execution
}

// Retrieve the logged-in user's username from the session
$username = $_SESSION['username'];

// Decode the incoming JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Perform a basic safety check to ensure valid data format
if (!$data || !is_array($data)) {
    // If the data is invalid, respond with an error message
    echo json_encode(["success" => false, "message" => "Invalid data"]);
    exit(); // Exit the script to prevent further execution
}

// Define the path to the journal data file
$file = 'journal_data.json';

// Check if the journal data file exists, if not create it with an empty array
if (!file_exists($file)) {
    file_put_contents($file, json_encode([], JSON_PRETTY_PRINT));
}

// Load the current journal data from the file
$current = json_decode(file_get_contents($file), true);

// If the user has no journal entries yet, initialize an empty array for them
if (!isset($current[$username])) {
    $current[$username] = [];
}

// Add the new journal entry to the user's data
$current[$username][] = $data;

// Save the updated data back to the journal file
file_put_contents($file, json_encode($current, JSON_PRETTY_PRINT));

// Respond with a success message indicating the entry was saved
echo json_encode(["success" => true, "message" => "Entry saved for $username"]);
?>
