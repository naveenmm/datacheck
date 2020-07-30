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
    if (isset($_POST['check'])) {
        $collegeid = "";
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $applied = $_POST['apply'];
        session_start();
        $_SESSION["applied"] = $applied;
        $_SESSION["mail"] = $_POST['email'];
        $_SESSION["phone"] = $_POST['phone'];
    }
    echo $_POST['email'];
    include_once "db.php";
    if ($email != null and $phone != null) {
        //$sql="SELECT * FROM `".$applied."` WHERE email='".$email."' UNION ALL SELECT * FROM `".$applied."` WHERE phone='".$phone."'";
        $sql = "SELECT * FROM `" . $applied . "` WHERE email='" . $email . "' and phone='" . $phone . "'";
        echo $sql;
        if (mysqli_num_rows(mysqli_query($conn, $sql)) < 1) {
            $sqlemail = "SELECT * FROM `" . $applied . "` WHERE email='" . $email . "'";
            $sqlphone = "SELECT * FROM `" . $applied . "` WHERE phone='" . $phone . "'";
            if (mysqli_num_rows(mysqli_query($conn, $sqlemail)) < mysqli_num_rows(mysqli_query($conn, $sqlphone))) {
                $sql = $sqlphone;
                $_SESSION["phoneedit"] = false;
                $_SESSION["mailedit"] = true;
            } elseif (mysqli_num_rows(mysqli_query($conn, $sqlphone)) < mysqli_num_rows(mysqli_query($conn, $sqlemail))) {
                $sql = $sqlemail;
                $_SESSION["mailedit"] = false;
                $_SESSION["phoneedit"] = true;
            } elseif (mysqli_num_rows(mysqli_query($conn, $sqlphone)) == mysqli_num_rows(mysqli_query($conn, $sqlemail))) {
                $sql = $sqlemail;
                $_SESSION["mailedit"] = false;
                $_SESSION["phoneedit"] = true;
            }
        } else {
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
    //$sql = "SELECT * FROM `" . $_SESSION["applied"] . "` WHERE email='" . $_POST['email'] . "' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) < 1) {
        header('Location:validate.php?error=No data found');
    }
    echo $sql;
    while ($row = mysqli_fetch_assoc($res)) {
        $_SESSION['id'] = $row['id'];
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
        if ($_SESSION['applied'] == 'internship_reg') {
            $verify_table = "verified_interns";
        } elseif ($_SESSION['applied'] == 'full_time_reg') {
            $verify_table = "verified_full_time";
        }
        $verify_sql = "SELECT * FROM `" . $verify_table . "` WHERE id='" . $_SESSION['id'] . "'";
        if (mysqli_num_rows(mysqli_query($conn, $verify_sql)) > 0) {
            header('Location:validate.php?error=You have already Verified data. Contact admin for details');
        }
    }
    ?>
    <center>
        <div class="headings">
            <h1>SOTI Campus Recruitment 2021</h1>
            <h3>Online Exam Registration Form</h3>
        </div>
        <div>
            <label>Candidate Name (In Capitals)*</label><br><br>
            <input type="text" id="name" readonly="true" value="<?php echo $name; ?>" name="name" required placeholder="Name" disabled>
            <button id='name_enable' onclick="enable('name')">Edit</button>
            <button id='name_disable' onclick="disable('name')" hidden>Confirm</button>
        </div>
        <div>
            <label>Email *</label><br><br>
            <input type="email" id="email" value="<?php echo $email; ?>" name="email" required placeholder="Email" disabled>
            <?php if ($_SESSION["mailedit"] == true) { ?>
                <button id='email_enable' onclick="enable('email')">Edit</button>
                <button id='email_disable' onclick="disable('email')" hidden>Confirm</button>
            <?php } ?>
        </div>
        <div>
            <label>Phone number *</label><br><br>
            <input type="text" id="phone" maxlength="10" value="<?php echo $phone; ?>" name="phone" required placeholder="Phone" disabled>
            <?php if ($_SESSION["phoneedit"] == true) { ?>
                <button id='phone_enable' onclick="enable('phone')">Edit</button>
                <button id='phone_disable' onclick="disable('phone')" hidden>Confirm</button>
            <?php } ?>
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
                <input type="text" id="graduation" name="graduation" value="<?php echo $graduation_course ?>" disabled placeholder="Graduated Course">
            </div>
            <div>
                <label>Graduation Branch *</label><br><br>
                <input type="text" id="graduationbranch" name="graduationbranch" value="<?php echo $graduation_branch ?>" disabled placeholder="Graduated Branch">
            </div>
            <div>
                <label>Name of the College - Graduated *</label><br><br>
                <input type="text" id="graduationCollege" name="graduationCollege" value="<?php echo $graduation_college ?>" disabled placeholder="Graduated College">
            </div>
            <div>
                <label>Year of Passing-Graduation *</label><br><br>
                <input type="text" id="graduationPass" name="graduationPass" value="<?php echo $graduation_year ?>" disabled placeholder="Year of Passing">
            </div>
        <?php } ?>
        <div>
            <label>Course : POST-Graduation *</label><br><br>
            <input type="text" id="post_graduation" name="post_graduation" value="<?php echo $post_graduation_course ?>" disabled placeholder="POST Graduation Course">
        </div>
        <div>
            <label>POST-Graduation Branch *</label><br><br>
            <input type="text" id="post_graduationbranch" name="post_graduationbranch" value="<?php echo $post_graduation_branch ?>" disabled placeholder="POST Graduated Branch">
        </div>
        <div>
            <label>Name of the College - POST-Graduated *</label><br><br>
            <input type="text" id="post_graduationCollege" name="post_graduationCollege" value="<?php echo $post_graduation_college ?>" disabled placeholder="POST Graduated College">
        </div>
        <div>
            <label>Year of Passing-POST-Graduation *</label><br><br>
            <input type="text" id="post_graduationPass" name="post_graduationPass" value="<?php echo $post_graduation_year ?>" disabled placeholder="Year of Passing">
        </div>
        <br><button value="CONFIRM" data-toggle="modal" data-target="#myModal" onclick="display_details()">CONFIRM</button><br><br>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Check Details</h4>
                    </div>
                    <div id='details_confirm' class="modal-body">
                        <script>
                            if (!document.getElementById('graduationCollege')) {
                                var grad = "nil";
                            } else {
                                var grad = document.getElementById('graduationCollege').value;
                            }
                            if (!document.getElementById('post_graduationCollege')) {
                                var postgrad = "nil";
                            } else {
                                var postgrad = document.getElementById('post_graduationCollege').value;
                            }
                            var details = "Name:" + document.getElementById('name').value + "\nCollegeid:" + document.getElementById('collegeid').value + "\nEmail:" + document.getElementById('email').value + "\nPhone:" + document.getElementById('phone').value + "\nGraduation College:" + grad + "\nPOST-Graduation College:" + postgrad;
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