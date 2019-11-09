<?php
session_start();
@include("..\connect\connection.php");
$sql = "UPDATE users SET offm='" . $_POST['mess'] . "' WHERE username='" . $_COOKIE['name'] . "'";
$result = $conn->query($sql);
mysqli_close($conn);
