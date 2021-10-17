<?php
    //starts a session
    session_start();

    //echos the date and time
    //nl2br is used to insert HTML line breaks before all newlines in a string
    echo nl2br ("Your parameters are:\n");

    //for each value in the session's values
    foreach($_SESSION['values'] as &$value)
    {
        //prints the value
        echo $value;
        echo nl2br ("\n");
    }
?>

<!--Redirect to form-->
<h3>Click <a href="question_4_send_data.php">here</a> to go back to the form</h3>