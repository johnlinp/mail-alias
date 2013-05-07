<?php
session_start();

require_once 'config.php';
require_once 'db.php';

function redirect($path) {
    return '
    <head>
        <meta http-equiv="refresh" content="0; url=' . $path . '">
    </head>
    ';
}

function get_leader_groups() {
    $username = $_SESSION['username'];
    if(get_one("SELECT COUNT(name) FROM people WHERE disa_username = '$username'") == 0)
        return array();
    return get_col("SELECT `group` FROM leader WHERE name = (SELECT name FROM people WHERE disa_username = '$username' LIMIT 1)");
}

# currently determined by email alias "admin201X"
function is_in_admin_list() {
    global $_admin_alias;
    $username = $_SESSION['username'];
    $my_emails = get_col("SELECT address FROM people WHERE disa_username = '$username'");
    $admin_emails = get_col("SELECT forward_addr FROM mail_alias WHERE alias = '$_admin_alias'");
    foreach($my_emails as $my_email) {
        if(in_array($my_email, $admin_emails))
            return true;
    }
    return false;
}

function update_title() {
    if(!isset($_SESSION['login']) || $_SESSION['login'] != true)
        return;
    $username = $_SESSION['username'];
    if(is_in_admin_list() || $username == 'yjhsu')
        $_SESSION['title'] = 'admin';
    else if(count(get_leader_groups()) > 0)
        $_SESSION['title'] = 'leader';
    else
        $_SESSION['title'] = 'user';
}

function make_log($tag, $description) {
    $username = $_SESSION['username'];
    put_one("INSERT INTO log (`username`, `tag`, `description`) VALUES ('$username', '$tag', '$description')");
}

?>
