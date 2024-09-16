<?php
    require_once __DIR__ .'/src/helpers.php';
    if(isAuth(isset($_SESSION["user"]["id"]) ? $_SESSION["user"]["id"] : "")){
        redirect("/src/pages/profile.php");
    }
    else{
        redirect("/src/pages/login.php");
    }
?>