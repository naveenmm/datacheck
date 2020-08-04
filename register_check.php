<?php
include_once "db.php";
function checkIfExists($conn){
    $sql_getemail_intern="SELECT email FROM `internship_reg` WHERE email='".$_POST['email']."'";
    $sql_getemail_fulltime="SELECT email FROM `full_time_reg` WHERE email='".$_POST['email']."'";
    if(mysqli_num_rows(mysqli_query($conn,$sql_getemail_intern))>0 or mysqli_num_rows(mysqli_query($conn,$sql_getemail_fulltime))>0){        
        return true;
    }
    else{
        return false;
    }
}

if(isset($_POST['submit'])){
    
    if($_POST['email']==$_POST['mail'])
    {
        if($_POST['apply']=="internship")
        {
            $verify_table="verified_interns";
            $table="internship_reg";            
        }
        else{
            $verify_table="verified_full_time";
            $table="full_time_reg";
        }
        if(checkIfExists($conn)==false){
        $sql="INSERT INTO `".$table."`(`Full_Name`,`email`, `phone`, `collegeid`, `address`, `home_town`, `course`, `branch`, `college`, `year_of_passing`,`comments`) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['collegeid']."','".$_POST['address']."','".$_POST['hometown']."','".$_POST['course']."','".$_POST['branch']."','".$_POST['college_name']."','".$_POST['pass']."','".$_POST['comments']."')";
        $res=mysqli_query($conn,$sql);
        if($res){
            $sql_getid="SELECT id FROM `".$table."` WHERE email='".$_POST['email']."'";
            $res_id=mysqli_fetch_assoc(mysqli_query($conn,$sql_getid));
            $sql_verify="INSERT INTO `".$verify_table."`(`id`) VALUES (".$res_id['id'].")";
            $verify=mysqli_query($conn,$sql_verify);
            if($verify){
                $_GET['sucess']='Data Updated and verified';    
                echo "<script>location.replace('validate.php?error=You have registered')</script>";            
            }
        }
        }
        else{
            
        echo "<script>location.replace('validate.php?error=You have registered')</script>";
        }
    }
    else{
        echo "<script>alert('Emails Don't match')</script>";
        echo "<script>location.replace('register.php?error=Emails dont match')</script>";
        $mail_not_match=true;
    }
    
}
