<!--Redirected from signup.html or login.html page!-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>StudyNest | Dashboard</title>
  <link rel="icon" type="image/jpeg" href="icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="dstyle.css" rel="stylesheet">
</head>

<body>
  <header>
    <img src="icon_v2" height="80px" width="80px" class="logo"><h1>StudyNest🌱</h1>
    <nav class="nav2">
    <a href="#"><button class="navbar" id="s"><img src="subjects.jpeg" alt="subject" height=30px" width="30px" > SUBJECTS</button></a>
    <a href="#"><button class="navbar" id="t"><img src="tasks.jpeg" alt="tasks" height="30px" width="30px"> TASKS</button></a>
    <a href="#"><button class="navbar" id="pl"><img src="planner.jpeg" alt="planner" height=30px" width="30px"> PLANNER</button></a>
    <a href="#"><button class="navbar" id="pr"><img src="profile.jpeg" alt="Profile" height="30px" width="30px"> PROFILE</button></a>
    <a href="#"><button onclick="changeTheme()" class="navbar" id="theme" style="border-radius:16px; height:30px;"><img src="lightdark.jpeg" alt="theme" height="30px" width="30px"> </button></a>
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
?>

  <div class="add">
    <h2>Let’s get started! Add your first subject, task or plan your week : </h2>
    <nav>
      <button type='button' id="addsub" onclick="window.location.href='addsub.php'">Add Subject</button>
      <button  type='button'>Add Task</button>
      <button  type='button'>Weekly Planner</button>
    </nav>
  </div>

  <div class="overview">
    <div class="item" id="dates"></div>
    <div class="item">Tasks Pending: 0</div>
    <div class="item">Mood: Not set</div>
  </div>

  <footer>
    <h3>Every great journey begins with a single step.</h3>
  </footer>

  <script src="dscript.js"></script>
  </body>
</html>
