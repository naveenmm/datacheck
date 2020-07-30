<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>    
    <script src="edit.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="register.css">
    <script src="edit.js"></script>
</head>

<body>
    <?php
    if(isset($_POST['check']))
    {
        $collegeid="";
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $applied=$_POST['apply'];
        session_start();
        $_SESSION["applied"] = $applied;
        $_SESSION["mail"] = $_POST['email'];
        $_SESSION["phone"]=$_POST['phone'];
    }
    echo $_POST['email'];
    include_once "db.php";
    if($email!=null and $phone!=null)
    {
        //$sql="SELECT * FROM `".$applied."` WHERE email='".$email."' UNION ALL SELECT * FROM `".$applied."` WHERE phone='".$phone."'";
        $sql="SELECT * FROM `".$applied."` WHERE email='".$email."' and phone='".$phone."'";
        echo $sql;
        if(mysqli_num_rows(mysqli_query($conn, $sql))<1)
        {
            $sqlemail="SELECT * FROM `".$applied."` WHERE email='".$email."'";
            $sqlphone="SELECT * FROM `".$applied."` WHERE phone='".$phone."'";
            if(mysqli_num_rows(mysqli_query($conn, $sqlemail))<mysqli_num_rows(mysqli_query($conn, $sqlphone))){
                $sql=$sqlphone;
                $_SESSION["phoneedit"]=false;
                $_SESSION["mailedit"] =true;
            }
            elseif(mysqli_num_rows(mysqli_query($conn, $sqlphone))<mysqli_num_rows(mysqli_query($conn, $sqlemail))){
                $sql=$sqlemail;
                $_SESSION["mailedit"] =false;
                $_SESSION["phoneedit"]=true;
            }
            elseif(mysqli_num_rows(mysqli_query($conn, $sqlphone))==mysqli_num_rows(mysqli_query($conn, $sqlemail)))
            {
                $sql=$sqlemail;
                $_SESSION["mailedit"] =false;
                $_SESSION["phoneedit"]=true;
            }
        }
        else{
            $_SESSION["mailedit"] =false;
            $_SESSION["phoneedit"]=false;
        }
    }
    elseif($email==null and $phone!=null)
    {
        $sql="SELECT * FROM `".$applied."` WHERE phone='".$phone."'";        
    }
    elseif($email!=null and $phone==null)
    {
        $sql="SELECT * FROM `".$applied."` WHERE email='".$email."'";        
    }
    elseif($email==null and $phone==null){
        $sql='';
        header('Location:validate.php?error=Enter any data');
    }
    //$sql = "SELECT * FROM `" . $_SESSION["applied"] . "` WHERE email='" . $_POST['email'] . "' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res)<1){
        header('Location:validate.php?error=No data found');
    }
    echo $sql;
    while ($row = mysqli_fetch_assoc($res)) {
        $_SESSION['id']=$row['id'];
        $name = $row['Full_Name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $collegeid = $row['collegeid'];
        $address = $row['address'];
        $hometown = $row['home_town'];
        $graduation_course = $row['graduation_course'];
        $graduation_branch = $row['graduation_branch'];
        $graduation_college = $row['graduation_college'];
        $graduation_year = $row['graduation_year'];
        $post_graduation_course = $row['post_graduation_course'];
        $post_graduation_branch = $row['post_graduation_branch'];
        $post_graduation_college = $row['post_graduation_college'];
        $post_graduation_year = $row['post_graduation_year'];
        if($_SESSION['applied']=='internship_reg')
        {
            $verify_table="verified_interns";
        }
        elseif($_SESSION['applied']=='full_time_reg')
        {
            $verify_table="verified_full_time";
        }
        $verify_sql="SELECT * FROM `".$verify_table."` WHERE id='".$_SESSION['id']."'";
        if(mysqli_num_rows(mysqli_query($conn,$verify_sql))>0)
        {
            header('Location:validate.php?error=You have already Verified data. Contact admin for details');
        }
    }
    ?>
    <center>
        <div class="headings">
            <h1>SOTI Campus Recruitment 2021</h1>
            <h3>Online Exam Registration Form</h3>
        </div>
        <!--<form action="validate.php" method="post">-->
        <div>
            <label>Candidate Name (In Capitals)*</label><br><br>
            <input type="text" id="name" readonly="true" value="<?php echo $name; ?>" name="name" required placeholder="Name" disabled>
            <button id='name_enable' onclick="enable('name')">Edit</button>
            <button id='name_disable' onclick="disable('name')" hidden>Confirm</button>
        </div>
        <div>
            <label>Email *</label><br><br>
            <input type="email" id="email" value="<?php echo $email; ?>" name="email" required placeholder="Email" disabled>
            <?php if($_SESSION["mailedit"] == true){?>
            <button id='email_enable' onclick="enable('email')">Edit</button>
            <button id='email_disable' onclick="disable('email')" hidden>Confirm</button>
            <?php }?>
        </div>
        <div>
            <label>Phone number *</label><br><br>
            <input type="text" id="phone" maxlength="10" value="<?php echo $phone; ?>" name="phone" required placeholder="Phone" disabled>
            <?php if($_SESSION["phoneedit"] == true){?>
            <button id='phone_enable' onclick="enable('phone')">Edit</button>
            <button id='phone_disable' onclick="disable('phone')" hidden>Confirm</button>
            <?php }?>
        </div>
        <div>
            <label>College id *</label><br><br>
            <input type="text" id="collegeid" readonly="true" value="<?php echo $collegeid; ?>" name="collegeid" required placeholder="Name" disabled>
            <button id='collegeid_enable' onclick="enable('collegeid')">Edit</button>
            <button id='collegeid_disable' onclick="disable('collegeid')" hidden>Confirm</button>
        </div>
        <div>
            <label>Address (In Capitals)*</label><br><br>
            <input type="text" id="address" value="<?php echo $address ?>" multiple name="address" placeholder="Address" disabled>
            <!-- <button id='address_enable' onclick="enable('address')">Edit</button>
            <button id='address_disable' onclick="disable('address')" hidden>Confirm</button> -->
        </div>
        <div>
            <label>Candidate Home Town *</label><br><br>
            <input type="text" id="hometown" value="<?php echo $hometown ?>" name="hometown" disabled placeholder="Home Town">
            <button id='hometown_enable' onclick="enable('hometown')">Edit</button>
            <button id='hometown_disable' onclick="disable('hometown')" hidden>Confirm</button>
        </div>
        <!--Graduation Details-->
        <?php
        if ($_SESSION["applied"] != 'internship_reg') { ?>
            <div>
                <label>Course : Graduation *</label><br><br>
                <select name="graduation" id="graduation" value="<?php echo $graduation_course ?>" disabled>
                    <option value="B.Tech/BE">B.Tech/BE</option>
                    <option value="BCA">BCA</option>
                    <option value="BSc">BSc</option>
                    <option value="Others">others</option>
                </select>
                <!-- <button id='graduation_enable' onclick="enable('graduation')">Edit</button>
                <button id='graduation_disable' onclick="disable('graduation')" hidden>Confirm</button> -->
            </div>
            <div>
                <label>Graduation Branch *</label><br><br>
                <select name="graduationbranch" id="graduationbranch" value="<?php echo $graduation_branch ?>" disabled>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Electronics and Communication">Electronics and Communication</option>
                    <option value="Information Science">Information Science</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Others">others</option>
                </select>
                <!-- <button id='graduationbranch_enable' onclick="enable('graduationbranch')">Edit</button>
                <button id='graduationbranch_disable' onclick="disable('graduationbranch')" hidden>Confirm</button> -->
            </div>
            <div>
                <label>Name of the College - Graduated *</label><br><br>
                <input type="text" id="graduationCollege" name="graduationCollege" value="<?php echo $graduation_college ?>" disabled placeholder="Graduated College">
                <!-- <button id='graduationCollege_enable' onclick="enable('graduationCollege')">Edit</button>
                <button id='graduationCollege_disable' onclick="disable('graduationCollege')" hidden>Confirm</button> -->
            </div>
            <div>
                <label>Year of Passing-Graduation *</label><br><br>
                <input type="text" id="graduationPass" name="graduationPass" value="<?php echo $graduation_year ?>" disabled placeholder="Year of Passing">
                <!-- <button id='graduationPass_enable' onclick="enable('graduationPass')">Edit</button>
                <button id='graduationPass_disable' onclick="disable('graduationPass')" hidden>Confirm</button> -->
            </div>
        <?php } ?>
        <div>
            <label>Course : POST-Graduation *</label><br><br>
            <select name="post_graduation" id="post_graduation" value="<?php echo $post_graduation_course ?>" disabled>
                <option value="B.Tech/BE">B.Tech/BE</option>
                <option value="BCA">BCA</option>
                <option value="BSc">BSc</option>
                <option value="Others">others</option>
            </select>
            <!-- <button id='post_graduation_enable' onclick="enable('post_graduation')">Edit</button>
            <button id='post_graduation_disable' onclick="disable('post_graduation')" hidden>Confirm</button> -->
        </div>
        <div>
            <label>POST-Graduation Branch *</label><br><br>
            <select name="post_graduationbranch" id="post_graduationbranch" value="<?php echo $post_graduation_branch ?>" disabled>
                <option value="Computer Science">Computer Science</option>
                <option value="Electronics and Communication">Electronics and Communication</option>
                <option value="Information Science">Information Science</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Others">others</option>
            </select>
            <!-- <button id='post_graduationbranch_enable' onclick="enable('post_graduationbranch')">Edit</button>
            <button id='post_graduationbranch_disable' onclick="disable('post_graduationbranch')" hidden>Confirm</button> -->
        </div>
        <div>
            <label>Name of the College - POST-Graduated *</label><br><br>
            <input type="text" id="post_graduationCollege" name="post_graduationCollege" value="<?php echo $post_graduation_college ?>" disabled placeholder="POST Graduated College">
            <!-- <button id='post_graduationCollege_enable' onclick="enable('post_graduationCollege')">Edit</button>
            <button id='post_graduationCollege_disable' onclick="disable('post_graduationCollege')" hidden>Confirm</button> -->
        </div>
        <div>
            <label>Year of Passing-POST-Graduation *</label><br><br>
            <input type="text" id="post_graduationPass" name="post_graduationPass" value="<?php echo $post_graduation_year ?>" disabled placeholder="Year of Passing">
            <!-- <button id='post_graduationPass_enable' onclick="enable('post_graduationPass')">Edit</button>
            <button id='post_graduationPass_disable' onclick="disable('post_graduationPass')" hidden>Confirm</button> -->
        </div>
        <br><button value="CONFIRM" data-toggle="modal" data-target="#myModal" onclick="display_details()">CONFIRM</button><br><br>
            <!-- </form> -->

        <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Check Details</h4>
      </div>
      <div id='details_confirm' class="modal-body">
          <script>
              if(!document.getElementById('graduationCollege'))
    {
        var grad="nil";
    }
    else{
        var grad=document.getElementById('graduationCollege').value;
    }
    if(!document.getElementById('post_graduationCollege'))
    {
        var postgrad="nil";
    }
    else{
        var postgrad=document.getElementById('post_graduationCollege').value;
    }
    var details="Name:"+document.getElementById('name').value+"\nCollegeid:"+document.getElementById('collegeid').value+"\nEmail:"+document.getElementById('email').value+"\nPhone:"+document.getElementById('phone').value+"\nGraduation College:"+grad+"\nPOST-Graduation College:"+postgrad;
    document.createTextNode(details)
    document.getElementById('details_confirm').appendChild(document.createTextNode(details));
          </script>
      </div>
      <div>
        <button type="button" onclick="post_edited()">CONFIRM</button>
        <button type="button" data-dismiss="modal">CANCEL</button>
      </div>
    </div>

  </div>
</div>
        
    </center>
</body>

</html>