<?php 
    require_once 'logout.php';
    require_once '../bootstrap.php';
    require_once '../database.php';
    $username = "admin";
    $password = "admin";
    $userIN = $passIN = "";

    date_default_timezone_set('Europe/Malta');

    if (isset($_POST["username"]) && isset($_POST["password"]))  {   
        $userIN = htmlspecialchars($_POST["username"]);
        $passIN = htmlspecialchars($_POST["password"]);
        
        if ($userIN == $username && $passIN == $password){ //user entered correct credentials
            ini_set('session.cookie_httponly', '1' ); //sets the cookie to be passed as HTTPOnly
            session_start();       
            $_SESSION["auth"] = "true";
            $_SESSION["created"] = strtotime(date('d/m/Y H:i:s'));
            header("Location: categories/admin_categories.php"); /* Redirect browser */
        }else{
            echo('<script> alert("Invalid details!"); </script>');
        }
    }
    
    echo $twig->render('admin.html', ["action" => htmlspecialchars($_SERVER["PHP_SELF"])]);    
?>

