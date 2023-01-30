<?php
$currPage = 'back_Deine TS3MusikBots';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>

<div class="content-body">
        <div class="container">
            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6">
                        <div class="page-title-content">
                            <h3>Deine TS3MusikBots</h3>
                            <p class="mb-2">Hier kannst du deine TS3MusikBots verwalten und steuern</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

				<?php
				$SQLGETNEWS = $db->prepare("SELECT * FROM `news_outages` WHERE `state` = 'nicht behoben' order by `id` DESC LIMIT 1");
				$SQLGETNEWS->execute();
				if ($SQLGETNEWS->rowCount() != 0) {
				while ($news = $SQLGETNEWS -> fetch(PDO::FETCH_ASSOC)){ ?>

                <div class="col-xxl-12 col-xl-12">
                    <div class="card m-0">
                        <div class="card-header">
                            <h4 class="card-title">Eine Systemeinschränkung wurde gemeldet</h4>
							<a href="<?= env('URL'); ?>serverstatus">Live-Status</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="activity-content">
                                <div class="scrollbar-container ps">
                                    <ul>
									
									
                                        <li class="d-flex justify-content-between align-items-center active">
                                            <div class="d-flex align-items-center">
                                                <div class="activity-user-img me-3"></div>
                                                <div class="activity-info">
                                                    <h5 class="mb-0">
														<?= $news['title']; ?>
													</h5>
                                                    <p>
														<?= $news['text']; ?>
													</p>
													<span class=" text-muted">
														<?= $helper->formatDate($news['created_at']); ?> - <?= $news['state']; ?>
													</span>
                                                </div>
                                            </div>
                                        </li>


                                    </ul>
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br><br>
                </div>

				<?php } } ?>

                <div class="col-xxl-9 col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

				<?php
				$SQLGETOWNBOTS = $db->prepare("SELECT * FROM `bots` WHERE `owner_id` = :userid");
				$SQLGETOWNBOTS->execute(array(":userid" => $userid));
				if ($SQLGETOWNBOTS->rowCount() != 0) {
				while ($bot = $SQLGETOWNBOTS -> fetch(PDO::FETCH_ASSOC)){ ?>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <a href="view/<?= $bot['id']; ?>">
                                    <div class="balance-stats">
                                        <h3><center><i class="fa fa-robot"></i><br> <?= $bot['name']; ?></center></h3>
										<center><p style="color:grey;">Bot-ID: <?= $bot['id']; ?></p></center>
                                    </div>
								</a>
                                </div>
								
								<?php } } ?>

								<?php if($getUserBotLimit > $getUserCurrentBots) { ?>
								
								<?php $avbots = $getUserBotLimit - $getUserCurrentBots; ?>
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <a href="create">
                                    <div class="balance-stats">
                                        <h3><center><i class="fa fa-plus"></i><br> Bot hinzufügen</center></h3>
										<center><p style="color:grey;">Noch <b><?= $avbots; ?></b> Bot(s) erstellbar</p></center>
                                    </div>
								</a>
                                </div>
								<?php } ?>

								<?php if($getUserBotLimit == $getUserCurrentBots) { ?>

								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <a href="../tickets">
                                    <div class="balance-stats">
                                        <h3><center><i class="fa fa-times"></i><br> Bot Limit erreicht</center></h3>
										<center><p style="color:grey;">
											Du hast <b><?= $getUserCurrentBots; ?>/<?= $getUserBotLimit; ?></b> Bots erstellt
											</p></center>
                                    </div>
								</a>
                                </div>
								<?php } ?>
								
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-6 col-lg-6">
					<div class="card border-warning bg-info bg-opacity-25 mb-3">
						<div class="card-body">
							<p class="card-text text-white text-opacity-75">
								Du kannst aktuell <b><?= $getUserBotLimit; ?></b> Bots erstellen.
								<br>
								<br>
								Sofern du dein Limit eweitern möchtest, eine Frage oder ein Problem hast. Kannst du uns gerne jederzeit
								im Support kontaktieren. Wir werden dir schnellstmöglichst antworten.
							</p>
						</div>
					</div>
                </div>


            </div>
        </div>
    </div>