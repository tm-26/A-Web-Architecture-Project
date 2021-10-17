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
        $_SESSION['which_effect'] = $_POST["effect"];
        $_SESSION['id'] = $_POST["id"];
        $_SESSION['welcomeMessage'] = $_POST["welcomeMessage"];
        $_SESSION['welcomeTitle'] = $_POST["welcomeTitle"];
        
    }

    if(isset($_POST["confirm"])){
        $welcomeMessage = htmlspecialchars($_SESSION['welcomeMessage'], ENT_QUOTES, 'UTF-8');
        $welcomeTitle = htmlspecialchars($_SESSION['welcomeTitle'], ENT_QUOTES, 'UTF-8');
        
        $return = editWelcome($_SESSION['id'],$welcomeMessage, $welcomeTitle);
        
        if($return == "Success")
        {
            header('Location: admin_welcome.php');
        }
        else
        {
            echo "<script type='text/javascript'>alert('".$return."');</script>";
        }
    }
 

    echo $twig->render('change_image_preview_welcomeMessage.html', ['id' => $_SESSION['id'],'welcomeMessage' => $_SESSION['welcomeMessage'], 'welcomeTitle' => $_SESSION['welcomeTitle']]);

    ?>  