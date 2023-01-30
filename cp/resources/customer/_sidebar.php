<?php
$SQLGETBOTLIMITFROMUSER = $db->prepare("SELECT * FROM `users` WHERE `id` = :userid");
$SQLGETBOTLIMITFROMUSER->execute(array(":userid" => $userid));
if ($SQLGETBOTLIMITFROMUSER->rowCount() != 0) {
while ($botlimit = $SQLGETBOTLIMITFROMUSER -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php $getUserBotLimit = $botlimit['bot_limit']; ?>

<?php if($botlimit['state'] == 'banned') { ?>
<?php header('Location: '.env('URL').'logout'); ?>
<?php } ?>

<?php } } ?>

<?php
$SQLGETCURRENTUSERBOTS = $db->prepare("SELECT * FROM `bots` WHERE `owner_id` = :userid");
$SQLGETCURRENTUSERBOTS->execute(array(":userid" => $userid));
if ($SQLGETCURRENTUSERBOTS->rowCount() != 0) {
while ($currentuserbots = $SQLGETCURRENTUSERBOTS -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php } } ?>

<?php $getUserCurrentBots = $SQLGETCURRENTUSERBOTS->rowCount(); ?>


    <div class="header">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="header-content">
                    <div class="header-left">
                        <div class="brand-logo"><a class="mini-logo" href="<?= env('URL'); ?>">
							<img src="<?= env('APP_LOGO'); ?>" alt="" width="40"></a></div>
						
						<small>
							Aufgrund von technischen Problemen kann es derzeit zu Verzögerungen bei dem Abspielen
							von Streams kommmen.
							<br>
							Sollten Sie ein schwarzes Bild sehen, laden Sie die Seite neu.
						</small>
                    </div>
                    <div class="header-right">
					

                        <div class="theme-switch">
							<a href="<?= env('URL'); ?>logout">
						    <i class="ri-logout-box-line" style="color:red;"></i>
							</a>
						</div>
						
                        <div class="theme-switch">
							<a href="<?= env('URL'); ?>news">
						    <i class="ri-mail-send-line"></i>
							</a>
						</div>

                        <div class="theme-switch">
							<a href="<?= env('URL'); ?>serverstatus">
							<i class="ri-server-line"></i>
							</a>
						</div>

                        <div class="theme-switch">
							<a href="<?= env('URL'); ?>changelog">
							<i class="ri-file-code-line"></i>
							</a>
						</div>

                        <div class="theme-switch">
							<a href="<?= env('URL'); ?>">
							<i class="ri-home-line"></i>
							</a>
						</div>
					

                        <!--<div class="dark-light-toggle theme-switch" onclick="themeToggle()">
                            <span class="dark"><i class="fa fa-moon"></i></span>
                            <span class="light"><i class="fa fa-sun"></i></span>
                        </div>-->


                        <div class="dropdown profile_log dropdown">
                            <div data-bs-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                                <div class="user icon-menu active"><span><img src="<?= env('APP_LOGO'); ?>" alt=""></span>
                                </div>
                            </div>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
								
                                <div class="user-email">
                                    <div class="user">
                                        <span class="thumb">
                                            <img src="<?= env('APP_LOGO'); ?>" alt="">
                                        </span>
                                        <div class="user-info">
                                            <h5><?= $username; ?></h5>
                                            <span><?= $user->getDataById($userid, 'role'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!--<a class="dropdown-item" href="./profile.html">
                                    <span><i class="ri-user-line"></i></span>Profile
                                </a>
                                <a class="dropdown-item logout" href="<?= env('URL'); ?>logout">
                                    <i class="fa fa-sign-out-alt" style="color:#E61313"></i>Ausloggen
                                </a>-->
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="sidebar">
    <div class="brand-logo"><a class="full-logo" href="./"><img src="<?= env('APP_LOGO'); ?>" alt="" width="30"></a></div>
    <div class="menu active">
        <ul class="show">
			
            <li class="<?php if($currPageName == "Dashboard") { ?> active <?php } ?>">
                <a href="<?= env('URL'); ?>dashboard" class="active">
                    <span><i class="ri-dashboard-2-line"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
			
            <li class="<?php if($currPageName == "Deine TS3MusikBots") { ?> active <?php } ?>">
                <a href="<?= env('URL'); ?>ts3musikbot/list" class="active">
                    <span><i class="ri-robot-line"></i></span>
                    <span class="nav-text">TS3MusikBots</span>
                </a>
            </li>
			
			<hr>

            <li class="<?php if($currPageName == "Deine Tickets") { ?> active <?php } ?>">
                <a href="<?= env('URL'); ?>tickets" class="active">
                    <span><i class="ri-ticket-line"></i></span>
                    <span class="nav-text">Ticketsystem</span>
                </a>
            </li>

     
			<?php if($user->isAdmin($_COOKIE['session_token'])){ ?>

			<hr>

            <li class="<?php if($currPageName == "Admin Dashboard") { ?> active <?php } ?>">
                <a href="<?= env('URL'); ?>admin/dashboard" class="active">
                    <span><i class="ri-home-line"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li class="<?php if($currPageName == "Alle Benutzer") { ?> active <?php } ?>">
                <a href="<?= env('URL'); ?>admin/users" class="active">
                    <span><i class="ri-user-line"></i></span>
                    <span class="nav-text">Nutzerliste</span>
                </a>
            </li>

            <li class="<?php if($currPageName == "Alle TS3MusikBots") { ?> active <?php } ?>">
                <a href="<?= env('URL'); ?>admin/bots" class="active">
                    <span><i class="ri-robot-line"></i></span>
                    <span class="nav-text">Botliste</span>
                </a>
            </li>

            <li class="<?php if($currPageName == "Alle Tickets") { ?> active <?php } ?>">
                <a href="<?= env('URL'); ?>admin/tickets" class="active">
                    <span><i class="ri-ticket-line"></i></span>
                    <span class="nav-text">Ticketsystem</span>
                </a>
            </li>
			
			<?php } ?>

        </ul>
    </div>
</div>