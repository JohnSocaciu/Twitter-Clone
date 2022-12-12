<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Page</title>
        <style>
            form{
                font-size: 25px;
                color: #6666ff;
                display:block;
                box-shadow: 2px 2px 2px black;
            }
            label{
                font-size: 25px;
            }
            input{
                font-size: 25px;
                margin-top: 10px;
            }
            h2{
                font-size:35px;
                color: blue;
            }
            body{
                background: linear-gradient(to right, lightblue, blue);
            }
        </style>
    </head>
    <?php include ('topNavigation.php'); ?> 
    <br>
    <body>
        <h2>Login</h2>
        <?php echo $message; ?> 
        <form action="login.php" method="post">
            <label>User Name:</label>
            <input type="text" name="user_name"/><br>
            <label>Password:</label>
            <input type="password" name="password_hash"/><br>
            <label>&nbsp;</label> 
            <input type="submit" name="submit" value="Login"/>
        </form>
    </body>
    <?php include('footer.php'); ?> 
</html>