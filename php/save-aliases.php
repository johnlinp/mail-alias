<?php
session_start();

require_once 'db.php';
require_once 'config.php';
require_once 'tools.php';

$username = $_SESSION['username'];
$email = get_one("SELECT address FROM people WHERE disa_username = '$username' AND status = 'enable'");

$num_added = 0;
$num_removed = 0;
foreach($_avai_aliases as $alias) {
    $exist = get_one("SELECT count(*) FROM mail_alias WHERE alias = '$alias' AND forward_addr = '$email'");
    $enabled = get_one("SELECT count(*) FROM mail_alias WHERE alias = '$alias' AND forward_addr = '$email' AND status = 'enable'");
    if($_POST[$alias]) {
        if($exist === "0") {
            put_one("INSERT INTO mail_alias (alias, forward_addr, status) VALUES ('$alias', '$email', 'enable')");
            ++ $num_added;
        } else if($enabled === "0") {
            put_one("UPDATE mail_alias SET status = 'enable' WHERE alias = '$alias' AND forward_addr = '$email' AND status = 'disable'");
            ++ $num_added;
        }
    } else {
        if($enabled > 0) {
            put_one("UPDATE mail_alias SET status = 'disable' WHERE alias = '$alias' AND forward_addr = '$email'");
            ++ $num_removed;
        }
    }
}

$_SESSION['msg'] = 0;

make_log('my alias', "added $num_added aliases and removed $num_removed aliases");

$title = $_SESSION['title'];
echo redirect("../webpages/$title/my-aliases.php");
?>
