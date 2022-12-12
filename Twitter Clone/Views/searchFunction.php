<?php
require_once 'Models/database.php';
?>
<!DOCTYPE HTML>  
<html>
    <head>
    </head>

    <?php
    $search_query = mysqli_real_escape_string($alternate_connection_mysqli, $_POST['search']); // search function at the top of the screen
    $query = "SELECT * FROM tweets WHERE user_name LIKE '$search_query'";
    $connection = mysqli_query($alternate_connection_mysqli, $query);
    $show_rows = mysqli_num_rows($connection);
    $row = mysqli_fetch_assoc($connection);
    if ($show_rows > 0) {
        ?>
    </body>
    <table> 
        <tr>
            <th>Message </th>
            <th>Likes </th>
            <th>Image </th> 
            <th>User Name </th> 
            <th>ID </th> 
        </tr> 
        <tr> 
            <td>
                <?php echo $row['message'] ?></td>
            <td>
                <?php echo $row['likes'] ?>
            </td> 
            <td>  
                <div><img src="Images/<?= $row['photo_path'] ?>"></div>
            </td>
            <td>
                <?php echo $row['user_name'] ?>
            </td>
            <td>
                <?php echo $row['id'] ?></td>
        </tr> 	
    </table>     
    </body>
    </html>
    <?php
} else {
    echo "There are no associated users that match your search!";
}
?>
<?php
