<?php   
    //For Staff
    include '../logout.php';
    include 'admin_staff_db.php';
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
        $_SESSION['name'] = $_POST["employee_name"];
        $_SESSION['position'] =$_POST["employee_position"];
        $_SESSION['description'] =  $_POST["employee_description"];
        $_SESSION['image'] = $_FILES["employee_image"];
        
        if(isset($_POST["previous_name"]) && isset($_POST["employee_id"])){
            $_SESSION['id'] = $_POST["employee_id"];
            
        $_SESSION['prev_name'] = $_POST["previous_name"];
        }
    }

    if(isset($_POST["confirm2"])){

        $name = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');
        $position = htmlspecialchars($_SESSION['position'], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($_SESSION['description'], ENT_QUOTES, 'UTF-8');
        $image = htmlspecialchars($_SESSION['image']['name'], ENT_QUOTES, 'UTF-8');;

        if( $_SESSION['which_effect'] =="add")
        {
            $return = add($name, $position, $image, $description, $_SESSION['id']);
            if($return == "Success")
            {
                header('Location: admin_staff.php');
            }
            else
            {
                echo "<script type='text/javascript'>alert('".$return."');</script>";
            }
        }
        elseif($_SESSION['which_effect'] =="edit")
        {
            $prev_name = htmlspecialchars($_SESSION['prev_name'], ENT_QUOTES, 'UTF-8');
            if($_SESSION['image']['size'] !== 0) {
                $return = edit($prev_name, $name, $image, $description, $_SESSION['id'], $position);
            }else{
                $return = edit($prev_name, $name, 0, $description, $_SESSION['id'], $position);
            }
            if($return == "Success")
            {
                header('Location: admin_staff.php');
            }
            else
            {
                echo "<script type='text/javascript'>alert('".$return."');</script>";
            }
        }
        
    }
    if($_FILES['employee_image']['size'] !== 0) { // NEW IMAGE EXISTS
        $imgname = $_FILES["employee_image"]['name'];
        move_uploaded_file($_FILES["employee_image"]['tmp_name'], "../../images/staff/$imgname");
    } else { //No new image
        require_once '../../database.php';
        $current_employee = $_POST["employee_id"];

        $db = new Db();
        $current_image_query = $db -> select("SELECT `image_location` FROM `staff` WHERE `employee_id` = '$current_employee'");
        $imgname = $current_image_query[0]["image_location"];
    }
    // Render view
    echo $twig->render('staff_preview.html', ['name' => $_SESSION['name'],'position'=>$_SESSION['position'], 'description' =>$_SESSION['description'],'image' =>$imgname]);

    ?>