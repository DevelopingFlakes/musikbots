<?php
$currPage = 'back_News';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>




    <div class="content-body">
        <div class="container">
            <div class="row">

                <div class="col-xxl-1 col-xl-12">
				</div>


                <div class="col-xxl-10 col-xl-12">
                    <div class="card m-0">
                        <div class="card-header">
                            <h4 class="card-title">Neuheiten offiziell von MusikBots</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="activity-content">
                                <div class="scrollbar-container ps">
                                    <ul>
										
				<?php
				$SQLGETNEWS = $db->prepare("SELECT * FROM `news` order by `id` DESC");
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



            </div>
        </div>
    </div>
