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

    <h1><?php echo $user_name; ?>'s Profile Page</h1>
    <form action="Profile.php?user_name=<?php echo $user_name; ?>" method="post">
        <input type="submit" name="follow" value="Follow">
        <input type="submit" name="unfollow" value="Unfollow">
    </form>
    <?php include('footer.php'); ?> 
</body>