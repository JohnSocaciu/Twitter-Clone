<head>
    <style>
        h1{
            text-align: center;
            font-size: 40px;
        }
        form{
            display:flex;
            justify-content: center;
        }
        body{
            background: linear-gradient(to right, lightblue, blue);
        }
    </style>
</head>
<?php include 'Views/topNavigation.php'; ?>
<body>

    <h1><?php echo $id; ?>'s Tweets - From The Associated ID</h1>
    <form action="profileTweets.php?id= <?php echo $id; ?>" method="post">
        <input type="submit" name="like" value="Like Tweet"/>
    </form>
    
        <?php include ("Views/index.php"); ?> 
    <?php include('footer.php'); ?> 
</body>