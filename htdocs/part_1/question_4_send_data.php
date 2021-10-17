<!--Form that sends a GET request to question 4_a with values in an array-->
<form action="question_4_a.php" method="GET"> 
    First value:
    <input type="text" name="values[first_value]"> 
    <br><br>Second value:
    <input type="text" name="values[second_value]">
    <br><br>
    <input type="Submit" name='submit' value="Submit to Question 4_A (GET)">
</form>

<!--Form that sends a POST request to question 4_b with values in an array-->
<form action="question_4_b.php" method="POST"> 
    First value:
    <input type="text" name="values[first_value]"> 
    <br><br>Second value:
    <input type="text" name="values[second_value]">
    <br><br>
    <input type="Submit" name='submit' value="Submit to Question 4_B (POST)">
</form>