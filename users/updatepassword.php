<?php
session_start();
@include("..\connect\connection.php");
$sql = "UPDATE users SET password='" . $_POST['pass'] . "' WHERE username='" . $_COOKIE['name'] . "'";
$result = $conn->query($sql);
mysqli_close($conn);
