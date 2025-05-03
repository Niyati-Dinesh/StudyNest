<?php
session_start();
if (!isset($_SESSION['username'])){
    http_response_code(401);
    exit();
}

header('Content-Type: application/json'); // 🚨 Required for JSON parsing

$username = $_SESSION['username'];
$server = 'localhost';
$suser = 'root';
$spwd = '';
$sdb = 'snest';

$connection = mysqli_connect($server, $suser, $spwd, $sdb);

if (!$connection) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit();
}

$sid = $_POST['subs']; // Correct variable name!

$query = "DELETE FROM users_subjects WHERE subject = '$sid' and uname='$username'";

if (mysqli_query($connection, $query)) {
    $query = "SELECT subject FROM users_subjects WHERE uname = '$username'";
    $result = mysqli_query($connection, $query);
    $allCleared = (mysqli_num_rows($result) == 0);

    echo json_encode(['success' => true, 'allCleared' => $allCleared]);
    http_response_code(200);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Failed to delete subject']);
}
?>
