<?php session_start();
//////////////////////////////////////////////////NEWS NEWS NEWS//////////////////////////////////////////////////////////
function linkBar($page, $pagesCount){
    for ($j = 1; $j <= $pagesCount; $j++){
        //the link
        if ($j == $page){
            echo '<a style="color: #808000;"><b>'.$j.'</b></a>';
        }
        else {
            echo '<a style="color: #808000;" href='.$_SERVER['php_self'].'?action=get&page='.$j.'>'.$j.'</a>';
        }

        //divider
        if ($j != $pagesCount){
            echo ' - ';
        }
    }
    return true;
} //end of function


//prepare
$perPage = 3; //number of news per page

if (empty($_GET['page']) || ($_GET['page'] <= 0)){
    $page = 1;
}
else {
    $page = (int) $_GET['page']; //page at the moment
}

//whole amount of info
$count = $db->numRows("SELECT * FROM news WHERE `visibility` != 0");
if ($count == 0) {
    die ("Error! There are no posts in the database");
}
$pagesCount = ceil($count / $perPage); //number of pages

//if the number of the page is bigger than the number of pages
if ($page > $pagesCount){
    $page = $pagesCount;
}

$startPosition = ($page - 1) * $perPage; //initial position

//call function
linkBar($page, $pagesCount);

//get the info out of database
$result = $db->getAllRows("SELECT * FROM news LIMIT ".$startPosition.", ".$perPage) or die ("Error!");
#while ($row = mysql_fetch_array($result)){
foreach ($result as $row) {
    $id = $row['id'];
    echo '<h1>'.$row['topic'].'</h1><p>'.$row['text'].'<br />'.$row['post_date'].'</p>';

    echo '<button type="submit" onclick="location.href=\''.$_SERVER['php_self'].'?action=get&page='.$page.'&hideId='.$id.'\';
    ">Hide</button>';
    if (isset($_GET['hideId'])){
        $hideId = $_GET['hideId'];
        $db->query("UPDATE news SET visibility=0 WHERE id=".$hideId) or die ("Failed to hide the post, reason: ".mysql_error()); //<--- by using this we can assume a reason of failed query
        echo '<script type="text/javascript">
            window.location.href="'.$_SERVER['php_self'].'?action=get&page='.$page.'";
            </script>';
    }

    echo '<button type="submit" onclick="location.href=\''.$_SERVER['php_self'].'?action=get&page='.$page.'&delId='.$id.'\';
    ">Delete</button>';
    if (isset($_GET['delId'])){
        $delId = $_GET['delId'];
        $db->query("DELETE FROM news WHERE id=".$delId) or die ("Failed to delete the post");
        echo '<script type="text/javascript">
            window.location.href="'.$_SERVER['php_self'].'?action=get&page='.$page.'";
            </script>';
    }


}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>