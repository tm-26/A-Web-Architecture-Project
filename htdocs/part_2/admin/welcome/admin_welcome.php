<?php
    include '../logout.php';
    include 'admin_welcome_db.php'; 
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
    $db = new Db();   
    $welcomes = $db -> select("SELECT * FROM `welcomepage`");
    $review = $db -> select("SELECT * FROM `review` WHERE 1");
    $specials = $db -> select("SELECT * FROM `specials` WHERE 1");
   
    $welcomes[0]["welcomeMessage"] = html_entity_decode($welcomes[0]["welcomeMessage"], ENT_QUOTES);
    $welcomes[0]["welcomeTitle"] = html_entity_decode($welcomes[0]["welcomeTitle"], ENT_QUOTES);
    
    foreach($review as $key => $field)
    {
        $review[$key]["reviewName"] = html_entity_decode($field["reviewName"], ENT_QUOTES);
        $review[$key]["reviewMessage"] = html_entity_decode($field["reviewMessage"], ENT_QUOTES);
    }

    foreach($specials as $key => $field)
    {
        $specials[$key]["Image"] = html_entity_decode($field["Image"], ENT_QUOTES);
        $specials[$key]["Name"] = html_entity_decode($field["Name"], ENT_QUOTES);
    }

    // Render view
    echo $twig->render('admin_welcome.html', ['welcomes' => $welcomes[0], 'reviews'=>$review,'specials'=>$specials]);
?>