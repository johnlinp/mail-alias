<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/privilege.php';
require_once '../../php/db.php';
require_once '../../php/html.php';

assertTitle();

$username = $_SESSION['username'];
$num_emails = get_one("SELECT COUNT(address) FROM people WHERE disa_username = '$username' AND status = 'enable'");
if($num_emails == 1)
    exit();
$emails = get_col("SELECT DISTINCT(address) FROM people WHERE disa_username = '$username'");
$emails_fill_list = array();
foreach($emails as $email) {
    $item = array();
    $item['email'] = $email;
    array_push($emails_fill_list, $item);
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
                <h2>Please Click on Your Most Convenient Email Address</h2>
<?php
echo clickable_list($emails_fill_list, 'email', '../../php/choose-email.php?email=%email%', 'false');
?>
            </div>
        </div>
    </body>
</html>

