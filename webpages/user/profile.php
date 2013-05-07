<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/privilege.php';
require_once '../../php/db.php';
require_once '../../php/html.php';

assertTitle();
?>

<?php
$username = $_SESSION['username'];
$realname = get_one("SELECT name FROM people WHERE disa_username = '$username'");
$email = get_one("SELECT address FROM people WHERE disa_username = '$username' AND status = 'enable'");
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
            <div data-role="content">
                <ul data-role="listview" data-inset="true">
                    <li data-role="list-divider"></li>
                    <li>
                        <p>Username</p>
                        <h3><?php echo $username; ?></h3>
                    </li>
                    <li>
                        <p>Real Name</p>
                        <h3><?php echo $realname; ?></h3>
                    </li>
                    <li>
                        <p>Email Address</p>
                        <h3><?php echo $email; ?></h3>
                    </li>
                    <li>
                        <p>All of My Aliases</p>
<?php
$aliases = get_col("SELECT DISTINCT(alias) FROM mail_alias WHERE forward_addr = '$email' AND status = 'enable'");
foreach($aliases as $alias)
    echo "<p><h3>$alias</h3></p>";
?>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>

