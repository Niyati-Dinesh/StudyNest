<!--
  Html page that prompts user to enter a subject 
  which will then be passed to addsubject.php page 
  that will add it to the users_subject table.
  Redirected from dashboard.php
-->

<?php
session_start();

// Check if the user is logged in, else redirect to login page
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
  <title>StudyNest | Add Subject</title>
  <link rel="icon" type="image/jpeg" href="pictures/icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="dstyle.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh; /* makes the body stretch to full viewport */
    }

    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }

    .subject {
      flex: 1;
      margin-top: 120px; /* to push content below fixed header */
      padding: 20px;
    }

    footer {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 15px;
      color: #333;
      box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
    }

    form {
      gap: 2rem;
    }

    input {
      background: rgba(255, 255, 255, 0.154);
      backdrop-filter: blur(18px);
      border: 0;
      padding: 10px 15px;
      border-radius: 10px;
      box-shadow: 2px 4px 8px rgba(255, 255, 255, 0.03);
      font-weight: bold;
      color: rgb(98, 98, 98);
      transition: background 0.6s ease-in-out;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <!-- Header with navigation -->
  <header>
    <a href="dashboard.php"><img src="pictures/icon_v2.jpeg" height="80px" width="80px" class="logo"></a>
    <h1>StudyNest🌱</h1>
    <nav class="nav2">
      <a href="#"><button class="navbar" id="s" onclick="window.location.href='showsub.php'"><img src="pictures/subjects.jpeg" alt="subject" height="30px" width="30px"> SUBJECTS</button></a>
      <a href="#"><button class="navbar" id="t" onclick="window.location.href='showtasks.php'"><img src="pictures/tasks.jpeg" alt="tasks" height="30px" width="30px"> TASKS</button></a>
      <a href="#"><button class="navbar" id="pl"><img src="pictures/planner.jpeg" alt="planner" height="30px" width="30px"> PLANNER</button></a>
      <a href="#"><button class="navbar" id="pr" onclick="window.location.href='profile.php'"><img src="pictures/pfp.jpeg" alt="Profile" height="30px" width="30px"> PROFILE</button></a>
      <a href="#"><button onclick="changeTheme()" class="navbar" id="theme" style="border-radius:16px; height:30px;"><img src="pictures/lightdark.gif" alt="theme" height="30px" width="30px"></button></a>
    </nav>
  </header>

  <br>

  <!-- Subject addition form -->
  <div class="subject">
    <h2>Add a New Subject to Your Nest 🐣</h2><br><br>
    <form method="POST" action="addsubject.php">
      <input placeholder="Enter subject name: " type="text" required id="sub" name='subject'><br><br>
      <button type="SUBMIT">ADD</button>
      <button type="button" onclick="cancel()">CANCEL</button>
    </form>
  </div>

  <!-- Footer section -->
  <footer>
    <p>Created with &lt;3 by Niyati</p>
  </footer>

  <!-- Link to external script -->
  <script src="dscript.js"></script>

</body>
</html>
