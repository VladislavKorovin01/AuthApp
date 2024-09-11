<?php
    require_once 'helpers.php';

    setValue("name", $_POST["name"] ?? null);
    setValue("email", $_POST["email"] ?? null);
    setValue("phone", $_POST["phone"] ?? null);
    setValue("password", $_POST["password"] ?? null);
    setValue("passwordConfirm",$_POST["passwordConfirm"] ?? null);
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($_POST["name"])){
            setError("name","field is required");
        } 
        if(empty($_POST["phone"])){
            setError("phone","field is required");
        } 
        else{
            if(!filter_var($_POST["phone"], FILTER_VALIDATE_INT)){
                setError("phone","phone not valid");
            }
        }
        if(empty($_POST["email"])){
            setError("email","field is required");
        }
        else{
            if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                setError("email","email not valid");
            }
        }

        if(empty($_POST["password"])){
           setError("password","password is required");
        }
        else{
            if($_POST["password"] !== $_POST["passwordConfirm"]){
                setError("password","Пароли должны совпадать");
            }
        }

        if(!isset($_SESSION["errors"])){
            
            $conn = GetConnection();

            $stmt = $conn -> prepare("SELECT * FROM Users WHERE Email=? OR Phone=?");
            $stmt -> bind_param("ss", GetValue("email"), getvalue("phone"));
            $stmt -> execute();
            $res = $stmt -> get_result() -> fetch_assoc();

            if($res!= null){
                $_SESSION["info"]="такой пользователь уже существует";
             }
            else{
                $stmt = $conn -> prepare("INSERT INTO Users(Name, Phone, Email,Password) VALUES(?,?,?,?)");
                $stmt -> bind_param("ssss", GetValue("name"), getvalue("phone"),GetValue("email"), password_hash(GetValue("password"),PASSWORD_DEFAULT));
                $stmt -> execute();
                header("Localtion: /index.php");
                die;
            }
        }
    }

    header("Location: /registrationform.php");
?>