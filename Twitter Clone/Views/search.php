<!DOCTYPE HTML>  
<html>
    <head>
            <form action="search.php" method="post">
                <input type="text" name="search" placeholder="/"/>
                <input type="submit" name="submit" value="Submit Search"/>
                <input type='hidden' name='action' value='search'/></form>
            </form>
        <meta charset="UTF-8">
        <style>
            input{
                 height: 75px;
                 font-size: 25px;
            }
            img{
                width: 500px;
            }
            table{
                width: 100%;
                font-size: 35px;
                background-color: #0099ff;
                border-collapse: collapse;
                border: 2px solid black;
            }
            td{
                text-align: center;
                border: 2px solid black;
            }
            body{
                background: linear-gradient(to right, lightblue, blue);
            }
        </style>
    </head>
    <?php include ('topNavigation.php'); ?> 
    <?php
    include 'Models/database.php';
    $query = "SELECT message, likes, user_name, photo_path, id FROM tweets";
    $connection = mysqli_query($alternate_connection_mysqli, $query);

    if (mysqli_num_rows($connection) > 0) {
        ?>
        <table> 
            <tr>
                <th>Message </th>
                <th>Likes </th>
                <th>Image </th> 
                <th>User Name </th> 
                <th>ID </th> 
            </tr> 
            <?php foreach ($tweets as $tweet): ?>
                <tr> 
                    <td><?php echo $tweet->get_message(); ?></td>
                    <td><?php echo $tweet->get_likes(); ?>
                    </td> 
                    <td>
                        <?php $images = mysqli_fetch_assoc($connection) ?>    
                        <div><img src="Images/<?= $images['photo_path'] ?>"></div>
                    </td>
                    <td><?php echo $tweet->get_user_name(); ?>
                    </td>
                    <td><?php echo $tweet->get_photo_path(); ?></td>
                </tr> 
            <?php endforeach; ?> 	
        </table>     
    <?php } ?>
</body>
<?php include('footer.php'); ?> 
</html>
