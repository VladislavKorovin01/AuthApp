<?php

session_start();

require_once __DIR__ . '/config.php';

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
function GetValue(string $key) : string{
    $value = isExist("values",$key) ? $_SESSION["values"][$key] : "";
    return $value;
}

function GetConnection() : mysqli|null{
    try{
        $conn = new mysqli(HOST_DB,USER_DB,PASSWORD_DB,DATABASE_DB);
        $conn -> set_charset(CHARSET_DB);
        return $conn;
    }
    catch(Throwable $e){
        $_SESSION["info"] = $e.GetMessage();
        return null;
    }

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

    redirect('/index.php');
}

function IsAuth() : bool{
    return isset($_SESSION["user"]["id"]);
}

function GetCurrentUser() : array{
    try{
        if(isAuth()){
            $id = $_SESSION["user"]["id"];
            $conn = GetConnection();
            $stmt = $conn -> prepare("SELECT Id ,Name, Phone, Email, Password FROM Users WHERE Id=?");
            $stmt->bind_param ("s", $id);
            $stmt -> execute();
            $user = $stmt -> get_result() -> fetch_assoc();
            if($user){
                return $user;
            }
            return [];
        }
        return [];
    }
    catch(Throwable $e){
        $_SESSION["info"] = $e.GetMessage();
        return [];
    }
}

function redirect(string $path){
    header("Location: $path");
    die;
}

function IsExistAlredyUserData(string $key, string $value) : bool{
    $conn = GetConnection();
    $stmt = $conn -> prepare("SELECT * FROM users WHERE $key=?");
    $stmt -> bind_param("s", $value);
    $stmt -> execute();
    $user = $stmt -> get_result() -> fetch_assoc();
    if($user){
        return true;
    }
    return false;
}

?>