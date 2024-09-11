<?php

require_once 'helpers.php';

setValue("login", $_POST["login"] ?? null); 
setValue("password", $_POST["password"] ?? null); 

    if(empty($_POST["login"])){
        setError("login","Обязательное поле");
    }
    if(empty($_POST["password"])){
        setError("password", "Обязательное поле");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(empty($_SESSION["errors"])){

            if(filter_var($_POST["login"], FILTER_VALIDATE_EMAIL)){
                $sql = "SELECT Id, Name, Email, Phone, Password FROM Users WHERE Email=?";
            }
            else{
                $sql = "SELECT Id, Name, Email, Phone, Password FROM Users WHERE Phone=?";
            }

            $conn = GetConnection();
            $stmt = $conn -> prepare($sql);
            $stmt -> bind_param("s",$_POST["login"]);
            $stmt -> execute();
            $user = $stmt -> get_result()-> fetch_assoc();

            if($user != null){
                if(password_verify($_POST["password"],$user["Password"])){
                    echo print_r($user);
                    SetDataProfile($user['Id'],$user['Name'],$user["Phone"], $user['Email']);
                    header("Location: /profile.php");
                    die;
                }
                $_SESSION["info"] = "неверный логин или пароль";
                header("Location: /index.php");
                die;
            }
            else{
                $_SESSION["info"]="пользователь не найден";
                header("Location: /index.php");
                die;
            }
        }
    }

    header("Location: /index.php");
?>