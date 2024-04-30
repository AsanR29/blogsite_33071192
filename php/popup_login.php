<?php
function popup_login($action){
    echo '<div class="prompt popup"><h2>Only registered users can ' . $action . '. Either log in or sign up to continue:</h2><footer><div class="footer_buttons_right"><a href="login.php"><button class="footer_button"</a>Log in</button><a href="signup.php"><button class="footer_button">Sign up</button></a><button class="footer_button" onclick="popupUnload(' . "'popup_login'" . ')">Back</button></div></footer></div>';
}
?>