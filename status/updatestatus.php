<?php
session_start();
@include("..\connect\connection.php");
$sql = "UPDATE `users` SET status=now() WHERE username='" . $_COOKIE['name'] . "'";
$result = $conn->query($sql);
