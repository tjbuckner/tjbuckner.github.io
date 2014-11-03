<?php
$index = $_POST["index"];
$newEntry = $_POST["firstName"] . "," . $_POST["lastName"] . "," . $_POST["phoneNumber"] . "\r\n";
$file = file('phonebook.dat');
array_splice($file, $index, 1);
array_splice($file, $index, 1, $newEntry);
file_put_contents('phonebook.dat', $file);
header("location: list.php");
?>
