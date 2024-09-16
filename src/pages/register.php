<?php
    require_once __DIR__ .'\..\helpers.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
    <div class='min-vh-100 d-flex justify-content-center align-items-center'>
        <form class='form border border-2 border-primary rounded-3 p-3 bg-light' method='POST' action='/actions/register.php'>
        <div class='form-group mb-3'>
                <div class="text text-danger ps-3 pe-3 pu-1 pb-1"><?php echo GetMessage() ?></div>
        </div>
        <div class='from-group mb-3'>
            <label class='form-label'>Name</label>
            <input class='form-control' type='text' name='name' value='<?php echo GetValue("name")?>'/>
            <span class='text-danger'><?php echo GetError("name")?></span>
        </div>
        <div class='from-group mb-3'>
            <label class='form-label'>Phone</label>
            <input class='form-control' type='text' name='phone' value='<?php echo GetValue("phone")?>'/>
            <span class='text-danger'><?php echo GetError("phone")?></span>
        </div>
        <div class='from-group mb-3'>
            <label class='form-label'>Email</label>
            <input class='form-control' type='text' name='email' value='<?php echo GetValue("email")?>'/>
            <span class='text-danger'><?php echo GetError("email")?></span>
        </div>

        <div class='form-group mb-3'>
            <label class="form-label">Password</label>
            <input id='pass' class="form-control" type="password" name='password' value='<?php echo isExist("values","password") ? GetValue("password") : ""?>'/>
            <span class="text-danger"><?php echo GetError("password")?></span>
            <div>
                <input id="checkVisiblePass" type="checkbox"/>
                <lable>Show password</lable>
            </div>
        </div>
        <div class='form-group mb-3'>
            <label class="form-label">Password</label>
            <input id='pass' class="form-control" type="password" name='passwordConfirm' value='<?php echo GetValue("passwordConfirm")?>'/>
        </div>
        <div class='form-group mb-3 d-flex justify-content-between align-items-center'>
                <div>
                    <input class='btn btn-primary' type='submit' value='Send'/>
                </div>
                <div>
                    <a class="nav-link active" href='/pages/login.php'>Войти</a>
                </div>
            </div>
        </form>
    </div>


    <?php
        $_SESSION["values"] = [];
        $_SESSION["errors"] = [];
    ?>

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
