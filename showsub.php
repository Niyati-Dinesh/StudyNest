<?php
// Start the session to maintain user login state
session_start();

// Redirect to login if user is not authenticated
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Get the current logged-in user's username from the session
$username = $_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>StudyNest | Subjects</title>
  <link rel="icon" type="image/jpeg" href="pictures/icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

  <!-- External CSS -->
  <link href="dstyle.css" rel="stylesheet">

  <!-- Internal styles specific to subject cards -->
  <style>
    #subs {
      display: flex;
      flex-direction: column;
      flex: 1;
      align-items: center;
      justify-content: flex-start;
      width: 100%;
      gap: 15px;
      padding: 20px;
    }

    .subject-card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      border-radius: 30px;
      padding: 10px 20px;
      width: 80%;
      max-width: 500px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      font-size: 1.1rem;
      color: #fefefe;
      transition: all 0.3s ease-in-out;
      overflow-wrap: break-word;
      word-break: break-word;
    }

    .subject-card:hover {
      transform: scale(1.02);
      background: rgba(255, 255, 255, 0.2);
    }

    .subject-text {
      flex: 1;
      text-align: left;
      padding-right: 10px;
      font-weight: 500;
    }

    .close-btn {
      background: transparent;
      border: none;
      font-size: 1.2rem;
      color: #ff9d9d;
      font-weight: bold;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .close-btn:hover {
      color: #ff4c4c;
      transform: scale(1.3);
    }
  </style>
</head>

<body>
  <!-- Header with logo and navigation buttons -->
  <header>
    <a href="dashboard.php">
      <img src="pictures/icon_v2.jpeg" height="80px" width="80px" class="logo">
    </a>
    <h1>StudyNest🌱</h1>
    <nav class="nav2">
      <a href="#"><button class="navbar" id="s" onclick="window.location.href='showsub.php'"><img src="pictures/subjects.jpeg" alt="subject" height="30px" width="30px"> SUBJECTS</button></a>
      <a href="#"><button class="navbar" id="t" onclick="window.location.href='showtasks.php'"><img src="pictures/tasks.jpeg" alt="tasks" height="30px" width="30px"> TASKS</button></a>
      <a href="#"><button class="navbar" id="pl" onclick="window.location.href='reflect.php'"><img src="pictures/planner.jpeg" alt="reflect" height="30px" width="30px"> REFLECT</button></a>
      <a href="#"><button class="navbar" id="pr" onclick="window.location.href='profile.php'"><img src="pictures/pfp.jpeg" alt="Profile" height="30px" width="30px"> PROFILE</button></a>
      <a href="#"><button onclick="changeTheme()" class="navbar" id="theme" style="border-radius:16px; height:30px;"><img src="pictures/lightdark.gif" alt="theme" height="30px" width="30px"></button></a>
    </nav>
  </header>

  <!-- Main content area showing subjects -->
  <div id="subs">
    <?php
    // Connect to the MySQL database
    $server = "localhost";
    $suser = "root";
    $spwd = "";
    $sdb = "snest";
    $connection = mysqli_connect($server, $suser, $spwd, $sdb);

    // Show error if connection fails
    if (!$connection) {
        die("Failed".mysqli_connect_error());
    }

    // Query to fetch subjects linked to the current user
    $query = "select subject from users_subjects where uname='$username'";
    $sid = 1;
    $resultset = mysqli_query($connection, $query);

    // If subjects are found, display them
    if (mysqli_num_rows($resultset) > 0) {
        while ($sub = mysqli_fetch_assoc($resultset)) {
            $sub_value = htmlspecialchars($sub['subject']); // Encode to prevent XSS
            echo "
            <div class='subject-card' id='sub_$sid'>
                <span class='subject-text'>$sub_value</span>
                <button class='close-btn' onclick='complete_sub(this, \"$sub_value\")'>×</button>
            </div>";
            $sid++;
        }
    } else {
        // No subjects found for user
        echo "<h1>No subjects added!</h1>";
    }
    ?>
  </div>

  <!-- Footer -->
  <footer>
    <p>Created with &lt;3 by Niyati</p>
  </footer>

  <!-- External JavaScript -->
  <script src="dscript.js"></script>
</body>
</html>
