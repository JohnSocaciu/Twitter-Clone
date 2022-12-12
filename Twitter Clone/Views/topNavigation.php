<!DOCTYPE html>
<head>
    <style>
        nav{
            font-size: 50px;
            text-align: center;
            color: #0099ff;
            background-color: deepskyblue;
            box-shadow: 2px 2px 2px black;
            font-family: fantasy;
            padding: 10px;
            margin-bottom: 0px;
            display: flex;
            justify-content: center;
        }
        a:hover{
            opacity: 70%;
            background-color: aqua;
        }
        a{
            text-decoration: none;
            display:inline-block;
            border:5px solid blue;
        }
    </style>
</head>
<header>
    <nav>
            <a href = "index.php">Home Page</a>&nbsp;
            <a href = "createAccount.php">Create Account</a>&nbsp; 
        <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) { ?> 
            <a href = "Profile.php">Search For Profile</a>&nbsp;
            <a href = "search.php">View And Search Tweets</a>&nbsp;
            <a href = "tweets.php">Tweet</a>&nbsp;
            <a href = "login.php?action=logout">log out</a>&nbsp;
            <a href = "profileTweets.php">Like Tweets</a>&nbsp;
        <?php } else { ?> 
            <a href = "login.php">Login</a>&nbsp; 
        <?php } ?> 
    </nav>
</header>