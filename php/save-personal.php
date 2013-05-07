<?php
session_start();

require_once 'db.php';
require_once 'config.php';
require_once 'tools.php';

$username = $_SESSION['username'];
$new_personal = addslashes($_POST['personal']);

if(strpos($new_personal, '@') !== FALSE) {
    $new_personal = substr($new_personal, 0, strpos($new_personal, '@'));
}

$email = get_one("SELECT address FROM people WHERE disa_username = '$username' AND status = 'enable'");
$num_old_personal = get_one("SELECT COUNT(*) FROM mail_alias WHERE forward_addr = '$email' AND status = 'enable' AND `usage` = 'personal'");
$num_used = get_one("SELECT COUNT(*) FROM mail_alias WHERE alias = '$new_personal' AND forward_addr != '$email' AND status = 'enable' AND `usage` = 'personal'");

if($new_personal == '' || $new_personal == 'YourAlias') {
    $_SESSION['nsg'] = 1;
} else if($num_used != '0') {
    $_SESSION['nsg'] = 2;
} else if($num_old_personal == 0) {
    put_one("INSERT INTO mail_alias (alias, forward_addr, status, `usage`) VALUES ('$new_personal',  '$email',  'enable',  'personal')");
    $_SESSION['nsg'] = 0;
} else {
    $old_personal = get_one("SELECT alias FROM mail_alias WHERE forward_addr = '$email' AND status = 'enable' AND `usage` = 'personal'");
    $old_personal = addslashes($old_personal);
    if($old_personal == $new_personal) {
        $_SESSION['nsg'] = 3;
    } else {
        put_one("UPDATE mail_alias SET alias = '$new_personal' WHERE alias = '$old_personal' AND forward_addr = '$email' AND status =  'enable' AND `usage` = 'personal' LIMIT 1");
        $_SESSION['nsg'] = 0;
    }
}


make_log('my alias', "change personal alias to $new_personal");

$title = $_SESSION['title'];
echo redirect("../webpages/$title/my-aliases.php");
?>
