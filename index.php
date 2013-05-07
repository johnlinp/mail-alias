<?php
session_start();

require_once 'php/config.php';
require_once 'php/privilege.php';
require_once 'php/db.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="author" content="averangeall">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    </head>

    <frameset rows="150,*" frameborder="no">
<?php
if(isLogin()) {
    $username = $_SESSION['username'];
    $realname = get_one("SELECT name FROM people WHERE disa_username = '$username'");
    $emails = get_one("SELECT COUNT(DISTINCT(address)) FROM people WHERE disa_username = '$username' AND status = 'enable'");

    if($realname == "")
        $_SESSION['basic'] = 1;
    else if($emails > 1)
        $_SESSION['basic'] = 2;
    else
        $_SESSION['basic'] = 0;

    echo '
        <frame src="webpages/' . $_SESSION['title'] . '/head.php" name="head" scrolling="no">
        <frame src="webpages/' . $_SESSION['title'] . '/first.php" name="content">
    ';
} else {
    echo '
        <frame src="webpages/none/head.php" name="head" scrolling="no">
        <frame src="webpages/none/login.php" name="content">
    ';
}
?>
    </frameset>

    <body>
    </body>
</html>

