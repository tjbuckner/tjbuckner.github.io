<?php
    session_start();

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        //open database connection
        $conn = mysql_connect('localhost','c2230a09','c2230a09') or trigger_error("SQL", E_USER_ERROR);
        $db = mysql_select_db('c2230a09proj',$conn) or trigger_error("SQL", E_USER_ERROR);

        $password = md5($password);
        $query = "SELECT firstName, lastName, userName, email FROM users WHERE userName = '$username' AND pass = '$password'";
        $result = mysql_query($query) or trigger_error("SQL", E_USER_ERROR);

        $num_rows = mysql_num_rows($result);

        if($num_rows == 1){
            $row = mysql_fetch_row($result);

            echo $row;

            $_SESSION['login'] = true;
            $_SESSION['firstName'] = $row[0];
            $_SESSION['lastName'] = $row[1];
            $_SESSION['username'] = $row[2];
            $_SESSION['email'] = $row[3];
            header("Location: loginSuccess.php");
        }
        else {
            header("Location: loginForm.php");
        }

    }
    else {
        header("Location: loginForm.php");
    }



    ?>
