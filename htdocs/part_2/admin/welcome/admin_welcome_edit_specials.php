<?php
    include '../logout.php';
    include 'admin_welcome_db.php'; 
    require_once '../../bootstrap.php';
    session_start();
    checkIfTimeout(); //NEEDS TO BE COPIED AT THE TOP OF EVERY ADMIN PAGE
    if (isset($_SESSION["auth"]) and $_SESSION["auth"] != "true")
    {
        logOut();
    }
    if(array_key_exists('logout',$_POST)){ //If user clicked to log out
        logOut(); 
    }
    echo $twig->render('admin_welcome_edit_specials.html', ['name' => $_POST["Name"], 'id'=>$_POST["id"], 'item_image'=>$_POST["Image"]]);

?>