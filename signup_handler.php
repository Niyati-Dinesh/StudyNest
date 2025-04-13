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
        header("Location:http://localhost/studynest/dashboard.php?user=".urlencode($username));
        exit();



}
?>