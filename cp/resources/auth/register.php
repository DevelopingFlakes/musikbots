<?php
$currPage = 'front_Account erstellen_auth';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/auth/register.php';
?>

<body class="pace-done pace-top theme-info"><div class="pace pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>

<div id="app" class="app app-full-height app-without-header">

<div class="login">

<div class="login-content">
<form method="POST" name="login_form">
<h1 class="text-center">Account erstellen</h1>
<div class="text-white text-opacity-50 text-center mb-4">
Bitte erstelle dir einen Account, bevor zu beginnst.
</div>

<div class="row justify-content-center h-100 align-items-center">
            <div class="col-xl-5 col-md-6">

                <div class="auth-form card">
                    <div class="card-body">


<div class="mb-3">
<label class="form-label">Nutzername <span class="text-danger">*</span></label>
<input name="username" type="text" class="form-control" value="" placeholder="">
</div>

<div class="mb-3">
<label class="form-label">Email Addresse <span class="text-danger">*</span></label>
<input name="email" type="text" class="form-control" value="" placeholder="">
</div>

<div class="mb-3">
<div class="d-flex">
<label class="form-label">Passwort <span class="text-danger">*</span></label>
<a href="#" class="ms-auto text-white text-decoration-none text-opacity-50">Forgot password?</a>
</div>
<input name="password" type="password" class="form-control" value="" placeholder="">
</div>

<div class="mb-3">
<div class="d-flex">
<label class="form-label">Passwort wiederholen <span class="text-danger">*</span></label>
<a href="#" class="ms-auto text-white text-decoration-none text-opacity-50">Forgot password?</a>
</div>
<input name="password_repeat" type="password" class="form-control" value="" placeholder="">
</div>


<!--<div class="mb-3">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="customCheck1">
<label class="form-check-label" for="customCheck1">Remember me</label>
</div>
</div>-->

<div class="mt-3 d-grid gap-2">
<button type="submit" name="register" class="btn btn-primary mr-2">Account erstellen</button>
</div>

	</div>
	</div>
	</div>
	</div>

<div class="text-center text-white text-opacity-50">
Du hast bereits einen Account? <a href="login">Zum Login</a>.
</div>
</form>
</div>

</div>


</div>



</body>

