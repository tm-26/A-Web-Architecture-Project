<?php   
    include '../logout.php';
    include 'admin_welcome_db.php';
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

    if(isset($_POST["effect"]))
    {
        $_SESSION['id'] = $_POST["id"];
        $_SESSION['reviewMessage'] = $_POST["reviewMessage"];
        $_SESSION['reviewName'] =$_POST["reviewName"];
        $_SESSION['reviewStars'] =  $_POST["reviewStars"];
        
    }
    if(isset($_POST["confirm"]))
    {
        $reviewMessage = htmlspecialchars($_SESSION['reviewMessage'], ENT_QUOTES, 'UTF-8');
        $reviewName = htmlspecialchars($_SESSION['reviewName'], ENT_QUOTES, 'UTF-8');
        
        $return = editReviews($_SESSION['id'], $reviewMessage, $reviewName, $_SESSION['reviewStars']);
        
        if($return == "Success")
        {
            header('Location: admin_welcome.php');
        }
        else
        {
            echo "<script type='text/javascript'>alert('".$return."');</script>";
        }
        
    }
    // Render view
    echo $twig->render('change_image_preview_reviews.html', ['id' => $_SESSION['id'],'reviewName'=>$_SESSION['reviewName'], 'reviewMessage' =>$_SESSION['reviewMessage'],'reviewStars' => $_SESSION['reviewStars']]);

    ?>