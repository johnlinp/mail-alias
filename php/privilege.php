<?php
session_start();

require_once "tools.php";

function isLogin() {
    return (isset($_SESSION['login']) && $_SESSION['login'] == true);
}

function assertTitle() {
    ob_start();
    $title = system('pwd | awk -F \'/\' \'{ print $NF }\'');
    ob_clean();
    if(!isLogin() || $_SESSION['title'] != $title)
        echo redirect('../none/refresh-parent.html');
}

?>
