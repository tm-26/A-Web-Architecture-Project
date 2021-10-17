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

        if( $_SESSION['which_effect'] =="add")
        {
            $return = add($_SESSION['name'], $_SESSION['position'],$_SESSION['image'],$_SESSION['description'],$_SESSION['id']);
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
            if($_SESSION['image']['size'] != 0) { //checks if new image was posted
                
                $return = edit($_SESSION['prev_name'],$_SESSION['name'], $_SESSION['image']['name'],$_SESSION['description'], $_SESSION['id'],$_SESSION['position']);
            }else{
                $return = edit($_SESSION['prev_name'],$_SESSION['name'], 0,$_SESSION['description'], $_SESSION['id'],$_SESSION['position']);
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
    if($_FILES['employee_image']['size'] != 0) { // NEW IMAGE EXISTS
        $imgname = $_FILES["employee_image"]['name'];
        move_uploaded_file($_FILES["employee_image"]['tmp_name'], "../../images/staff/$imgname");
    } else { //No new image
        include_once '../../db_connect.php';
        $conn = OpenCon(); // Create connection
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $current_employee = $_POST["employee_id"];
        $current_image_query = mysqli_query($conn,"SELECT `image_location` FROM `staff` WHERE `employee_id` = '$current_employee'");
        $image_query = mysqli_fetch_row($current_image_query);
        $imgname = $image_query[0];
    }
    // Render view
    echo $twig->render('staff_preview.html', ['name' => $_SESSION['name'],'position'=>$_SESSION['position'], 'description' =>$_SESSION['description'],'image' =>$imgname]);

    ?>