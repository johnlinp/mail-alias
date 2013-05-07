<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/privilege.php';
require_once '../../php/db.php';

assertTitle();
?>

<?php
$username = $_SESSION['username'];
$realname = get_one("SELECT name FROM people WHERE disa_username = '$username'");
$persons = get_col("SELECT DISTINCT(name) FROM people");
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
                <h2>Choose a Person To Edit</h2>
                <h3>You Can Use the Filter Here!</h3>
                <ul data-role="listview" data-filter="true" data-inset="true">
<?php
foreach($persons as $person)
    echo '<li><a href="other-aliases.php?username=' . $person . '" data-rel="popup">' . $person . '</a></li>';
?>
                </ul>
                </div>
            </div>
        </div>
    </body>
</html>

