<?php
$currPage = 'back_Alle Nutzer';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>

<div class="content-body">
        <div class="container">
            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6">
                        <div class="page-title-content">
                            <h3>Alle Nutzer</h3>
                            <p class="mb-2">Hier kannst du alle Nutzer einsehen</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-xxl-9 col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

				<?php
				$SQLGETUSER = $db->prepare("SELECT * FROM `users`");
				$SQLGETUSER->execute();
				if ($SQLGETUSER->rowCount() != 0) {
				while ($user = $SQLGETUSER -> fetch(PDO::FETCH_ASSOC)){ ?>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <a href="user/<?= $user['id']; ?>">
                                    <div class="balance-stats">
                                        <h3><center><i class="fa fa-user"></i><br> <?= $user['username']; ?></center></h3>
										<center>
											<p style="color:grey;">
												User-ID: <?= $user['id']; ?>
												<br>
												Bot-Limit: <?= $user['bot_limit']; ?>
											</p>
										</center>
                                    </div>
								</a>
                                </div>
								
								<?php } } ?>
								
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-6 col-lg-6">
					<div class="card border-warning bg-info bg-opacity-25 mb-3">
						<div class="card-body">
							<p class="card-text text-white text-opacity-75">
								Aktuell sind <b><?= $SQLGETUSER->rowCount(); ?></b> Kunden registriert.
							</p>
						</div>
					</div>
                </div>


            </div>
        </div>
    </div>