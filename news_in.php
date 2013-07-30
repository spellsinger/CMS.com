<?php
////////////////////////////////////////////////////////////NEWS INPUT///////////////////////////////////////////////////////
//form
echo '<form method="post" action="'.$_SERVER['php_self'].'">';
echo '<input type="hidden" value="true" name="posted">';
echo 'Topic:<br /><input type="text" maxlength="200" name="topic"><br />';
echo 'Text:<br /><textarea rows="5" cols="25" maxlength="2000" name="text"></textarea><br />';
echo '<button type="submit">Post</button><button type="reset">Clear the form</button>';
echo '</form>';


//connecting to database
$connection = mysql_connect('localhost', 'admin', 'admin') or die ("Connection failed");
$db_selected = mysql_select_db('cms', $connection) or die ("Failed to select database");

$topicIn = $_POST['topic'];
$textIn = $_POST['text'];
$postDate = date('d.m.Y');

if (isset($_POST['posted'])){
    $messageAdded = mysql_query("INSERT INTO news (topic, text, post_date) VALUES ('$topicIn', '$textIn',
'$postDate')") or die ("Failed to post the message");
    if ($messageAdded){
        echo 'The message was posted successfully';
    }
    else {
        echo 'Error. Try again';
    }
}


print mysql_error();
?>