<?php

function selectCommentReports($comment_id, $total, $page){
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sql = 'SELECT * FROM  Comment_reports';
    if($comment_id != null){
        $sql .= ' WHERE Comment_reports.comment_id = :comment_id';
    }
    $sql .= ' ORDER BY Comment_reports.comment_id ASC LIMIT ' . $total;
    if($page >= 1){
        $sql .= ' OFFSET ' . (($page-1)*10);
    }
    
    $stmt = $db->prepare($sql);
    if($comment_id != null){
        $stmt->bindParam(':comment_id', $comment_id, SQLITE3_INTEGER);
    }
    $result = $stmt->execute();

    $data = array();
    $i = 0;
    while($row = $result->fetchArray()){
        $data[$i] = $row;
        $i += 1;
    }
    return $data;
}

function selectReportedComments($account_id, $total, $page){
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sql = 'SELECT * FROM Comments WHERE EXISTS (SELECT comment_id AS report_id, resolved FROM Comment_reports WHERE Comments.comment_id = report_id AND resolved=0)';
    if($account_id != null){
        $sql .= ' AND Comments.account_id = :account_id';
    }
    $sql .= ' ORDER BY Comments.comment_id ASC LIMIT ' . $total;
    if($page >= 1){
        $sql .= ' OFFSET ' . (($page-1)*10);
    }

    $stmt = $db->prepare($sql);
    if($account_id != null){
        $stmt->bindParam(':account_id', $account_id, SQLITE3_INTEGER); 
    }
    $result = $stmt->execute();

    $data = array();
    $i = 0;
    while($row = $result->fetchArray()){
        $data[$i] = $row;
        $i += 1;
    }
    return $data;
}

?>