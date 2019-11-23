<?php
session_start();
@include("..\connect\connection.php");
$sql = "SELECT status FROM users WHERE username='" . $_COOKIE['name'] . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$send = strtotime($row['status']);
$sql = "SELECT name,status,offm FROM users WHERE username='" . $_POST['rec'] . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$rec = strtotime($row['status']);
if (($send - $rec) > 12) {
    echo "<div><span class='us'>" . $row['name'] . "</span>
        <span class='stat'>Offline</span></div>";
    echo "<br><p class='offm'>" . $row['offm'] . "</p>";
} else {
    echo "<div><span class='us'>" . $row['name'] . "</span>
        <span class='stat'>Online</span></div>";
}
