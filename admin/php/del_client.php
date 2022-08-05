<?php 
    session_start();
	include "../../config.php";  
    header('Content-Type: text/html; charset=utf-8');
    if (!(isset($_POST["id_client"]) &&!($_SESSION['admin_login'] == ""))){
       //exit();
       die("No");
    }
    else{
        $id_client=$_POST["id_client"];
        //echo $id_client;
        $link = mysqli_connect($host, $user, $password, $db);
        //Check connection
        if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $admin_login=$_SESSION["admin_login"];
        $query="SELECT status FROM admins WHERE login=".$admin_login."";
        $result = mysqli_query($link, $query);
        
        if ($result==$options_admin[1] or $result==$options_admin[2]){
            $query_del="DELETE FROM clients WHERE id_client=".$id_client."";
            $result_del = mysqli_query($link, $query_del);
            if ($result_del=="TRUE"){
                echo "successful";
            }
            else{
                echo "error";
            }
        }
        else{
            echo "Dosent avialable";    
        }

    }
    
 ?>