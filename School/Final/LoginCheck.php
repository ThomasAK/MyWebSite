<?php
session_start();
unset($_SESSION['badPass']);

$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];

require_once 'DataBaseConnection.php';

$myusername = mysql_fix_string($con, $myusername);
$mypassword = mysql_fix_string($con, $mypassword);

$Hashed = hash("ripemd128", $mypassword);

$sql = "SELECT * FROM Library.Users WHERE UserName='"
        .$myusername ."' and thepassword='".$mypassword . "'";
$result = $con->query($sql);

if(!$result){
    $message = "Whole query ". $sql;
    echo $message;
    die('Invalid query: '. mysqli_error());
}
//Mysql_num_row is counting table row
$count = $result->num_rows;

// If result matched $myusername and $mypassword, table row must be 1 row
if($count == 1){
    $_SESSION['user'] = $myusername;
    $_SESSION['password'] = $mypassword;
    // Register $myusername, $mypassword and redirect to file "LoginSuccess.php"
    header("Location:catalogue.php");
    
} else {
    $_SESSION['badPass']++;
    header("Location:LoginForm.php");
    //echo "Wrong email or password";
}

?>