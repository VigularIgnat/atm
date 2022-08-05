<?php 
	include "../../config.php";  
    header('Content-Type: text/html; charset=utf-8');
    if (!(isset($_POST["id"]) && isset($_POST["pib"]) && isset($_POST["ipn"]) && isset($_POST["born"]) && $_POST["reg_date"] && $_POST["status"])){
        //exit();
        die("No");
     }
     else{
        $id=$_POST["id"];
        $pib=$_POST["pib"];
        $ipn=$_POST["ipn"];
        $born=$_POST["born"];
        $reg_date=$_POST["reg_date"];
        $status=$_POST["status"];

        $link = mysqli_connect($host, $user, $password, $db);

        // Check connection
        if (!$link) {   
        die("Connection failed: " . mysqli_connect_error());
        }
    
        $query="UPDATE clients SET pib='".$pib."', ipn='".$ipn."', born='".$born."', reg_date='".$reg_date."', status='".$status."' WHERE id='".$id."'";
        $result = mysqli_query($link, $query);
        if ($result=="TRUE"){
            echo "Succesfull";
        }
        else{
            echo "Error";
        }
    }
    
    


 ?>