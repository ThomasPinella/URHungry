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
        <title>Calendar</title>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
            $( document ).ready(function() {
                $('.date').click(function(){
                    if($(this).css('height') != '360px')
                    {
                        $('.date').animate({width:'180', height:'220'}, 'fast');
                        $('.date').find('span').animate({'font-size':'20px'}, 'fast');

                    }
                    $(this).animate({width:'300', height:'360'}, 'fast');
                    $(this).find('span').animate({'font-size':'30px'}, 'fast');
                });
            });
        </script>
        <style>
            .parent_div
            {
                width:auto;
                margin-top:10%;
                margin-left:8%;
                /*border:3px solid blue;*/
                display:inline-block;
            }
            .date
            {
                margin:0px;
                border:3px solid black;
                width:180px;
                height:220px;
                float:left;
            }
            
            .date span
            {
                font-size:20px;
                margin-left:10px;
            }
            
            #a0 span
            {
                font-size:30px;
            }
            
            #a0
            {
                border-top-left-radius:20px;
                width:300px;
                height:360px;
            }
            
            #a4
            {
                border-top-right-radius:20px;
            }
        </style>
    </head>
    <body>
        
        <?php
            $counter = 0;
            print '<div class="parent_div">';
            $date = new DateTime();
            while ($counter < 5)
            {
                print '<div id="a'.$counter.'" class="date">';
                $month = (int)$date->format('m');
                $day = (int)$date->format('d');
                $day_of_week = $date->format('l');
                print '<span>'.$month.'/'.$day.' '.$day_of_week.'</span>';
                createTable($date);
                $date->modify('+1 day');
                print '</div>';
                $counter++;
            }
            print '</div>';
            
            function createTable($current_date)
            {
                print '<table>';
                $ur = new Database();
                $ur->db_connect();
                $dateformat = $current_date->format('Y-m-d');
                $query = "SELECT * FROM free_food_events WHERE '$dateformat' = date(event_when)";
                //print $query;
                $result = $ur->do_query($query);
                
                while ($row = mysqli_fetch_array($result))
                {
                    print '<tr><td>';
                    print $row['event_host'];
                    print '</td></tr>';
                    //print $row['event_where'];
                    print '<br />';
                }
                print '</table>';
            }
        ?>
    </body>
</html>
