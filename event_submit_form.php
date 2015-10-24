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
        <script>
            function validateForm() 
            {
            var host = document.forms["event_form"]["host"].value;
            var where = document.forms["event_form"]["where"].value;
            var when = document.forms["event_form"]["when"].value;
            var description = document.forms["event_form"]["description"].value;
            if (host == null || host == "") 
            {
                alert("Organization Name must be filled out.");
                return false;
            }
            if (where == null || where == "") 
            {
                alert("Where the event will take place must be filled out.");
                return false;
            }
            if (when == null || when == "") 
            {
                alert("When the event will take place must be filled out.");
                return false;
            }
            if (description == null || description == "") 
            {
                alert("The description must be filled out.");
                return false;
            }
}
        </script>
        
        <style>
		table.DA
		{
			margin-left:auto;
			margin-right:auto;
			/*border-collapse: collapse;*/
			border-spacing: 0;
			table-layout:fixed;
			/*border:3px solid blue;*/
			box-shadow:2px 2px 6px black;
			width:40%;
                        border-top-left-radius:20px;
                        border-top-right-radius:20px;
		}
			
		table.DA td
		{
			padding:10px;
			padding-bottom:20px;
			/*background-color:#ecedff;*/
		}
		
		table.DA tr td input
		{
			width: 400px;
		}
                /*html 
                { 
                    background: url(Sunset.jpg) no-repeat center center fixed; 
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;
                  }*/
	</style>
    </head>
    
    <body>
        <?php
            if (isset($_POST['submit']))
            {
                $ur = new Database();
                $ur->db_connect();
                $link = $_REQUEST['link'];
                $link = !empty($link) ? '"'.$link.'"' : "NULL";
                $timestamp = strtotime($_REQUEST['when']);
                $datetime = "'".date("Y-m-d H:i:s", $timestamp)."'";

                $insert_query = 'INSERT INTO free_food_events VALUES (DEFAULT, '.$datetime.', "'.$_REQUEST['where'].'", "'.$_REQUEST['host'].'", "'.$_REQUEST['description'].'", '.$link.');';
                $result = $ur->do_query($insert_query);
                //print $insert_query;
                print '<h1><center>Successfully Submitted!</center></h1><br><br>';
                print '<a href="index.php">Calendar</a><br>';
                print '<a href="event_submit_form.php">Submit another event</a>';
            }
            else
            {
                print '<h1><center>Free Food Event Form</center></h1>';
                print '<form method="POST" name="event_form" onsubmit="return validateForm()">';
                print '    <table class="DA">';
                print '         <tr><td><span style="color:red;font-size:75%;">*Required Fields</span></td></tr>';
                print '         <tr><td><span style="color:red;">*</span>Organization Name:<br>';
                print '                 <input type="text" name="host">';
                print '         </td></tr>';
                print '         <tr><td><span style="color:red;">*</span>Where:<br>';
                print '                 <input type="text" name="where">';
                print '         </td></tr>';
                print '         <tr><td><span style="color:red;">*</span>When:<br>';
                print '                 <input type="datetime-local" name="when">';
                print '         </td></tr>';
                print '         <tr><td>Link (to Facebook page, club page, or event page):<br>';
                print '                 <input type="text" name="link">';
                print '         </td></tr>';
                print '         <tr><td><span style="color:red;">*</span>Description (reason for event, foods being served, etc.):<br>';
                print '                 <textarea name="description" rows="4" cols="50"></textarea>';
                print '         </td></tr>';
                print '         <tr><td style="text-align:center;">';
                print '             <input style="width:20%;" type="submit" name="submit" value="Submit">';
                print '         </td></tr>';
                print '    </table>';
                print '</form>';
            }
        ?>
    </body>
</html>
