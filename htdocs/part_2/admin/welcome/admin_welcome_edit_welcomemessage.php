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
    echo $twig->render('admin_welcome_edit_welcomemessage.html', ['welcomeTitle' => $_POST["welcomeTitle"], 'welcomeMessage'=>$_POST["welcomeMessage"],'id'=>$_POST["id"],'which'=>$_POST["which"]]);
?>