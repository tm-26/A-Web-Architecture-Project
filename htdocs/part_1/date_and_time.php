<?php
    //sets the timezone to Malta
    date_default_timezone_set('Europe/Malta');

    //saves date in variable current_date
    $current_date = date('d/m/Y');

    //saves time in variable current_time
    $current_time = date('H:i:s');

    //echos the date and time
    //nl2br is used to insert HTML line breaks before all newlines in a string
    echo nl2br ("Current date on this server is $current_date\nCurrent time on this server is $current_time");
?>