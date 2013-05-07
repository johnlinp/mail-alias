<?php
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
            <div data-role="content">
                <h2>Please Login with Your Disa Account</h2>
                <form name="login" action="../../php/login.php" method="post" target="_parent">
                    <div data-role="fieldcontain">
                        <input type="text" name="username" data-mini="true" placeholder="Username" />
                    </div>
                    <div data-role="fieldcontain">
                        <input type="password" name="password" data-mini="true" placeholder="Password"/>
                    </div>
                    <p><input type="submit" value="Login" data-icon="home" data-mini="true" data-inline="true" /></p>
                </form>
            </div>
        </div>
    </body>
</html>

