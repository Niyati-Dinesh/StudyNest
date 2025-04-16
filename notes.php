<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
echo "
<div class='welcome-banner'>
  <h2>Welcome, $username 🌿</h2>
  <p>Your study sanctuary awaits. Let's bloom 🌸</p>
</div>";
?>
<div class="welcome">
    <h2>Hey Niyati &lt;3 Ready to conquer the day?</h2>
  </div>







<div>
<form method="POST">
  <input type="text" placeholder="Enter a subject:">
  <button>ADD</button>
<form>
  