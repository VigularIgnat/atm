<?php
    session_start();
    if(isset($_POST["login"]) && isset($_POST["password"])){
        $_login=$_POST["login"];
        $_password=md5($_POST["password"]);

        include "../config.php";  
        //header('Content-Type: text/html; charset=utf-8');
        if ($_SESSION['admin_login'] == ""){
            $link = mysqli_connect($host, $user, $password, $db);

            // Check connection
            if (!$link) {
                die("Connection failed: " . mysqli_connect_error());
            }
        
            $query="SELECT * FROM admins WHERE login='".$_login."' AND password='".$_password."'";
    
            $result = mysqli_query($link, $query);
    
            $n=mysqli_num_rows($result);
            if ($n == 1) {
                $_SESSION["admin_login"]=$_login;
    
                if ($_SESSION['admin_login'] == "") {
                    header("location: /error/");
                }
                $html= file_get_contents("pages/clients.html");
                echo $html;
    
         
            } else {
                $html= file_get_contents("pages/autorisation.html");
                echo $html;
            }
            }
            else{
                $html= file_get_contents("pages/autorisation.html");
                echo $html;
            }
        }
        else{
            $html= file_get_contents("pages/clients.html");
            echo $html;
        }
       


?>