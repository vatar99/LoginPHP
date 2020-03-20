<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "registration");

if(isset($_POST['register_btn'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if($password == $password2){
$password = md5($password);
$sql = "INSERT INTO users (username, email,password) VALUES('$username', '$email', '$password')";
mysqli_query($db, $sql);
$_SESSION['message']= "You are now logged in";
$_SESSION['username']= $username;
header("location: home.php");
    }else {
$_SESSION['message']= "The two passwords do not match";
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
<title>TZ</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
<h1>Register</h1>
</div>

<?php 
if(isset($_SESSION['message'])){
    echo "<div id='error_msg'>".$_SESSION['message']."</div>";
    unset($_SESSION['message']);
}
?>

<form method = "post" action="register.php">
<table>
<tr>
<td>Username:</td>
<td><input type="text" name="username" class="textInput"></td>
</tr>
                <tr>
<td>Email:</td>
<td><input type="email" name="email" class="textInput"></td>
                </tr>
             <tr>
<td>Password:</td>
<td><input type="password" name="password" class="textInput"></td>
            </tr>
        <tr>
<td>Password again:</td>
<td><input type="password" name="password2" class="textInput"></td>
        </tr>
    <tr>
<td><div><a href="login.php">Sign Up</a></div></td>
<td><input type="submit" name="register_btn" value="Register"></td>
    </tr>
</table>
</form>

</body>
</html>