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
        <title>Catalogue</title>
  
        <div class="form" id="form_container">
            <form action="catalogue.php" method="Post">
                <div>
        
        <p><span class="text">Please Select a product:</span>
            <select id ="Select_Product" name="Select_Product" oncahnge="productInfo(this.value)" class="select">
                <option value=""></option>
        <?php
        $search = "SELECT Name, ProductID FROM Library.Products";
        $return = $con->query($search);
        
        if(!$return) {
            $message = "Whole query: " . $search;
            echo $message;
            die('Invalid query: ' . mysqli_error());
        }
        while ($row = mysqli_fetch_array($return)){
            if($row['ProductID'] == $product_id) {
                echo "<option value='" . $row['ProductID']."'selected='selected'>" .$row['Name'] . "</option>\n";
            } else {
                echo "<option value='" . $row['ProductID'] . "'>" .$row['Name'] . "</option>\n";
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
                    $sql = "SELECT Name, Description, Price FROM Library.Products WHERE ProductID =" . $infonum;
                    
                    echo "<table align ='left' width='100%'><tr><th>Name</th><th>Description</th><th>price</th></tr>";
                    $result = $con->query($sql);
                    
                    if(mysqli_num_rows($result)>0){
                        list($infoname, $infodescription, $infoprice) = mysqli_fetch_row($result);
                        echo "<tr>";
                        echo "<td align=\"center\" width=\"450px\">$infoname</td>";
                        echo "<td align=\"center\" width=\"325px\">$infodescription</td>";
                        echo "<td align=\"center\">$infoprice</td>";
                        echo "<td alignt =\"left\" width=\"450px\"><img src='productImages\\$product_id.jpg' height=\"160\" width=\"160\"></td>";
                        echo"</tr>";
                    }
                    echo "</table>";
                }
                ?>
            </div>
            <div id="Display_cart">
              
        
        
        <?php
        if($_SESSION['cart']) {
            echo "<table border=\"1\" padding\"3\" width=\"640px\"><tr><th>Name</th><th>Description</th><th>Price</th>"
            ."<th width=\"60px\">Amount</th></tr>";
            
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $sql = "SELECT Name, Description, Price FROM Library.Products WHERE ProductID = ". $product_id;
                $result = $con->query($sql);
                
                if(mysqli_num_rows($result)>0){
                    list($name, $description, $price) = mysqli_fetch_row($result);
                    $total = $total + ($price * $quantity);
                    echo "<tr>";
                    echo "<td width=\"250px\">$name</td>";
                    echo "<td width=\"350px\">$description</td>";
                    echo "<td align=\"right\" width=\"75px\">$price</td>";
                    echo "<td align=\"right\">$quantity</td>";
                    
                    echo"</tr>";
                }
            }
            
            echo "<tr>";
            echo "<td></td><td></td><td align=\"left\">Total</td><td align=\"right\">$total</td>";
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
