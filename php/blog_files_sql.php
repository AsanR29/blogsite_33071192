<?php

function getLastFilename(){
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sql = 'SELECT MAX(blog_file_id) FROM Blog_files';
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    $row = $result->fetchArray();
    if($row){
        return $row[0];
    }
    else{
        return 0;
    }
}

?>