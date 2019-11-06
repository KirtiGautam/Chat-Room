<?php
session_start();
if (!isset($_SESSION["name"]) || $_COOKIE['name'] == '')
    header('Location: index.php');
if (isset($_POST["logout"])) {
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie('name', '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();

    echo '<meta http-equiv="REFRESH" content="0";url="index.php">';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="chat.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
    <h1>Hello <?php @include("connection.php");
                $sql = "SELECT name FROM users WHERE username='" . $_SESSION['name'] . "'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['name'];
                mysqli_close($conn); ?></h1>
    <h2>Please select a user to chat with:</h2>
    <div class="row">
        <div class="col-lg-4">
            <form method="post">
                <?php
                @include("connection.php");
                $sql = "SELECT username,name FROM users";
                $result = $conn->query($sql);
                echo '<ul>';
                while ($row = $result->fetch_assoc()) {
                    if ($row['username'] == $_SESSION["name"])
                        continue;
                    echo "<li style=' cursor: pointer;' onclick='getPaging(\"" . $row['username'] . "\")' id='" . $row['username'] . "'  value='" . $row['username'] . "'>" . $row['name'] . "</li>";
                }
                echo '</ul>';
                mysqli_close($conn);
                ?>
            </form>
        </div>
        <div id="c" class="col-lg-8 ">
            <center>
                <h1 id="status">Chat window</h1>
            </center>





            <form method="POST">
                <button name="logout" type="submit">logout</button>
            </form>
            <div class="chatWindow" id="chat" onscroll="scro()">
            </div>
            <center>
                <form action="">
                    <input type="text" id="message" class="ssss" name="mess">
                    <input type="submit" value="Send" onclick="myFunction(); return false;">
                </form>
            </center>
        </div>
    </div>
</body>
<script>
    var reciep;
    let intervalid;
    let intervalid2;

    window.setInterval(function() {

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {                
            }
        }
        xmlHttp.open("post", "updatestatus.php");
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send();
    }, 2000);

    function getPaging(val) {
        val = "rec=" + val;
        reciep = val;
        window.clearInterval(intervalid);
        intervalid = window.setInterval(function() {

            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function() {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    document.getElementById('chat').innerHTML = xmlHttp.responseText;
                }
            }
            xmlHttp.open("post", "getmessages.php");
            xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlHttp.send(val);
        }, 2000);


        window.clearInterval(intervalid2);
        intervalid2 = window.setInterval(function() {

            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function() {
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                    document.getElementById('status').innerHTML = "Chat Room " + xmlHttp.responseText;
                }
            }
            xmlHttp.open("post", "getstatus.php");
            xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlHttp.send(val);
        }, 2000);


    }

    function myFunction() {
        var elements = document.getElementsByClassName("ssss");
        var formData = new FormData();
        var dat = reciep;
        dat = dat + "&message=" + document.getElementById('message').value;
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById('message').value = null;
            }
        }
        xmlHttp.open("post", "sendmessage.php");
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send(dat);
    }
</script>

</html>