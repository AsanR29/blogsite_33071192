<?php

function loadBlogPreview($i, $blog_preview){
    //put comment id into the report button. account_id into the block button
    $blog_id = $blog_preview["blog_post_id"];
    $account_id = $blog_preview["account_id"];
    $date = $blog_preview["date"];
    $visibility = $blog_preview["visibility"];
    $title = $blog_preview["title"];
    $preview = $blog_preview["preview"];

    $response = "<section class='blog_preview' id='" . $i . "'><h2>" . $title . "</h2><p>" . $preview . "</p><label>Date: " . $date . "<a href='view.php?blog=" . $blog_id . "'><button>Read</button></a></section>";
    return $response;
}

?>