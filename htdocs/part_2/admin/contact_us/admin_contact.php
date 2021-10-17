<?php
    include '../logout.php';
    include 'admin_contact_db.php'; 
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
    $test = "test";
    if(isset($_POST['effect']) and ($_POST['effect'] == 'editAll')){
        $openHours = htmlspecialchars($_POST["openingHours"], ENT_QUOTES, 'UTF-8');
        //$email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
        $address = htmlspecialchars($_POST["address"], ENT_QUOTES, 'UTF-8');
        $telephone = htmlspecialchars($_POST["telephone"], ENT_QUOTES, 'UTF-8');
        $mobile = htmlspecialchars($_POST["mobile"], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
        $return = editAll($openHours, $email, $address, $telephone, $mobile);
        echo "<script type='text/javascript'>alert('".$return."');</script>";
    }

    if(isset($_POST['effect']) and ($_POST['effect'] == 'editEmail')){
        $_SESSION['email'] = $_POST["email"];
        $return = editEmail($_POST["email"]);
        $returnmessage = 'Email edited successfully  ';
        echo "<script type='text/javascript'>alert('".$returnmessage."');</script>";

    }


    
    $db = new Db();   
    $contactDetails = $db -> select("SELECT * FROM contactdetails");
    $email = $db -> select("SELECT * FROM email");

    $contactDetails[0]["telephone"] = htmlspecialchars_decode($contactDetails[0]["telephone"], ENT_QUOTES);
    $contactDetails[0]["mobileNumber"] = htmlspecialchars_decode($contactDetails[0]["mobileNumber"], ENT_QUOTES);
    $contactDetails[0]["address"] = htmlspecialchars_decode($contactDetails[0]["address"], ENT_QUOTES);
    $contactDetails[0]["openingHours"] = htmlspecialchars_decode($contactDetails[0]["openingHours"], ENT_QUOTES);
    $contactDetails[0]["email"] = htmlspecialchars_decode($contactDetails[0]["email"], ENT_QUOTES);

    $email[0]["email"] = htmlspecialchars_decode($email[0]["email"], ENT_QUOTES);

    // Render view
    echo $twig->render('admin_contact.html', ['contactDetails' => $contactDetails, 'emails' => $email]);

?>