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
        }
        ?>
        <form action="edit.php" method="post">
            <div>
                <label>Email</label><br><br>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <label>Phone number</label><br><br>
                <input type="text" id="phone" pattern="[0-9]{10}" maxlength="10" name="phone" placeholder="Mobile" required title="Enter a valid 10 digit phone number">
            </div>
            <br><input type="submit" name="check" value="SUBMIT">&nbsp;&nbsp;<a href="register.php">Register only if no data found</a>
        </form><br>
        
    </center>
</body>

</html>