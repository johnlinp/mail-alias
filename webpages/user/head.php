<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/privilege.php';
require_once '../../php/html.php';

assertTitle();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="author" content="averangeall">
<?php
echo jquery_mobile_header('../..');
?>
    </head>

    <body>
        <div data-role="page">
            <div data-role="header">
                <h1><?php echo $_title; ?></h1>
<?php
if($_SESSION['basic'] == 0)
echo '
    <div data-role="navbar">
        <ul>
            <li><a href="my-aliases.php" target="content" data-icon="check" data-theme="c" id="aliases">Edit My Aliases</a></li>
            <li><a href="profile.php" target="content" data-icon="gear" data-theme="c" id="profile">My Profile</a></li>
            <li><a href="http://agent.csie.ntu.edu.tw/~wiki/admin_files/EmailAliases.php" target="content" data-icon="info" data-theme="c" id="others">See Other People</a></li>
            <li><a href="../../php/logout.php" target="content" data-icon="back" data-theme="c" id="logout">Logout</a></li>
        </ul>
    </div>
';
?>
            </div>
            <div data-role="content">
            </div>
        </div>
    </body>
</html>

