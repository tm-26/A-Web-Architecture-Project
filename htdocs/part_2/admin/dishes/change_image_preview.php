<?php
    include '../logout.php';
    include 'admin_dishes_db.php'; 
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
        
        $_SESSION['price'] = $_POST["item_price"];
        $_SESSION['image'] = $_FILES["item_image"];
        $_SESSION['categ'] =$_POST["item_category"];
        $_SESSION['description'] =  $_POST["item_description"];
        $_SESSION['name'] = $_POST["item_name"];
        if(isset($_POST["previous_name"]) && isset($_POST["item_id"])){
            $_SESSION['id'] =$_POST["item_id"];
            
        $_SESSION['prev_name'] = $_POST["previous_name"];
        }
    }
    if(isset($_POST["confirm2"])){

        $description = htmlspecialchars($_SESSION['description'], ENT_QUOTES, 'UTF-8');
        $image = htmlspecialchars($_SESSION['image']['name'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');

        if( $_SESSION['which_effect'] =="add")
        {
            $return = add($description, $_SESSION['price'], $image, $name, $_SESSION['categ']);
            if($return == "Success")
            {
                header('Location: admin_dishes.php');
            }
            else
            {
                echo "<script type='text/javascript'>alert('".$return."');</script>";
            }
        }
        elseif($_SESSION['which_effect'] =="edit")
        {
            $prev_name = htmlspecialchars($_SESSION['prev_name'], ENT_QUOTES, 'UTF-8');

            if($_SESSION['image']['size'] != 0) {
                $return = edit($prev_name, $name, $image, $description, $_SESSION['price'], $_SESSION['id'], $_SESSION['categ']);
            } else {
                $return = edit($prev_name, $name, 0, $description,$_SESSION['price'], $_SESSION['id'],$_SESSION['categ']);
            }

            
            if($return == "Success")
            {
                header('Location: admin_dishes.php');
            }
            else
            {
                echo "<script type='text/javascript'>alert('".$return."');</script>";
            }
        }
    }
    if($_FILES['item_image']['size'] != 0) { // NEW IMAGE EXISTS
        $current_image_query = $_FILES["item_image"]['name'];
        move_uploaded_file($_FILES["item_image"]['tmp_name'], "../../images/dishes/$current_image_query");
    } else { //No new image
        $current_item = $_POST["item_id"];
        $db = new Db();   
        $query = $db -> select("SELECT `image_location` FROM `item_details` WHERE `item_id` = '$current_item'");
        $current_image_query = $query[0]["image_location"];
    }
    // Render view
    echo $twig->render('dishes_preview.html', ['item_price' => $_SESSION['price'],'item_name'=>$_SESSION['name'], 'item_image' =>$current_image_query,'item_description' =>$_POST["item_description"]]);

?>