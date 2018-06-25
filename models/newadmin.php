<?php
        include_once("../includes/session.php");
        include_once("../includes/zz.php"); 
        include_once("../includes/functions.php"); 
            
        confirm_adminlogged_in();

        $fileName = $_FILES["admins"]["name"];
        $fileType = $_FILES["admins"]["type"];
        $filePath = $_FILES["admins"]["tmp_name"];
        $dtime = date('Y_m_d_H_i_s');

        if(!move_uploaded_file("$filePath","../uploads/admin$dtime$fileName")) 
        {
                header("Location:../dashboard.php");
        }else
        {
                $key=fopen("../uploads/admin$dtime$fileName","rb");
                $countrow = 0;
                while (!feof($key)) 
                {
                        ++$countrow;
                                                                                
                        $line = fgetcsv($key,1024,',');
                                
                        if($countrow > 1)
                        {
                                $staffno = trim($line[0]);
                                $college = trim($line[1]);
                                $dept = trim($line[2]);
                                $sname = trim($line[3]);
                                $fname = trim($line[4]);
                                $email = trim($line[5]);
                                $phone = trim($line[6]);
                                $role = trim($line[7]);
                                        
                                if($staffno != '')
                                {
                                        $sql="INSERT INTO `stafflist`(`staffno`, `college`, `dept`, `sname`, `fname`, `email`, `phone`) 
                                        VALUES ('$staffno','$college','$dept','$sname','$fname','$email','$phone')";

                                        $result=mysql_query($sql);

                                        $staff = $staffno;
                                        $adminroleid = $role;
                                        $loginTime = date('Y-m-d H:i:s');


                                        // Insert the new admin
                                        $newprogress = mysql_query("INSERT INTO staffrole (staffNum, staffRoleNo, loginTime) 
                                                VALUES ('$staff', '$adminroleid', '$loginTime')", $connection);
                                        confirm_query($newprogress);
                                }
                        }
                }

                fclose($key);
                header("Location:../dashboard.php");
                                        
        }
?>