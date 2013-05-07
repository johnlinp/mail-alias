<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/privilege.php';
require_once '../../php/db.php';
require_once '../../php/html.php';

assertTitle();
?>

<?php
$groups = get_col("SELECT DISTINCT(member) FROM category WHERE status = 'active'");
$groups_fill_list = array();
foreach($groups as $group) {
    $item = array();
    $item['group'] = $group;
    array_push($groups_fill_list, $item);
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
                <h2>Choose a Group To Edit</h2>
                <h3>Search Here!</h3>
<?php
echo clickable_list($groups_fill_list, 'group', 'group-aliases.php?group=%group%', 'true');
?>
                </div>
            </div>
        </div>
    </body>
</html>

