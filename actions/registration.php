<?php
    require_once 'helpers.php';

    $name = $_POST["name"] ?? null;
    $email = $_POST["email"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $password = $_POST["password"] ?? null;
    $passwordConfirm = $_POST["passwordConfirm"] ?? null;
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($name)){
            setError("name","обязательное поле");
        } 
        if(empty($phone) || !filter_var($phone, FILTER_VALIDATE_INT)){
            setError("phone","обязательное поле");
        }
        if(empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
            setError("email","почта не валидна");
        }

        if(empty($password)){
           setError("password","обязательное поле");
        }
        else{
            if($password !== $passwordConfirm){
                setError("password","Пароли должны совпадать");
            }
        }

        if(empty($_SESSION["errors"])){
            try{
                $conn = GetConnection();
                $stmt = $conn -> prepare("SELECT * FROM Users WHERE Email=? OR Phone=?");
                $stmt -> bind_param("ss", $email, $phone);
                $stmt -> execute();
                $res = $stmt -> get_result() -> fetch_assoc();
    
                if($res!= null){
                    $_SESSION["info"]="такой пользователь уже существует";
                 }
                else{
                    $stmt = $conn -> prepare("INSERT INTO Users(Name, Phone, Email,Password) VALUES(?,?,?,?)");
                    $hash =  password_hash($password, PASSWORD_DEFAULT);
                    $stmt -> bind_param("ssss", $name, $phone, $email, $hash);
                    $stmt -> execute();
                    header("Localtion: /index.php");
                    die;
                }
            }
            catch(Throwable $e){
                $_SESSION["info"] = "произлошла ошибка, попробуйте войти позже";
            }

        }
    }

    header("Location: /registrationform.php");
?>