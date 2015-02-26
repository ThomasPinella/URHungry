<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Calendar</title>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
            $( document ).ready(function() {
                $('.date').click(function(){
                    if($(this).css('height') != '300px')
                    {
                        $('.date').animate({width:'160', height:'200'}, 'fast');
                    }
                    $(this).animate({width:'250', height:'300'}, 'fast');
                });
            });
        </script>
        <style>
            .parent_div
            {
                width:auto;
                margin-top:10%;
                margin-left:15%;
                /*border:3px solid blue;*/
                display:inline-block;
            }
            .date
            {
                margin:0px;
                border:3px solid black;
                width:160px;
                height:200px;
                float:left;
            }
        </style>
    </head>
    <body>
        
        <?php
            $counter = 0;
            print '<div class="parent_div">';
            //print '<div style="width:300px;height:330px;" class="date"></div>';
            while ($counter < 5)
            {
                print '<div id="'.$counter.'" class="date"></div>';
                $counter++;
            }
            print '</div>';
        ?>
    </body>
</html>
