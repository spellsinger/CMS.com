<?php session_start();

echo '<form action="'.$_SERVER['php_self'].'?action=authorised" method="post">';
echo '<input type="hidden" value="true" name="enter">';
echo '<input type="text" name="login">';
echo '<input type="password" name="password">';
echo '<button type="submit">Enter</button>';
echo '</form>';


$login = $_POST['login'];
$password = $_POST['password'];

if ($login == "" || $password == ""){
    echo 'Fill in the info';
}

else {
    $matching = mysql_query("SELECT * FROM users WHERE login=$login");
    $matchArr = mysql_fetch_array($matching);
    if (empty($matchArr['password'])){
        exit('Login or password is incorrect');
    }
    if ($password != $matchArr['password']){
        echo 'The password is incorrect';
    }
    else {
        $_SESSION['login'] = $matchArr['login'];
        $_SESSION['id'] = $matchArr['id'];
        $_SESSION['rights'] = $matchArr['rights'];

        echo '<script type="text/javascript">
        window.location.href="index.php?authorised=authorised"
        </script>';
    }

}


?>