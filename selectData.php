<?php

while ($row = mysqli_fetch_assoc($res)) {
    echo "<tr><td><input type='radio' id='selected' name='selected' value='" . $row['email'] . "'></td><td>" . $row['Full_Name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['graduation_course'] . "</td><td>" . "</td><td>" . $row['post_graduation_course'] . "</td></tr>";
}
echo "</table>";
?><script>
    function checkSelected() {
        var check = 0;
        var checkvalue;
        var sel = document.getElementsByName('selected');
        for (i = 0; i < sel.length; i++) {
            if (sel[i].checked) {
                checkvalue = sel[i].value;
                check = 1;
            }
        }
        if (check == 1) {
            const form = document.createElement('form');
            form.method = 'post';
            form.action = 'edit.php';
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = 'mail';
            hiddenField.value = checkvalue;
            form.appendChild(hiddenField);
            document.body.appendChild(form);
            form.submit();
        } else {
            alert('Select any data');
        }
    }
</script><?php
            echo "<input type='button' onclick='checkSelected()' name='selectedradio' value='CHECK DATA'";
            ?>