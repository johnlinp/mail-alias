<?php
session_start();

require_once 'db.php';
require_once 'tools.php';

if(!isset($_GET['email']))
    exit();
$use_email = $_GET['email'];

if($_SESSION['title'] == 'admin' && isset($_GET['username']) && $_GET['username'] != '')
    $username = $_GET['username'];
else
    $username = $_SESSION['username'];

$emails = get_col("SELECT address FROM people WHERE disa_username = '$username'");

foreach($emails as $email) {
    if($email == $use_email)
        put_one("UPDATE people SET status = 'enable' WHERE address = '$email' AND disa_username = '$username'");
    else
        put_one("UPDATE people SET status = 'disable' WHERE address = '$email' AND disa_username = '$username'");
}

make_log('email', 'selected ' . $use_email);

echo redirect('../webpages/none/refresh-parent.html');
?>
