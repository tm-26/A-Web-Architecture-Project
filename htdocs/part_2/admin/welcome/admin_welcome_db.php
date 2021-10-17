<?php
    include_once '../../database.php';
    
    function editWelcome($id, $welcomeMessage, $welcomeTitle)
    {
        $id = 0;
        $db = new Db();
        $result = $db -> query("UPDATE `welcomepage` SET `welcomeMessage`='".$welcomeMessage."', `welcomeTitle`='".$welcomeTitle."' WHERE welcomepage.`id` = '".$id."';");
        
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

    function editReviews($id, $reviewMessage, $reviewName, $reviewStars)
    {
        $db = new Db();
        $result = $db -> query("UPDATE `review` SET `reviewMessage`='".$reviewMessage."', `reviewName`='".$reviewName."', `reviewStars`='".$reviewStars."' WHERE review.`id` = '".$id."';");
        
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
    
    function editSpecials($id, $Name, $Image)
    {
        $db = new Db();
        $result = $db -> query("UPDATE `specials` SET `Image`='".$Image."', `Name`='".$Name."' WHERE specials.`id` = '".$id."';");
        
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
    