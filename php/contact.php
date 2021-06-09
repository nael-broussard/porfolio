<?php

    $array = array("firstname" => "", "name" => "", "email" => "", "phone" => "",  "message" => "", "firstnameError" => "", "nameError" => "", "emailError" => "", "phoneError" => "", "messageError" => "", "isSuccess" => false);

    $emailTo = "nael.broussard@gmail.com";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $array["firstname"] = verufyInput($_POST["firstname"]);
        $array["name"] = verufyInput($_POST["name"]);
        $array["email"] = verufyInput($_POST["email"]);
        $array["phone"] = verufyInput($_POST["phone"]);
        $array["message"] = verufyInput($_POST["message"]);
        $array["isSuccess"] = true;
        $emailText = "";
        
        
        if(empty($array["firstname"])){
            $array["firstnameError"] = "Je veux connaitre ton prénom !";
            $array["isSuccess"] = false;
        }else{
            $emailText .= "Firstname : {$array["firstname"]}\n";
        }
        
        if(empty($array["name"])){
            $array["nameError"] = "Et oui je veux tout savoir, même ton nom !";
            $array["isSuccess"] = false;
        }else{
            $emailText .= "Name : {$array["name"]}\n";
        }

        if(!isEmail($array["email"])){
            $array["emailError"] = "T'essaies de me rouler ? c'est pas un Email ça !";
            $array["isSuccess"] = false;
        }else{
            $emailText .= "Email : {$array["email"]}\n";
        }
        
        if(!isPhone($array["phone"])){
            $array["phoneError"] = "Que des chiffres et des espaces stp.";
            $array["isSuccess"] = false;
        }else{
            $emailText .= "Phone : {$array["phone"]}\n";
        }
                
        if(empty($array["message"])){
            $array["messageError"] = "Qu'est-ce que tu veux me dire !";
            $array["isSuccess"] = false;
        }else{
            $emailText .= "Message : {$array["message"]}\n";
        }
        
        if($array["isSuccess"]){
            $headers = "From: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply_to: {$array["email"]}";
            mail($emailTo, "Un message de votre site", $emailText, $headers);
        }
        
        echo json_encode($array);
        
    }

    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function isPhone($var){
        return preg_match("/^[0-9 ]*$/", $var);
    }
    
    function verufyInput($var){
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }

?>