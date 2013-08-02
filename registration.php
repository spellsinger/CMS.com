<?php

echo '<html>';
echo '<head>';
echo '<title>Registration</title>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
echo '</head>';
echo '<body>';


echo '<form method="post" action="'.$_SERVER['php_self'].'">';
echo '<input type="hidden" value="true" name="done">';
echo 'Name:';
echo '<input type="text" maxlength="20" name="userName"><br />';
echo 'Login:';
echo '<input type="text" maxlength="20" name="login"><br />';
echo 'E-mail:';
echo '<input type="text" maxlength="30" name="e-mail"><br />';
echo 'Password:';
echo '<input type="password" maxlength="30" name="password"><br />';
echo 'Confirm password:';
echo '<input type="password" maxlength="30" name="cPassword"><br />';
echo '<button type="submit">Register!</button>';
echo '</form>';


$userName = $_POST['userName'];
$login = $_POST['login'];
$email = $_POST['e-mail'];
$password = $_POST['password'];
$cPassword = $_POST['cPassword'];

//connecting to database
$connection = mysql_connect('localhost', 'admin', 'admin') or die ("Connection failed");
$db_selected = mysql_select_db('cms', $connection) or die ("Failed to select database");


if (isset($_POST['done'])){
    if (empty($userName) || empty($login) || empty($email) || empty($password) || empty($cPassword)){
        echo '<script type="text/javascript">window.alert("Fill all the info");</script>';
    }
    elseif ($password != $cPassword){
        echo 'The password is not correct';
    }
    else {
        $matchIdArr = mysql_query("SELECT id FROM users WHERE login='$login'");
        $matchArray = mysql_fetch_array($matchIdArr);
        if (!empty($matchArray)){
            echo 'The login already exists';
        }
        else {
            $registrationDone = mysql_query("INSERT INTO users (username, login, password, email) VALUES ('$userName', '$login',
    '$password', '$email')") or die ("Failed to register, reason: ".mysql_error());
            if ($registrationDone){
                echo "Registered successfully";
            }
            else {
                "Error, try again";
            }
        }
    }
}


echo '</body>';
echo '</html>';


?>