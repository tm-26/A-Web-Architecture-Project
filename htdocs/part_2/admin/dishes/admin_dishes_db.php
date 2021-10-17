<?php
    include_once '../../database.php';
    
    function checkDuplicate($item_name){
        $db = new Db();
        $sql = $db->query("SELECT * FROM `item` WHERE `item_name`='".$item_name."';");
        while ($row = $sql->fetch_assoc()) {
            return True; //if there are any rows with the same name
        }
        return False;

    }
    
    function edit($previous_name, $item_name, $item_image,$item_description, $item_price, $item_id, $item_category)
    {
        if (checkDuplicate($item_name) == TRUE and $previous_name!==$item_name)
        {
            return "Item \'".$item_name."\' already exists";
        }
        else
        {   
            $db = new Db();

            $sql = $db->query("UPDATE `item`, `item_details` SET `category_id`='".$item_category."', `item_name` = '".$item_name."', `description` =  '".$item_description."', `price` =  '".$item_price."' WHERE item.`item_id` = '".$item_id."' AND item_details.`item_id` = '".$item_id."';");
            //TO UPDATE IMAGE:
            if($item_image !== 0)
            {
                $insert = $db->query("UPDATE `item_details` SET `image_location` = '".$item_image."' WHERE `item_details`.`item_id` = '".$item_id."';");
                //$imgname = $item_image;
                //move_uploaded_file($item_image['tmp_name'], "picture/$imgname");
            }
            if ($sql === FALSE)
            {
                $error = $db->error();
                return "Error updating item: ".$error;
            }
            else
            {
                return "Success";
            }
        }
    }
    function add($item_description, $item_price, $item_image, $item_name, $category_id)
    {
        if (checkDuplicate($item_name) == TRUE)
        {
            return "Dish \'".$item_name."\' already exists";
        }
        else
        {   
            $db = new Db();

            $_SESSION['biggest_index']++;

            $sql1 = $db->query("INSERT INTO `item`(`item_id`, `category_id`, `item_name`) VALUES ('".$_SESSION['biggest_index']."','".$category_id."','".$item_name."');");
            $sql2 = $db->query("INSERT INTO `item_details`(`item_id`, `description`, `price`,`image_location`) VALUES ('".$_SESSION['biggest_index']."','".$item_description."','".$item_price."','".$item_image."');");
            if ($sql1 === FALSE || $sql2 === FALSE)
            {
                $error = $db->error();
                return "Error updating item: ".$error;
            }
            else
            {
                return "Success";
            }
        }
    }

 

    function remove($item_id)
    {
        $db = new Db();
        
        $sql1 = $db->query("DELETE FROM `item` WHERE `item_id`='".$item_id."';");
        $sql2 = $db->query("DELETE FROM `item_details` WHERE `item_id`='".$item_id."';");
        if ($sql2 === FALSE || $sql1== FALSE    )
        {        
            $error = $db->error();
                return "Error updating item: ".$error;
        }
        else
        {
            return "Success";
        }
    }
?>