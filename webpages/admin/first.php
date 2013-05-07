<?php
session_start();

require_once '../../php/config.php';
require_once '../../php/privilege.php';
require_once '../../php/db.php';
require_once '../../php/tools.php';

assertTitle();
?>

<?php
switch($_SESSION['basic']) {
    case 0: echo redirect('groups.php'); break;
    case 1: echo redirect('real-name.php'); break;
    case 2: echo redirect('emails.php'); break;
}
?>
