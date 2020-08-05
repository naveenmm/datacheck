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
        <form action="" method="post">
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
                <label>Address *</label><br><br>
                <input type="text" id="address" name="address" required placeholder="Address" maxlength="358" value="<?php if(isset($_POST['address'])){ echo $_POST['address'];} ?>">
            </div>
            <div>
                <label>Mobile Number * <small>(Enter valid Indian 10 digit Mobile number</small></label><br><br>
                <input type="text" id="phone" minlength="10" maxlength="10" name="phone" required placeholder="Phone" title="Enter a valid 10 digit phone number" pattern="[0-9]{10}" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; }?>">
            </div>
            <div>
                <label>Candidate Home Town / State *</label><br><br>
                <input type="text" id="hometown" name="hometown" required placeholder="Home Town" value="<?php if(isset($_POST['hometown'])){ echo $_POST['hometown'];} ?>">
            </div>
            <div>
                <label>Interested to apply for *</label><br><br>
                <select name="apply" id="apply" required value="<?php if(isset($_POST['apply'])){ echo $_POST['apply'];}?>">
                    <option value="Intern">FULL TIME INTERNSHIP(6 Months)</option>
                    <option value="Fresher">FULL TIME DEVELOPER</option>
                </select>
            </div>
            <div>
                <label>Name of College *</label><br><br>
                <input type="text" list="collegelistdata" id="college_name" name="college_name" required placeholder="College" value="<?php if(isset($_POST['college_name'])){ echo $_POST['college_name']; }?>">
                <datalist id="collegelistdata">
                    <?php 
                    include_once "db.php";
                    $sql="SELECT name FROM `college_list`";
                    $res=mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<option value='".$row['name']."'>";
                    }
                    ?>
                </datalist>
            </div>
            <div>
                <label>College ID *</label><br><br>
                <input type="text" id="collegeid" name="collegeid" required placeholder="College-ID" value="<?php if(isset($_POST['collegeid'])){ echo $_POST['collegeid']; }?>">
            </div>
            
            <div>
                <label>Course * <small>(Current Course)</small></label><br><br>
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
                <label>Branch *</label><br><br>
                <select name="branch" id="branch" required value="<?php if(isset($_POST['branch'])){ echo $_POST['branch']; }?>">
                <?php 
                    //include_once "db.php";
                    $sql="SELECT branch FROM `branchlist`";
                    $res=mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<option value='".$row['branch']."'>".$row['branch']."</option>";
                    }?>
                </select>
            </div>
            <div>
                <label>Year of Passing *</label><br><br>
                <input type="text" id="pass" name="pass" pattern="[0-9]{4}" title="Enter a valid year of passing" required placeholder="Year of Passing" maxlength="4" minlength="4" value="<?php if(isset($_POST['pass'])){ echo $_POST['pass']; }?>">
            </div>
            <div>
            <label>Comments</label><br>
            <small>Any comments on the course or branch you selected<small><br><br>
            <textarea rows=3 id="comments" name="comments" placeholder="Comments" maxlength="100" style="width:100%"></textarea>
            </div>
            <br><input type="submit" value="SUBMIT" name="submit">
        </form>

        <?php include "register_check.php";     
        ?>
    </center>
    
</body>


</html>