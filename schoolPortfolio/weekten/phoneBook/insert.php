
<?php
    //if all three fields have been sent...
    if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['phoneNumber'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $phoneNumber = $_POST['phoneNumber'];

        //open database connection
        $conn = mysql_connect('localhost','c2230a09','c2230a09') or trigger_error("SQL", E_USER_ERROR);
        $db = mysql_select_db('c2230a09proj',$conn) or trigger_error("SQL", E_USER_ERROR);

        $query = "INSERT INTO phonebook (firstName, lastName, phoneNumber) VALUES('$firstName', '$lastName', '$phoneNumber')";
        $result = mysql_query($query) or trigger_error("SQL", E_USER_ERROR);

//        //create a string to enter into the file
//        $entry = $_POST["firstName"] . "," . $_POST["lastName"] . "," . $_POST["phoneNumber"] . "\r\n";
//        //and append the string to the file
//        $ret = file_put_contents('phonebook.dat', $entry, FILE_APPEND | LOCK_EX);
//        //if this wasn't successful...
//        if($ret === false) {
//            //print an error.
//            die('Error writing file.');
//        }
//        else {
//
//        }
    }
    else {
        //print error if al three fields haven't been set.
        die('No data to process.');
    }
    //and redirect to list.php
    header("location: list.php");
?>
