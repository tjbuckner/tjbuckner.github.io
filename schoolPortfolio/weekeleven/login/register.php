<?php
    session_start();

    if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        //open database connection
        $conn = mysql_connect('localhost','c2230a09','c2230a09') or trigger_error("SQL", E_USER_ERROR);
        $db = mysql_select_db('c2230a09proj',$conn) or trigger_error("SQL", E_USER_ERROR);

        $query = "SELECT userName FROM users WHERE userName = '$username'";
        $result = mysql_query($query) or trigger_error("SQL", E_USER_ERROR);

        $num_rows = mysql_num_rows($result);

        if($num_rows == 0) {
            $password = md5($password);
            $registerQuery = "INSERT INTO users (firstName, lastName, userName, email, pass)
    values ('$firstName', '$lastName', '$username', '$email', '$password')";
            mysql_query($registerQuery);

            $_SESSION['login'] = true;
            $_SESSION['firstName'] = $firstName;
            $_SESSION['lastName'] = $lastName;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            header("Location: loginSuccess.php");
        }
        else {
            header("Location: loginForm.php");
        }

    }
    else {
        echo "STUCK2";
        header("Location: loginForm.php");
    }



    ?>
