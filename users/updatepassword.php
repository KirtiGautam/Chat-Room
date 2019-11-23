<?php
session_start();
@include("..\connect\connection.php");
$sql = "UPDATE users SET password='" . password_hash($_POST["pass"], PASSWORD_BCRYPT) . "' WHERE username='" . $_COOKIE['name'] . "'";
$result = $conn->query($sql);
mysqli_close($conn);
