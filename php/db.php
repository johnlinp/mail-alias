<?php
require_once 'config.php';

$_link = mysql_connect($_db_hostname, $_db_username, $_db_password);
mysql_select_db($_db_database, $_link);

mysql_query("SET NAMES 'UTF8'");
mysql_query("SET CHARACTER_SET_RESULTS='UTF8'");
mysql_query("SET CHARACTER_SET_CLIENT='UTF8'");

function get_table($cmd) {
    $res = array();
    $query = mysql_query($cmd);
    while(($row = mysql_fetch_array($query)) != null)
        array_push($res, $row);
    return $res;
}

function get_col($cmd) {
    $res = array();
    $query = mysql_query($cmd);
    while(($row = mysql_fetch_array($query)) != null)
        array_push($res, $row[0]);
    return $res;
}

function get_row($cmd) {
    $query = mysql_query($cmd);
    $row = mysql_fetch_array($query);
    if($row == null)
        return array();
    return $row;
}

function get_one($cmd) {
    $query = mysql_query($cmd);
    $row = mysql_fetch_array($query);
    if($row == null)
        return "";
    return $row[0];
}

function put_one($cmd) {
    mysql_query($cmd);
}
?>
