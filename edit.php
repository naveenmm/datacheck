<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>

<body>
    <?php
    echo $_POST['mail'];
    include_once "db.php";
    $sql = "SELECT * FROM `internship_reg` WHERE email='" . $_POST['mail'] . "' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <center>
            <div class="headings">
                <h1>SOTI Campus Recruitment 2021</h1>
                <h3>Online Exam Registration Form</h3>
            </div>
            <form action="sucess.php" method="post">
                <div>
                    <label>Candidate Name (In Capitals)*</label><br><br>
                    <input type="text" id="name" value="<?php echo $row['Full_Name']; ?>" name="name" required placeholder="Name">
                </div>
                <div>
                    <label>Email *</label><br><br>
                    <input type="email" id="email" value="<?php echo $row['email']; ?>" name="email" required placeholder="Email">
                </div>
                <div>
                    <label>Phone number *</label><br><br>
                    <input type="text" id="phone" maxlength="10" value="<?php echo $row['phone']; ?>" name="phone" required placeholder="Phone">
                </div>
                <br><input type="submit" value="SUBMIT">
            </form>
        </center><?php
                }
                    ?>

</body>

</html>