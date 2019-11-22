<?php
session_start();
if (!isset($_SESSION["name"])|| $_COOKIE['name'] == '')
    header('Location: index.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chat Window</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/chat.css">
</head>

<body style="background-image: url('https://cdn.pixabay.com/photo/2017/08/12/03/22/flower-2633363_960_720.png');background-size:cover;">
    <form action="">
        <table>
            <tr>
                <td>
                    <div class="con">F.R.I.E.N.D.S</div>
                </td>
                <td></td>
                <td>
                    <button onclick="changep()" title="Change Password"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>
                    <button onclick="upmess()" title="Update offline message"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    <button onclick="log()"  title="Logout" value="logoff"><i class="fa fa-power-off" aria-hidden="true"></i></button>
                </td>
            </tr>
            <tr>
                <td>
                    <h1>Hello <?php @include("connect\connection.php");
                                $sql = "SELECT name FROM users WHERE username='" . $_COOKIE['name'] . "'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                echo $row['name'];
                                mysqli_close($conn); ?>
                    </h1>
                </td>

            </tr>
            <tr>
                <td>
                    <h2 id="used">Please select a user to chat with:</h2>
                </td>
                <td>
                    <h1 id="status">Chat window</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="users" id="used"></div>
                </td>
                <td>
                    <div class="chatWindow" id="chat" onscroll="scro()"></div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td width="1000px">
                    <textarea name="mess" id="message" class="ssss" placeholder="Enter any message"></textarea>
                    <button type="submit" title="send" onclick="myFunction(); return false;"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </td>
            </tr>
        </table>
    </form>


</body>
<script src="js/chat.js"></script>

</html>