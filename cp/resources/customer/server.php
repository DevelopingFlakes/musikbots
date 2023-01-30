<?php
$currPage = 'back_Serverstatus';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>

<div class="content-body">
        <div class="container active">

            <div class="row">

				<?php
				$SQLGETNEWS = $db->prepare("SELECT * FROM `news_outages` WHERE `state` = 'nicht behoben' order by `id` DESC LIMIT 5");
				$SQLGETNEWS->execute();
				if ($SQLGETNEWS->rowCount() != 0) {
				while ($news = $SQLGETNEWS -> fetch(PDO::FETCH_ASSOC)){ ?>
				
				            <div class="col-xxl-1 col-xl-12">
				</div>

                <div class="col-xxl-10 col-xl-12">
                    <div class="card m-0">
                        <div class="card-header">
                            <h4 class="card-title">Eine oder mehrere Systemeinschränkung(en) wurde(n) gemeldet</h4>
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
				
				            <div class="col-xxl-1 col-xl-12">
				</div>

				<?php } } ?>

            <div class="col-xxl-1 col-xl-12">
				</div>

                <div class="col-xxl-10">
                    <div class="card">
                    <h3>Serverstatus</h3>
                        <p class="mb-2">Hier siehst du den aktuellen Status unserer Infrastruktur</p>
                        <div class="card-body">

                <?php
                $SQLGETSERVER = $db->prepare("SELECT * FROM `servers` order by `loc` DESC");
                $SQLGETSERVER->execute();
                if ($SQLGETSERVER->rowCount() != 0) {
                while ($server = $SQLGETSERVER -> fetch(PDO::FETCH_ASSOC)){ ?>
							
							<div class="verify-content">
                                <div class="d-flex align-items-center">
									<span class="me-3 icon-circle bg-primary text-white"><i class="ri-server-line"></i></span>
                                    <div class="primary-number">
                                        <p class="mb-0">
											<strong><img src="<?= $server['logo']; ?>" width="15"> <?= $server['name']; ?></strong>
										</p>
										<small>
											<?php if($server['state'] == 'success') {?> 
											Dieser Dienst ist aktuell <b>uneingeschränkt</b> erreichbar. 
											<?php } ?>

											<?php if($server['state'] == 'danger') {?> 
											Dieser Dienst ist aktuell <b>nicht</b> erreichbar. 
											<?php } ?>
										</small>
										<br>
										<span class="text-<?= $server['state']; ?>">
											<?php if($server['state'] == 'success') {?> Erreichbar <?php } ?>
											<?php if($server['state'] == 'danger') {?> Nicht erreichbar <?php } ?>
										</span>
                                    </div>
                                </div>
                            </div>
							
                            <hr class="dropdown-divider my-4">
							
							<?php } } ?>
							

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>