<?php
Include("comment.php");
Include("comments_sql.php");
Include("comment_report.php");
Include("comment_reports_sql.php");
Include("blog_preview.php");
Include("blog_previews_sql.php");
Include("create_account_sql.php");

Include("login_sql.php");
Include("session_sql.php");
Include("create_comment_sql.php");
Include("popup_login.php");

Include("blog_files_sql.php");
if($_POST["file"] == "comments"){
    $total = 0;
    $blog_post_id = -1;
    $page = 1;
    if( (!isset($_POST["total"])) || ($_POST["total"] < 1) || (!isset($_POST["id"]))){
        return;
    }
    if(isset($_POST["page"]) && $_POST["page"] != null){
        $page = $_POST["page"];
    }
    $total = $_POST["total"];
    $blog_post_id = $_POST["id"];
    
    $comments_array = selectComments($blog_post_id, $total, $page);
    for($i = 0; $i < count($comments_array); $i++){
        echo loadComment($i, $comments_array[$i], false);
    }
}
if($_POST["file"] == "comment_reports"){
    $total = 0;
    $comment_id = null;
    $page = 1;
    if( (!isset($_POST["total"])) || ($_POST["total"] < 1) ){
        return;
    }
    if(isset($_POST["page"]) && $_POST["page"] != null){
        $page = $_POST["page"];
    }
    if(isset($_POST["comment_id"])){
        $comment_id = $_POST["comment_id"];
    }
    $total = $_POST["total"];

    $comments_array = selectCommentReports($comment_id, $total, $page);
    for($i = 0; $i < count($comments_array); $i++){
        echo loadCommentReport($i, $comments_array[$i]);
    }
}

if($_POST["file"] == "reported_comments"){
    $total = 0;
    $account_id = null;
    $page = 1;
    if( (!isset($_POST["total"])) || ($_POST["total"] < 1) ){
        return;
    }
    if(isset($_POST["page"]) && $_POST["page"] != null){
        $page = $_POST["page"];
    }
    if(isset($_POST["account_id"])){
        $account_id = $_POST["account_id"];
    }
    $total = $_POST["total"];
    
    $comments_array = selectReportedComments($account_id, $total, $page);
    for($i = 0; $i < count($comments_array); $i++){
        echo loadComment($i, $comments_array[$i], true);
    }
}

if($_POST["file"] == "blog"){
    $total = 0;
    $account_id = null;
    $page = 1;
    if( (!isset($_POST["total"])) || ($_POST["total"] < 1) || (!isset($_POST["account_id"])) ){
        return;
    }
    if(isset($_POST["page"]) && $_POST["page"] != null){
        $page = $_POST["page"];
    }
    $account_id = $_POST["account_id"];
    $total = $_POST["total"];

    $blogs_array = selectBlogPreviews($account_id, $total, $page);
    for($i = 0; $i < count($blogs_array); $i++){
        echo loadBlogPreview($i, $blogs_array[$i]);
    }
}

if($_POST["file"] == "create_account"){
    session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];
    $type = 1;
    $result = createAccount($username, $password, $type);
    if($result){
        $account_id = accountLogin($username, $password);
        deleteSessions($account_id);
        $session_id = createSession($account_id);
        $_SESSION["session"] = $session_id;
        echo 1;
    }
    else{
        echo 0;
    }
}

if($_POST["file"] == "login_account"){
    session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];
    $account_id = accountLogin($username, $password);
    if($account_id){
        deleteSessions($account_id);
        $session_id = createSession($account_id);
        $_SESSION["session"] = $session_id;
        echo 1;
    }
    else{
        echo 0;
    }
}

if($_POST["file"] == "create_comment"){
    $account_id = $_POST["account_id"];
    $blog_post_id = $_POST["blog_post_id"];
    $contents = $_POST["contents"];
    $date = $_POST["date"];
    echo createComment($account_id, $blog_post_id, $contents, $date);
}

if($_POST["file"] == "popup_login"){
    session_start();
    $action = "";
    if(isset($_POST["value"])){
        $action = $_POST["value"];
    }
    if(isset($_POST["save_value"])){
        $_SESSION["comment"] = $_POST["save_value"];
    }
    else{
        $_SESSION["comment"] = "FAIL";
    }
    echo popup_login($action);
}

if($_POST["file"] == "signup"){
    header("Location: ../signup.php");
}

if($_POST["file"] == "lastFile"){
    echo getLastFilename();
}
?>