<?php
    require_once '../logout.php';
    require_once 'admin_dishes_db.php'; 
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

    $db = new Db();   
    $category_name = $db -> select("SELECT * FROM category");
    if(isset($_POST["change"])){
        if($_POST["change"] == "add"){
            $change = 'add';
            echo $twig->render('admin_dishes_new.html', ['change' => $change,'categories'=>$category_name]);
        }elseif($_POST["change"] == "edit" and isset($_POST["item_name"])){
            $change = 'edit';
            echo $twig->render('admin_dishes_new.html', ['change' => $change,'categories'=>$category_name, 'item_image'=>$_POST['item_image'],'item_category' =>$_POST["item_category"],'item_name' =>$_POST["item_name"],'item_id' =>$_POST["item_id"],'item_price' =>$_POST["item_price"],'item_description' =>$_POST["item_description"]]);
        }
    }
   
?>
