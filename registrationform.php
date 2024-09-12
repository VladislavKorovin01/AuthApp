<?php
    require_once 'layout.php';
?>
<div class='border border-primary rounded-3 col-lg-3 col-md-5 col-sm-6 col-6 p-3 ms-3 container'>
    <form class='form' method='POST' action='\actions\registration.php'>
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
    <div class='form-grou mb-3 d-flex justify-content-between align-items-center'>
            <div>
                <input class='btn btn-primary' type='submit' value='Send'/>
            </div>
            <div>
                <a href='index.php'>Войти</a>
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