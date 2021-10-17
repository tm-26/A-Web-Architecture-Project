<?php   
    //For Staff
    include '../logout.php';
    include 'admin_welcome_db.php';
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

    if(isset($_POST["effect"]))
    {
        $_SESSION['id'] = $_POST["id"];
        $_SESSION['Name'] = $_POST["Name"];
        $_SESSION['image'] = $_FILES["image"];
        
    }
    if(isset($_POST["confirm"])){
               
        $name = htmlspecialchars($_SESSION['Name'], ENT_QUOTES, 'UTF-8');
        $image = htmlspecialchars($_SESSION['image']['name'], ENT_QUOTES, 'UTF-8');
        
        $return = editSpecials($_SESSION['id'],$name, $image);
        
        if($return == "Success")
        {
            header('Location: admin_welcome.php');
        }
        else
        {
            echo "<script type='text/javascript'>alert('".$return."');</script>";
        }
    }
    
    if($_FILES['image']['size'] != 0) { // NEW IMAGE EXISTS
        $imgname = $_FILES["image"]['name'];
        move_uploaded_file($_FILES["image"]['tmp_name'], "../../images/home/$imgname");
    } else { //No new image
        require_once '../../database.php';
        $id = $_POST["id"];
        $db = new Db();
        $current_image_query = $db -> select("SELECT `image` FROM `specials` WHERE `id` = '$id'");
        $imgname = $current_image_query[0]['image'];
    }
    // Render view
    
    echo $twig->render('change_image_preview_specials.html', ['Name' => $_SESSION['Name'],'image' => $imgname, 'image_name'=>$_SESSION['image']['name'],'id' => $_SESSION['id']]);
    ?>