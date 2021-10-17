<?php
    include '../logout.php';
    include 'admin_staff_db.php'; 
    require_once '../../bootstrap.php';
    require_once '../../database.php';
    session_start();
    checkIfTimeout(); //NEEDS TO BE COPIED AT THE TOP OF EVERY ADMIN PAGE
    if (isset($_SESSION["auth"]) and $_SESSION["auth"] != "true")
    {
        logOut();
    }
    if(array_key_exists('logout',$_POST)){ //If user clicked to log out
        logOut(); 
    }
    if(isset($_POST["change"])){
        if($_POST["change"] == "add"){
            $change = 'add';
            echo $twig->render('admin_staff_new.html', ['change' => $change]);
        }elseif($_POST["change"] == "edit"){
            $change = 'edit';
            echo $twig->render('admin_staff_new.html', ['change' => $change,'employee_name' =>$_POST["employee_name"],'employee_position' =>$_POST["employee_position"],'employee_description' =>$_POST["employee_description"],'employee_image' =>$_POST["employee_image"],'employee_id' =>$_POST["employee_id"]]);
        }
    }
?>