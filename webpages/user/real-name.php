<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/privilege.php';
require_once '../../php/db.php';
require_once '../../php/html.php';

assertTitle();

$username = $_SESSION['username'];
$realname = get_one("SELECT name FROM people WHERE disa_username = '$username'");
if($realname != '')
    exit();

$realnames = get_col("SELECT DISTINCT(name) FROM people WHERE disa_username = ''");
$realnames_fill_list = array();
foreach($realnames as $realname) {
    $item = array();
    $item['realname'] = $realname;
    array_push($realnames_fill_list, $item);
}
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
<?php
echo sure_pupups($realnames_fill_list, 'realname', '../../php/add-real-name.php?realname=%realname%', 'Are You Sure?', 'This action is not reversible, please make sure that %realname% is your real name.');
?>

                <h2>Please Click on Your Real Name</h2>
                <h3>Search Here!</h3>
<?php
echo clickable_list($realnames_fill_list, 'realname', '#sure-%realname%', 'true');
?>
            </div>
        </div>
    </body>
</html>

