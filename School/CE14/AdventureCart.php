<?php
session_start();

setlocale(LC_MONETARY, "en_US");
$product_id = $_POST['Select_Product'];
$action = $_POST['action'];
switch ($action){
case "Add":
    $_SESSION['cart'][$product_id] ++;
    break;
case "Remove":
    $_SESSION['cart'][$product_id] --;
    if ($_SESSION['cart'][$product_id] <= 0){
        unset($_SESSION['cart'][$product_id]);
    }
    break;
case "Empty":
    unset($_SESSION['cart']);
    break;
case "Info":
    $infonum = $product_id;
    break;
}
print_r($_SESSION);
require_once 'DataBaseConnection.php';

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <meta charset="UTF-8"><link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAAAAAA19fXAMCAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIBAQECAgICAgICAQEBAgICAQABAgICAgICAgEAAQICAgEAAQECAgECAgEBAAEBAgIBAAAAAQEAAQEAAQAAAAEBAQABAQABAAEBAAEAAQEAAQEAAQEAAQABAQABAAEBAAEBAAEBAAEAAQEAAQABAQABAQAAAAEBAAAAAQEAAAABAQIBAQECAQABAQICAQEBAgICAgICAgEAAQICAgICAgICAgICAgIBAQECAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon">
        <title>Adventure Cart</title>
  

        <link href="/CSIS2440/CodeEx/view.css" rel="stylesheet" type="text/css">
        <div class="form" id="form_container">
            <form action="AdventureCart.php" method="Post">
                <div>
        
        <p><span class="text">Please Select a product:</span>
            <select id ="Select_Product" name="Select_Product" oncahnge="productInfo(this.value)" class="select">
                <option value=""></option>
        <?php
        $search = "SELECT Item, idAdventureGear FROM Library.AdventureGear";
        $return = $con->query($search);
        
        if(!$return) {
            $message = "Whole query: " . $search;
            echo $message;
            die('Invalid query: ' . mysqli_error());
        }
        while ($row = mysqli_fetch_array($return)){
            if($row['idAdventureGear'] == $product_id) {
                echo "<option value='" . $row['idAdventureGear']."'selected='selected'>" .$row['Item'] . "</option>\n";
            } else {
                echo "<option value='" . $row['idAdventureGear'] . "'>" .$row['Item'] . "</option>\n";
            }
        }
        ?>
            </select>
        </p>
        
        <table>
            <tr>
                <td>
                    <input id="button_ADD" type="submit" value="Add" name="action" class="button"/>
                </td>
                <td>
                    <input name="action" type="submit" class="button" id="button_Remove" value="Remove"/>
                </td>
                <td>
                    <input name="action" type="submit" class="button" id="button_empty" value="Empty">
                </td>
                <td>
                    <input name="action" type="submit" class="button" id="button_Info" value="Info">
                </td>
            </tr>   
        </table>
        
        </div>
                <div id="productInformation">
                    
                </div>
            <div>
                <?php 
                if($infonum > 0) {
                    $sql = "SELECT Item, Cost, Weight, ItemImage FROM Library.AdventureGear WHERE idAdventureGear =" . $infonum;
                    
                    echo "<table align ='left' width='100%'><tr><th>Name</th><th>Price</th><th>Weight</th></tr>";
                    $result = $con->query($sql);
                    
                    if(mysqli_num_rows($result)>0){
                        list($infoname, $infoprice, $inforweight, $infoimage) = mysqli_fetch_row($result);
                        echo "<tr>";
                        echo "<td alignt =\"left\" width=\"450px\">$infoname</td>";
                        echo "<td alignt =\"left\" width=\"325px\">$infoprice</td>";
                        echo "<td alignt =\"center\">$inforweight</td>";
                        echo "<td alignt =\"left\" width=\"450px\"><img src='images\\$infoimage' height=\"160\" width=\"160\"></td>";
                        echo"</tr>";
                    }
                    echo "</table>";
                }
                ?>
            </div>
            <div id="Display_cart">
              
        
        
        <?php
        if($_SESSION['cart']) {
            echo "<table border=\"1\" padding\"3\" width=\"640px\"><tr><th>Name</th><th>Weight</th><th>Price</th>"
            ."<th width=\"60px\">Line</th></tr>";
            
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $sql = "SELECT Item, Cost, Weight FROM Library.AdventureGear WHERE idAdventureGear = ". $product_id;
                $result = $con->query($sql);
                
                if(mysqli_num_rows($result)>0){
                    list($name, $price, $weight) = mysqli_fetch_row($result);
                    $weight = $weight * $quantity;
                    $line_cost = $price * $quantity;
                    $totWeight = $totWeight + $weight;
                    $total = $total + $line_cost;
                    echo "<tr>";
                    echo "<td alignt =\"Left\" width=\"450px\">$name</td>";
                    echo "<td alignt =\"center\" width=\"75px\">$weight</td>";
                    echo "<td alignt =\"center\" width=\"75px\">$price</td>";
                    echo "<td alignt =\"center\">$line_cost</td>";
                    
                    echo"</tr>";
                }
            }
            
            echo "<tr>";
            echo "<td align=\"right\">Total Weight</td><td align=\"right\">$totWeight</td><td align=\"right\">Total</td>";
            echo "<td align=\"right\">$total</td>";
            echo "</tr>";
            echo "</table>";
        } else {
            echo"You have no items in your shopping cart.";
        }
        mysqli_close($con);
        ?>
            </div>
    </body>
</html>
