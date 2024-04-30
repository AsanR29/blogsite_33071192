<!DOCTYPE html>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <?php include 'php/login.php'; ?>
        <?php include 'php/elements.php'; ?>
        <script type="text/javascript" src="javascript/main.js"></script>
        
    </head>
    <body>
    
    <div class="body">
    </div>
        <?php include 'php/header.php'; ?>
        <main>
            <article id="signup_container">
                <form>
                <h2>Sign up</h2>
                <label>Username:</label>
                <input type="text" id="username"></input><br>
                <label>Password:</label>
                <input type="text" id="password"></input>
                <input type="button" value="Create" onclick="createAccount()"></input>
                </form>
                <label id="response"></label>
                <?php include 'php/footer.php'; ?>
            </article>
            
            
        </main>
        <footer></footer>
    
    </body>

</html>