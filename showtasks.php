<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

$server = 'localhost';
$sqluser = 'root';
$sqlpwd = '';
$sqldb = 'snest';
$connection = mysqli_connect($server, $sqluser, $sqlpwd, $sqldb);

if (!$connection) {
    die("Failed to connect: " . mysqli_connect_error());
}

$query = "SELECT * FROM users_tasks WHERE uname = '$username' ORDER BY deadline ASC";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>StudyNest | Your Tasks</title>
  <link href="dstyle.css" rel="stylesheet">
  <style>
    .task-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      padding: 20px;
      margin-top: 100px;
    }

    .task-card {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(14px);
      border-radius: 20px;
      padding: 20px;
      box-shadow: 2px 4px 16px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .task-card:hover {
      transform: scale(1.02);
    }

    .task-title {
      font-weight: bold;
      font-size: 1.2rem;
      margin-bottom: 10px;
    }

    .task-subject {
      color: #444;
      font-size: 0.95rem;
    }

    .task-desc {
      margin: 10px 0;
      font-size: 0.9rem;
      color: #333;
    }

    .deadline {
      font-style: italic;
      color: #8a2be2;
    }

    .status {
      font-weight: bold;
      color: green;
    }

    .pending {
      color: darkorange;
    }

  </style>
</head>
<body>

<header>
  <h1>🌱 Your Tasks, Baby</h1>
</header>

<div class="task-container">
  <?php
    if (mysqli_num_rows($result) > 0) {
        while ($task = mysqli_fetch_assoc($result)) {
            echo "<div class='task-card'>";
            echo "<div class='task-title'>" . htmlspecialchars($task['task']) . "</div>";
            echo "<div class='task-subject'>📘 " . htmlspecialchars($task['subject']) . "</div>";
            echo "<div class='task-desc'>" . nl2br(htmlspecialchars($task['description'])) . "</div>";
            echo "<div class='deadline'>🗓️ Due: " . $task['deadline'] . "</div>";
            echo "<div class='status " . ($task['status'] == 'pending' ? 'pending' : '') . "'>Status: " . ucfirst($task['status']) . "</div>";
            echo "</div>";
        }
    } else {
        echo "<p style='text-align:center;'>You haven’t added any tasks yet, cutie 🥺</p>";
    }
  ?>
</div>

</body>
</html>
