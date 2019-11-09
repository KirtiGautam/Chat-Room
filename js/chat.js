var reciep;
let intervalid;
let intervalid2;

const img = document.querySelector('.zet');
const menu = document.querySelector('.menu');

img.addEventListener('mousedown', ({ offsetX, offsetY }) => {
    menu.style.top = offsetY + 'px';
    menu.style.left = offsetX + 'px';
});

function upmess() {
    var me = prompt("Enter your offline message", "Sorry I am unavailable.");
    if (me == null || me == "") {
        return;
    } else {
        me ="mess="+me; 
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                alert("Message updated Successfully");
            }
        }
        xmlHttp.open("post", "messages/updatemessage.php");
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send(me);
    }
}

function changep() {
    var pass = prompt("Enter your new password", "");
    if (pass == null || pass == "") {
        return;
    }
    var confirm = prompt("Confirm new password", "");
    if(pass != confirm){
        alert("Passwords don't match, try again");
        return;
    }
    else {
        pass ="pass="+me; 
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                alert("Password updated Successfully");
            }
        }
        xmlHttp.open("post", "users/updatepassword.php");
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send(pass);
    }
}

window.setInterval(function () {

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            document.getElementById('used').innerHTML = xmlHttp.responseText;
        }
    }
    xmlHttp.open("post", "users/getusers.php");
    xmlHttp.send();
}, 2000);

window.setInterval(function () {

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) { }
    }
    xmlHttp.open("post", "status/updatestatus.php");
    xmlHttp.send();
}, 2000);

function getPaging(val) {
    val = "rec=" + val;
    reciep = val;
    window.clearInterval(intervalid);
    intervalid = window.setInterval(function () {

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById('chat').innerHTML = xmlHttp.responseText;
            }
        }
        xmlHttp.open("post", "messages/getmessages.php");
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send(val);
    }, 2000);

    window.clearInterval(intervalid2);
    intervalid2 = window.setInterval(function () {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById('status').innerHTML = xmlHttp.responseText;
            }
        }
        xmlHttp.open("post", "status/getstatus.php");
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send(val);
    }, 2000);

}

function myFunction() {
    var dat = reciep;
    dat = dat + "&message=" + document.getElementById('message').value;
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            document.getElementById('message').value = '';
        }
    }
    xmlHttp.open("post", "messages/sendmessage.php");
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send(dat);
}