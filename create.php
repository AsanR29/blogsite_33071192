<!DOCTYPE html>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <?php include 'php/login.php'; ?>
        <?php include 'php/elements.php'; ?>
        <script type="text/javascript" src="javascript/main.js"></script>
        
    </head>
    <body onload='imageListen()'>
    <div class="body">
    </div>
    <div id="popup_element">
    </div>
        <?php include 'php/header.php'; ?>
        <main>
            <article>
                <form method="post" action="php/receive_file.php" enctype="multipart/form-data" id="blog_form">
                    <div id="shadowArea" name="realText"></div>
                    <textarea class="editing" id="testsubject" rows="1" name="textarea"></textarea>
                    <input type="file" id="imageSubmission" name="imageSubmission" accept="image/jpeg" />
                    <input type="submit" />
                </form>
                <p id="response"></p>
            </article>
            <?php include 'php/footer.php'; ?>
            
        </main>
        <footer></footer>
    
    </body>

</html>