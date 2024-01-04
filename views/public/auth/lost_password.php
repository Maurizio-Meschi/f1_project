<?php
if (!set_include_path("{$_SERVER['DOCUMENT_ROOT']}"))
    error("500", "set_include_path()");
if(session_status() == PHP_SESSION_NONE) session_start();

require_once("controllers/auth/auth.php");
require_once("utility/error_handling.php");
require_once ("DB/DB.php");
include("views/partials/alert.php");


[$login_allowed, $user] = check_cookie();
if (check_user_auth($user)) {
    set_session($user);
    header("Location: /f1_project/views/private/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lost password</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="/f1_project/assets/css/log_reg_style.css">
    <link rel="stylesheet" href="/f1_project/assets/css/style.css">

    <?php include("views/partials/head.php"); ?>
</head>

<body class="bg-dark vh-100">

    <div id="bg-login" class="container-fluid">
        <?php include ("views/partials/navbar_log_reg.php"); ?>

        <div class="flex-container d-flex justify-content-center">
            <form id="login-form" action="/f1_project/controllers/auth/lost_password.php" class="container-element log p-2" method="POST">

                <div style="margin-left: 10px; margin-right: 10px">
                    <?php $function = "document.getElementsByClassName('container-element')[0].style.height = '480px'" ?>
                    <?php err_msg_alert($function); ?>
                    <?php succ_msg_alert($function); ?>
                </div>

                <fieldset>
                    <legend class="d-flex align-items-center justify-content-start gap-2 hover-red px-2">
                        <span class="material-symbols-outlined">passkey</span>
                        <strong>PASSWORD RECOVERY</strong>
                    </legend>
                    <hr>
                    <div class="row mb-3">
                        <div class="text-box">
                            Write your email that you used to register on our website.
                            <br>
                            If correct, we will send your new password
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 text-box">
                            <label for="email" class="form-label"><strong>EMAIL</strong></label><br>
                            <div class="input-group mb-2">
                                <span class="input-group-text material-symbols-outlined text-dark" id="email-addon">mail</span>
                                <input type="email" id="email" class="form-control" name="email" placeholder="name@example.com" aria-describedby="email-addon" required>
                            </div>
                            <div id="select-info" class="d-none d-flex gap-2 mt-1 py-1">
                                <span class="material-symbols-outlined"></span>
                                <span class=""></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row col-12 d-flex justify-content-around align-items-center mx-auto gap-3 px-2">
                        <button type="submit" class="btn btn-danger btn-reverse-color col-12 col-md-5 d-flex align-items-center justify-content-center gap-2">
                            <span class="material-symbols-outlined text-light">mail</span>
                            <strong>Send new password</strong>
                        </button>
                        <a href="/f1_project/views/public/auth/registration.php" class="my_outline_animation col-12 col-md-4 text-center text-white text-decoration-none d-flex align-items-center justify-content-center gap-1 p-2 hover-red">
                            <span class="material-symbols-outlined text-light">login</span>
                            <span class="d-inline d-xxl-inline">Back to login</span>
                        </a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</body>
<script src="/f1_project/assets/js/validators/email.js"></script>
</html>