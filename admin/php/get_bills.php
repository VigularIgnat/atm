<?php 
	include "link_config.php";  
    header('Content-Type: text/html; charset=utf-8');
    /*if (!isset($_GET("client_surname"))){
       //exit();
       die("No");
    }*/
    $id_client=$_POST["id_client"];
    //echo $id_client;
	$link = mysqli_connect($host, $user, $password, $db);
    //Check connection
    if (!$link) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $query="SELECT * FROM bills WHERE id_client=".$id_client."";
    $result = mysqli_query($link, $query);

    $n=mysqli_num_rows($result);
    if ($n > 0) {

        for ($i=0; $i < $n; $i++) { 
            $row = mysqli_fetch_assoc($result);
            $array_clients=array("id"=> $row["id"], "id_client"=> $row["id_client"], "dt_create"=>$row["dt_create"],  "bill"=>$row["bill"],  "balance"=>$row["balance"], "valute"=>$row["valute"],"limit_cash"=>$row["limit_cash"], "limit_credit"=>$row["limit_credit"]);
            
        }       
        echo "[".json_encode($array_clients)."]";
    } else {
        echo "0 results";
    }


 ?>