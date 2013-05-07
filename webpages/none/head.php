<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/html.php';
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
if(isset($_SESSION['err']) && $_SESSION['err'] > 0) {
    echo '<div data-role="header" data-theme="e">';
    switch($_SESSION['err']) {
        case 1: echo '<h1>請把資料填好呀</h1>'; break;
        case 2: echo '<h1>沒有這個人喔</h1>'; break;
        case 3: echo '<h1>密碼打錯了喔</h1>'; break;
    }
    echo '</div>';
    unset($_SESSION['err']);
}
?>
            </div>

            <div data-role="content">
            </div>
        </div>
    </body>
</html>

