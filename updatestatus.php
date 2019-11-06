<?php
session_start();
@include("connection.php");
$sql = "UPDATE `users` SET status=now() WHERE username='".$_COOKIE['name']."'";
$result = $conn->query($sql);