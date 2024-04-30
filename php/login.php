<?php
Include("session_sql.php");
$user_id = -1;
//do session unset stuff for the user_id and session id
$blog_id = -1;
$page = 1;
$element_id = -1;

$comment = "";

session_start();
if(isset($_SESSION["session"])){
    $user_id = loadSession($_SESSION["session"]);
}
if(isset($_SESSION["comment"])){
    $comment = $_SESSION["comment"];
}

$content_type = "";
if(isset($_GET["blog"])){
    $blog_id = $_GET["blog"];
}
if(isset($_GET["page"])){
    $page = $_GET["page"];
}
if(isset($_GET["account"])){
    $element_id = $_GET["account"];
}
if(isset($_GET["comment"])){
    $element_id = $_GET["comment"];
}
if(isset($_GET["view"])){
    $content_type = $_GET["view"];
    //blogs, comments, blog_reports, comment_reports
}
?>