<?php 
	include "../config.php";  
    header('Content-Type: text/html; charset=utf-8');
    if (!(isset($_POST["id_client"]))){
       //exit();
       die("No");
    }
    else{
        $id_client=$_POST["id_client"];
        
        $link = mysqli_connect($host, $user, $password, $db);

        // Check connection
        if (!$link) {   
        die("Connection failed: " . mysqli_connect_error());
        }
        //$num_card=mysqli_real_escape_string($link,$num_card);
        //$pin_card=mysqli_real_escape_string($link,$pin_card);
        $query="SELECT id
        FROM bills
        WHERE id_client=".$id_client."";
        $result = mysqli_query($link, $query);
        $id_bill =mysqli_fetch_assoc($result);
        
        
        $query_cards="SELECT *
        FROM cards
        WHERE id_bill=".$id_bill."";
        $result_cards = mysqli_query($link, $query_cards);
        $row_cards =mysqli_fetch_assoc($result_cards);
        $n=mysqli_num_rows($result);
        if ($n > 0) {
            $array_clients=array("id"=> $row_cards["id"], "id_bill"=> $row_cards["id_bill"], "card_code"=>$row_cards["card_code"],  "cvc"=>$row_cards["cvc"],  "card_year"=>$row_cards["card_year"], "card_month"=>$row_cards["card_month"],"dt_create"=>$row_cards["dt_create"], "status"=>$row_cards["status"]);
            echo json_encode($array_clients);
       
        }else{
            echo "0 results";
        }

    }
    
 ?>