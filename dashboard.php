
<!--Redirected from signup.html or login.html page!-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>StudyNest | Dashboard</title>
  <link rel="icon" type="image/jpeg" href="pictures\icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="dstyle.css" rel="stylesheet">

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

<?php
  session_start();

  if (!isset($_SESSION['username'])) {
      header("Location: login.html");
      exit();
  }

  $username = $_SESSION['username'];
  echo "
  <div class='welcome'>
      <h2>Hey $username &lt;3 Ready to conquer the day?</h2>
    </div>";
    echo"<script> var user='$username';</script>";
    $username = $_SESSION['username'];
    $server = 'localhost';
    $suser = 'root';
    $spwd = '';
    $sdb = 'snest';
    $connection = mysqli_connect($server, $suser, $spwd, $sdb);
    
    if (!$connection) {
        die("Failed: " . mysqli_connect_error());
    }
    $query="select count(tid) from users_tasks where uname='$username'";
    $result=mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);
    $ct=($row['count(tid)']>0)?$row['count(tid)']:0;
?>

<center>
  <img src="pictures/girlcats.gif"  height="230px" width="350px" id="girlcat"
  style="border-radius: 16px;
        object-fit: cover; 
        box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
        margin:0px;"><img>
</center>
  <div class="add">
    <h2>Let’s get started! Add a subject, task or plan your week : </h2><br>
    <nav>
      <button type='button' id="addsub" onclick="window.location.href='addsub.php'">Add Subject</button>
      <button  type='button' id="addtask" onclick="window.location.href='addtask.php'">Add Task</button>
      <button  type='button' id="planner" onclick="window.location.href='planner.php'">Weekly Planner</button>
    </nav>
  </div>

    <div class="overview">
    <div class="item" id="dates"></div>
    <div class="item">Tasks Pending: <?php echo $ct?>

    </div>
    <div class="item">Mood: Not set</div>
  </div>

  <footer>
  <p>Created with &lt;3 by Niyati</p>
  </footer>

  <script src="dscript.js"></script>
  <script>
    if (document.getElementById("dates")) {
      datetime();
    }
  </script>

  </body>
</html>

