<?php
$currPage = 'team_Alle TS3MusikBots_admin';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>

<div class="content-body">
        <div class="container">
            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6">
                        <div class="page-title-content">
                            <h3>Alle TS3MusikBots</h3>
                            <p class="mb-2">Hier kannst du alle MusikBots einsehen</p>
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
				$SQLGETALLBOTS = $db->prepare("SELECT * FROM `bots`");
				$SQLGETALLBOTS->execute();
				if ($SQLGETALLBOTS->rowCount() != 0) {
				while ($bot = $SQLGETALLBOTS -> fetch(PDO::FETCH_ASSOC)){ ?>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <a href="../admin/ts3musikbot/view/<?= $bot['id']; ?>">
                                    <div class="balance-stats">
                                        <h3><center><i class="fa fa-robot"></i><br> <?= $bot['name']; ?></center></h3>
										<center>
											<p style="color:grey;">
												Bot-ID: <?= $bot['id']; ?>
												<br>
												Inhaber: <?= $user->getDataById($bot['owner_id'], 'username'); ?>
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

				<?php
				$SQLGETSERVLIMIT = $db->prepare("SELECT * FROM `servers`");
				$SQLGETSERVLIMIT->execute();
				if ($SQLGETSERVLIMIT->rowCount() != 0) {
				while ($serv = $SQLGETSERVLIMIT -> fetch(PDO::FETCH_ASSOC)){ ?>
				<?php $globallimit = $serv['bot_limit']; ?>
				<?php } } ?>

                <div class="col-xxl-3 col-xl-6 col-lg-6">
					<div class="card border-warning bg-info bg-opacity-25 mb-3">
						<div class="card-body">
							<p class="card-text text-white text-opacity-75">
								Maximal erstellbar: <b><?= $SQLGETSERVLIMIT->rowCount() * $globallimit; ?></b>
								<br>
								Derzeit erstellt: <b><?= $SQLGETALLBOTS->rowCount(); ?></b>
								<br>
								Derzeit verfügbare Server: <b><?= $SQLGETSERVLIMIT->rowCount(); ?></b>
							</p>
						</div>
					</div>
                </div>


            </div>
        </div>
    </div>