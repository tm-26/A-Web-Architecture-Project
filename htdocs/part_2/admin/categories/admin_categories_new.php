<?php
    include '../logout.php';
    include 'admin_categories_db.php';
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
        if($_POST["effect"]=="add")
        {
            $category_name = htmlspecialchars($_POST["category_name"], ENT_QUOTES, 'UTF-8');
            $return = add($category_name);
            if($return == "Success")
            {
                header('Location: admin_categories.php');
            }
            else
            {
                echo "<script type='text/javascript'>alert('".$return."');location='admin_categories.php';</script>";
            }
        }
        elseif($_POST["effect"]=="edit")
        {
            $previous_name = htmlspecialchars($_POST["previous_name"], ENT_QUOTES, 'UTF-8');
            $category_name = htmlspecialchars($_POST["category_name"], ENT_QUOTES, 'UTF-8');
            
            $return = edit($previous_name, $category_name);
            if($return == "Success")
            {
                header('Location: admin_categories.php');
            }
            else
            {
                echo "<script type='text/javascript'>alert('".$return."');location='admin_categories.php';</script>";
            }
        }
    }
    if(isset($_POST["change"])){
        if($_POST["change"] == "add"){
            $change = 'add';
             // Render view
            echo $twig->render('admin_categories_new.html', ['change' => $change]);
        }
        elseif($_POST["change"] == "edit" and isset($_POST["category_name"])){
            $change = 'edit';
            $category_name = $_POST["category_name"];
            // Render view
            echo $twig->render('admin_categories_new.html', ['change' => $change,'category_name'=>$category_name]);
        }
    }
?>