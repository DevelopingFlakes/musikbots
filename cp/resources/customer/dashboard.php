<?php
$currPage = 'back_Dashboard';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>




    <div class="content-body">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6">
                    <div class="promotion d-flex justify-content-between align-items-center">
                        <div class="promotion-detail">
                            <h3 class="text-white mb-3">Es gibt was zu Feiern, die V2 ist da!</h3>
                            <p>
								Lange gab es keine großen Änderungen mehr, dass hat jetzt ein Ende! In der V2 bieten
								wir euch ein Eigenentwickeltes Interface mit neuer Performance und Verwaltungsoberfläche.
							</p>
							<a class="btn btn-primary me-3" href="<?= env('URL'); ?>ts3musikbot/create">Jetzt einen Bot erstellen</a>
                        </div>
                    </div>
                </div>

				<div class="col-xxl-6">
                    <div class="card m-0">
                        <div class="card-body p-0">
                            <div class="activity-content">
                                <div class="scrollbar-container ps">
                                    <ul>
									
				<?php
				$SQLGETSERVER = $db->prepare("SELECT * FROM `servers` LIMIT 3");
				$SQLGETSERVER->execute();
				if ($SQLGETSERVER->rowCount() != 0) {
				while ($server = $SQLGETSERVER -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php
$SQLGETSBOTSONSERV = $db->prepare("SELECT * FROM `bots` WHERE `server_id` = :serverid");
$SQLGETSBOTSONSERV->execute(array(":serverid" => $server['id']));
if ($SQLGETSBOTSONSERV->rowCount() != 0) {
while ($serv2 = $SQLGETSBOTSONSERV -> fetch(PDO::FETCH_ASSOC)){ ?>
<?php } } ?>
									
                                        <li class="d-flex justify-content-between align-items-center active">
                                            <div class="d-flex align-items-center">
                                                <div class="activity-user-img me-3">
													<img src="<?= $server['logo']; ?>" alt="" width="50">
												</div>
                                                <div class="activity-info">
                                                    <h5 class="mb-0">
														<?= $server['name']; ?>
													</h5>
                                                    <p><?= $SQLGETSBOTSONSERV->rowCount(); ?>/<?= $server['bot_limit']; ?> erstellte Bots</p>
                                                </div>
                                            </div>
                                            <div class="text-end">
												<span class=" text-muted"></span>
											</div>
                                        </li>
										
										
										<?php } } ?>

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
                    </div>
                </div>


<?php
                $SQLGETBOTS = $db->prepare("SELECT `id` FROM `bots`");
                $SQLGETBOTS->execute();
                if ($SQLGETBOTS->rowCount() != 0) {
                while ($notused = $SQLGETBOTS -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php } } ?>

				<div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center">
                        <div class="widget-icon me-3 bg-primary"><span><i class="fa fa-globe"></i></span></div>
                        <div class="widget-content">
                            <h3><?= $SQLGETBOTS->rowCount() ?></h3>
                            <p>Gesamt erstellte Bots</p>
                        </div>
                    </div>
                </div>


<?php
                $SQLALLA = $db->prepare("SELECT `id` FROM `bots` WHERE `owner_id` = $userid");
                $SQLALLA->execute();
                if ($SQLALLA->rowCount() != 0) {
                while ($row = $SQLALLA -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php } } ?>

				<div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center">
                        <div class="widget-icon me-3 bg-primary"><span><i class="fas fa-robot"></i></span></div>
                        <div class="widget-content">
                            <h3><?= $SQLALLA->rowCount() ?>/<?= $getUserBotLimit; ?></h3>
                            <p>Deine erstellten Bots</p>
                        </div>
                    </div>
                </div>

<?php
                $SQLSERV = $db->prepare("SELECT `id` FROM `servers`");
                $SQLSERV->execute();
                if ($SQLSERV->rowCount() != 0) {
                while ($row = $SQLSERV -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php } } ?>

				<div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center">
                        <div class="widget-icon me-3 bg-primary"><span><i class="fa fa-server"></i></span></div>
                        <div class="widget-content">
                            <h3><?= $SQLSERV->rowCount() ?></h3>
                            <p>Verfügbare Server</p>
                        </div>
                    </div>
                </div>

<?php
                $SQLGETUSERS = $db->prepare("SELECT `id` FROM `users`");
                $SQLGETUSERS->execute();
                if ($SQLGETUSERS->rowCount() != 0) {
                while ($row = $SQLGETUSERS -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php } } ?>

				<div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center">
                        <div class="widget-icon me-3 bg-primary"><span><i class="fa fa-user"></i></span></div>
                        <div class="widget-content">
                            <h3><?= $SQLGETUSERS->rowCount(); ?></h3>
                            <p>Aktive Benutzer</p>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-xl-12">
                    <div class="card m-0">
                        <div class="card-header">
                            <h4 class="card-title">Neuheiten offiziell von MusikBots</h4>
							<a href="news">Alle Beiträge</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="activity-content">
                                <div class="scrollbar-container ps">
                                    <ul>
										
				<?php
				$SQLGETNEWS = $db->prepare("SELECT * FROM `news` order by `id` DESC LIMIT 3");
				$SQLGETNEWS->execute();
				if ($SQLGETNEWS->rowCount() != 0) {
				while ($news = $SQLGETNEWS -> fetch(PDO::FETCH_ASSOC)){ ?>
									
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
													<span class=" text-muted"><?= $helper->formatDate($news['created_at']); ?></span>
                                                </div>
                                            </div>
                                        </li>
										
										
										<?php } } ?>

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
                    </div>
                </div>


                <div class="col-xxl-3 col-xl-12">
                    <div class="card m-0">
                        <div class="card-header">
                            <h4 class="card-title">Offizieller Discord</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="activity-content">
                                <div class="scrollbar-container ps">
                                    <ul>
										<iframe src="https://discord.com/widget?id=894000109224882268&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>

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
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-12">
                    <div class="card m-0">
                        <div class="card-header">
                            <h4 class="card-title">Ausfälle</h4>
							<a href="serverstatus">Live-Status</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="activity-content">
                                <div class="scrollbar-container ps">
                                    <ul>
										
				<?php
				$SQLGETNEWS = $db->prepare("SELECT * FROM `news_outages` WHERE `state` = 'nicht behoben' order by `id` DESC");
				$SQLGETNEWS->execute();
				if ($SQLGETNEWS->rowCount() != 0) {
				while ($news = $SQLGETNEWS -> fetch(PDO::FETCH_ASSOC)){ ?>
									
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
										
										
										<?php } } ?>

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
                    </div>
                </div>


            </div>
        </div>
    </div>
