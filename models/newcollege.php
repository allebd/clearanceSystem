<?php
        include_once("../includes/session.php");
        include_once("../includes/zz.php"); 
        include_once("../includes/functions.php"); 
            
        confirm_adminlogged_in();

        $fileName = $_FILES["colleges"]["name"];
        $fileType = $_FILES["colleges"]["type"];
        $filePath = $_FILES["colleges"]["tmp_name"];
        $dtime = date('Y_m_d_H_i_s');

        if(!move_uploaded_file("$filePath","../uploads/colleges$dtime$fileName")) 
        {
                header("Location:../colleges.php");
        }else
        {
                $key=fopen("../uploads/colleges$dtime$fileName","rb");
                $countrow = 0;
                while (!feof($key)) 
                {
                        ++$countrow;
                                                                                
                        $line = fgetcsv($key,1024,',');
                                
                        if($countrow > 1)
                        {
                                $sno = trim($line[0]);
                                $college = trim($line[1]);
                                $col = trim($line[2]);
                                        
                                if($college != '')
                                {
                                        // Insert the new college
                                        $newprogress = mysql_query("INSERT INTO `colleges`(`college`, `col`) VALUES ('$college','$col')", $connection);
                                        confirm_query($newprogress);
                                }
                        }
                }

                fclose($key);
                header("Location:../colleges.php");
                                        
        }
?>