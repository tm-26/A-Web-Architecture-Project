<?php
    include '../logout.php';
    include 'admin_dishes_db.php'; 
    require_once '../../bootstrap.php';
    require_once '../../database.php';

    session_start();
    checkIfTimeout(); 
    if (isset($_SESSION["auth"]) and $_SESSION["auth"] != "true")
    {
        logOut();
    }
    if(isset($_POST["logout"])){ //If user clicked to log out
        logOut(); 
    }

    if(isset($_POST["change"]))
    {
        if($_POST["change"]=="remove")
        {
            $return = remove($_POST["item_id"]);
            if($return != "Success")
            {
                echo "<script type='text/javascript'>alert('".$return."');</script>";
            }
        }
    }
    $db = new Db();   
    $categories = $db -> select("SELECT * FROM category");
    $items = $db -> select("SELECT `item_id`,`item_name`, category_id FROM `item`");
    $item_desc = $db -> select("SELECT item_id, `description`,`price`,`image_location` FROM item_details");
    
    foreach($categories as $key => $field)
    {
        $categories[$key]['category_name'] = htmlspecialchars_decode($field['category_name'], ENT_QUOTES);
    }
    foreach($items as $key => $field)
    {
        $items[$key]['item_name'] = htmlspecialchars_decode($field['item_name'], ENT_QUOTES);
        $biggest_index = $field["item_id"];
    }
    foreach($item_desc as $key => $field)
    {
        $item_desc[$key]['description'] = htmlspecialchars_decode($field['description'], ENT_QUOTES);
        $item_desc[$key]['image_location'] = htmlspecialchars_decode($field['image_location'], ENT_QUOTES);
    }

    if(!isset($_SESSION['biggest_index']) or $_SESSION['biggest_index']<$biggest_index) {
        $_SESSION['biggest_index'] = $biggest_index;
    }
    
    // Render view
    echo $twig->render('admin_dishes.html', ['categories' => $categories, 'items' => $items, 'item_desc' => $item_desc, 'biggest_index'=>$_SESSION['biggest_index']]);
?>
