<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Submit Tweets</title>
        <style>
            form{
                font-size: 25px;
                color: #6666ff;
                display:block;
                box-shadow: 2px 2px 2px black;
            }
            label{
                font-size: 25px;
                text-shadow: 1px 1px 1px black;
            }
            input{
                font-size: 25px;
                margin-top: 10px;
            }
            h2{
                font-size:35px;
                color: blue;
                text-shadow: 2px 2px 2px black;
            }
            body{
                background: linear-gradient(to right, lightblue, blue);
            }
        </style>
    </head>
    <?php include ('topNavigation.php'); ?> 
    <br>
    <body>
        <h2>Create Tweet: </h2>
        <form action="tweets.php" method="post" enctype="multipart/form-data">
            <label>Include An Image: </label>
            <input type="file" name="photo_path"><br/>
            <label>Include Your Message: </label>
            <input type="text" name="message"><br>
            <label>&nbsp;</label> 
            <input type="submit" name ="submit" value="Send Tweet"/>
        </form>

    </body>
    <?php include('footer.php'); ?> 
</html>

