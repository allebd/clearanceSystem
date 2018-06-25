<?php
        include_once("../includes/session.php");
        include_once("../includes/zz.php"); 
        include_once("../includes/functions.php"); 
            
        confirm_adminlogged_in();
            
        $dId = $_GET['ad'];

        $deleting = "DELETE FROM `departments` WHERE did = '$dId'";
        $deleted = mysql_query($deleting);
        
        header("Location:../departments.php");
        exit();
?>