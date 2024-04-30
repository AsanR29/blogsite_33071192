<?php
if(isset($_POST["submit"])){
    if(isset($_POST["tag"])){
        header("Location: search.php?view=blog&tag=" . $_POST["tag"]);
    }
}
?>

<header>
<div class="header">
<h1 class="header">Incredible blog website</h1>
<form method="post">
<input class="header" list="header_list" name="tag">
<datalist id="header_list">
<option value="Naruto"></option>
<option value="Sasuke"></option>
</datalist>
</input>
<input type="submit" value="Search" name="submit"></input>
</form>
<div><?php echo $user_id; ?><div>
</div>
</header>