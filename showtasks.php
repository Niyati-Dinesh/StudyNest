<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>StudyNest | Tasks</title>
  <link rel="icon" type="image/jpeg" href="pictures\icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="dstyle.css" rel="stylesheet">
  <script src="dscript.js" defer></script>
  <style>
    #tasks {
      display: flex;
      flex-direction: column;
      flex: 1;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>

<body>
<header>
    <a href="dashboard.php"><img src="pictures/icon_v2.jpeg" height="80px" width="80px" class="logo"></a><h1>StudyNest🌱</h1>
    <nav class="nav2">
    <a href="#"><button class="navbar" id="s" onclick="window.location.href='showsub.php'" ><img src="pictures/subjects.jpeg" alt="subject" height=30px" width="30px" > SUBJECTS</button></a>
    <a href="#"><button class="navbar" id="t" onclick="window.location.href='showtasks.php'"><img src="pictures/tasks.jpeg" alt="tasks" height="30px" width="30px"> TASKS</button></a>
    <a href="#"><button class="navbar" id="pl"><img src="pictures/planner.jpeg" alt="planner" height=30px" width="30px"> PLANNER</button></a>
    <a href="#"><button class="navbar" id="pr" onclick="window.location.href='profile.php'"><img src="pictures/pfp.jpeg" alt="Profile" height="30px" width="30px"> PROFILE</button></a>
    <a href="#"><button onclick="changeTheme()" class="navbar" id="theme" style="border-radius:16px; height:30px;"><img src="pictures/lightdark.gif" alt="theme" height="30px" width="30px"> </button></a>
    </nav>
  </header>

  <div id="tasks">
    <?php
    $server = 'localhost';
    $sqluser = 'root';
    $sqlpwd = '';
    $sqldb = 'snest';

    $connection = mysqli_connect($server, $sqluser, $sqlpwd, $sqldb);

    if (!$connection) {
        die("Failed to connect: " . mysqli_connect_error());
    }

    // Query to fetch tasks
    $query = "SELECT tid, task, subject, description, deadline, status FROM users_tasks WHERE uname = '$username'";
    $resultset = mysqli_query($connection, $query);

    if (mysqli_num_rows($resultset) > 0) {
        while ($task = mysqli_fetch_assoc($resultset)) {
            // Define checkbox checked status based on task completion
            $checked = ($task['status'] == 'complete') ? 'checked' : '';
            echo "<div id='{$task['tid']}'>
                    <form>
                        <input type='checkbox' name='tasks' value='{$task['tid']}' $checked onchange='complete_task({$task['tid']})'> {$task['task']} ({$task['deadline']})<br>
                        <p>SUBJECT: {$task['subject']}<br>
                        DESCRIPTION: {$task['description']}<br><br></p>
                    </form>
                  </div>";
          
        }
    } else {
        echo "<h1>All Tasks Completed! Yay!</h1>";
    }
    ?>
  </div>

  <footer>
    <p>Created with &lt;3 by Niyati</p>
  </footer>


</body>
</html>
