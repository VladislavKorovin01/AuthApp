<?php

require_once __DIR__ . '/../helpers.php';

$login = $_POST["login"] ?? null; 
$password = $_POST["password"] ?? null; 

setValue("login", $login);
setValue("password",$password);

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
                        redirect("/src/pages/profile.php");
                    }
                    $_SESSION["info"] = "неверный логин или пароль";
                    redirect("/src/pages/login.php");
                }
                else{
                    $_SESSION["info"]="пользователь не найден";
                    redirect("/index.php");
                }
            }
            catch(Throwable $e){
                $_SESSION["info"] = "произлошла ошибка, попробуйте войти позже";
            }
        }
    }

    redirect("/src/pages/login.php");
?>