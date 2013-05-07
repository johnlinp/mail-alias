<?php
session_start();

require_once 'db.php';
require_once 'config.php';
require_once 'tools.php';

if($_SESSION['title'] != 'admin' || $_SESSION['title'] != 'leader')
    exit();

$title = $_SESSION['title'];

$action = $_GET['action'];
$email = $_GET['email'];
$alias = $_GET['alias'];

$exist = get_one("SELECT count(*) FROM mail_alias WHERE alias = '$alias' AND forward_addr = '$email'");
$enabled = get_one("SELECT count(*) FROM mail_alias WHERE alias = '$alias' AND forward_addr = '$email' AND status = 'enable'");
if($action == 'add') {
    if($exist === "0")
        put_one("INSERT INTO mail_alias (alias, forward_addr, status) VALUES ('$alias', '$email', 'enable')");
    else if($enabled === "0")
        put_one("UPDATE mail_alias SET status = 'enable' WHERE alias = '$alias' AND forward_addr = '$email' AND status = 'disable'");
    make_log('group alias', "added $email into $alias");
} else if($action == 'remove') {
    if($exist > 0)
        put_one("UPDATE mail_alias SET status = 'disable' WHERE alias = '$alias' AND forward_addr = '$email'");
    make_log('group alias', "removed $email from $alias");
}


echo redirect("../webpages/$title/group-aliases.php?group=$alias");

?>
