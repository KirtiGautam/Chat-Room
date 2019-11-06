<?php
session_start();
@include("connection.php");
$sql = "INSERT INTO messages (sender, text, reciever) VALUES ('" . $_SESSION['name'] . "', '" . $_POST["message"] . "', '" . $_POST['rec'] . "')";
$result = $conn->query($sql);
mysqli_close($conn);