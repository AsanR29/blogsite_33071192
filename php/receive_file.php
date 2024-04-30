<?php
//var_dump(array_values($_POST));
//var_dump($_FILES);
$file_name = $_FILES["imageSubmission"]["name"];
$file_temp_location = $_FILES["imageSubmission"]["tmp_name"];
if(!$file_temp_location){
    echo 'Error';
}
if(move_uploaded_file($file_temp_location, "../userfiles/$file_name")){
    echo "$file_name upload is complete";
}   else {
    echo "failed to move the file.";
}
exit();

if($_FILES){
    echo "Hello";
    return;
    if(isset($_FILES["imageSubmission"])){
        foreach($_FILES["imageSubmission"] as $key => $row){
            echo $row;
        }
    }
}
else if(isset($_FILES["imageSubmission"])){
    echo "image submission";
}
else if(isset($_FILES["name"])){
    echo "name ig";
}
else{
    print_r($_FILES);
    echo $_FILES["imageSubmission"]["name"];
}
?>