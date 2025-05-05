<!-- Redirected from signup.html or login.html page! -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>StudyNest | Dashboard</title>
  <!-- Favicon for the website -->
  <link rel="icon" type="image/jpeg" href="pictures\icon_v2.jpeg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Google font for styling -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <!-- Custom CSS for page styling -->
  <link href="dstyle.css" rel="stylesheet">
  <style>
    /* Navigation bar style */
    nav {
      display: flex;
      flex-direction: row;
      gap: 2rem;
      align-items: center;
      flex-wrap: wrap;
      justify-content: center;
      animation: fadeInSide 1.5s ease-in;
    }

    /* Animation for fading in nav bar */
    @keyframes fadeInSide {
        from {
            transform: translateX(30px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Overview section style */
    .overview {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      align-items: center;
      padding: 10px;
      animation: fadeInUp 1.5s ease-in;
    }

    /* Animation for fading in the overview section */
    @keyframes fadeInUp {
        from {
          transform: translateY(30px);
          opacity: 0;
        }
        to {
          transform: translateY(0);
          opacity: 1;
        }
    }
      
    /* Welcome section style with animation */
    .welcome {
      display: flex;
      justify-content: center;
      height: 80px;
      padding: 10px;
      width: auto;
    }

    /* Typing animation for the welcome text */
    .welcome h2 {
      animation: typing 3s steps(var(--steps)) forwards, blink 0.6s step-end infinite;
      font-size: 32px;
      width: 0;
      white-space: nowrap;
      border-right: 2px solid white;
      overflow: hidden;
    }

    /* Keyframes for typing effect */
    @keyframes typing {
      from { width: 0 }
      to { width: var(--width); overflow: hidden; }
    }

    /* Keyframes for blinking cursor effect */
    @keyframes blink {
      50% { border-color: transparent }
    }
  </style>
</head>

<body>
  <!-- Header with site logo and navigation -->
  <header>
    <a href="dashboard.php"><img src="pictures/icon_v2.jpeg" height="80px" width="80px" class="logo"></a><h1>StudyNest🌱</h1>
    <nav class="nav2">
      <!-- Navigation buttons to different pages of the dashboard -->
      <a href="#"><button class="navbar" id="s" onclick="window.location.href='showsub.php'"><img src="pictures/subjects.jpeg" alt="subject" height="30px" width="30px" > SUBJECTS</button></a>
      <a href="#"><button class="navbar" id="t" onclick="window.location.href='showtasks.php'"><img src="pictures/tasks.jpeg" alt="tasks" height="30px" width="30px"> TASKS</button></a>
      <a href="#"><button class="navbar" id="pl" onclick="window.location.href='reflect.php'"><img src="pictures/planner.jpeg" alt="reflect" height="30px" width="30px"> REFLECT</button></a>
      <a href="#"><button class="navbar" id="pr" onclick="window.location.href='profile.php'"><img src="pictures/pfp.jpeg" alt="Profile" height="30px" width="30px"> PROFILE</button></a>
      <a href="#"><button onclick="changeTheme()" class="navbar" id="theme" style="border-radius:16px; height:30px;"><img src="pictures/lightdark.gif" alt="theme" height="30px" width="30px"> </button></a>
    </nav>
  </header>

  <!-- PHP section for session management and task count -->
  <?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        header("Location: login.html");
        exit();
    }

    // Retrieve username from session
    $username = $_SESSION['username'];
    echo "
    <div class='welcome'>
        <h2>Hey $username &lt;3 Ready to conquer the day?</h2>
      </div>";

    // JavaScript variable for the username to use on the client-side
    echo "<script> var user='$username';</script>";

    // Database connection
    $server = 'localhost';
    $suser = 'root';
    $spwd = '';
    $sdb = 'snest';
    $connection = mysqli_connect($server, $suser, $spwd, $sdb);

    if (!$connection) {
        die("Failed: " . mysqli_connect_error());
    }

    // Query to count the number of tasks assigned to the user
    $query = "select count(tid) from users_tasks where uname='$username'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $ct = ($row['count(tid)'] > 0) ? $row['count(tid)'] : 0;
  ?>

  <!-- Centered image -->
  <center>
    <img src="pictures/girlcats.gif"  height="230px" width="350px" id="girlcat"
    style="border-radius: 16px;
          object-fit: cover; 
          box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
          margin:0px;">
  </center>

  <!-- Section for adding new subjects, tasks, or journal entries -->
  <div class="add">
    <h2>Let’s get started! Add a subject, task or plan your week:</h2><br>
    <nav>
      <!-- Buttons to add new subject, task, or journal -->
      <button type='button' id="addsub" onclick="window.location.href='addsub.php'">Add Subject</button>
      <button  type='button' id="addtask" onclick="window.location.href='addtask.php'">Add Task</button>
      <button  type='button' id="planner" onclick="window.location.href='journal.php'">Journal</button>
    </nav>
  </div>

  <!-- Overview section displaying task count -->
  <div class="overview">
    <div class="item" id="dates"></div>
    <div class="item">Tasks Pending: <?php echo $ct?></div>
  </div>

  <!-- Footer with creator credit -->
  <footer>
    <p>Created with &lt;3 by Niyati</p>
  </footer>

  <!-- Custom JavaScript for dynamic content -->
  <script src="dscript.js"></script>

  <!-- JavaScript for customizing typing animation and content -->
  <script>
    if (document.getElementById("dates")) {
      datetime(user);
    }

    // Set custom CSS properties for the typing effect based on the text length
    window.addEventListener('DOMContentLoaded', () => {
      const heading = document.querySelector('.welcome h2');
      const text = heading.textContent.trim();
      const chLength = text.length;

      // Set the custom CSS properties for the typing effect
      heading.style.setProperty('--width', `${chLength}ch`);
      heading.style.setProperty('--steps', chLength);
    });
  </script>

</body>
</html>
