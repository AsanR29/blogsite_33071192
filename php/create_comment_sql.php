<?php

function createComment($account_id, $blog_post_id, $contents, $date){
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sql = 'INSERT INTO Comments(account_id, blog_post_id, contents, date) VALUES(:account_id, :blog_post_id, :contents, :date)';
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':account_id', $account_id, SQLITE3_INTEGER);
    $stmt->bindParam(':blog_post_id', $blog_post_id, SQLITE3_INTEGER);
    $stmt->bindParam(':contents', $contents, SQLITE3_TEXT);
    $stmt->bindParam(':date', $date, SQLITE3_TEXT);
    $result = $stmt->execute();
    
    return $result;
}

?>