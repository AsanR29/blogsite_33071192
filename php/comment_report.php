<?php

function loadCommentReport($i, $comment_report){
    $comment_report_id = $comment_report["comment_report_id"];
    $type = $comment_report["type"];
    $explanation = $comment_report["explanation"];
    return "<section class='comment_report' id='r" . $i . "'><p>" . $explanation . "</p><label>Reason: " . typeToReason($type) . "</label><button>approve</button><button>dismiss</button></section><section class='shadow' id='rs" . $i . "'></section>";
}

function typeToReason($type){
    switch($type){
        case 0:
            return "Other";
        case 1:
            return "Harassment";
        case 2:
            return "Hate speech";
        default:
            return "Other";
    }
}

?>