<?php
include_once "db.php";
function checkIfExists($conn){
    $sql_getemail="SELECT email FROM `registration` WHERE email='".$_POST['email']."'";
    if(mysqli_num_rows(mysqli_query($conn,$sql_getemail))>0){        
        return true;
    }
    else{
        return false;
    }
}

if(isset($_POST['submit'])){
    
    if($_POST['email']==$_POST['mail'])
    {
        if(checkIfExists($conn)==false){
            $sql="INSERT INTO `registration`(`Full_Name`,`email`, `phone`, `collegeid`, `address`, `home_town`, `course`, `branch`, `college`, `year_of_passing`,`applied`,`comments`) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['collegeid']."','".$_POST['address']."','".$_POST['hometown']."','".$_POST['course']."','".$_POST['branch']."','".$_POST['college_name']."','".$_POST['pass']."','".$_POST['apply']."','".$_POST['comments']."')";
            $res=mysqli_query($conn,$sql);
            if($res){
                $sql_getid="SELECT id FROM `registration` WHERE email='".$_POST['email']."'";
                $res_id=mysqli_fetch_assoc(mysqli_query($conn,$sql_getid));
                $sql_verify="INSERT INTO `verified`(`id`) VALUES (".$res_id['id'].")";
                $verify=mysqli_query($conn,$sql_verify);
                if($verify){  
                    echo "<script>location.replace('validate.php?error=You have registered sucessfully')</script>";            
                }
            }
        }
        else{            
            echo "<script>location.replace('validate.php?error=You have already registered. Please Validate')</script>";
        }
    }
    else
    {
        echo "<script>alert('Emails Don't match')</script>";
        echo "<script>location.replace('register.php?error=Emails dont match')</script>";
        $mail_not_match=true;
    }
    
}
