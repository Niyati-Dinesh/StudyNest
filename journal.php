<!---Redirected from journal button dashboard.php------>
<?php 
  // Start the session to check if the user is logged in
  session_start();

  // If user is not logged in, redirect them to the login page
  if (!isset($_SESSION['username'])) {
    header("Location:login.html");
    exit();
  }
  // Assign the username from session to a variable
  $username = $_SESSION['username'];
?>
<!--------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Meta data for the page -->
  <meta charset="UTF-8">
  <title>StudyNest | Journal</title>
  <link rel="icon" type="image/jpeg" href="pictures/icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="dstyle.css" rel="stylesheet">

  <!-- Custom CSS Styles for the page -->
  <style>
    /* General Styles */
    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient( #483434, #6b4f4f, #eed6c4, #3a3d3a);
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

    /* Journal Container */
    #journal {
      font-family: "Playfair Display", serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 90%;
      gap: 1rem;
      flex: 1;
    }

    /* Journal Type Selection */
    #div1 {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      width:100%;
    }

    /* Journal Form Styles */
    #s1, select {
      background-color: #fbe4d8;
      color: #4c3d19;
      border: 2px solid #8a7d4c;
      padding: 10px 15px;
      border-radius: 12px;
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      outline: none;
      margin: 1rem;
      width: 20%;
    }

    /* Mood Selection Dropdown */
    #moods {
      background-color: #fbe4d8;
      color: #4c3d19;
      border: 2px solid #8a7d4c;
      padding: 10px 15px;
      border-radius: 12px;
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      outline: none;
      margin: 1rem;
      width: 80%;
    }

    /* Form Input and Textarea Styles */
    textarea, input[type="text"], input[type="url"] {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(4px);
      margin: 10px auto;
      padding: 10px;
      border-radius: 10px;
      border: none;
      width: 80%;
      color: rgba(19, 19, 19, 0.46);
      font-size: 20px;
    }

    /* Button Styles */
    button[type="submit"] {
      background-color: #fbe4d8;
      color: #4c3d19;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      cursor: pointer;
      margin: 1rem auto;
      display: block;
    }

    /* Section Styles for Normal and Leetcode Journal */
    #normal, #leetcode {
      display: flex;
      flex-direction: column;
      width: 100%;
      background: none;
      padding: 0;
      box-shadow: none;
    }

    .journal-meta {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 1rem;
      margin-top: 1rem;
      width: 80%;
    }

    .leetcode-row {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-top: 10px;
      width: 80%;
    }

    .leetcode-row select {
      width: 20%;
    }

    input::placeholder, textarea::placeholder, #dates {
      color: rgba(19, 19, 19, 0.46);
    }

    .darktheme input::placeholder, .darktheme textarea::placeholder, .darktheme #dates {
      color: white;
    }

  </style>
</head>

<!--- HEADER SECTION -->
<body>
<header>
    <!-- Logo and navigation buttons -->
    <a href="dashboard.php"><img src="pictures/icon_v2.jpeg" height="80px" width="80px" class="logo"></a><h1>StudyNest🌱</h1>
    <nav class="nav2">
        <a href="#"><button class="navbar" id="s" onclick="window.location.href='showsub.php'"><img src="pictures/subjects.jpeg" alt="subject" height=30px" width="30px"> SUBJECTS</button></a>
        <a href="#"><button class="navbar" id="t" onclick="window.location.href='showtasks.php'"><img src="pictures/tasks.jpeg" alt="tasks" height="30px" width="30px"> TASKS</button></a>
        <a href="#"><button class="navbar" id="pl" onclick="window.location.href='reflect.php'"><img src="pictures/planner.jpeg" alt="reflect" height=30px" width="30px"> REFLECT</button></a>
        <a href="#"><button class="navbar" id="pr" onclick="window.location.href='profile.php'"><img src="pictures/pfp.jpeg" alt="Profile" height="30px" width="30px"> PROFILE</button></a>
        <a href="#"><button onclick="changeTheme()" class="navbar" id="theme" style="border-radius:16px; height:30px;"><img src="pictures/lightdark.gif" alt="theme" height="30px" width="30px"> </button></a>
    </nav>
</header>

<!-- CONTENT SECTION -->
  <div id="journal">
    <!-- Journal type toggle -->
    <div id="div1">
      <h2>JOURNAL</h2>
      <select id="journaltype" onchange="toggleJournalType()">
        <option value="normal">Normal</option>
        <option value="leetcode">LeetCode</option>
      </select>
    </div>

    <!-- Normal Journal Section -->
    <div id="normal">
      <div class="journal-meta">
        <b><div class="item" id="dates"></div></b>
        <form onsubmit="return submitJournal(event, 'normal')" id="normalForm">
          <select id="moods" name="diffmood">
            <option value="happy">Happy</option>
            <option value="sad">Sad</option>
            <option value="angry">Angry</option>
            <option value="norm">Normal</option>
            <option value="stress">Stressed</option>
            <option value="ovulating">Ovulating</option>
          </select>
      </div>
      <textarea id="ndesc" name="ndesc" placeholder="New things learned, places visited, books read, movies watched..."></textarea>
      <button type="submit">LOG</button></form>
    </div>

    <!-- LeetCode Journal Section -->
    <div id="leetcode" style="display:none;">
    <form onsubmit="return submitJournal(event, 'leetcode')" id="leetcodeForm">
      <input type="text" name="title" placeholder="Problem Title:">
      <input type="url" name="url" placeholder="Paste problem url:">
      <input type="text" name="topic" placeholder="Topic:">
      <div class="leetcode-row">
        <select name="difficulty">
          <option value="easy">Easy</option>
          <option value="medium">Medium</option>
          <option value="hard">Hard</option>
        </select>
        <select name="status">
          <option value="solved">Solved</option>
          <option value="notsolved">Not Solved</option>
        </select>
      </div>
      <textarea  name="jdesc" placeholder="Struggles faced, new things learned, logic used etc..."></textarea>
      <button type="submit">LOG</button></form>
    </div>
  </div>

  <!-- FOOTER -->
  <footer>
    <p>Created with &lt;3 by Niyati</p>
  </footer>

  <!-- External JS -->
  <script src="dscript.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- DateTime function call for dynamic display -->
  <script>
    if (document.getElementById("dates")) {
      datetime(); 
    }
  </script>
</body>
</html>
