<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php
        $page_advertasiment=file_get_contents("pages/reklama.html");
        if (!isset($_POST["num_card"])){
            echo $page_advertasiment;
        }
        else{
            include "config.php";
            $num_card=$_POST["num_card"];
            $num_card=htmlspecialchars($num_card);
            
            $link = mysqli_connect($host, $user, '', $db);
            if ($link){
                $query="SELECT id FROM cards WHERE card_code='".mysqli_real_escape_string($link,$num_card)."'";
                $result = mysqli_query($link, $query);
                $n=mysqli_num_rows($result);

                if ($n==1){
                    $page_pin=file_get_contents("pages/pin.html");
                    $page_pin=str_replace("{card}",$num_card, $page_pin);
                    echo $page_pin;
                }
                else{
                    echo $page_advertasiment;
                }
            }
            else{
                echo $page_advertasiment;
            }
        }
        //$id_client=$_POST["id_client"];
        //$step=$_POST["step"];

    ?>
</body>
</html>