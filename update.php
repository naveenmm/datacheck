<?php include_once "db.php";
session_start();
$phone=$_POST['phone'];
$mail=$_POST['mail'];
$graduationCollege=$_POST['graduationCollege'];
$post_graduationCollege=$_POST['post_graduationCollege'];

$sql="UPDATE `".$_SESSION["applied"]."` SET `email`='".$mail."', `phone`='".$phone."', `graduation_college`='".$graduationCollege."', `post_graduation_college`='".$post_graduationCollege."' WHERE `email`='".$_SESSION["mail"]."'";
if($_SESSION["applied"]=='full_time_reg')
{
    $verify_table='verified_full_time';
}
else{
    $verify_table='verified_interns';
}
$sql_verify="INSERT INTO `".$verify_table."`(`id`) VALUES (".$_SESSION['id'].")";
$res=mysqli_query($conn,$sql);
if($res){
    //();
    echo "Data Updated";
}
else{

}
$verify=mysqli_query($conn,$sql_verify);
if($verify){
    session_unset();
    echo "and verified";
}
else{

}
?>