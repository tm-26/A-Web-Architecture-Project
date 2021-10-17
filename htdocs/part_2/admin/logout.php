<?php
    function logOut(){
        session_start();
        //Forces browser to delete cookie
        setcookie(session_name(), "", time() - 3600);
        // remove all session variables (~$_SESSION = array())
        session_unset(); 
        // destroy the session (clears session store (e.g. session file))
        session_destroy(); 
        header("Location: ../admin.php", true, 302);
    }

    function checkIfTimeout(){
        date_default_timezone_set('Europe/Malta');
        $current_session_time = strtotime(date('d/m/Y H:i:s'));
        if(!isset($_SESSION["created"]) or $current_session_time - $_SESSION["created"] > 60*60){ //60 seconds * 60 minutes = 1 hour
            logOut();
        }
    }
?>
