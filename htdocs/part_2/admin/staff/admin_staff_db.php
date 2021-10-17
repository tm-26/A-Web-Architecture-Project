<?php
    include_once '../../database.php';
    
    function checkDuplicate($employee_id){
        $db = new Db();
        $sql = $db -> query("SELECT * FROM `staff` WHERE `employee_name`='".$employee_id."';");
        while ($row = $sql->fetch_assoc()) {
            return True; //if there are any rows with the same name
        }
        return False;
    }

    function edit($previous_name, $employee_name, $imgname ,$employee_description, $id, $employee_position)
    {
        $db = new Db();

        $sql = $db -> query("UPDATE `staff` SET `employee_id`='".$id."', `employee_name` = '".$employee_name."', `employee_position` = '".$employee_position."', `employee_description` =  '".$employee_description."' WHERE staff.`employee_id` = '".$id."';");
        //TO UPDATE IMAGE:
        if($imgname !== 0)
        {
            $insert = $db -> query("UPDATE `staff` SET `image_location` = '".$imgname."' WHERE `employee_id` = '".$id."';");
            move_uploaded_file($imgname['tmp_name'], "../../images/staff/$imgname");
        }
        if ($sql === FALSE)
        {

            $error = $db->error();
            return "Error updating employee: ".$error;
        }
        else
        {
            return "Success";
        }
        
    }
    function add($employee_name, $employee_position, $imagename, $employee_description, $employee_id)
    {
        if (checkDuplicate($employee_id) == TRUE)
        {
            return "Employee with id: \'".$employee_id."\' already exists"; 
        }
        
        else
        {   
            $db = new Db();

            $_SESSION['biggest_index']++;

            $sql1 = $db -> query("INSERT INTO `staff`(`employee_description`, `employee_id`, `employee_name`, `employee_position`, `image_location`) VALUES ('".$employee_description."','".$_SESSION['biggest_index']."','".$employee_name."','".$employee_position."','".$imagename."');");
            if ($sql1 === FALSE)
            {
                $error = $db->error();
                return "Error creating employee: ".$error;
            }
            else
            {
                $imgname = $imagename['name'];
                move_uploaded_file($imagename['tmp_name'], "../../images/staff/$imgname");
               
                return "Success";
            }
        }
    }

    function remove($id)
    {
        $db = new Db();
        
        $sql1 = $db -> query("DELETE FROM `staff` WHERE `employee_id`='".$id."';");
        if ($sql1 === FALSE)
        {        
            $error = $db->error();
            return "Error removing category: ".$error;
        }
        else
        {
            return "Success";
        }
    }
?>