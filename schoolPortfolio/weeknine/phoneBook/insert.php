
<?php
    if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['phoneNumber'])) {
        $entry = $_POST["firstName"] . "," . $_POST["lastName"] . "," . $_POST["phoneNumber"] . "\r\n";
        $ret = file_put_contents('phonebook.dat', $entry, FILE_APPEND | LOCK_EX);
        if($ret === false) {
            die('Error writing file.');
        }
        else {

        }
    }
    else {
        die('No data to process.');
    }
    header("location: list.php");
?>
