<?php

function selectBlogPreviews($account_id, $total, $page){
    
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sql = 'SELECT * FROM Blog_posts WHERE (Blog_posts.account_id = :account_id';
    $sql .= ') ORDER BY Blog_posts.blog_post_id DESC LIMIT ' . $total;
    if($page >= 1){
        $sql .= ' OFFSET ' . (($page-1)*10);
    }
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':account_id', $account_id, SQLITE3_INTEGER); 
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