<?php
   require_once 'layout.php';

    if(isAuth(isset($_SESSION["user"]["id"]))){
        header("Location: /profile.php");
    }
?>
<div class='border border-primary rounded-3 col-4 p-3 m-auto container-fluid'>
    <form class='form' method='POST' action='\actions\login.php'>
        <div class='form-group mb-3'>
            <div class="text text-danger ps-3 pe-3 pu-1 pb-1"><?php echo GetMessage() ?></div>
        </div>
        <div class='from-group mb-3'>
            <label class='form-label'>Login</label>
            <input class='form-control' type='text' placeholder="Email or phone number" name='login' value='<?php echo GetValue("login")?>'/>
            <span class='text-danger'><?php echo GetError("login")?></span>
        </div>
        <div class='form-group mb-3'>
            <label class="form-label">Password</label>
            <input id='pass' class="form-control" type="password" name='password' value='<?php echo GetValue("password")?>'/>
            <span class="text-danger"><?php echo GetError("password")?></span>
            <div>
                <input id="checkVisiblePass" type="checkbox"/>
                <lable>Show password</lable>
            </div>
        </div>
        <div class='form-grou mb-3 d-flex justify-content-between align-items-center'>
            <div>
                <input class='btn btn-primary' type='submit' value='Send'/>
            </div>
            <div>
                <a href='\registrationform.php'>Зарегистироваться</a>
            </div>
        </div>
    </form>
</div>

<div>
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