<?php

function loadComment($i, $comment, $expand){
    //put comment id into the report button. account_id into the block button
    $comment_id = $comment["comment_id"];
    $account_id = $comment["account_id"];
    $contents = $comment["contents"];
    $date = $comment["date"];

    $response = "<section class='comment' id='" . $i . "'><p>" . $contents . "</p><label>Date: " . $date;
    if($expand){
        $response .= "<button onclick='dropdownLoad(" . '"comment_reports"';
        $response .= ', "s';
        $response .= $i . '", ';
        $response .= $comment_id . ", 1, 5)'>Expand</button>";
    }
    else{
        $response .= "<button>report</button><button>delete</button>";
    }
    $response .= "</label></section><section class='shadow' id='s" . $i . "'></section>";
    return $response;
}

?>