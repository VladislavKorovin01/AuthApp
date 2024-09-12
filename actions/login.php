<?php

require_once 'helpers.php';

$login = $_POST["login"] ?? null; 
$password = $_POST["password"] ?? null; 

    if(empty($login)){
        setError("login","Обязательное поле");
    }
    if(empty($password)){
        setError("password", "Обязательное поле");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(empty($_SESSION["errors"])){

            try{
                if(filter_var($login, FILTER_VALIDATE_EMAIL)){
                    $sql = "SELECT Id, Name, Email, Phone, Password FROM Users WHERE Email=?";
                }
                else{
                    $sql = "SELECT Id, Name, Email, Phone, Password FROM Users WHERE Phone=?";
                }
                $conn = GetConnection();
                $stmt = $conn -> prepare($sql);
                $stmt -> bind_param("s",$login);
                $stmt -> execute();
                $user = $stmt -> get_result()-> fetch_assoc();

                if($user != null){
                    if(password_verify($password,$user["Password"])){
                        $_SESSION["user"]["id"] = $user["Id"];
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
            catch(Throwable $e){
                $_SESSION["info"] = "произлошла ошибка, попробуйте войти позже";
            }
        }
    }

    header("Location: /index.php");
?>