<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>My First PHP Page</title>
    </head>
    <body>
         <select class="select" name="Sites" onchange="location = this.value;">
            <option>Sites</option>
            <option value="../../index.html">Portfolio</option>
            <option value="../../RecipeIndex.html">Recipes</option>
            <option value="../CE02/CE02.php">School CE02</option>
        </select>
        <h3> my first PHP Program </h3>
        <?php
        /*
         * Thomas Kempton
         * 27
         */
            echo "<h1>Hello World</h1>";
            $greeting = "<p>PHP is fun!\n</p>";
            print($greeting);
        ?>
    </body>
</html>
