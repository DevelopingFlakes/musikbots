<?php
$currPage = 'front_Passwort vergessen_auth';
include BASE_PATH.'app/controller/PageController.php';
include BASE_PATH.'app/manager/customer/auth/forgot_password.php';
?>
<div class="container" data-layout="container">
    <div class="row flex-center min-vh-100 py-6">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <a class="d-flex flex-center mb-4" href="<?= $helper->url(); ?>">
                <img class="mr-2" src="<?= $helper->cdnUrl(); ?>img/illustrations/falcon.png" alt="" width="58" />
                <span class="text-sans-serif font-weight-extra-bold fs-5 d-inline-block"><?= $helper->siteName(); ?></span>
            </a>
            <div class="card">
                <div class="card-body p-4 p-sm-5">
                    <div class="row text-left justify-content-between align-items-center mb-2">
                        <div class="col-auto">
                            <h5><?= $currPageName; ?></h5>
                        </div>
                    </div>
                    <?php if(isset($_GET['key']) && !empty($_GET['key'])){ $key = $_GET['key']; ?>
                        <form method="post">
                            <input name="key" hidden="hidden" value="<?= $_GET['key']; ?>">
                            <div class="form-group">
                                <input class="form-control" type="password" name="new_password" placeholder="Neues Passwort" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="new_password_repeat" placeholder="Neues Passwort wiederholen" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block mt-3" type="submit" name="resetPW">Passwort ändern</button>
                            </div>
                        </form>
                    <?php } else { ?>
                        <form method="post">
                            <div class="form-group">
                                <input class="form-control" type="text" name="user_info" placeholder="E-Mail / Benutzername" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block mt-3" type="submit" name="requestReset">Reset anfodern</button>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>