<?php include_once "db.php";
session_start();
$phone=$_GET['phone'];
$mail=$_GET['mail'];
$college=$_GET['college'];
$collegeid=$_GET['collegeid'];
$hometown=$_GET['hometown'];
$address=$_GET['address'];
$year=$_GET['year'];
$name=$_GET['name'];
$comment=$_GET['comments'];
$course=$_GET['course'];
$branch=$_GET['branch'];

$sql="UPDATE `registration` SET `email`=\"".$mail."\", `phone`=\"".$phone."\", `college`=\"".$college."\", `home_town`=\"".$hometown."\",`collegeid`= \"".$collegeid."\",`Full_Name`=\"".$name."\",`year_of_passing`=\"".$year."\",`address`=\"".$address."\",`comments`=\"".$comment."\",`course`=\"".$course."\",`branch`=\"".$branch."\" WHERE `id`='".$_SESSION["id"]."'";
 $sql_verify="INSERT INTO `verified`(`id`) VALUES (".$_SESSION['id'].")";
 $res=mysqli_query($conn,$sql);
 $verify=mysqli_query($conn,$sql_verify);
 if($res and $verify){
     session_unset();
     header('Location:validate.php?sucess=You have sucessfully Registered');
 }
 else{

 }
