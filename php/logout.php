<?php
session_start();

require_once 'tools.php';
?>

<?php
make_log('logout', 'logout successfully');
unset($_SESSION['login']);
unset($_SESSION['username']);
unset($_SESSION['title']);
echo redirect('../webpages/none/refresh-parent.html'); break;
?>
