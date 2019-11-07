<?php
session_start();
@include("..\connect\connection.php");
$sql = "SELECT status FROM users WHERE username='" . $_COOKIE['name'] . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$send = strtotime($row['status']);

$sql = "SELECT username,name,status FROM users";
$result = $conn->query($sql);
echo '<ul>';
while ($row = $result->fetch_assoc()) {
    if ($row['username'] == $_SESSION["name"])
        continue;
    $rec = strtotime($row['status']);
    $stat = "Online";
    if (($send - $rec) > 12)
        $stat = "Offline";
    echo  "<li> <span style=' cursor: pointer;' onclick='getPaging(\"" . $row['username'] . "\")' id='" . $row['username'] . "'  value='" . $row['username'] . "'>" . $row['name'] ."  " . $stat .  "</span></li>";
}
echo '</ul>';
