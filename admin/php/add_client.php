<?php 
	include "../../config.php";  
    header('Content-Type: text/html; charset=utf-8');
    if (!isset($_POST["pib"]) || !isset($_POST["ipn"]) || !isset($_POST["born"]) || !isset($_POST["reg_date"]) || !isset($_POST["status"])){
        echo "no_data";
    }
    else{
        $pib=$_POST["pib"];
        $ipn=$_POST["ipn"];
        $born=$_POST["born"];
        $reg_date=$_POST["reg_date"];
        $status=$_POST["status"];
        //echo $id_client;
        $link = mysqli_connect($host, $user, $password, $db);
        //Check connection
        if (!$link) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query="INSERT INTO clients (pib, ipn, born, reg_date, status) VAlUES ('".$pib."', '".$ipn."', '".$born."', '".$reg_date."', ".$status.")";
        $result = mysqli_query($link, $query);
        if ($result==TRUE){
            echo "succesfull";
        }
        else{
            echo "no";
        }
    }
 ?>