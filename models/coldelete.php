<?php
        include_once("../includes/session.php");
        include_once("../includes/zz.php"); 
        include_once("../includes/functions.php"); 
            
        confirm_adminlogged_in();
            
        $cId = $_GET['ad'];

        $deleting = "DELETE FROM `colleges` WHERE cid = '$cId'";
        $deleted = mysql_query($deleting);
        
        header("Location:../colleges.php");
        exit();
?>