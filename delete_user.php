<?php
// require_once("db.php");
// $sql = "DELETE FROM users WHERE userId='" . $_GET["userId"] . "'";
// mysqli_query($conn,$sql);

$file_out=file("test.txt");
$row_number= $_GET["rowNum"];

//Delete the recorded line
unset($file_out[$row_number]);

//Recorded in a file
file_put_contents("test.txt", implode("", $file_out));
header("Location:index.php");
?>