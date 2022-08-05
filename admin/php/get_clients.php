<?php 
	include "link_config.php";  
    header('Content-Type: text/html; charset=utf-8');
    if (!(isset($_GET["client_surname"]))){
       //exit();
       die("No");
    }
    else{
        $surname=htmlspecialchars($_GET["client_surname"]);
        $link = mysqli_connect($host, $user, $password, $db);

        // Check connection
        if (!$link) {   
        die("Connection failed: " . mysqli_connect_error());
        }
    
        $query="SELECT * FROM clients WHERE UPPER(pib) like '%".strtoupper($surname)."%' ORDER BY pib";
        $result = mysqli_query($link, $query);

        $n=mysqli_num_rows($result);
        if ($n > 0) {
             
            for ($i=0; $i < $n; $i++) { 
                $row = mysqli_fetch_assoc($result);
                /*switch($row["status"]){
                    case 0: $status="no_active"; break;
                    case 1: $status="active"; break;
                }*/

                $str_array.='{"id":"'.$row["id"].'","pib":"'.$row["pib"].'","ipn":"'.$row["ipn"].'","born":"'.$row["born"].'","reg_date":"'.$row["reg_date"].'","status":"'.$row["status"].'"},';
            }

            $str_array = substr($str_array,0,-1);

            $str_array.="]";
            echo $str_array;
            
       
       
        }else{
            echo "0 results";
        }


    }
    
 ?>