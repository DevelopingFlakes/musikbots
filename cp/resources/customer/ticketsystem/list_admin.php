<?php
$currPage = 'team_Alle Tickets_admin';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>

<div class="content-body">
        <div class="container">
            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6">
                        <div class="page-title-content">
                            <h3>Alle Tickets</h3>
                            <p class="mb-2">Hier kannst du alle Tickets einsehen</p>
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
				$SQLGETTICKETS = $db->prepare("SELECT * FROM `tickets`");
				$SQLGETTICKETS->execute();
				if ($SQLGETTICKETS->rowCount() != 0) {
				while ($ticket = $SQLGETTICKETS -> fetch(PDO::FETCH_ASSOC)){ ?>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <a href="../admin/ticket/view/<?= $ticket['id']; ?>">
                                    <div class="balance-stats">
                                        <h3><center><i class="fa fa-ticket-alt"></i><br> TICKET #<?= $ticket['id']; ?></center></h3>
										
										<?php if($ticket['state'] == 'open') { ?>
										<center>
											<p style="color:grey;">
												Ticket ist offen
												<br>
												Ersteller: <?= $user->getDataById($ticket['owner_id'], 'username'); ?>
											</p>
										</center>
										<?php  } ?>

										<?php if($ticket['state'] == 'closed') { ?>
										<center>
											<p style="color:grey;">
												Ticket ist geschlossen
												<br>
												Ersteller: <?= $user->getDataById($ticket['owner_id'], 'username'); ?>
											</p>
										</center>
										<?php  } ?>
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
								Im Ticketsystem kannst du Hilfe von unserem Team erhalten. Hier kannst du ebenfalls
								dein Bot Limit kostenfrei erweitern lassen.
							</p>
						</div>
					</div>
                </div>


            </div>
        </div>
    </div>