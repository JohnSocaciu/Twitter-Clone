<!DOCTYPE html>
<html>
    <head>
        <style>body{
                background: linear-gradient(to right, lightblue, blue);
            }
            img{
                margin-top: 20px;
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-bottom: 20px; 
                width: 50%;
            }
        </style>
    </head>
    <?php
    include'Views/topNavigation.php';
    session_start();
    require_once'Models/database.php';
    require_once'Models/tweets.php';
    require_once 'Models/login.php';
    ?> 
    <body> 

        <img src="Images/twitterLogo.jpg"/>
        <?php
        try {
            if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
                $tweets = list_tweets_from_follows();
                include ("Views/index.php");
            }
        } catch (Exception $ex) {
            $error_message = $ex->getMessage();
            include('Views/error.php');
        }

        include 'Views/footer.php';
        ?> 
    </body>
</html>