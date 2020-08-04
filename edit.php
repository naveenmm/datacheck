<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOTI Registration</title>
    <script src="edit.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="register.css">
    <script src="edit.js"></script>
</head>

<body>
    <?php
    //getting post data from validate.php
    if (isset($_POST['check'])) {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $applied = $_POST['apply'];
        session_start();//setting sessions for updating in the end
        $_SESSION["applied"] = $applied;
        $_SESSION["mail"] = $_POST['email'];
        $_SESSION["phone"] = $_POST['phone'];
    }
    include_once "db.php";
    //if both email and phone are given
    if ($email != null and $phone != null) {        
        $sql = "SELECT * FROM `" . $applied . "` WHERE email='" . $email . "' and phone='" . $phone . "'";
        //echo $sql;
        if (mysqli_num_rows(mysqli_query($conn, $sql)) < 1) {
            $sqlemail = "SELECT * FROM `" . $applied . "` WHERE email='" . $email . "'";
            $sqlphone = "SELECT * FROM `" . $applied . "` WHERE phone='" . $phone . "'";
            //if email data is only available
            if (mysqli_num_rows(mysqli_query($conn, $sqlemail)) < mysqli_num_rows(mysqli_query($conn, $sqlphone))) {
                $sql = $sqlphone;
                $_SESSION["mail"]="";
                $_SESSION["phoneedit"] = false;
                $_SESSION["mailedit"] = true;
            } 
            //if phone data is available
            elseif (mysqli_num_rows(mysqli_query($conn, $sqlphone)) < mysqli_num_rows(mysqli_query($conn, $sqlemail))) {
                $sql = $sqlemail;
                $_SESSION["phone"]="";
                $_SESSION["mailedit"] = false;
                $_SESSION["phoneedit"] = true;
            }             
             elseif (mysqli_num_rows(mysqli_query($conn, $sqlphone)) == mysqli_num_rows(mysqli_query($conn, $sqlemail))) {
                 $sql = $sqlemail;
                 $_SESSION["phone"]="";
                 $_SESSION["mailedit"] = false;
                 $_SESSION["phoneedit"] = true;
             }
        } 
        else {
            $_SESSION["mailedit"] = false;
            $_SESSION["phoneedit"] = false;
        }
    } elseif ($email == null and $phone != null) {
        $sql = "SELECT * FROM `" . $applied . "` WHERE phone='" . $phone . "'";
    } elseif ($email != null and $phone == null) {
        $sql = "SELECT * FROM `" . $applied . "` WHERE email='" . $email . "'";
    } elseif ($email == null and $phone == null) {
        $sql = '';
        header('Location:validate.php?error=Enter any data');
    }
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) < 1) {
        header('Location:validate.php?error=No data found. Did you choose the correct option in the drop down?');
    }
    //fetching data if available
    while ($row = mysqli_fetch_assoc($res)) {
        $_SESSION['id'] = $row['id'];
        $name = $row['Full_Name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $collegeid = $row['collegeid'];
        $address = $row['address'];
        $hometown = $row['home_town'];
        $course = $row['course'];
        $branch = $row['branch'];
        $college = $row['college'];
        $year = $row['year_of_passing'];
        if ($_SESSION['applied'] == 'internship_reg') {
            $verify_table = "verified_interns";
        } elseif ($_SESSION['applied'] == 'full_time_reg') {
            $verify_table = "verified_full_time";
        }
        $verify_sql = "SELECT * FROM `" . $verify_table . "` WHERE id='" . $_SESSION['id'] . "'";
        //checking if already verified
        if (mysqli_num_rows(mysqli_query($conn, $verify_sql)) > 0) {
            header('Location:validate.php?error=You have already Verified data. Any queries contact your college placement officer');
        }
    }
    ?>
    <center>
        <div class="headings">
            <h1>SOTI Campus Recruitment 2021</h1>
            <h3>Online Exam Registration Form</h3>
        </div>
        <div class="centerdiv"> 
            <!-- <form id="editform"> -->
        <div>
            <label>Candidate Name (In Capitals)*</label><br><br>
            <input type="text" id="name" value="<?php echo $name; ?>" name="name" required placeholder="Name">
            <!-- <button id='name_enable' onclick="enable('name')">Edit</button>
            <button id='name_disable' onclick="disable('name')" hidden>Confirm</button> -->
        </div>
        <div>
            <label>Email *</label><br><br>
            <input type="email" id="email" value="<?php echo $email; ?>" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required placeholder="Email" <?php if ($_SESSION["mailedit"] == false){echo "disabled";}?>>
        </div>
        <div>
            <label>Mobile Number * <small>(Enter valid Indian 10 digit Phone number)</small></label><br><br>
            <input type="text" id="phone" maxlength="10" minlength="10" pattern="[0-9]{10}" value="<?php echo $phone; ?>" name="phone" required placeholder="Phone" <?php if ($_SESSION["phoneedit"] == false){echo "disabled";}?>>
        </div>
        <div>
            <label>College id *</label><br><br>
            <input type="text" id="collegeid" value="<?php echo $collegeid; ?>" name="collegeid" required placeholder="Name">
        </div>
        <div>
            <label>Address *</label><br><br>
            <input type="text" id="address" value="<?php echo $address ?>" multiple name="address" placeholder="Address" required>
        </div>
        <div>
            <label>Candidate Home Town / State *</label><br><br>
            <input type="text" id="hometown" value="<?php echo $hometown ?>" name="hometown" placeholder="Home Town" required>
        </div>
        <div>
            <label>Course * <small>(Current Course)</small></label><br><br>            
            <input type="text" id="course" name="course" value="<?php echo $course ?>" disabled placeholder="Course">
        </div>
        <div>
            <label>Branch *</label><br><br>
            <input type="text" id="branch" name="branch" value="<?php echo $branch ?>" disabled placeholder="Branch">
        </div>
        <div>
            <label>Name of the College *</label><br><br>
            <input type="text" list="collegelistdata" id="college" name="college" value="<?php echo $college ?>" placeholder="College" required>
            <datalist id="collegelistdata">
                    <?php
                    $sqlcollegelist="SELECT name FROM `college_list`";
                    $res=mysqli_query($conn,$sqlcollegelist);
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<option value='".$row['name']."'>";
                    }
                    ?>
                </datalist>
        </div>
        <div>
            <label>Year of Passing *</label><br><br>
            <input type="text" id="year" name="year" value="<?php echo $year ?>" placeholder="Year of Passing" minlength="4" maxlength="4" required>
        </div>
        <div>
            <label>Comments</label>
            <small><small><br><br>
            <textarea rows=3 id="comments" name="comments" placeholder="Comments" maxlength="100" style="width:100%"></textarea>
            </div>
        <!-- </form> -->
        <br><button class="confirm" value="CONFIRM" data-toggle="modal" data-target="#myModal" onclick=" func()">CONFIRM</button><br><br>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Check Details</h4>
                    </div> 
                    <script>
                            function func(){
                            document.getElementById('namediv').innerHTML="";
                            document.getElementById('phonediv').innerHTML="";
                            document.getElementById('collegeiddiv').innerHTML="";
                            document.getElementById('emaildiv').innerHTML="";
                            document.getElementById('addressdiv').innerHTML="";
                            document.getElementById('hometowndiv').innerHTML="";
                            document.getElementById('collegediv').innerHTML="";
                            document.getElementById('yeardiv').innerHTML="";
                            var name = "Name:" + document.getElementById('name').value;
                            var phone = "Phone:" + document.getElementById('phone').value;
                            var collegeid = "CollegeId:" + document.getElementById('collegeid').value;
                            var email = "Email:" + document.getElementById('email').value;
                            var address = "Address:" + document.getElementById('address').value;
                            var hometown = "Hometown:" + document.getElementById('hometown').value;
                            var college = "College:" + document.getElementById('college').value;
                            var year = "Year of Passing:" + document.getElementById('year').value;
                            document.getElementById('namediv').appendChild(document.createTextNode(name));
                            document.getElementById('phonediv').appendChild(document.createTextNode(phone));
                            document.getElementById('collegeiddiv').appendChild(document.createTextNode(collegeid));
                            document.getElementById('emaildiv').appendChild(document.createTextNode(email));
                            document.getElementById('addressdiv').appendChild(document.createTextNode(address));
                            document.getElementById('hometowndiv').appendChild(document.createTextNode(hometown));
                            document.getElementById('collegediv').appendChild(document.createTextNode(college));
                            document.getElementById('yeardiv').appendChild(document.createTextNode(year));
                            if(document.getElementById('name').value=="" || document.getElementById('phone').value=="" || document.getElementById('collegeid').value=="" || document.getElementById('email').value=="" || document.getElementById('address').value=="" || document.getElementById('hometown').value=="" || document.getElementById('college').value=="" || document.getElementById('year').value=="" || document.getElementById('phone').value.length!=10 ||document.getElementById('year').value.length!=4){
                                if(document.getElementById('phone').value.length!=10 ||document.getElementById('year').value.length!=4){
                                    document.getElementById("posteditbtn").style.visibility='hidden';
                                    document.getElementById("errordiv").innerHTML="Check phone number(10 digit) and year of passing";
                                }                                   
                                else{
                                    document.getElementById("posteditbtn").style.visibility='hidden';
                                    document.getElementById("errordiv").innerHTML="Fill all fields";
                                }                                
                                }
                            else{
                                if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('email').value)==false)
                                    {
                                        document.getElementById("posteditbtn").style.visibility='hidden';
                                        document.getElementById("errordiv").innerHTML="check your email(wrong format)";
                                    }
                                    else{
                                document.getElementById("posteditbtn").style.visibility='visible';
                                document.getElementById("errordiv").innerHTML="";
                                    }
                                }
                            }
                        </script>
                    <div id='namediv' class="modal-body">                                           
                    </div>
                    <div id="phonediv">
                    </div>
                    <div id="collegeiddiv">
                    </div>
                    <div id="emaildiv">
                    </div>
                    <div id="addressdiv">
                    </div>
                    <div id="hometowndiv">
                    </div>
                    <div id="collegediv">
                    </div>
                    <div id="yeardiv">
                    </div>
                    <div>
                        <p style="color:crimson" id="errordiv"></p>
                    <p style="color:crimson">Data cannot be changed once confirmed. Are you sure?</p>
                        <button type="button" id="posteditbtn" onclick="post_edited()">CONFIRM</button>
                        <button type="button" data-dismiss="modal">CANCEL</button>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </center>
</body>

</html>