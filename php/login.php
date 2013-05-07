<?php
session_start();

require_once "db.php";
require_once "tools.php";

function goBackIndex($err) {
    echo '
    <head>
        <meta http-equiv="refresh" content="0; url=../">
    </head>
    ';
    $_SESSION['err'] = $err;
    exit();
}

# use disa account here
function correct_username_password($username, $password) {
    ob_start();
    $whoami = system("../scripts/check-password.sh '$username' '$password'", $ret);
    ob_clean();
    return ($whoami == $username);
}

if(!isset($_POST['username']) || !isset($_POST['password']))
    goBackIndex(-1);

$username = $_POST['username'];
$password = $_POST['password'];

if($username == '' || $password == '') {
    make_log('login', "lack of username or password");
    goBackIndex(1);
} 
if(!correct_username_password($username, $password)) {
    make_log('login', "wrong username or wrong password");
    goBackIndex(3);
} else {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;
    update_title();
    make_log('login', "login successfully");
    goBackIndex(0);
}

?>
