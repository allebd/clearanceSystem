<?php
        include_once("../includes/session.php");
        include_once("../includes/zz.php"); 
        include_once("../includes/functions.php"); 
            
        confirm_adminlogged_in();
            
        $studId = $_GET['ad'];

        $deleting = "DELETE FROM `studlist` WHERE matricno = '$studId'";
        $deleted = mysql_query($deleting);
        
        header("Location:../students.php");
        exit();
?>