<?php
require_once '../bootstrap.php';
require_once '../database.php';

$db = new Db();   
$contactDetails = $db -> select("SELECT * FROM contactdetails");
$welcomes = $db -> select("SELECT * FROM `welcomepage`");

$welcomes[0]["welcomeMessage"] = html_entity_decode($welcomes[0]["welcomeMessage"], ENT_QUOTES);
$welcomes[0]["welcomeTitle"] = html_entity_decode($welcomes[0]["welcomeTitle"], ENT_QUOTES);

$contactDetails[0]["telephone"] = htmlspecialchars_decode($contactDetails[0]["telephone"], ENT_QUOTES);
$contactDetails[0]["mobileNumber"] = htmlspecialchars_decode($contactDetails[0]["mobileNumber"], ENT_QUOTES);
$contactDetails[0]["address"] = htmlspecialchars_decode($contactDetails[0]["address"], ENT_QUOTES);
$contactDetails[0]["openingHours"] = htmlspecialchars_decode($contactDetails[0]["openingHours"], ENT_QUOTES);
$contactDetails[0]["email"] = htmlspecialchars_decode($contactDetails[0]["email"], ENT_QUOTES);

// Render view
echo $twig->render('contact.html',  ['contactDetails' => $contactDetails,'welcomeMessages' => $welcomes[0]]);