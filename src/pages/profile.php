<?php
    require_once __DIR__ .'\..\helpers.php';

    if(!isAuth()){
        redirect('/src/pages/login.php');
    }
    $user = GetCurrentUser();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Profile</title>
</head>
<body>
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="border border-2 border-primary rounded-3 p-3 bg-light d-flex flex-column justify-content-between" style="width: 400px; min-height: 300px">
            <div>
                <h2>Профиль пользователя</h2>
                <div class="row">
                    <div class="col">
                        <label>Имя</label>
                    </div>
                    <div class="col">
                        <label><?php echo $user["Name"]?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Номер телефона</label>
                    </div>
                    <div class="col">
                        <label><?php echo $user["Phone"]?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Электронная почта</label>
                    </div>
                    <div class="col">
                        <label><?php echo $user["Email"]?></label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <form action="#" method="post">
                    <input type="submit" class="btn btn-warning" value="Изменить данные"/>
                </form>
                <form action="/src/actions/logout.php" method="post">
                    <input type="submit" class="btn btn-danger" value="Выйти"/>
                </form>
            </div>
        </div>
    </div>
<script>
    const passCheckBox = document.querySelector("#checkVisiblePass");
    const inputPass = document.querySelector("#pass");
    passCheckBox.addEventListener('click',()=>{
        if(inputPass.type === "password"){
            inputPass.type = "text";
        }
        else{
            inputPass.type = "password";
        }
    });
</script>
</body>
</html>



