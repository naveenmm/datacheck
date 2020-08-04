<?php include_once "db.php"; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOTI Registration</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
    <center>
        <div class="headings">
            <h1>SOTI Campus Recruitment 2021</h1>
            <h3>DETAILS VALIDATION FORM</h3>
        </div>
        <?php
        if (isset($_GET['error'])) {
            echo "<script>alert('" . $_GET['error'] . "')</script>";
        }
        if (isset($_GET['sucess'])) {
            echo "<script>alert('" . $_GET['sucess'] . "')</script>";
            session_unset();
        }
        ?>
        <form action="edit.php" method="post">
            <!--<div>
                <label>Enter College id</label><br><br>
                <input type="text" id="name" name="name" required placeholder="Name">
            </div>  -->
            <!-- <div> 
                <label>Validate</label><br><br>
                <input type="text" name="collegeid" placeholder="College ID" value="">
            </div>-->
            <div>
                <label>Email</label><br><br>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <label>Phone number</label><br><br>
                <input type="text" id="phone" maxlength="10" name="phone" placeholder="Phone" required>
            </div>
            <div>
                <label>Applied For</label><br><br>
                <select name="apply" id="apply">
                    <option value="internship_reg">FULL TIME INTERNSHIP(6 Months)</option>
                    <option value="full_time_reg">FULL TIME DEVELOPER(Fresher Hiring)</option>
                </select>
            </div>
            <br><input type="submit" name="check" value="SUBMIT">
        </form><br>
        <a href="register.php">Create new only if no data found</a>
    </center>
</body>

</html>