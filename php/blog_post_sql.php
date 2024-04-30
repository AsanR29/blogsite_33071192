<?php

function selectBlogPost($blog_post_id){
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sqls = array(
        0 => 'SELECT * FROM Blog_posts WHERE (Blog_posts.blog_post_id = :blog_post_id)',
        1 => 'SELECT Blog_text.blog_text_id,Blog_text.contents,Blog_text.position FROM Blog_text WHERE (Blog_text.blog_post_id = :blog_post_id) ORDER BY position ASC',
        2 => 'SELECT blog_file_id,type,alt_text,position FROM Blog_files WHERE (Blog_files.blog_post_id = :blog_post_id) ORDER BY position ASC',
    );

    $data = array();
    for($j = 0; $j < 3; $j++){
        $stmt = $db->prepare($sqls[$j]);
        $stmt->bindParam(':blog_post_id', $blog_post_id, SQLITE3_INTEGER); 
        $result = $stmt->execute();

        if($j == 0){
            $data[0] = $result->fetchArray();
        }
        else{
            while($row = $result->fetchArray()){
                $data[$row["position"]] = $row;
            }
        }
    }
    return $data;
}

?>