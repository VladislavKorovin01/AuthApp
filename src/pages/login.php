<?php
    require_once __DIR__ . '/../helpers.php';
    if(isAuth()){
        redirect('/src/pages/profile.php');
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login</title>
</head>
<body>
        <div class=' min-vh-100 d-flex justify-content-center align-items-center'>
            <div class="border border-2 border-primary rounded-3 col-4 p-3 bg-light" style="width:300px; min-height: 300px;">
                <form class='' method='POST' action='/src/actions/login.php'>
                    <div class='form-group mb-3'>
                        <div class="text text-danger ps-3 pe-3 pu-1 pb-1"><?php echo GetMessage() ?></div>
                    </div>
                    <div class='from-group mb-3'>
                        <label class='form-label'>Логин</label>
                        <input class='form-control' type='text' placeholder="Эл. почта или номер тел." name='login' value='<?php echo GetValue("login")?>'/>
                        <span class='text-danger'><?php echo GetError("login")?></span>
                    </div>
                    <div class='form-group mb-3'>
                        <label class="form-label">Пароль</label>
                        <input id='pass' class="form-control" type="password" name='password' placeholder="********" value='<?php echo GetValue("password")?>'/>
                        <span class="text-danger"><?php echo GetError("password")?></span>
                        <div>
                            <input id="checkVisiblePass" type="checkbox"/>
                            <lable>Показать пароль</lable>
                        </div>
                    </div>
                    <div class='form-grou mb-3 d-flex justify-content-between align-items-center'>
                        <div>
                            <input class='btn btn-primary' type='submit' value='Войти'/>
                        </div>
                        <div>
                            <a href='/src/pages/register.php'>Зарегистироваться</a>
                        </div>
                    </div>
                </form>
                <div>
                    
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



