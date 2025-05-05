<?php
session_start(); // Start session to access user data
header("Content-Type: application/json"); // Set content type for JSON response

// ---------- AUTHENTICATION CHECK ---------- //
if (!isset($_SESSION['username'])) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]); // User not logged in
    exit();
}

$username = $_SESSION['username'];
$date = $_POST['dates']; // Date received from client-side (format: Y-m-d)

// ---------- DATE FORMAT VALIDATION ---------- //
// Convert date to the format stored in the journal JSON file (e.g., "Monday 6 May 2024")
$dateObj = DateTime::createFromFormat("Y-m-d", $date);
if (!$dateObj) {
    echo json_encode(["success" => false, "message" => "Invalid date format"]);
    exit();
}
$formattedDate = $dateObj->format("l j F Y");

// ---------- READ AND PARSE JOURNAL FILE ---------- //
$filecontent = json_decode(file_get_contents("journal_data.json"), true);

// Check if there are any entries for the user
if (!isset($filecontent[$username])) {
    echo json_encode(["success" => false, "message" => "No Entries Found"]);
    exit();
}

$userEntries = $filecontent[$username];
$matched = []; // Array to store matched entries

// ---------- MATCH ENTRIES BASED ON DATE ---------- //
foreach ($userEntries as $entry) {
    if (isset($entry['date']) && $entry['date'] === $formattedDate) {
        $matched[] = $entry;
    }
}

// ---------- SEND RESPONSE TO CLIENT ---------- //
if (empty($matched)) {
    echo json_encode(["success" => false, "message" => "No Entries Found"]);
} else {
    echo json_encode(["success" => true, "message" => $matched]);
}
?>
