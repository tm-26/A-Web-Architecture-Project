<?php
    //starts a session
    session_start();
    //sets the timezone to Malta
    date_default_timezone_set('Europe/Malta');

    //if there is a previous session
    if (isset($_SESSION['last_session_time'])) 
    {   
        /*Note: strtotime will be used to convert a string containing the date into a Unix timestamp in order
        to be able to get the time difference in seconds*/
        //gets current date and saves it in current_session_time
        $current_session_time = strtotime(date('d-m-Y H:i:s'));
        //gets time from the previous session and saves it in last_session_time_variable
        $last_session_time_variable = strtotime($_SESSION['last_session_time']);

        //difference in seconds between sessions
        $difference = $current_session_time - $last_session_time_variable;

        //echos difference between sessions
        echo 'Your last session was ',$difference,' seconds ago';

        //sets the session's last_session_time to the current date
        $_SESSION['last_session_time'] = date('d-m-Y H:i:s');
    }
    else //there is no previous session
    {
        //saves current date to variable current_session_time
        $current_session_time = date('d-m-Y H:i:s');

        //informs user that it is the first session and prints the current session time
        echo 'This is your first session at time: ';
        echo $current_session_time;

        ///sets the session's last_session_time to current_session_time
        $_SESSION['last_session_time'] = $current_session_time;
    }
?>