<!DOCTYPE html>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <?php include 'php/login.php'; ?>
        <?php include 'php/elements.php'; ?>
        <script type="text/javascript" src="javascript/main.js"></script>
        
    </head>
    <body onload='bodyLoad("<?php echo $content_type; ?>", "elements", <?php echo $element_id; ?>, <?php echo $page; ?>, 10)'>
    <div class="body">
    </div>
        <?php include 'php/header.php'; ?>
        <main>
            <article id="elements_container">
                <div id="elements"></div>
                <?php include 'php/footer.php'; ?>
            </article>
            
            
        </main>
        <footer></footer>
    
    </body>

</html>