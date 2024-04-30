<?php
    Include("blog_post.php");
    Include("blog_post_sql.php");
    function load($type, $id){
        if($type == "blog"){
            $blog_post_data = selectBlogPost($id);
            echo loadBlogPost($blog_post_data);
        }
    }
    function loadElements($type){
        if($type == "comments"){
            for($i = 1; $i < 11; $i++){
                echo "<section><p>Comment number " . $i . ".</p><button>report</button><button>delete</button></section>";
            }
        }
    }
?>