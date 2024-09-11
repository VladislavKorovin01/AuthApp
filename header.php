<?php
    require_once __DIR__ . '\actions\helpers.php';
?>

<div class="d-flex justify-content-between">
        <div>Logo</div>
        <div class="col-4 d-flex">
            <ul class="d-flex justify-content-around">
                <li class="nav-item ms-2">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link active" href="regform.php">Registration</a>
                </li>
                <li class="nav-item ms-2">
                    <?php if(!isset($_SESSION["profile"])){?>
                        <a class="nav-link active" href="index.php">Login</a>
                    <?php }else{ ?>
                        <a class="nav-link active" href="actions/logout.php">Logout</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>