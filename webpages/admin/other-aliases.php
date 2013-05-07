<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/privilege.php';
require_once '../../php/db.php';

assertTitle();

if(!isset($_GET['username']) || $_GET['username'] = '')
    exit();
$other = $_GET['username'];
$groups = get_col("SELECT DISTINCT(member) FROM category WHERE status = 'active'");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="author" content="averangeall">
        <link rel="stylesheet"  href="http://jquerymobile.com/test/css/themes/default/jquery.mobile.css" />
<?php
    echo jquery_mobile_header('../..');
?>
       </head>

    <body>
        <div data-role="page">
            <div data-role="content">
                <h2>Mail Aliases of <?php echo $other; ?></h2>
                <form name="login" action="../../php/save-aliases.php" method="post">
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
<?php
$email = get_one("SELECT address FROM people WHERE disa_username = '$other' AND status = 'enable'");
foreach($groups as $group) {
    $checked = (get_one("SELECT COUNT(*) FROM mail_alias WHERE alias = '$group' AND forward_addr = '$email' AND status = 'enable'") > 0) ? 'checked' : '';
    echo '<input type="checkbox" name="' . $group . '" id="' . $group . '" class="custom" ' . $checked . ' />';
    echo '<label for="' . $group . '">' . $group . '</label>';
}
?>
                        </fieldset>
                    </div>
                    <p><input type="submit" id="submit" value="Done" data-icon="check" data-inline="true" /></p>
                </form>
                <p><h3>
<?php
if(isset($_SESSION['msg'])) {
    switch($_SESSION['msg']) {
        case 0: echo 'All aliases saved!'; break;
        case 1: echo 'Some problems here...'; break;
    }
    unset($_SESSION['msg']);
}
?>
                </h3></p>
            </div>
        </div>
    </body>
</html>

