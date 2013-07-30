<?php

date_default_timezone_set('Europe/Kiev');
require_once('config.php');
require_once('functions.php');
require_once('db.php');

$db = new DB($config['db']);

//example of usage of DB class
#var_dump($db->getAllRows("SELECT * FROM news"));

//example of logging using
//writeLog('test2!'); 


echo '<html>';
echo '<head>';
echo '<title>News</title>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
echo '</head>';
echo '<body>';


echo '<p><a href="'.$_SERVER['php_self'].'?action=post">I want to post the news</a></p>';
echo '<p><a href="'.$_SERVER['php_self'].'?action=get">I want to read the news</a></p>';

$action = $_GET['action'];

switch ($action) {
	case 'post':
		include 'news_in.php';
	case 'get':
	default:
		include 'news_out.php';
}

//else {
//    echo "This is the home page";
//}


echo '</body>';
echo '</html>';

?>
