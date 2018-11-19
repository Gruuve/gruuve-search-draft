<?php 

$id = $_GET['id'];
include("db.php");
$q1 = "select * from websites where id=$id";
$res = mysqli_query($con,$q1);
$row = mysqli_fetch_assoc($res);
$link = $row['link'];
$clicks = $row['clicks'];
$clicks = $clicks + 1;

$q2 = "UPDATE websites SET clicks = $clicks WHERE id = $id";
$res2 = mysqli_query($con,$q2);

echo "<script>window.location.href = \"$link\";</script>";

?>