<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require_once '../bootstrap.php';
require_once '../database.php';

$db = new Db();   
$email = "";
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

if (isset($_POST["email"]) and count($_SESSION["favourites"])>0)
{    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    $subject = "Jack's Eat House - Your Favourites!";

    $body = "<h1 style='color:#6C3312; font-weight: bold; font-size:25px;'>You have requested to send your favourite dishes by email!<br>Here are your favourites:</h1><br>";
    
    $body .= "<table align='center' style='table-layout:fixed width:100% max-width:800px;'>";
    $count = 0;

    foreach($_SESSION["favourites"] as $favourite)
    {
        if($count%2==0)
        {
            $body .= "<tr>";
        }

        $body .= "<td style='width:400px;border:10px;border-style: outset;padding:10px;overflow:hidden;' bgcolor='#dfaf8b'>";

        $favourite_details = $db -> select("SELECT item_name, item.item_id, item_details.item_id, description, price, image_location FROM item, item_details WHERE item.item_id = item_details.item_id AND item.item_id = ".$favourite);
        
        $body .= "<p style='margin:10px; color:black; text-align:center; font-weight:bold; font-size:25px;'>".$favourite_details[0]['item_name']."</p><br>";
        $body .= "<p style='margin:0px; color:black; text-align:center; font-size:17px;'>".$favourite_details[0]['description']."</p><br>";
        $body .= "<p style='font-weight:bold; margin:0px; color:black; text-align:center; font-size:20px;'>&euro;".$favourite_details[0]['price']."</p><br>";
        $body .= "<img src='cid:".str_replace(' ','%20',$favourite_details[0]['item_name'])."' style='width:250px;height:250px;  display: block;margin-left: auto;margin-right: auto;' alt='".$favourite_details[0]['image_location']."'><br><br>";

        $mail->AddEmbeddedImage("../images/dishes/".$favourite_details[0]['image_location'],$favourite_details[0]['item_name'],$favourite_details[0]['item_name']);
        
        $body .= "</td>";

        if($count%2!=0 OR count($_SESSION["favourites"])==$count)
        {
            $body .= "</tr>";
        }

        $count = $count + 1;
    }
    $body .="</table>";

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML(true);
    $mail->Username = 'noreply.jackseathouse@gmail.com';
    $mail->Password = 'HackeyMcHackFace';
    $mail->setFrom('noreply@jackseathouse.com');
    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->AddAddress($_POST["email"]);

    try
    {
        $mail->send();
        $email = "Email successfully sent to ".$_POST["email"]."!";
    }
    catch(Exception $e)
    {
        $email = "Problem with sending email :(";
    }
}

$welcomes = $db -> select("SELECT * FROM `welcomepage`");

$welcomes[0]["welcomeMessage"] = html_entity_decode($welcomes[0]["welcomeMessage"], ENT_QUOTES);
$welcomes[0]["welcomeTitle"] = html_entity_decode($welcomes[0]["welcomeTitle"], ENT_QUOTES);

// Render view
echo $twig->render('favourites.html', ['welcomeMessages' => $welcomes[0], 'categories' => $categories,'items'=> $items,'favourites'=>$_SESSION["favourites"],'email'=>$email]);
?>
