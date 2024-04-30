<?php

function selectComments($blog_post_id, $total, $page){
    
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sql = 'SELECT * FROM Comments WHERE (Comments.blog_post_id = :blog_post_id';
    $sql .= ') ORDER BY Comments.comment_id ASC LIMIT ' . $total;
    if($page >= 1){
        $sql .= ' OFFSET ' . (($page-1)*10);
    }
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':blog_post_id', $blog_post_id, SQLITE3_INTEGER); 
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