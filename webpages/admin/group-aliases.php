<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/privilege.php';
require_once '../../php/db.php';
require_once '../../php/html.php';

assertTitle();

if(!isset($_GET['group']) || $_GET['group'] == '')
    exit();

$group = $_GET['group'];
$people = get_table("SELECT name, address FROM people WHERE status = 'enable'");
$members = get_col("SELECT address FROM people, mail_alias WHERE address = forward_addr AND alias = '$group' AND mail_alias.status = 'enable'");
?>

<?php
$people_fill_list = array();
$idx = 0;
foreach($people as $person) {
    $item = array();
    $checked = in_array($person[1], $members);
    $icon = '<img src="../../images/' . ($checked ? 'check.png' : 'uncheck.png') . '" alt="no" class="ui-li-icon">';
    $item['person'] = $icon . $person[0] . ' ' . $person[1];
    $item['verb'] = $checked ? "Removed from $group" : "Added into $group";
    $item['name'] = $person[0];
    $item['email'] = $person[1];
    $item['action'] = $checked ? 'remove' : 'add';
    $item['idx'] = $idx;
    ++ $idx;
    array_push($people_fill_list, $item);
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
<a data-icon="delete" data-iconpos="notext"></a>
                <h2>Click on the People!</h2>
                <h3>Search Here!</h3>
<?php
echo sure_pupups($people_fill_list, 'idx', '../../php/change-alias-status.php?action=%action%&email=%email%&alias=' . $group, 'Are You Sure?', 'Do you want to make %name% (%email%) %verb%?');
echo clickable_list($people_fill_list, 'person', '#sure-%idx%', 'true');
?>
                </div>
            </div>
        </div>
    </body>
</html>

