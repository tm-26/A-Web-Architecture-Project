<?php
    session_start();
    if (isset($_POST["item"]))
    {
        if($_POST["change"] == "add")
        {
            array_push($_SESSION["favourites"],$_POST["item"]);
        }
        else
        {
            if (($key = array_search($_POST["item"],$_SESSION["favourites"])) !== false) {
                unset(($_SESSION["favourites"])[$key]);
            }
        }

        unset($_POST["change"]);
        unset($_POST["item"]);
    }

?>