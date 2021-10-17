<?php
    include '../logout.php';
    include 'admin_categories_db.php';
    require_once '../../bootstrap.php';
    require_once '../../database.php';

    session_start();
    checkIfTimeout(); 
    if (isset($_SESSION["auth"]) and $_SESSION["auth"] != "true")
    {
        logOut();
    }
    if(array_key_exists('logout',$_POST)){ //If user clicked to log out
        logOut(); 
    }

    if(isset($_POST["change"]))
    {
        if($_POST["change"]=="remove")
        {
            $category_name = htmlspecialchars($_POST["category_name"], ENT_QUOTES, 'UTF-8');
            $return = remove($category_name);
            if($return != "Success")
            {
                echo "<script type='text/javascript'>alert('".$return."');</script>";
            }
        }
    }
    
    $db = new Db();   
    $categories = $db -> select("SELECT * FROM category");
    foreach($categories as $key => $field){
        $categories[$key]['category_name'] = htmlspecialchars_decode($field['category_name'], ENT_QUOTES);
        $biggest_index = $field["category_id"];
    }
    if(!isset($_SESSION['biggest_index']) or $_SESSION['biggest_index']<$biggest_index) {
        $_SESSION['biggest_index'] = $biggest_index;
    }

    // Render view
    echo $twig->render('admin_categories.html', ['categories' => $categories,'biggest_index'=>$_SESSION['biggest_index']]);
?>