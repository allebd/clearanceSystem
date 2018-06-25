<?php
        include_once("../includes/session.php");
        include_once("../includes/zz.php"); 
        include_once("../includes/functions.php"); 
            
        confirm_adminlogged_in();

        $studId = $_GET['ad'];
        $clearname = $_SESSION['adminroleid'];
        $dtime = date('Y_m_d_H_i_s');

        // Clear Student
        $newprogress = mysql_query("INSERT INTO `clearance`(`studclearno`, `clearname`, `clearstatus`, `cleardate`) VALUES ('$studId','$clearname','Cleared','$dtime')", $connection);
        confirm_query($newprogress);
                               

        header("Location:../clearance.php");
?>