<?php

session_start();

// $_SESSION["errors"]=[];
// $_SESSION["values"]=[];

require_once __DIR__ . '\..\config.php';

function setError(string $key, string $value){
    $_SESSION["errors"][$key]=$value;
}

function setValue(string $key, string $value){
    $_SESSION["values"][$key]=$value;
}


function isExist(string $arrays, string $key) : bool{
    return isset($_SESSION[$arrays][$key]);
}

function GetError(string $key) : string{
    $error = isExist("errors",$key) ? $_SESSION["errors"][$key] : "";
    unset($_SESSION["errors"][$key]);
    return $error;
}
function GetValue(string $key) :string{
    $value = isExist("values",$key) ? $_SESSION["values"][$key] : "";
    unset($_SESSION["values"]["key"]);
    return $value;
}

function GetConnection() : mysqli{
    $conn = new mysqli(HOST_DB,USER_DB,PASSWORD_DB,DATABASE_DB);
    $conn -> set_charset(CHARSET_DB);
    return $conn;
}
function GetMessage() : string{
    $message = isset($_SESSION["info"]) ? $_SESSION["info"] : "";
    unset($_SESSION["info"]);
    return $message;
}

function SetDataProfile(string $id, string $name, string $phone, string $email){
    $_SESSION["profile"]["id"] = $id;   
    $_SESSION["profile"]["name"] = $name;  
    $_SESSION["profile"]["phone"] = $phone;  
    $_SESSION["profile"]["email"] = $email;   
}

function GetProfileValue($key) : string{
    $value = isset($_SESSION["profile"]) ? $_SESSION["profile"][$key] : "";
    return $value;
}

function Logout(){
    unset($_SESSION["errors"]);
    unset($_SESSION["values"]);
    unset($_SESSION["profile"]);

    header("Location: /index.php");
}





?>