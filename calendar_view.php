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
                $('.date').click(function() {
                    if($(this).css('height') != '360px')
                    {
                        $('.date').animate({width:'180', height:'220'}, 'fast');
                        $('.date').find('span').animate({'font-size':'20px'}, 'fast');
                        $('.date').find('.food_table td table td').animate({'font-size':'12px'}, 'fast');

                    }
                    $(this).animate({width:'300', height:'360'}, 'fast');
                    $(this).find('span').animate({'font-size':'30px'}, 'fast');
                    $(this).find('.food_table td table td').animate({'font-size':'30px'}, 'fast');
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
            
            .date:hover
            {
                cursor:pointer;
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
            
            #a0 .food_table td table td
            {
                font-size:30px;
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
                /*display:block;*/
                /*height:50px;*/
                border-spacing:0;
                border-collapse:collapse;
            }
            
            .food_table td table td
            {
                font-size:12px;
                border:none;
            }
            
            .food_table td table .event_detail
            {
                text-align:right;
            }
            
            .food_table td table .event_time
            {
                text-align:left;
            }
                     
            html 
            { 
                background: url(new_bg.jpg) no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            
            .black_overlay
            {
                display: none;
                position: absolute;
                top: 0%;
                left: 0%;
                width: 100%;
                height: 100%;
                background-color: black;
                z-index:1001;
                opacity:.70;
                filter: alpha(opacity=70);
            }
            
            .white_content 
            {
                display: none;
                position: absolute;
                top: 25%;
                left: 25%;
                width: 50%;
                height: 50%;
                padding: 16px;
                border-radius:8px;
                background-color: white;
                z-index:1002;
                overflow: auto;
            }

            #loginbutton 
            {
                transition:background-color 0.2s ease;
                background-color:white;
                border-radius:6px;
                padding:6px;
                float:right;
                color:black;
                cursor:pointer;
            }
            
            #loginbutton:hover
            {
                background-color:green;
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
                $query = "SELECT * FROM free_food_events WHERE '$dateformat' = date(event_when) ORDER BY event_when;";
                $result = $ur->do_query($query);
                $counter = 0;
                while ($row = mysqli_fetch_array($result))
                {
                    print '<tr><td onclick="document.getElementById(\'detail_view'.$counter.'\').style.display=\'block\';document.getElementById(\'fade\').style.display=\'block\'">';
                    print '<table style="width:100%;">';
                    print '<tr><td class="event_time" rowspan="2">'.date('g:ia', strtotime($row['event_when'])).'</td>';
                    print '<td class="event_detail">'.$row['event_host'].'</td></tr>';
                    print '<tr><td class="event_detail">'.$row['event_where'].'</td></tr>';
                    print '</table>';
                    //print $row['event_host'];
                    //print '<br>';
                    //print $row['event_where'];
                    //print '<br>';
                    //print date('g:i a', strtotime($row['event_when']));
                    print '</td></tr>';
                    createDetailView($counter, $row);
                    $counter++;
                }
                if ($counter == 0)
                {
                    print '<tr><td>No free food today :(</td></tr>';
                }
                print '</table>';
                //return 
            }
            
            function createDetailView($num, $row)
            {
                print '<div id="detail_view'.$num.'" class="white_content">'.$row['event_host'].'<br>'.$row['event_where'].'<br>'.date('g:ia', strtotime($row['event_when'])).'<br><br>'.$row['description'].'<br><br>Link: <a href="http://'.$row['link'].'">'.$row['link'].'</a><a style="position:absolute;top:12px;right:12px" href="javascript:void(0)" onclick = "document.getElementById(\'detail_view'.$num.'\').style.display=\'none\';document.getElementById(\'fade\').style.display=\'none\'">Close</a></div>';
                print '<div id="fade" class="black_overlay"></div>';
            }
        ?>   
                <div onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" id="loginbutton" class="popupbutton">Club Login</div>
                
                <div id="light" class="white_content">This is the lightbox content. <a href="javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
                <div id="fade" class="black_overlay"></div>
        
    </body>
</html>