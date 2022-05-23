<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Class Exercise 2</title>
    </head>
    <body>
         <select class="select" name="Sites" onchange="location = this.value;">
            <option>Sites</option>
            <option value="../../index.html">Portfolio</option>
            <option value="../../RecipeIndex.html">Recipes</option>
            <option value="../CE01/ce01.php">School CE01</option>
        </select>
        <?php
        $d = date("D");
        echo "<p>$d<br>";
        if($d == "Fri" or $d == "Sat" or $d == "sun") {
            $message = "Have a nice weekend";
        }else if ($d == "Mon") {
            $message = "Oh no its monday";
        }else{
            $message = "Have a nice day";
        }
        echo $message . "</p> <p>";
        //Stop
        
        switch ($d) {
            
            case "Mon":
                echo "Today is Monday<ul>"
                ."<li>csis 2440</li>
                    </ul</p>";
                break;
            case "Tue":
                echo "Today is Tuesday";
                break;
            case "Wed":
                echo "Today is Wednesday";
                break;
            case "Thu":
                echo "Today is Thursday";
                break;
            case "Fri";
                echo "Today is Friday";
                break;
            case "Sat";
                echo "Today is Saturday";
                break;
            case "Sun":
                echo "Today is Sunday";
                break;
            default :
                echo "Wonder which day is this?</p>";
        
        }
        
        $a = 0;
        $b = 0;
        print('<table width=\'50\'class="table"><tr><th>$a</th><th>$b</th></tr>');
        for ($i=0; $i < 5;$i++) {
            $a += 10;
            $b += 5;
            print("<tr><td>$a</td><td>$b</td></tr>");
        }
        
        print("</table><br>At the end of the loop a=$a and b=$b and i=$i");
        
        $i = rand(0,50);
        
        $num = rand(51,100);
        
        do {
            $num--;
            
            $i++;
        }while ($i < $num);
        
        echo "<br>Loop stopped at i = $i and num = $num";
        
        echo"<br>Year of Birth:<select><option>--</option>";
        $year1 = date("Y");
        for ($y = 0; $y <100;$y++){
            if ($y > 17) {
                $yearval = $year1 - $y;
                echo "<option>$yearval</option>\n";
            }
        }
        
        echo "</select>";
        ?>
    </body>
</html>
