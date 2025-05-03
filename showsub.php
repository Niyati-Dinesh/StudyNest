<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
$username = $_SESSION['username'];?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>StudyNest | Subjects</title>
  <link rel="icon" type="image/jpeg" href="pictures/icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="dstyle.css" rel="stylesheet">

  <style>

    #subs {
      display: flex;
      flex-direction: column;
      flex: 1;
      align-items: center;
      justify-content: center;
}

    .subbut{
      background: rgba(255, 255, 255, 0.154);
      backdrop-filter: blur(18px);
      border: 0;
     padding:2px;
      border-radius: 2px;
      box-shadow: 2px 4px 8px rgba(255, 255, 255, 0.03);
      font-weight: bold;
      color: rgb(98, 98, 98);
      transition: background 0.6s ease-in-out;
      cursor: pointer;
    }
    .subbut:hover {
        transform: scale(1.10);
       
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

<div id="subs">
    <?php
    $server="localhost";
    $suser="root";
    $spwd="";
    $sdb="snest";
    $connection=mysqli_connect($server,$suser,$spwd,$sdb);
    if (!$connection){
        die("Failed".mysqli_connect_error());
    }
    $query="select subject from users_subjects where uname='$username'";

    $sid=1;
    $resultset=mysqli_query($connection,$query);
    if (mysqli_num_rows($resultset) > 0) {
        while ($sub = mysqli_fetch_assoc($resultset)) {
            $sub_value=$sub['subject'];
            echo "<div id='$sid'>
            <input type='button' value='x' onclick='complete_sub(this, \"$sub_value\")' class='subbut'>  
            $sub_value
            </div><br>";


        }
       
    }
    else {
      echo "<h1>No subjects added!</h1>";
  }

    ?>
</div>

<footer>
    <p>Created with &lt;3 by Niyati</p>
  </footer>

  <script src="dscript.js"></script>
</body>
</html>
