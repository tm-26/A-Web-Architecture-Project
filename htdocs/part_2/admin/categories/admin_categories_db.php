<?php
    require_once '../../database.php';
    
    function checkDuplicate($category_name){
        $db = new Db();   
        $categories = $db -> select("SELECT * FROM `category` WHERE `category_name`='".$category_name."';");
        if($categories != NULL)
        {
            if (count($categories) > 0)
            {
                return True;
            }
            else
            {
                return False;
            }
        }
        else
        {
            return NULL;
        }
        
    }
    
    function add($category_name)
    {   
        $return = checkDuplicate($category_name);
        if ($return == TRUE)
        {
            return "Category \'".$category_name."\' already exists";
        }
        else if($return == FALSE)
        {   
            $_SESSION['biggest_index']++;

            $db = new Db();
            $result = $db -> query("INSERT INTO `category`(`category_id`, `category_name`) VALUES ('".$_SESSION['biggest_index']."','".$category_name."');");

            if ($result === FALSE)
            {
                $error = $db->error();
                $error = htmlspecialchars($error);
                return $error;
            }
            else
            {
                return "Success";
            }
        }
        else
        {
            return "Error checking for duplicate categories";
        }
    }

    function edit($previous_name, $category_name)
    {
        $return = checkDuplicate($category_name);
        if ($return == TRUE and $previous_name!=$category_name)
        {
            return "Category \'".$category_name."\' already exists";
        }
        else if($return == FALSE)
        {   
            $db = new Db();
            $result = $db -> query("UPDATE `category` SET `category_name` = '".$category_name."' WHERE `category_name` = '".$previous_name."';");

            if ($result === FALSE)
            {
                $error = $db->error();
                $error = htmlspecialchars($error);
                return $error;
            }
            else
            {
                return "Success";
            }
        }else if($previous_name === $category_name)
        {
            return "No changes were made.";
        }
        else
        {
            return "Error checking for duplicate categories";
        }
    }
    

    function remove($category_name)
    {
        $db = new Db();
        $result = $db -> query("DELETE FROM `category` WHERE `category_name`='".$category_name."';");

        if ($result === FALSE)
        {
            $error = $db->error();
            $error = htmlspecialchars($error);
            return $error;
        }
        else
        {
            return "Success";
        }
    }
?>