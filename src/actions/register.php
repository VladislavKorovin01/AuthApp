<?php
    require_once __DIR__ .'/../helpers.php';

    $name = $_POST["name"] ?? null;
    $email = $_POST["email"] ?? null;
    $phone = $_POST["phone"] ?? null;
    $password = $_POST["password"] ?? null;
    $passwordConfirm = $_POST["passwordConfirm"] ?? null;

    setValue("name", $name);
    setValue("phone", $phone);
    setValue("email",$email);
    setValue("password",$password);
    setValue("passwordConfirm",$passwordConfirm);

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty($name)){
            setError("name","обязательное поле");
        }
        else{

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
        if(IsExistAlredyUserData("Name",$name)){
            setError("name","пользователь с таким именем уже есть");
        }
        if(IsExistAlredyUserData("Phone",$phone)){
            setError("phone","пользователь с таким номером телефона уже есть");
        }
        if(IsExistAlredyUserData("Email",$email)){
            setError("email","пользователь с такой почтой уже есть");
        }

        if(empty($_SESSION["errors"])){
            try{
                $conn = GetConnection();
                $stmt = $conn -> prepare("INSERT INTO Users(Name, Phone, Email,Password) VALUES(?,?,?,?)");
                $hash =  password_hash($password, PASSWORD_DEFAULT);
                $stmt -> bind_param("ssss", $name, $phone, $email, $hash);
                $stmt -> execute();
                redirect("/index.php");
            }
            catch(Throwable $e){
                $_SESSION["info"] = "произлошла ошибка, попробуйте войти позже";
            }

        }
    }
    redirect("/pages/register.php");
?>