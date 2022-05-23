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
        <div>Guess a Number 1-100 </div>
        <?php
        session_start();
        //print_r($_SESSION);
        //session_destroy();
        if(!isset($_SESSION["randNum"])){
            $_SESSION["randNum"] = rand(1,100);
            $_SESSION["NumGuesses"] = 0;
            $_SESSION["low"]= 1;
            $_SESSION["high"] = 100;
        }
        $randNum = $_SESSION["randNum"];
        $userGuess = $_POST["userGuess"];
        $count = $_SESSION["NumGuesses"];
        $message = "";
        if(isset($_POST['userGuess'])&& $userGuess > 0){
            $_SESSION["NumGuesses"]++;
            $count++;
            if($userGuess < $randNum){
                $message = "<center>You Guessed too low!</center>"
                        ."You are on guess $count";
                $_SESSION["low"] = $userGuess;
            } else if($userGuess > $randNum) {
                $message = "<center> You Guessed too high!"
                        ."</center> You are on Guess $count";
                $_SESSION["high"] = $userGuess;
            } else if ($userGuess == $randNum) {
                $message = "<center>Congratulations you're right!"
                        ."</center>You Guessed right in $count guesses.";
                $_SESSION["low"] = $userGuess;
                $_SESSION["high"] = $userGuess;
                unset($_SESSION["randNum"]);
                unset($_SESSION["NumGuesses"]);
                session_destroy();
            }
        } else {
            $message = "<center>Are you ready to start?"
                    ."</center> You are on guess $count";
        }
        
        echo <<<HTML
        <html>
            <head>
             <title>Guessing Game</title>
             <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAAAAAAAA19fXAMCAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIBAQECAgICAgICAQEBAgICAQABAgICAgICAgEAAQICAgEAAQECAgECAgEBAAEBAgIBAAAAAQEAAQEAAQAAAAEBAQABAQABAAEBAAEAAQEAAQEAAQEAAQABAQABAAEBAAEBAAEBAAEAAQEAAQABAQABAQAAAAEBAAAAAQEAAAABAQIBAQECAQABAQICAQEBAgICAgICAgEAAQICAgICAgICAgICAgIBAQECAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=" rel="icon" type="image/x-icon">
            </head>
        <body>
        <center>
        <form action="CE12.php" method="POST">
            Guess a number 1-100:<select name="userGuess">
HTML;
        if($_SESSION["low"]== $_SESSION["high"]){
            echo "<option Value='0'>".$_SESSION["high"]."</option>";
        } else {
            for($i = $_SESSION["low"]; $i <= $_SESSION['high']; $i++){
                echo "<option value='$i'>$i</option>";
            }
        }
        echo <<<HTML
                    </select>
                    <input type="submit" value="Guess" name="button"/>
                </form></center>
HTML;
        echo $message;
        echo "</body></html>";
        ?>
    </body>
</html>
