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

        <div>
            <label>Course *</label><br><br>
            <input type="text" id="course" name="course" value="<?php echo $course ?>" disabled placeholder="Course">
        </div>
        <div>
            <label>Branch *</label><br><br>
            <input type="text" id="branch" name="branch" value="<?php echo $branch ?>" disabled placeholder="Branch">
        </div>
        <div>
            <label>Name of the College *</label><br><br>
            <input type="text" id="college" name="college" value="<?php echo $college ?>" disabled placeholder="College">
            <button id='college_enable' onclick="enable('college')">Edit</button>
            <button id='college_disable' onclick="disable('college')" hidden>Confirm</button>
        </div>
        <div>
            <label>Year of Passing *</label><br><br>
            <input type="text" id="year" name="year" value="<?php echo $year ?>" disabled placeholder="Year of Passing">
        </div>
        <br><button value="CONFIRM" data-toggle="modal" data-target="#myModal">CONFIRM</button><br><br>

        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Check Details</h4>
                    </div>
                    <div id='details_confirm' class="modal-body">
                        <script>
                            if (!document.getElementById('college')) {
                                var college = "nil";
                            } else {
                                var college = document.getElementById('college').value;
                            }

                            var details = "Name:" + document.getElementById('name').value + "\nCollegeid:" + document.getElementById('collegeid').value + "\nEmail:" + document.getElementById('email').value + "\nPhone:" + document.getElementById('phone').value + "\College:" + college;
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