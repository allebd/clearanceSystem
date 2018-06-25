<?php
        include_once("../includes/session.php");
        include_once("../includes/zz.php"); 
        include_once("../includes/functions.php"); 
            
        confirm_adminlogged_in();

        $fileName = $_FILES["students"]["name"];
        $fileType = $_FILES["students"]["type"];
        $filePath = $_FILES["students"]["tmp_name"];
        $dtime = date('Y_m_d_H_i_s');

        if(!move_uploaded_file("$filePath","../uploads/students$dtime$fileName")) 
        {
                header("Location:../students.php");
        }else
        {
                $key=fopen("../uploads/students$dtime$fileName","rb");
                $countrow = 0;
                while (!feof($key)) 
                {
                        ++$countrow;
                                                                                
                        $line = fgetcsv($key,1024,',');
                                
                        if($countrow > 1)
                        {
                                $sno = trim($line[0]);
                                $fname = trim($line[1]);
                                $sname = trim($line[2]);
                                $matricno = trim($line[3]);
                                $regno = trim($line[4]);
                                $program = trim($line[5]);
                                $dept = trim($line[6]);
                                $college = trim($line[7]);
                                $theclearance = trim($line[8]);
                                        
                                if($matricno != '')
                                {
                                        // Insert the new student
                                        $newprogress = mysql_query("INSERT INTO `studlist`(`matricno`, `regno`, `program`, `college`, `dept`, `sname`, `fname`, `theclearance`) VALUES ('$matricno','$regno','$program','$college','$dept','$sname','$fname','$theclearance')", $connection);
                                        confirm_query($newprogress);
                                }
                        }
                }

                fclose($key);
                header("Location:../students.php");
                                        
        }
?>