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
if($_SESSION['phone']==""){
$sql="UPDATE `".$_SESSION["applied"]."` SET `email`='".$mail."', `phone`='".$phone."', `college`='".$college."', `home_town`='".$hometown."',`collegeid`= '".$collegeid."',`Full_Name`='".$name."',`year_of_passing`='".$year."',`address`='".$address."',`comments`='".$comment."' WHERE `email`='".$_SESSION["mail"]."'";
}
else{
    $sql="UPDATE `".$_SESSION["applied"]."` SET `email`='".$mail."', `phone`='".$phone."', `college`='".$college."', `home_town`='".$hometown."',`collegeid`= '".$collegeid."',`Full_Name`='".$name."',`year_of_passing`='".$year."',`address`='".$address."',`comments`='".$comment."' WHERE `phone`='".$_SESSION["phone"]."'";
}
 if($_SESSION["applied"]=='full_time_reg')
 {
     $verify_table='verified_full_time';
 }
 else{
     $verify_table='verified_interns';
 }
 $sql_verify="INSERT INTO `".$verify_table."`(`id`) VALUES (".$_SESSION['id'].")";
 $res=mysqli_query($conn,$sql);
 $verify=mysqli_query($conn,$sql_verify);
 if($res and $verify){
    //();
     sleep(3);
     session_unset();
     header('Location:validate.php?sucess='.$sql);
 }
 else{

 }
