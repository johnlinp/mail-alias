<?php
function jquery_mobile_header($root_dir) {
    return '
        <link rel="stylesheet" href="' . $root_dir .  '/css/jquery.mobile-1.3.0.css" />
        <script src="' . $root_dir . '/js/jquery.js"></script>
        <script src="' . $root_dir . '/js/jquery-mobile-config.js"></script>
        <script src="' . $root_dir . '/js/jquery.mobile-1.3.0.min.js"></script>
    ';
}

function fill_template($template, $item) {
    $res = $template;
    foreach($item as $name => $value)
        $res = str_replace('%' . $name . '%', $value, $res);
    return $res;
}

function check_list($list, $action) {
    $res = '';
    $res .= '
        <form name="login" action="' . $action . '" method="post">
            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup">
    ';
    foreach($list as $item => $checked) {
        $res .=  '<input type="checkbox" name="' . $item . '" id="' . $item . '" class="custom" ' . $checked . ' />';
        $res .=  '<label for="' . $item . '">' . $item . '</label>';
    }
    $res .=  '
                </fieldset>
            </div>
            <p><input type="submit" id="submit" value="Done" data-icon="check" data-inline="true" /></p>
        </form>
    ';
    return $res;
}

function sure_pupups($list, $main, $template_href, $title, $template_msg) {
    $res = '';
    foreach($list as $item) {
        $href = fill_template($template_href, $item);
        $msg = fill_template($template_msg, $item);
        $res .= '
            <div data-role="popup" id="sure-' . $item[$main] . '" data-overlay-theme="d" data-theme="c" style="max-width:500px;" class="ui-corner-all">
                <div data-role="header" data-theme="d" class="ui-corner-top">
                    <h1>' . $title . '</h1>
                </div>
                <div data-role="content" data-theme="d" style="padding:15px;" class="ui-corner-bottom">
                    <p>' . $msg . '</p>
                    <a href="' . $href . '" data-role="button" data-theme="b">Yes, Pretty Sure!</a>       
                    <a href="#" data-role="button" data-theme="c" data-rel="back">Cancel</a>
                </div>
            </div>
        ';
    }
    return $res;
}

function clickable_list($list, $main, $template_href, $filter) {
    echo '<ul data-role="listview" data-filter="' . $filter . '" data-inset="true">';
    foreach($list as $item) {
        $href = fill_template($template_href, $item);
        echo '<li><a href="' . $href . '" data-rel="popup">' . $item[$main] . '</a></li>';
    }
    echo '</ul>';
}

function single_input($personal, $action) {
    $res = '';
    $res .= '
        <form name="personal" action="' . $action . '" method="post">
            <div data-role="fieldcontain">
                <input type="text" name="personal" data-mini="true"
                placeholder="New Alias" value="' . (($personal == '') ?
                'YourAlias' : $personal) . '@ai.csie.ntu.edu.tw' . '" />
            </div>
            <p><input type="submit" id="submit" value="Done" data-icon="check" data-inline="true" /></p>
        </form>
    ';
    return $res;
}

?>
