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
    <link rel="stylesheet" href="styles/chat.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <div class="con">F.R.I.E.N.D.S</div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h1>Hello <?php @include("connect\connection.php");
                            $sql = "SELECT name FROM users WHERE username='" . $_COOKIE['name'] . "'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['name'];
                            mysqli_close($conn); ?></h1>
                <h2>Please select a user to chat with:</h2>
                <div  class="users" id="used">
                </div>
            </div>
            <div id="c" class="col-lg-8 ">
                <h1 id="status">Chat window</h1>
                <div class="chatWindow col-lg-12" id="chat" onscroll="scro()"></div>
                <div class="col-lg-12"><br></div>
                <form action="">
                    <div class="col-lg-8"><textarea name="mess" id="message" class="ssss" placeholder="Enter any message"></textarea></div>
                    <div class="col-lg-4"><input type="submit" value="Send" onclick="myFunction(); return false;"></div>
                </form>
            </div>
        </div>
        <div><br><br></div>
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <form method="POST">
                <button name="logout" type="submit">Logout</button>
            </form>
        </div>
    </div>
    </div>
</body>
<script src="js/chat.js"></script>

</html>