<?php
// function printTable($conn,$sql){
//     $res=mysqli_query($conn,$sql);
//     if(mysqli_num_rows($res)){
//     if($res)
//     {   
//         //echo "<form action='selectData.php' method='post'>";
//         echo "<table>
//         <tr>
//         <th>Select</th>
//         <th>Name</th>
//         <th>email</th>
//         <th>phone</th>
//         <th>Graduation</th>
//         <th>PG</th>
//         </tr>";
//         include_once "selectData.php";       
//             //echo "</form>";
//     }
//     else 
//     {
//      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//     }
//     }
//     else{
//         echo 'No data found';
//     }
//     //include_once "selectData.php";
//     }

if(isset($_POST['check']))
{
    //$collegeid=$_POST['collegeid'];
    $collegeid="";
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $applied=$_POST['apply'];
    session_start();
    $_SESSION["applied"] = $applied;
    if($email==null and $phone==null and $collegeid!=null)
    {
        $sql="SELECT * FROM `".$applied."` WHERE collegeid='".$collegeid."'";
        //printTable($conn,$sql);
    }
    elseif($email==null and $phone!=null and $collegeid==null)
    {
        $sql="SELECT * FROM `".$applied."` WHERE phone='".$phone."'";
        //printTable($conn,$sql);
    }
    elseif($email!=null and $phone==null and $collegeid==null)
    {
        $sql="SELECT * FROM `".$applied."` WHERE email='".$email."'";
        //printTable($conn,$sql);
    }
    elseif($email!=null and $phone!=null and $collegeid==null) 
    {
        $sql="SELECT * FROM `".$applied."` WHERE email='".$email."' UNION ALL SELECT * FROM `".$applied."` WHERE phone='".$phone."'";
        //printTable($conn,$sql);
    }
    elseif($email!=null and $phone==null and $collegeid!=null) 
    {
        $sql="SELECT * FROM `".$applied."` WHERE email='".$email."' UNION ALL SELECT * FROM `".$applied."` WHERE collegeid='".$collegeid."'";
        //printTable($conn,$sql);
    }
    elseif($email==null and $phone!=null and $collegeid!=null) 
    {
        $sql="SELECT * FROM `".$applied."` WHERE collegeid='".$collegeid."' UNION ALL SELECT * FROM `".$applied."` WHERE phone='".$phone."'";
        //printTable($conn,$sql);
    }
    elseif($email==null and $phone==null and $collegeid==null)
    {
        echo "<script>alert('Enter any data')</script>";
    }
    else{
        $sql="SELECT * FROM `".$applied."` WHERE collegeid='".$collegeid."' UNION ALL SELECT * FROM `".$applied."` WHERE email='".$email."' UNION ALL SELECT * FROM `".$applied."` WHERE phone=".$phone;
        //printTable($conn,$sql);
    }    
}
