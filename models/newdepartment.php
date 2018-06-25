<?php
        include_once("../includes/session.php");
        include_once("../includes/zz.php"); 
        include_once("../includes/functions.php"); 
            
        confirm_adminlogged_in();

        $fileName = $_FILES["departments"]["name"];
        $fileType = $_FILES["departments"]["type"];
        $filePath = $_FILES["departments"]["tmp_name"];
        $dtime = date('Y_m_d_H_i_s');

        if(!move_uploaded_file("$filePath","../uploads/departments$dtime$fileName")) 
        {
                header("Location:../departments.php");
        }else
        {
                $key=fopen("../uploads/departments$dtime$fileName","rb");
                $countrow = 0;
                while (!feof($key)) 
                {
                        ++$countrow;
                                                                                
                        $line = fgetcsv($key,1024,',');
                                
                        if($countrow > 1)
                        {
                                $sno = trim($line[0]);
                                $department = trim($line[1]);
                                $dept = trim($line[2]);
                                $coldept = trim($line[3]);
                                        
                                if($department != '')
                                {
                                        // Insert the new department
                                        $newprogress = mysql_query("INSERT INTO `departments`(`coldept`, `dept`, `department`) VALUES ('$coldept','$dept','$department')", $connection);
                                        confirm_query($newprogress);
                                }
                        }
                }

                fclose($key);
                header("Location:../departments.php");
                                        
        }
?>