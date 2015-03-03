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
                background-color:white;
                margin:0px;
                border-top:3px solid black;
                border-bottom:3px solid black;
                border-right:3px solid black;
                width:180px;
                height:220px;
                float:left;
                overflow-y:scroll;
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
                border-left:3px solid black;
                width:300px;
                height:360px;
            }
            
            #a4
            {
                border-top-right-radius:20px;
            }
            
            .food_table
            {
                table-layout:fixed;
                width:100%;
                /*height:89%;*/
                /*border:3px solid black;*/
            }
            
            .food_table td
            {
                border:2px solid black;
                display:block;
                height:50px;
                border-spacing:0;
                border-collapse:collapse;
            }
                     
            html 
            { 
                background: url(urh_bg.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
              }
        </style>
    </head>
    <body>
        <?php
            $counter = 0;
            print '<div class="parent_div">';
            $date = new DateTime();
            $date->setTimezone(new DateTimeZone('America/New_York'));
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
                print '<table cellspacing="0" class="food_table">';
                $ur = new Database();
                $ur->db_connect();
                $dateformat = $current_date->format('Y-m-d');
                $query = "SELECT * FROM free_food_events WHERE '$dateformat' = date(event_when);";
                $result = $ur->do_query($query);
                $counter = 0;
                while ($row = mysqli_fetch_array($result))
                {
                    print '<tr><td>';
                    print $row['event_host'];
                    print '<br>';
                    print $row['event_where'];
                    print '<br>';
                    print date('g:i a', strtotime($row['event_when']));
                    print '</td></tr>';
                    $counter++;
                }
                if ($counter == 0)
                {
                    print '<tr><td>No free food today :(</td></tr>';
                }
                print '</table>';
            }
        ?>
    </body>
</html>
