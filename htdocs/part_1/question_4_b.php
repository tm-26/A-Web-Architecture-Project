<?php    
    
    //starts a session
    session_start();
    
    //saves the values obtained from the post request to the session variable 'values'
    $_SESSION['values'] = $_POST['values'];

    echo "Since this is a POST request, the URL doesn't contain the parameters passed"
?>

<!--Redirect to question 5-->
<h3>Click <a href="part_1/question_5.php">here</a> to display the contents of the session variables</h3>