<?php
require_once '../bootstrap.php';
require_once '../database.php';

$db = new Db(); 
$welcomes = $db -> select("SELECT * FROM `welcomepage`");
$staff = $db -> select("SELECT * FROM staff"); 

$welcomes[0]["welcomeMessage"] = html_entity_decode($welcomes[0]["welcomeMessage"], ENT_QUOTES);
$welcomes[0]["welcomeTitle"] = html_entity_decode($welcomes[0]["welcomeTitle"], ENT_QUOTES);

foreach($staff as $key => $field){
    $biggest_index = $field["employee_id"];
    $staff[$key]["employee_name"] = htmlspecialchars_decode($field["employee_name"], ENT_QUOTES);
    $staff[$key]["employee_position"] = htmlspecialchars_decode($field["employee_position"], ENT_QUOTES);
    $staff[$key]["employee_description"] = htmlspecialchars_decode($field["employee_description"], ENT_QUOTES);
    $staff[$key]["image_location"] = htmlspecialchars_decode($field["image_location"], ENT_QUOTES);
}

// Render view
echo $twig->render('about.html', ['staff' => $staff, 'welcomeMessages' => $welcomes[0]]);