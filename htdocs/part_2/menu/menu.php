<?php
session_start();
require_once '../bootstrap.php';
require_once '../database.php';


$db = new Db();   
$categories = $db ->select("SELECT category_id, category_name FROM `category` WHERE 1");
$items = $db -> select("SELECT item_name, category_id, item.item_id, item_details.item_id, description, price, image_location FROM item, item_details WHERE item.item_id = item_details.item_id"); //to be changed when charlton lets me know the db tables

foreach($categories as $key => $field)
{
    $categories[$key]['category_name'] = htmlspecialchars_decode($field['category_name'], ENT_QUOTES);
}
foreach($items as $key => $field)
{
    $items[$key]['item_name'] = htmlspecialchars_decode($field['item_name'], ENT_QUOTES);
    $items[$key]['description'] = htmlspecialchars_decode($field['description'], ENT_QUOTES);
    $items[$key]['image_location'] = htmlspecialchars_decode($field['image_location'], ENT_QUOTES);
}

if (!isset($_SESSION["favourites"]))
{
    $_SESSION["favourites"] = array();
}

$welcomes = $db -> select("SELECT * FROM `welcomepage`");

$welcomes[0]["welcomeMessage"] = html_entity_decode($welcomes[0]["welcomeMessage"], ENT_QUOTES);
$welcomes[0]["welcomeTitle"] = html_entity_decode($welcomes[0]["welcomeTitle"], ENT_QUOTES);

// Render view
echo $twig->render('menu.html', ['categories' => $categories,'items'=> $items,'favourites'=>$_SESSION["favourites"],'welcomeMessages' => $welcomes[0]]);
?>