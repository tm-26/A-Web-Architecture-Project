<?php
    include '../logout.php';
    include 'admin_staff_db.php';  
    require_once '../../bootstrap.php';
    require_once '../../database.php';

    session_start();
    checkIfTimeout(); //to be copied at top of every admin page
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
            $return = remove($_POST["employee_id"]);
            if($return != "Success")
            {
                echo "<script type='text/javascript'>alert('".$return."');</script>";
            }
        }
    }
    
    $db = new Db();   
    $staff = $db -> select("SELECT * FROM staff");
    
    foreach($staff as $key => $field){
        $biggest_index = $field["employee_id"];
        $staff[$key]["employee_name"] = htmlspecialchars_decode($field["employee_name"], ENT_QUOTES);
        $staff[$key]["employee_position"] = htmlspecialchars_decode($field["employee_position"], ENT_QUOTES);
        $staff[$key]["employee_description"] = htmlspecialchars_decode($field["employee_description"], ENT_QUOTES);
        $staff[$key]["image_location"] = htmlspecialchars_decode($field["image_location"], ENT_QUOTES);
    }
    
    if(!isset($_SESSION['biggest_index']) and $_SESSION['biggest_index']<$biggest_index) {
        $_SESSION['biggest_index'] = $biggest_index;
    }
     // Render view
     echo $twig->render('admin_staff.html', ['staff' => $staff, 'biggest_index'=>$_SESSION['biggest_index']]);


?>
