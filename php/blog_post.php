<?php

function loadBlogPost($blog_post){
    //put comment id into the report button. account_id into the block button
    $response = "<h2>";
    $response .= $blog_post[0]["title"] . "</h2>";
    for($i = 1; $i < count($blog_post); $i++){
        $boi = $blog_post[$i];
        if(isset($boi["type"])){
            $response .= "<img src='userfiles/" . $boi["blog_file_id"];
            switch($boi["type"]){
                case 1:
                    $response .= ".png";
                    break;
            }
            $response .= "'>";
        }
        else{ 
            if(isset($boi["contents"])){
                $response .= "<p>" . $boi["contents"] . "</p>";
            }
            else{
                $response .= "<label>" . $boi["position"] . "</label>";
            }
        }
    }
    
    return $response;
}

?>