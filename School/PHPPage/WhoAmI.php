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
        <a href="Nav.html"></a> 
       
    </head>
    <body>
        <h1>PHP Page</h1>
        <div id="main">
            <form action="WhoYouAre.php" method="post">
                <?php
                //This creates the form for name, age, address, state, gender
                 print <<<HTML
                    
                    Name: <input type="text" name="Name"><br>
                    Age: <input type="number" name="Age"><br>
                    Address: <input type="text" name="Address"><br>
                    State: <input type="text" name="State"><br>
                    Gender: F <input type="radio" value="F" name="Gender" checked="true">
                    M <input type="radio" value="M" name="Gender"> <br>
                    <input type="submit" value="Submit" name="Create"><br>
HTML;
                ?>
            </form>
        </div>
    </body>
</html>
