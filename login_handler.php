

<?php
// Start the session to enable session handling
session_start();

// Database connection variables
$sname = "localhost";
$uname = "root";
$pass = "";
$dname = "snest";

// Enable MySQLi error reporting to catch errors easily
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Establish a connection to the database
    $connection = mysqli_connect($sname, $uname, $pass, $dname);

    // Check if the connection is successful
    if (!($connection)) {
        // If connection fails, display an error message and terminate the script
        die("Failed to connect!" . mysqli_connect_error());
    }

    // Check if the login form has been submitted with the necessary fields
    if (isset($_POST['username']) && isset($_POST['pwd'])) {
        // Escape special characters in the username and password to prevent SQL injection
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['pwd']);

        // Query to find the user by username
        $query = "select * from users where uname='$username'";

        // Execute the query and get the result set
        $resultset = mysqli_query($connection, $query);

        // Check if any rows are returned (i.e., user exists in the database)
        if (mysqli_num_rows($resultset) > 0) {
            // Fetch user data from the result set
            $user = mysqli_fetch_assoc($resultset);

            // Verify if the provided password matches the stored password hash
            if (password_verify($password, $user['pwd'])) {
                // If login is successful, store the username in the session and redirect to the dashboard
                $_SESSION['username'] = $username;
                header("Location:http://localhost/studynest/dashboard.php?user=" . urlencode($username));
                exit(); // Stop further script execution after redirection
            } else {
                // If password verification fails, show an error message
                echo "
                <script>
                alert('Invalid username or password!'); window.location.href='http://localhost/studynest/login.html';
                </script>";
            }
        } else {
            // If no user is found with the given username, show an error message
            echo "
            <script>
            alert('Invalid username or password!'); window.location.href='http://localhost/studynest/login.html';
            </script>";
        }
    }
} catch (mysqli_sql_exception $e) {
    // If an error occurs (e.g., database connection or query issues), redirect to the signup page with an error message
    echo "<script>
        alert('System error. Please sign up first.');
        window.location.href='http://localhost/studynest/signup.html';
    </script>";
}

?>
