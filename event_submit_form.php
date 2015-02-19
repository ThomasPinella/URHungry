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
    <style>
		table.DA
		{
			margin-left:auto;
			margin-right:auto;
			border-collapse: collapse;
			border-spacing: 0;
			table-layout:fixed;
			border:3px solid blue;
			box-shadow:2px 2px 6px black;
			width:40%;
		}
			
		table.DA td
		{
			padding:10px;
			padding-bottom:20px;
			background-color:#ecedff;
		}
		
		table.DA tr td input
		{
			width: 400px;
		}
	</style>
    <body>
        <?php
            if (isset($_POST("submit")))
            {
                //insert query here. And success message, link back to calendar and submit page.
            }
            else
            {
                echo "hi";
                print '<h1><center>Free Food Event Form</center></h1>';
                print '<form method="POST" name="event_form">';
                print '    <table class="DA">';
                print '         <tr><td>Organization Name:< /br>';
                print '                 <textarea name="host" rows="1" cols="50"></textarea>';
                print '         </td></tr>';
                print '         <tr><td>Where:< /br>';
                print '                 <textarea name="where" rows="1" cols="50"></textarea>';
                print '         </td></tr>';
                print '         <tr><td>When:< /br>';
                print '    </table>';
                print '</form>';
            }
        ?>
    </body>
</html>
