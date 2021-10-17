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
    if($_POST["id"] == 1){
        $whichReview = "Left";
    }
    else if($_POST["id"] == 2){
        $whichReview = "Middle";
    }
    else if($_POST["id"] == 3){
        $whichReview = "Middle";
    }
   // Render view
   echo $twig->render('admin_welcome_edit_review.html', ['whichReview' => $whichReview, 'reviewStars'=>$_POST["reviewStars"], 'reviewName'=>$_POST["reviewName"],'reviewMessage'=>$_POST["reviewMessage"], 'id' => $_POST["id"]]);
?>