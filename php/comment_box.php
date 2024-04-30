<section class="comment">
    <textarea id="comment_text" name="comment_text"><?php if(isset($_SESSION["comment"])){ echo $_SESSION["comment"]; } ?></textarea>
</section>
<footer>
    <div class="footer_buttons_right">
        <!--<input type="submit" class = "footer_button" name="submit" value="Send"></input>-->
        <button class="footer_button" onclick="create_comment(<?php echo $user_id; ?>, <?php echo $blog_id; ?>, 'comment_text', '26022024')">Send</button>
    </div>
</footer>