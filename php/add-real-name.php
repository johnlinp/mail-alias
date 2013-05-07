<?php
session_start();

require_once 'db.php';
require_once 'tools.php';

$username = $_SESSION['username'];
$realname = $_GET['realname'];
put_one("UPDATE people SET disa_username = '$username' WHERE name = '$realname'");

update_title();

make_log('real name', 'selected ' . $realname);

echo redirect('../webpages/none/refresh-parent.html');
?>
