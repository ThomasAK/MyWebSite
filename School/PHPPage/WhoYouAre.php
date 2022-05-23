<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
                    //posting form data
                    $name = htmlentities($_POST['Name']);
                    $name = strtolower($name);
                    $name = ucwords($name);
                    $age = $_POST["Age"];
                    $address = $_POST['Address'];
                    $state = $_POST['State'];
                    $gender = $_POST['Gender'];
                    
                    //reading in text file
                    $postpage = explode("\n", file_get_contents('PostPage.txt'));
                    
                    // changing background color if gender is M
                    if ($gender == "M"){
                        echo '<body style="background-color:green">';
                    }
                    
                    //Printing out post variables 
                    printf("Name: %s <br>Age: %s <br>Address:  %s <br>State:  %s <br>Gender:  %s <br><br>",$name, $age,$address,$state,$gender);
                    
                    //Printing out years from current year to the year the person was born
                    for($i=0; $i < $age; $i++){
                        echo (date("Y")-$i)."<br>";
                    }
                    
                    //printing a extra space 
                    printf("<br>");
                    
                    //printing out postpage.txt
                    for($i=0; $i < sizeof($postpage); $i++){
                        echo $postpage[$i]."<br>";
                    }
        ?>
    </body>
</html>
