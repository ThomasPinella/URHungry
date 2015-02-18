<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    session_start();
    require_once('Database.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>UR Hungry</title>
    </head>
    <body>
        <?php
            echo "Hi! Blah blah!";
            echo '<br />';
            /*$link = mysqli_connect(null, 'root', 'root', 'ur_hungry', 3306, '/Applications/MAMP/tmp/mysql/mysql.sock');
            $result = mysqli_query($link, 'SELECT * FROM free_food_events');
            
            while ($row = mysqli_fetch_array($result))
            {
                print $row['event_where'];
                print '<br />';
            }*/

            $ur = new Database();
            $ur->db_connect();
            $result = $ur->do_query('SELECT * FROM free_food_events');
            
            while ($row = mysqli_fetch_array($result))
            {
                print $row['event_where'];
                print '<br />';
            }
        ?>
    </body>
</html>
