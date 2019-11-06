<?php
session_start();
@include("connection.php");
$sql = "SELECT status FROM users WHERE username='". $_POST['rec']."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$rec=strtotime($row['status']);
$sql = "SELECT status FROM users WHERE username='". $_COOKIE['name']."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$send=strtotime($row['status']);
if(($send-$rec)>12)
    echo "Offline";
else
    echo "Online";