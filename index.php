<?php include_once "db.php"; ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>

<body>
    <center>
        <div class="headings">
            <h1>SOTI Campus Recruitment 2021</h1>
            <h3>Online Exam Registration Form</h3>
        </div>
        <form method="post">
            <!--<div>
                <label>Enter College id</label><br><br>
                <input type="text" id="name" name="name" required placeholder="Name">
            </div>  -->
            <div>
                <label>Check Repetition</label><br><br>
                <select name="repetition" id="repetition" required>
                    <option value="byname">Check by name</option>
                    <option value="byemail">Check by mail</option>
                    <option value="phone">Check by phone number</option>
                </select>
            </div>
            <br><input type="submit" name="check" value="SUBMIT">
        </form>
        <?php include_once "check.php"; ?>

    </center>
</body>

</html>