<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create Account</title>
        <style>
            form{
                font-size: 25px;
                color: #6666ff;
                display:block;
                box-shadow: 2px 2px 2px black;
            }
            table{
                border-collapse: collapse;
                border: 2px solid blue;
                font-size: 25px;
            }
            tr{
                border:2px solid blue;
            }
            th{
                background-color: lightskyblue;
            }
            td{
                border:2px solid blue;
                background-color: beige
            }
            body{
                background: linear-gradient(to right, lightblue, blue);
            }
            h2{
                font-size:25px;
                color: blue;
            }
            input{
                font-size: 23px;
                display: block;
                box-shadow: 2px 2px 2px black;
            }
        </style> 
    </head>
    <?php include('topNavigation.php'); ?> 
    <body>
        <header><h2>Accounts Created on This Social Media Platform: </h2></header>
        <table> 
            <tr>
                <th>User Name </th>
                <th>User ID </th> 
                <th>Password </th>
                <th>Email Address </th> 
            </tr> 
            <?php foreach ($users as $user): ?>
                <tr> 
                    <td><?php echo $user->get_email_address(); ?></td> 
                    <td><?php echo $user->get_password(); ?></td> 
                    <td><?php echo $user->get_id(); ?></td>
                    <td><?php echo $user->get_user_name(); ?></td>
                </tr> 
            <?php endforeach; ?> 
        </table> 
    </table> 
    <h2> Create User Account: </h2>  
    <form action="createAccount.php" method="post">
        <label>First Name and Last Name: </label> 
        <input type="text" name="user_name"/><br>
        <labal>Password: </labal>
        <input type="password" name="password_hash"/><br>
        <label>Email Address: </label>
        <input type="text" name="email_address"/><br>
        <input type='hidden' name='action' value ='insert'/><br>
        <label>&nbsp;</label> 
        <input type="submit" value = "Add User"/>
    </form>
    <h2> Update User Account: </h2>
    <form action="createAccount.php" method="post">
        <label>First Name and Last Name: </label> 
        <input type="text" name="user_name"/><br>
        <labal>Password: </labal>
        <input type="password" name="password_hash"/><br>
        <label>Email Address: </label> 
        <input type="text" name="email_address"/><br>
        <input type='hidden' name='action' value ='update'/><br>
        <label>&nbsp;</label> 
        <input type="submit" value = "Update User"/>
    </form>
    <br>
</body>
<?php include('footer.php'); ?> 
</html>
