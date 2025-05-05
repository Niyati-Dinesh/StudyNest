<!--Redirected from logout button on profile.php page-->

<?php
// Start the session to access session variables
session_start();

// Unset all session variables to clear session data
session_unset();

// Destroy the session to remove all session data completely
session_destroy();

// Redirect the user to the index page with a logout parameter in the URL
header("Location:index.html?logout=1");

// Ensure the script stops execution after the redirection
exit();
?>
