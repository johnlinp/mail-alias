<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/privilege.php';
require_once '../../php/db.php';
require_once '../../php/html.php';

assertTitle();

$username = $_SESSION['username'];
$email = get_one("SELECT address FROM people WHERE disa_username = '$username' AND status = 'enable'");
$aliases = array();
foreach($_avai_aliases as $alias) {
    $checked = (get_one("SELECT COUNT(*) FROM mail_alias WHERE alias = '$alias' AND forward_addr = '$email' AND status = 'enable' AND `usage` = 'group'") > 0) ? 'checked' : '';
    $aliases[$alias] = $checked;
}
$personal = get_one("SELECT alias FROM mail_alias WHERE forward_addr = '$email' AND status = 'enable' AND `usage` = 'personal'");
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
                <h2>Please Enter The Alias You Want</h2>
                <h3><?php echo ($personal == '') ? '<i>your-alias</i>' :
                $personal; ?>@ai.csie.ntu.edu.tw → <?php echo $email; ?></h3>
<?php
echo single_input($personal, '../../php/save-personal.php');
?>
                <p><h3>
<?php
if(isset($_SESSION['nsg'])) {
    switch($_SESSION['nsg']) {
        case 0: echo '<font color="#00AA00">New alias saved!</font>'; break;
        case 1: echo '<font color="#AA0000">Don\'t leave the place blank!</font>'; break;
        case 2: echo '<font color="#AA0000">The alias is used by others.</font>'; break;
        case 3: echo '<font color="#AA0000">Don\'t repeat yourself!</font>'; break;
    }
    unset($_SESSION['nsg']);
}
?>
                </h3></p>
                <h2>Please Check Your Desired Email Subscriptions</h2>
<?php
echo check_list($aliases, '../../php/save-aliases.php');
?>
                <p><h3>
<?php
if(isset($_SESSION['msg'])) {
    switch($_SESSION['msg']) {
        case 0: echo '<font color="#00AA00">All subscriptions saved!</font>'; break;
        case 1: echo '<font color="#AA0000">Some problems here...</font>'; break;
    }
    unset($_SESSION['msg']);
}
?>
                </h3></p>
            </div>
        </div>
    </body>
</html>

