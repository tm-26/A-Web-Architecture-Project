<?php
    include_once '../../database.php';

    function editAll($openingHours, $email, $address, $telephone, $mobileNumber){
        $id = 1;
        $db = new Db();

        $result = $db -> query("UPDATE `contactdetails` SET `openingHours` =  '".$openingHours."' WHERE contactdetails.`contactID` = '".$id."';");
        if ($result === FALSE)
        {
            $error = $db->error();
            $error = htmlspecialchars($error);
            return $error;
        }
        
        $result = $db -> query("UPDATE `contactdetails` SET `address` =  '".$address."' WHERE contactdetails.`contactID` = '".$id."';");
        if ($result === FALSE)
        {
            $error = $db->error();
            $error = htmlspecialchars($error);
            return $error;
        }

        $result = $db -> query("UPDATE `contactdetails` SET `telephone`='".$telephone."', `mobileNumber` = '".$mobileNumber."', `email` =  '".$email."' WHERE contactdetails.`contactID` = '".$id."';");
        if ($result === FALSE)
        {
            $error = $db->error();
            $error = htmlspecialchars($error);
            return $error;
        }
        else
        {
            return "Contact Details edited successfully";
        }
    
    }

    function editEmail($email){
    
            $id = 1;
            $db = new Db();


            $result = $db -> query("UPDATE `email` SET `email` =  '".$email."';");
            if ($result === FALSE)
            {
                $error = $db->error();
                $error = htmlspecialchars($error);
                return $error;
            }
            else
            {
                return "Email edited successfully";
            }

    }
?>
