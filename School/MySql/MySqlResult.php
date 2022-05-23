<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
require_once 'DataBaseConnection.php';
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$username = $_POST['username'];
$password = $_POST['password'];
$sex = $_POST['sex'];
$relation = $_POST['relation'];
$requestType = $_POST['requestType'];
?>

<html>
     <head>
        <meta charset="UTF-8">
        <meta name="google" content="notranslate">
        <meta http-equiv="Content-Language" content="en">
        <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAC9qnMA9ubeAObKrAD///8A7s60AO7WvQDNupQA1bJ7AMWqcwD/8v8A//r2AM2qcwDevpwAtJ1aAN7StAC9oWIA//b2AN7CiwD27uYAtJlaAMWhYgCkhTEAzbqLAP/y7gD24s0A5trFAP/6/wD26t4AzaFiAN7KrADNtoMA/+7uAM2ycwD23s0A1cKcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMiHQMDAwMDAwMDAwMDAwMNBQMDAwMDAwMDGgkDAwMaHRwCAwMDAwMPGCIDAwMDAw4RGgMDAwMEAhUDAwMDARMhAwMDAwMDEQoCAwMDAw8aAwMDAwMDAyIDAwMDAx8eAwMDAwMDAwMYGQMDAwMgEgMDAwMDAwMDBwMDAwMBAAMDAwMDAwMDEgIaAwMKDQMDAwMDAwMDAwwJBQMhExoDAwMDAwMDAxsiFxYUBgMDAwMDAwMDAwMECAsQAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon" />
        <title>MySql Results</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">      
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/normalize.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>

        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
                    <?php
                    // put your code here
                    //print_r($_POST);
                    $birthday = $month . "/".$day."/".$year;
                    switch ($requestType) {
                        case "Create";
                            $insert = "INSERT INTO `Library`.`Users` (`UserName`, `FirstName`, `LastName`, `Phone`,"
                                    ." `Address`, `City`, `State`,`Zip`, `BirthDate`, `Sex`, `Relation`, `thepassword`)"
                                    . "VALUES ('$username','$fname', '$lname', '$phone', '$address', '$city', '$state','$zip', '$birthday', '$sex','$relation','$password')";

                        $success = $con->query($insert);

                        if ($success == FALSE) {
                            $failmess = "Whole query". $insert ."<br>";
                            echo $failmess;
                            die('Invalid query: '.mysqli_error($con));
                        } else {
                            echo "$name was added<br>";
                        }
                        break;

                        case "Update";
                            //echo "Updating";
                            $update = "UPDATE `Library`.`Users` SET `FirstName` ='$fname' ";
                            if($phone > 0){
                                $update = $update . ", `Phone` = '$phone' ";
                            }
                            if($address != "") {
                                $update = $update . ",`Address` = '$address' ";
                            }
                            if($city != ""){
                                $update = $update . ",`City` = '$city' ";
                            }
                            if($state != ""){
                                $update = $update . ",`State` = '$state' ";
                            }
                            if($zip != ""){
                                $update = $update . ",`Zip` = '$zip' ";
                            }
                            if($password != ""){
                                $update = $update . ",`thepassword` = '$password'";
                            }
                            $update.= " WHERE (`UserName` = '$username')";
                            $success = $con->query($update);
                            if ($success == FALSE) {
                            $failmess = "Whole query". $update ."<br>";
                            echo $failmess;
                            die('Invalid query: '.mysqli_error($con));
                        } else {

                            echo $name . " was made Active<br>";
                        }
                        break;

                        case "Search";
                            $search = "SELECT * FROM Library.Users WHERE";
                            if(!empty($fname) OR !empty($lname)){
                                $search = $search." FirstName LIKE '%$fname%' AND LastName LIKE '%$lname%'";
                                if(!empty($phone)){
                                    $search = $search." OR";
                                }
                            } 
                            if(!empty($phone)) {
                                $search = $search." Phone LIKE '%$phone%'";
                            }
                            $search = $search. " ORDER BY FirstName";
                            $return = $con->query($search);
                            
                            if (!$return) {
                                $message = "whole query ". $search;
                                echo $message;
                                die('Invalid query: '.mysqli_errno($con));
                            }
                            
                            echo "<table class='table'><thead><th>First Name</th><th>Last Name</th><th>Phone</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>Birthday</th><th>UserName</th><th>Sex</th><th>Relation</th></thead><tbody>";
                            while ($row = $return->fetch_assoc()) {
                                echo "<tr><td>". $row['FirstName']
                                        . "</td><td>". $row['LastName']
                                        . "</td><td> ". $row['Phone']
                                        . "</td><td> ". $row['Address']
                                        . "</td><td> ". $row['City']
                                        . "</td><td> ". $row['State']
                                        . "</td><td> ". $row['Zip']
                                        . "</td><td> ". $row['BirthDate']
                                        . "</td><td> ". $row['UserName']
                                        . "</td><td> ". $row['Sex']
                                        . "</td><td> ". $row['Relation']
                                        . "</td></tr>";
                            }
                            echo "</tbody></table>";
                            break;
                        default: echo "This is bad<br>";
                    }
                    $con->close;
                    ?>
                    <a href="MySql.php">Back</a>
                </div>
            </div>
        </div>
    </body>
</html>
