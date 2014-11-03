<?php
$index = $_POST["entry"];
$file = file('phonebook.dat');
array_splice($file, $index, 1);
file_put_contents('phonebook.dat', $file);
header("location: list.php");
?>
