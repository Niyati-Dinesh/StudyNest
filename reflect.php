<!-- Redirected from Reflect button on dashboard -->

<?php
session_start();
// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>StudyNest | Reflect</title>
  <link rel="icon" type="image/jpeg" href="pictures/icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Fonts & Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="dstyle.css" rel="stylesheet">

  <style>
    /* Body Styles */
    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(#483434,#6b4f4f,#eed6c4,#3a3d3a);
      background-repeat: no-repeat;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 2rem;
      color: white;
      text-align: center;
      overflow-x: hidden;
    }

    /* Header Styles */
    header {
      background: #483434;
      color: #fbe4d8ce;
      display: flex;
      align-items: center;
      gap: 1rem;
      width: 100%;
      padding: 20px;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    /* Footer Styles */
    footer {
      background: rgba(58, 61, 58, 0.14);
      backdrop-filter: blur(10px);
      width: 100%;
      color: #fbe4d8ce;
      text-align: center;
      padding: 15px;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Reflect Section Styles */
    #reflect {
        font-family: "Playfair Display", serif;
        font-optical-sizing: auto;
        font-weight: 400;
        font-style: normal;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: start;
        width: 90%;
        max-width: 700px;
        gap: 2rem;
        flex: 1;
        margin-top: 2rem;
    }

    /* Reflect Form Styling */
    #reflectform {
      background: rgba(255, 255, 255, 0.05);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(10px);
      width: 100%;
    }

    /* Input & Button Styling */
    #reflectform input[type="date"] {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      border-radius: 10px;
      padding: 12px 20px;
      font-size: 16px;
      color: white;
      margin-bottom: 15px;
      width: 100%;
      text-align: center;
    }

    #reflectform button[type="submit"] {
      background-color: #fbe4d8;
      color: #4c3d19;
      border: none;
      padding: 12px 24px;
      border-radius: 12px;
      cursor: pointer;
      font-size: 16px;
      transition: transform 0.3s ease, background-color 0.3s ease;
      display: inline-block;
    }

    /* Button Hover Effect */
    #reflectform button[type="submit"]:hover {
      transform: scale(1.05);
      background-color: #e4cab7;
    }

    /* Entry Styles */
    #entry {
      background: rgba(255, 255, 255, 0.07);
      backdrop-filter: blur(8px);
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
      width: 100%;
      min-height: 120px;
      white-space: pre-wrap;
      font-size: 20px;
      color: #fbe4d8;
    }

    /* Placeholder Styles */
    input::placeholder,
    textarea::placeholder,
    #dates,
    #entry {
      color: rgba(19, 19, 19, 0.46);
    }

    /* Dark Theme Styling */
    .darktheme input::placeholder,
    .darktheme textarea::placeholder,
    .darktheme #dates,
    .darktheme #entry {
      color: white;
    }
  </style>
</head>

<body>
  <!-- HEADER -->
  <header>
    <a href="dashboard.php"><img src="pictures/icon_v2.jpeg" height="80px" width="80px" class="logo"></a><h1>StudyNest🌱</h1>
    <nav class="nav2">
      <!-- Navigation Links -->
      <a href="#"><button class="navbar" id="s" onclick="window.location.href='showsub.php'"><img src="pictures/subjects.jpeg" alt="subject" height="30px" width="30px"> SUBJECTS</button></a>
      <a href="#"><button class="navbar" id="t" onclick="window.location.href='showtasks.php'"><img src="pictures/tasks.jpeg" alt="tasks" height="30px" width="30px"> TASKS</button></a>
      <a href="#"><button class="navbar" id="pl" onclick="window.location.href='reflect.php'"><img src="pictures/planner.jpeg" alt="reflect" height="30px" width="30px"> REFLECT</button></a>
      <a href="#"><button class="navbar" id="pr" onclick="window.location.href='profile.php'"><img src="pictures/pfp.jpeg" alt="Profile" height="30px" width="30px"> PROFILE</button></a>
      <a href="#"><button onclick="changeTheme()" class="navbar" id="theme" style="border-radius:16px; height:30px;"><img src="pictures/lightdark.gif" alt="theme" height="30px" width="30px"></button></a>
    </nav>
  </header>

  <!-- MAIN CONTENT -->
  <div id="reflect">
    <!-- Reflect Form for Date Input -->
    <form method="POST" onsubmit="return viewJournal(event)" id="reflectform">
      <h2>REFLECT</h2><br>
      <input type="date" name="date" id="date" required>
      <button type="submit">VIEW</button>
    </form>
    <!-- Entry Section to Display Reflection -->
    <div id="entry"></div>
  </div>

  <!-- FOOTER -->
  <footer>
    <p>Created with &lt;3 by Niyati</p>
  </footer>

  <!-- Scripts -->
  <script src="dscript.js"></script>
</body>
</html>
