<?php include_once "db.php"; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="edit.js"></script>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>

<body>
    <center>
        <div class="headings">
            <h1>SOTI Campus Recruitment 2021</h1>
            <h3>Online Exam Registration Form</h3>
        </div>
        <?php 
        if(isset($_GET['error'])){
            echo "<script>alert('Emails Don't match');</script>";
            echo "<strong>Emails dont match. Enter details again</strong>";
        }     
        ?>
        <form action="register_check.php" method="post">
            <div>
                <label>Candidate Name (In Capitals)*</label><br><br>
                <input type="text" id="name" name="name" required placeholder="Name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>">
            </div>
            <div>
                <label>Email *</label><br><br>
                <input type="email" id="email" name="email" required placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; }?>">
            </div>
            <div id="maildiv">
                <label>Re Enter Email (BOTH Emails must match)*</label><br><br>
                <input type="text" id="mail" name="mail" required placeholder="Email" value="<?php if(isset($_POST['mail'])){ echo $_POST['mail']; }?>">
            </div>
            <div>
                <label>Address (In Capitals)*</label><br><br>
                <input type="text" id="address" name="address" required placeholder="Address" maxlength="358" value="<?php if(isset($_POST['address'])){ echo $_POST['address'];} ?>">
            </div>
            <div>
                <label>Phone number *</label><br><br>
                <input type="text" id="phone" minlength="10" maxlength="10" name="phone" required placeholder="Phone" pattern="[0-9]{10}" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; }?>">
            </div>
            <div>
                <label>Candidate Home Town *</label><br><br>
                <input type="text" id="hometown" name="hometown" required placeholder="Home Town" value="<?php if(isset($_POST['hometown'])){ echo $_POST['hometown'];} ?>">
            </div>
            <div>
                <label>Interested to apply for *</label><br><br>
                <select name="apply" id="apply" required value="<?php if(isset($_POST['apply'])){ echo $_POST['apply'];}?>">
                    <option value="INTERNSHIP">FULL TIME INTERNSHIP(6 Months)</option>
                    <option value="FULL TIME DEVELOPER">FULL TIME DEVELOPER</option>
                </select>
            </div>
            <div>
                <label>Name of College *</label><br><br>
                <input type="text" id="college_name" name="college_name" required placeholder="Graduated College" value="<?php if(isset($_POST['college_name'])){ echo $_POST['college_name']; }?>">
            </div>
            <div>
                <label>College ID *</label><br><br>
                <input type="text" id="collegeid" name="collegeid" required placeholder="College-ID" value="<?php if(isset($_POST['collegeid'])){ echo $_POST['collegeid']; }?>">
            </div>
            <!--Graduation Details-->
            <div>
                <label>Course(Current)*</label><br><br>
                <select name="course" id="course" required value="<?php if(isset($_POST['course'])){ echo $_POST['course']; }?>">
                    <option value="B.Tech/BE">B.Tech/BE</option>
                    <option value="BCA">BCA</option>
                    <option value="BSc">BSc</option>
                    <option value="M.Tech">M.Tech</option>
                    <option value="MCA">MCA</option>
                    <option value="MSc">MSc</option>
                    <option value="Others">others</option>
                </select>
            </div>
            <div>
                <label>Graduation Branch *</label><br><br>
                <select name="branch" id="branch" required value="<?php if(isset($_POST['branch'])){ echo $_POST['branch']; }?>">
                    <option value="Computer Science">Computer Science</option>
                    <option value="Electronics and Communication">Electronics and Communication</option>
                    <option value="Information Science">Information Science</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Others">others</option>
                </select>
            </div>
            <div>
                <label>Year of Passing *</label><br><br>
                <input type="text" id="pass" name="pass" required placeholder="Year of Passing" maxlength="4" minlength="4" value="<?php if(isset($_POST['pass'])){ echo $_POST['pass']; }?>">
            </div>
            <!--<div>
                <label>Name of the College - Post-Graduated *</label><br><br>
                <input type="text" id="postgraduationCollege" name="postgraduationCollege" required
                    placeholder="Post-Graduated College">
            </div>-->
            <!-- <div>
                <label>Name of the College - Post-Graduated *</label><br><br>
                    <select name="postgraduationCollege" id="postgraduationCollege" required>
                    <?php
                    /*$sql="SELECT name FROM college_list";
                    $res=mysqli_query($conn,$sql);
                    if($res)
                    {
                        while($row=mysqli_fetch_array($res)){
                            echo "<option value='".$row[0]."'>".$row[0]."</option>";
                        }
                    }
                    else 
                    {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }*/

                    ?>   
                </select>
            </div> -->

            <br><input type="submit" value="SUBMIT" name="submit">
        </form>

        <?php include "register_check.php";     
        ?>
    </center>
    
</body>


</html>