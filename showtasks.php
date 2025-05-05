<?php
// Start a new session or resume the existing one
session_start();

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Store the username from the session for later use
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic Page Setup -->
  <meta charset="UTF-8">
  <title>StudyNest | Tasks</title>
  <link rel="icon" type="image/jpeg" href="pictures/icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Fonts and Stylesheets -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="dstyle.css" rel="stylesheet">
  <script src="dscript.js" defer></script>

  <style>
    /* Task container styles */
    #tasks {
      padding: 40px 20px;
      display: flex;
      flex: 1;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }

    /* Individual task card */
    .task-card {
      background-color: rgba(255, 255, 255, 0.16);
      border-radius: 16px;
      padding: 20px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.2s, box-shadow 0.3s;
    }

    /* Task card hover effect */
    .task-card:hover {
      transform: scale(1.01);
      box-shadow: 0px 6px 16px rgba(0,0,0,0.15);
    }

    /* Form layout inside each task */
    .task-card form {
      display: flex;
      flex-direction: column;
    }

    /* Label styling */
    .task-card label {
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 10px;
      color: #3A345B;
    }

    /* Paragraph styles inside the card */
    .task-card p {
      margin: 4px 0;
      font-size: 14px;
      color: #495057;
    }

    /* Checkbox appearance */
    input[type="checkbox"] {
      transform: scale(1.2);
      margin-right: 10px;
      accent-color: #3A345B;
    }

    /* Style for completed tasks */
    .complete {
      text-decoration: line-through;
      color: #aaa;
    }
  </style>
</head>

<body>
  <!-- Header section with logo and navbar -->
  <header>
    <a href="dashboard.php"><img src="pictures/icon_v2.jpeg" height="80px" width="80px" class="logo"></a>
    <h1>StudyNest🌱</h1>
    <nav class="nav2">
      <a href="#"><button class="navbar" id="s" onclick="window.location.href='showsub.php'">
        <img src="pictures/subjects.jpeg" alt="subject" height="30px" width="30px"> SUBJECTS
      </button></a>
      <a href="#"><button class="navbar" id="t" onclick="window.location.href='showtasks.php'">
        <img src="pictures/tasks.jpeg" alt="tasks" height="30px" width="30px"> TASKS
      </button></a>
      <a href="#"><button class="navbar" id="pl" onclick="window.location.href='reflect.php'">
        <img src="pictures/planner.jpeg" alt="reflect" height="30px" width="30px"> REFLECT
      </button></a>
      <a href="#"><button class="navbar" id="pr" onclick="window.location.href='profile.php'">
        <img src="pictures/pfp.jpeg" alt="Profile" height="30px" width="30px"> PROFILE
      </button></a>
      <a href="#"><button onclick="changeTheme()" class="navbar" id="theme" style="border-radius:16px; height:30px;">
        <img src="pictures/lightdark.gif" alt="theme" height="30px" width="30px">
      </button></a>
    </nav>
  </header>

  <!-- Task Display Section -->
  <div id="tasks">
    <?php
    // MySQL connection setup
    $server = 'localhost';
    $sqluser = 'root';
    $sqlpwd = '';
    $sqldb = 'snest';

    $connection = mysqli_connect($server, $sqluser, $sqlpwd, $sqldb);

    // Error handling for DB connection
    if (!$connection) {
        die("Failed to connect: " . mysqli_connect_error());
    }

    // Fetch tasks for the current user
    $query = "SELECT tid, task, subject, description, deadline, status FROM users_tasks WHERE uname = '$username'";
    $resultset = mysqli_query($connection, $query);

    // Display each task card
    if (mysqli_num_rows($resultset) > 0) {
        while ($task = mysqli_fetch_assoc($resultset)) {
            $checked = ($task['status'] == 'complete') ? 'checked' : '';
            $class = ($task['status'] == 'complete') ? 'complete' : '';
            echo "<div class='task-card' id='{$task['tid']}'>
                    <form>
                      <label>
                        <input type='checkbox' name='tasks' value='{$task['tid']}' $checked onchange='complete_task({$task['tid']})'>
                        <span class='$class'>{$task['task']} — due {$task['deadline']}</span>
                      </label>
                      <p><strong>Subject:</strong> {$task['subject']}</p>
                      <p><strong>Description:</strong> {$task['description']}</p>
                    </form>
                  </div>";
        }
    } else {
        // If no tasks are found
        echo "<h1>🎉 All Tasks Completed! You're killing it!</h1>";
    }
    ?>
  </div>

  <!-- Footer -->
  <footer>
    <p>Created with &lt;3 by Niyati</p>
  </footer>
</body>
</html>
