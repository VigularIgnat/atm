<?php 
	include "../../config.php";  
    header('Content-Type: text/html; charset=utf-8');
    echo "bu";
	if (isset($_REQUEST['login']) && isset($_REQUEST['password'])){
        $login=$_POST['login'];
        $password_admin=$_POST['password'];
        
        $link = mysqli_connect($host, $user, $password, $db);

        // Check connection
        if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
        }
        else{
            echo "log";
        }
        $query="SELECT id, login, status FROM admins WHERE login=".$login." AND password=MD5(".$row.") AND place=".$place;
        $result=mysqli_query($link, $query);

        $n=mysqli_num_rows($result);
        if ($n > 0) {
            // output data of each row
            $str_array="[";
            for ($i=0; $i < $n; $i++) { 
                $row = mysqli_fetch_assoc($result);
                /*$str_array.='{"id":"'.$row["id_film"].'","name":"'.$row["filmname"].'","tm":"'.$row["tm"].'","poster":"'.$row["poster"].'","price":"'.$row["price"].'"},';*/
                $str_array.='{"id":"'.$row["id"].'","login":"'.$row["login"].'","status":"'.$row["status"].'"}';
            }

            echo $str_array;
                       
        } else {
            echo "0 results";
        }
    
    }
 ?>