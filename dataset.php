<?php
    require_once('functions.php');
    $con = openConnection();
    $strSql = "SELECT * FROM tbl_products ORDER BY id";    
    $arrProducts = getRecord($con, $strSql);
    closeConnection($con);
?>