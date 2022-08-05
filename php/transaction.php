<?php 
	include "../config.php";  
    header('Content-Type: text/html; charset=utf-8');
    if (!(isset($_POST["sum"]))|| !(isset($_POST["id_client"]))|| !(isset($_POST["id_card"])) ||!$_POST["id_bankomat"]){
       //exit();
       die("No");
    }
    else{
        $sum=$_POST["sum"];
        $id_client=$_POST["id_client"];
        $id_card=$_POST["id_card"];
        $id_bankomat=$_POST["id_bankomat"];
 
        //$link = mysqli_connect($host, $user, '', $db);
    

        $sum=intval($sum);
        
        
        $mysqli = new mysqli ($host, $user,  $password,  $db);
        
        /*mysqli_query($MyConnection ,"SET @sum_='".$sum."';");
        mysqli_query($MyConnection ,"SET @id_client_='".$id_client."';");
        mysqli_query($MyConnection ,"SET @id_card_='".$id_card."';");
        mysqli_query($MyConnection ,"SET @id_bankomat_='".$id_bankomat."';");*/
        $mysqli->query("SET @res_ = 11");
        $s="CALL create_transaction(".$sum.", ".$id_client.", ".$id_card.", ".$id_bankomat.", @res_)";
        //echo $s;
        $res_sql=$mysqli->query($s);
        //var_dump($res_sql);
        $result = $mysqli->query("SELECT @res_ as res");
        $row = $result->fetch_row();
        //var_dump($row[0]);
        echo $row[0];
        
            
     
    }
        


?>
