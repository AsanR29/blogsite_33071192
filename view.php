<!DOCTYPE html>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <?php include 'php/login.php'; ?>
        <?php include 'php/elements.php'; ?>
        <script type="text/javascript" src="javascript/main.js"></script>
        
    </head>
    <body onload='bodyLoad("comments", "comments", <?php echo $blog_id; ?>, <?php echo $page; ?>, 10)'>
    <div class="body">
    </div>
    <div id="popup_element">
    </div>
        <?php include 'php/header.php'; ?>
        <main>
            <article>
                <?php load('blog',$blog_id); ?>
            </article>
            <article id="leave_comment">
                <?php include 'php/comment_box.php'; ?>
            </article>
            <article id="comment_section">
                <div id="comments"></div>
                
            </article>
            <?php include 'php/footer.php'; ?>
            
            
        </main>
        <footer></footer>
    
    </body>

</html>