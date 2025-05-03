<?php
session_start();

$uname="root";
$pwd="";
$server="localhost";
$connection=mysqli_connect($server,$uname,$pwd);
if (!($connection)){
    die("Failed to connect".mysqli_connect_error());
}
$query="CREATE DATABASE IF NOT EXISTS snest";
mysqli_query($connection, $query); 
mysqli_select_db($connection, "snest");
$query = "CREATE TABLE IF NOT EXISTS users (
    uname VARCHAR(50) PRIMARY KEY,
    email VARCHAR(50),
    pwd VARCHAR(255)
)";

mysqli_query($connection,$query);
if (isset($_POST['username'])&&isset($_POST['pwd'])&&isset($_POST['email'])){
    $username=mysqli_real_escape_string($connection,$_POST['username']);
    $pass=mysqli_real_escape_string($connection,$_POST['pwd']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);

    $query = "SELECT uname FROM users WHERE uname = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "
        <script>
            alert('Username already exists, please try another username!');
            window.location.href='http://localhost/studynest/signup.html';
        </script>
        ";
        exit();
    }
    
    
        $hashed=password_hash($pass, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (uname, email, pwd) VALUES ('$username', '$email', '$hashed')";
        mysqli_query($connection,$query);
        $_SESSION['username']=$username;
        

        //creates users_subjects table;
        $query = "
            CREATE TABLE IF NOT EXISTS users_subjects (
                uname VARCHAR(50),
                subject VARCHAR(25),
                PRIMARY KEY (uname, subject),
                FOREIGN KEY (uname) REFERENCES users(uname) ON DELETE CASCADE
            )";
        mysqli_query($connection, $query);

        //create users_tasks table
        $query = "CREATE TABLE IF NOT EXISTS users_tasks (
            tid INT AUTO_INCREMENT PRIMARY KEY,
            uname VARCHAR(50),
            task VARCHAR(50),
            subject VARCHAR(25),
            description TEXT DEFAULT NULL,
            deadline DATE DEFAULT '0000-00-00',
            status ENUM('pending','complete') DEFAULT 'pending',
            FOREIGN KEY (uname, subject) REFERENCES users_subjects(uname, subject) ON DELETE CASCADE
        ) AUTO_INCREMENT=1";
        mysqli_query($connection, $query);

        header("Location:http://localhost/studynest/dashboard.php?user=".urlencode($username));
        exit();



}
?>