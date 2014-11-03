<?php
$id = $_POST["index"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$phoneNumber = $_POST["phoneNumber"];

//open database connection
$conn = mysql_connect('localhost','c2230a09','c2230a09') or trigger_error("SQL", E_USER_ERROR);
$db = mysql_select_db('c2230a09proj',$conn) or trigger_error("SQL", E_USER_ERROR);

$query = "UPDATE phonebook SET firstName = '$firstName', lastName = '$lastName', phoneNumber = '$phoneNumber' WHERE id = '$id'";
$result = mysql_query($query) or trigger_error("SQL", E_USER_ERROR);

header("location: list.php");
?>
