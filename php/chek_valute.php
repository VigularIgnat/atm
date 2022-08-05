<?php 
	include "config.php";  
    header('Content-Type: text/html; charset=utf-8');
    if (!(isset($_POST["num_card"]))|| !(isset($_POST["card_pin"]))){
       //exit();
       die("No");
    }
    else{
        $pin_card=$_POST["card_pin"];
        $num_card=$_POST["num_card"];
        $pin_card=htmlspecialchars($pin_card);
        $link = mysqli_connect($host, $user, $password, $db);

        // Check connection
        if (!$link) {   
        die("Connection failed: " . mysqli_connect_error());
        }
        //$num_card=mysqli_real_escape_string($link,$num_card);
        //$pin_card=mysqli_real_escape_string($link,$pin_card);
        $pin_card=MD5(mysqli_real_escape_string($link,$pin_card));

        $query="SELECT  C.id_bill, B.id_client, C.id AS id_card, B.balance, B.valute, Cl.pib, C.status
        FROM cards C, bills B, clients Cl
        WHERE C.id_bill=B.id AND B.id_client=Cl.id AND  C.card_code='".$num_card."' AND C.pin='".$pin_card."'";
        $result = mysqli_query($link, $query);
        $row =mysqli_fetch_assoc($result);
        $n=mysqli_num_rows($result);
        if ($n ==1 ) {
            //$array_clients=array("id"=> $row_client["id"], "pib"=> $row_client["pib"], "ipn"=>$row_client["ipn"], "born"=> $row_client["born"], "reg_date"=> $row_client["reg_date"], "status"=>$row_client["status"]);*/

            /*$array_clients=array("id"=> $row_client["id"], "pib"=> $row_client["pib"], "status"=>$row_client["status"]);
            echo json_encode($array_clients);*/
            $page_client=file_get_contents("pages/balance.html");
            $page_client=str_replace("{hello}",$row["pib"], $page_client);
            $page_client=str_replace("{balance}",$row["balance"], $page_client);
            $page_client=str_replace("{id_card}",$row["id_card"], $page_client);
            $page_client=str_replace("{id_client}",$row["id_client"], $page_client);
            $page_client=str_replace("{valute}",$row["valute"], $page_client);
            if ($row["status"]==1){
                $page_client=str_replace("{status}","активний", $page_client);
                $page_client=str_replace("{state}","", $page_client);
            }
            else{
                $page_client=str_replace("{status}","заблокований", $page_client);
                $page_client=str_replace("{state}","disabled", $page_client);
            }
            echo $page_client;
        }else{
            $page_pin=file_get_contents("pages/pin.html");
            echo $page_pin;
        }

        
    }
    
 ?>