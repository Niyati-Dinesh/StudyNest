<!--Redirected from the profile button on dashboard-->

<?php
// Start the session to track the user session
session_start();

// Check if the username is not set in the session, meaning the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.html");
    exit();
}

// Retrieve the username from session to display user-specific data
$username = $_SESSION['username'];

// Database connection variables
$server = "localhost";
$suser = "root";
$spwd = "";
$sdb = "snest";

// Establish a connection to the MySQL database
$connection = mysqli_connect($server, $suser, $spwd, $sdb);

// Check if the connection was successful
if (!$connection) {
    // If connection fails, output an error message and stop further execution
    die("Failed " . mysqli_connect_error());
}

// Query to fetch the email of the logged-in user from the database
$query = "select email from users where uname='$username'";
$result = mysqli_query($connection, $query);
$email = mysqli_fetch_assoc($result)['email'];

// Query to count the number of subjects the user has added
$query1 = "select count(subject) from users_subjects where uname='$username'";
$result1 = mysqli_query($connection, $query1);
$subject = mysqli_fetch_assoc($result1)['count(subject)'];

// Query to count the number of pending tasks for the user
$query2 = "select count(tid) from users_tasks where uname='$username'";
$result2 = mysqli_query($connection, $query2);
$task = mysqli_fetch_assoc($result2)['count(tid)'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>StudyNest | Profile</title>
  <link rel="icon" type="image/jpeg" href="pictures\icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="dstyle.css" rel="stylesheet">

  <style>
    /* Profile section styles */
    #profile {
        display: flex;
        flex-direction: column;
        flex: 1;
        align-items: center;
        justify-content: center;  
    }

    /* Profile image styling */
    #pfp {
      height: 100px;
      width: 100px;
      border-radius: 50px;
    }

    /* Profile section layout */
    #profile {
      width: 500px;
    }

    /* Logout button styling */
    #logout {
      margin-top: 30px;
      background-color: rgb(143, 105, 105);
      border: none;
      padding: 10px 20px;
      border-radius: 20px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s ease-in-out;
      color: white;
    }

    /* Hover effect for logout button */
    #logout:hover {
      transform: scale(1.10);
    }
  </style>
</head>

<body>
<header>
    <!-- Logo and navigation bar -->
    <a href="dashboard.php"><img src="pictures/icon_v2.jpeg" height="80px" width="80px" class="logo"></a>
    <h1>StudyNest🌱</h1>
    <nav class="nav2">
        <!-- Navigation buttons with images -->
        <a href="#"><button class="navbar" id="s" onclick="window.location.href='showsub.php'">
            <img src="pictures/subjects.jpeg" alt="subject" height="30px" width="30px"> SUBJECTS</button></a>
        <a href="#"><button class="navbar" id="t" onclick="window.location.href='showtasks.php'">
            <img src="pictures/tasks.jpeg" alt="tasks" height="30px" width="30px"> TASKS</button></a>
        <a href="#"><button class="navbar" id="pl">
            <img src="pictures/planner.jpeg" alt="planner" height="30px" width="30px"> PLANNER</button></a>
        <a href="#"><button class="navbar" id="pr">
            <img src="pictures/pfp.jpeg" alt="Profile" height="30px" width="30px"> PROFILE</button></a>
        <a href="#"><button onclick="changeTheme()" class="navbar" id="theme" style="border-radius:16px; height:30px;">
            <img src="pictures/lightdark.gif" alt="theme" height="30px" width="30px"> </button></a>
    </nav>
</header>

<!-- Profile section content -->
<div id="profile">
  <br>
  <!-- Display profile picture and username -->
  <img src="pictures/pfp.jpeg" id="pfp"></img><?php echo "<h2>$username</h2>" ?>
  
  <!-- Display email of the user -->
  <p><b> Email: <?php echo "$email"; ?></b></p><br>

  <div style="display: flex; flex: 1; align-items: center; justify-content: center; height: 75px; flex: 1;">
    <!-- Display number of subjects added -->
    <div id="subjects" style="display: flex; flex-direction: row; align-items: center; justify-content: center; object-fit: cover; margin: 10px">
        <b><?php echo "$subject<br>"; ?>Subjects Added</b>
    </div>

    <!-- Display number of tasks pending -->
    <div id="tasks" style="display: flex; flex-direction: row; align-items: center; justify-content: center; margin: 10px">
        <b><?php echo "$task <br>"; ?>Tasks Pending</b>
    </div>
  </div>

  <!-- Logout form -->
  <form action="end_session.php">
      <button type="submit" id="logout">LOGOUT</button>
  </form>
  <br>
</div>

<!-- Footer content -->
<footer>
    <h3>Every great journey begins with a single step.</h3>
</footer>

<script src="dscript.js"></script>

</body>
</html>
