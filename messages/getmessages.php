<?php
session_start();
@include("..\connect\connection.php");
$sql = "SELECT sender,text FROM messages WHERE (sender='" . $_COOKIE['name'] . "' AND reciever='" . $_POST['rec'] . "') OR (sender='" . $_POST['rec'] . "' AND reciever='" . $_COOKIE['name'] . "') ORDER BY time ASC";
$result = $conn->query($sql);
echo '<ul>';
while ($row = $result->fetch_assoc()) {
    if ($row['sender'] == $_COOKIE['name'])
        echo '<li class="sender dam">' . $row['text'] . '</li>';
    else if ($row['sender'] == $_POST['rec'])
        echo '<li class="reciever dam">' . $row['text'] . '</li>';
}
echo '</ul>';
mysqli_close($conn);
