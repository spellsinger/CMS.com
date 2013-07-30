<?php


echo '<html>';
echo '<head>';
echo '<title>News</title>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
echo '</head>';
echo '<body>';


echo '<p><a href="'.$_SERVER['php_self'].'?action=post">I want to post the news</a></p>';
echo '<p><a href="'.$_SERVER['php_self'].'?action=get">I want to read the news</a></p>';
$action = $_GET['action'];
if ($action == "post"){
    include 'news_in.php';
}
elseif ($action == "get"){
    include 'news_out.php';
}
//else {
//    echo "This is the home page";
//}


echo '</body>';
echo '</html>';

?>
