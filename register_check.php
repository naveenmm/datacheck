<?php
function checkIfExists($table,$conn){
    $sql_getemail="SELECT email FROM `".$table."` WHERE email='".$_POST['email']."'";
    if(mysqli_num_rows(mysqli_query($conn,$sql_getemail))>0){        
        return true;
    }
    else{
        echo "checking false";
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
        if(checkIfExists($table,$conn)==false){
        $sql="INSERT INTO `".$table."`(`Full_Name`,`email`, `phone`, `collegeid`, `address`, `home_town`, `course`, `branch`, `college`, `year_of_passing`) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['collegeid']."','".$_POST['address']."','".$_POST['hometown']."','".$_POST['course']."','".$_POST['branch']."','".$_POST['college_name']."','".$_POST['pass']."')";
        $res=mysqli_query($conn,$sql);
        if($res){
            $sql_getid="SELECT id FROM `".$table."` WHERE email='".$_POST['email']."'";
            $res_id=mysqli_fetch_assoc(mysqli_query($conn,$sql_getid));
                echo $res_id['id'];
            
            $sql_verify="INSERT INTO `".$verify_table."`(`id`) VALUES (".$res_id['id'].")";
            $res=mysqli_query($conn,$sql);
            $verify=mysqli_query($conn,$sql_verify);
            if($verify){
                sleep(3);
                $_GET['sucess']='Data Updated and verified';                
            }
        }
        }
        else{
            echo "checking";
        echo "<script>location.replace('validate.php?error=You have registered')</script>";
        }
        
        //echo $sql;
    }
    else{
        echo "<script>alert('Emails Don't match')</script>";
    }
    
}
