<?php
            if(isset($_POST['check']))
            {
                $val=$_POST['repetition'];
                switch($val)
                {
                    case "byname":
                        $querystr="Full_Name";
                    break;
                    case "byemail":
                        $querystr="email";
                    break;
                    case "phone":
                        $querystr="phone";
                    break;
                }
            
            $sql="SELECT a.* FROM internship_reg a JOIN (SELECT Full_Name, email, phone, COUNT(*) FROM internship_reg GROUP BY Full_Name, email,phone HAVING count(*) > 1 ) b ON a.".$querystr." = b.".$querystr;   
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<table>
                        <tr>
                        <th>Name</th>
                        <th>email</th>
                        <th>phone</th>
                        </tr>";
              while($row=mysqli_fetch_array($res))
              {
                echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
              }
              echo "</table>";
            }
            else 
            {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
