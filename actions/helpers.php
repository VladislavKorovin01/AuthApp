<?php

session_start();

require_once __DIR__ . '\..\config.php';

function setError(string $key, string $value){
    if(!isset($_SESSION["errors"])){
        $_SESSION["errors"]=[];
    }
    $_SESSION["errors"][$key]=$value;
}

function setValue(string $key, string $value){
    if(!isset($_SESSION["values"])){
        $_SESSION["values"]=[];
    }
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
function GetValue(string $key) : string{
    $value = isExist("values",$key) ? $_SESSION["values"][$key] : "";
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

function GetProfileValue($key) : string{
    $value = isset($_SESSION["profile"]) ? $_SESSION["profile"][$key] : "";
    return $value;
}

function Logout(){
    unset($_SESSION["errors"]);
    unset($_SESSION["values"]);
    unset($_SESSION["user"]);

    header("Location: /index.php");
}

function isAuth(string $id) : array|bool{
    $conn = GetConnection();
    $stmt = $conn -> prepare("SELECT Id ,Name, Phone, Email, Password FROM Users WHERE Id=?");
    $stmt->bind_param ("s", $id);
    $user = $stmt -> execute();
    if($user != null){
        return $user;
    }
    return false;
}





?>