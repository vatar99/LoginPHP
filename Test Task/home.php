<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "registration");
$dv = mysqli_connect("localhost", "root", "", "contact");

if(empty($_SESSION['username'])){
    header('location: login.php');
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
<h1>Home</h1>
</div>
<?php 
if(isset($_SESSION['message'])){
    echo "<div id='error_msg'>".$_SESSION['message']."</div>";
    unset($_SESSION['message']);
}
?>
<div><h4>Welcome: <?php echo $_SESSION['username']; ?></h4></div>

<h1>Home</h1>
<div><a href="index.php">Contact</a></div>
<div><a href="logout.php">Logout</a></div>


</body>
</html>