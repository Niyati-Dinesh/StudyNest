<?php
session_start();

$sname="localhost";
$uname="root";
$pass="";
$dname="snest";
$connection=mysqli_connect($sname,$uname,$pass,$dname);
if (!($connection)){
    die("Failed to connect!".mysqli_connect_error());
}

if(isset($_POST['username'])&&isset($_POST['pwd'])){
    $username=mysqli_real_escape_string($connection,$_POST['username']);
    $password=mysqli_real_escape_string($connection,$_POST['pwd']);
    $query="select * from users where uname='$username'";
    $resultset=mysqli_query($connection,$query);
    if (mysqli_num_rows($resultset)>0){
        $user=mysqli_fetch_assoc($resultset);
        if (password_verify($password, $user['password'])){
            $_SESSION['username']=$username;
            header("Location:http://localhost/studynest/dashboard.php?user=".urlencode($username));
            exit();
        }
        else{
            echo"
            <script>
            alert('Invalid username or password!'); window.location.href='http://localhost/studynest/login.html';
            </script>";
        }

    }
    else{
        echo"
        <script>
        alert('Invalid username or password!'); window.location.href='http://localhost/studynest/login.html';
        </script>";
    }
}

?>