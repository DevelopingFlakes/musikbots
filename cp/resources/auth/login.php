<?php
$currPage = 'front_Login_auth';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/auth/login.php';

?>

<body class="pace-done pace-top theme-info"><div class="pace pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
<div class="pace-activity"></div></div>

<div id="app" class="app app-full-height app-without-header">

<div class="login">

<div class="login-content">
<form method="POST" name="login_form">
<h1 class="text-center">Einloggen</h1>
<div class="text-white text-opacity-50 text-center mb-4">
Zur Sicherheit deiner und unserer Daten, solltest du dich anmelden.
</div>

<!--<div class="row">

	              
	<div class="col-xxl-4">
	</div>
        
	<div class="col-xxl-4">
		<div class="promotion d-flex justify-content-between align-items-center">    
			<div class="promotion-detail">
				<h3 class="text-white mb-3">Es gibt was zu Feiern, die V2 ist da!</h3>
				<p>
					<center>
					Wir haben unser komplettes CP nun selber gestaltet und entwickelt, wodurch wir euch eine verbesserte
					Performance sowie neue Leistung bereitstellen können. Leider benötigst du jedoch ein neues Konto.
					</center>
				</p>
			</div>	
		</div>     
	</div>

</div>-->

<div class="row justify-content-center h-100 align-items-center">
            <div class="col-xl-5 col-md-6">

<div class="auth-form card">
                    <div class="card-body">

<div class="mb-3">
<label class="form-label">Email Addresse <span class="text-danger">*</span></label>
<input name="email" type="text" class="form-control" value="" placeholder="">
</div>
<div class="mb-3">
<div class="d-flex">
<label class="form-label">Passwort <span class="text-danger">*</span></label>
<a href="<?= env('DISOCRD'); ?>" target="_blank" class="ms-auto text-white text-decoration-none text-opacity-50">Passwort vergessen?</a>
</div>
<input name="password" type="password" class="form-control" value="" placeholder="">
</div>
<!--<div class="mb-3">
<div class="form-check">
<input class="form-check-input" type="checkbox" value="" id="customCheck1">
<label class="form-check-label" for="customCheck1">Remember me</label>
</div>
</div>-->


<div class="mt-3 d-grid gap-2">
<button type="submit" name="login" class="btn btn-primary mr-2">Einloggen</button>
</div>

	</div>
	</div>

	</div>
	</div>

<div class="text-center text-white text-opacity-50">
Du hast noch keinen Account? <a href="register">Account erstellen</a>.
</div>
</form>
</div>

</div>


</div>



</body>



