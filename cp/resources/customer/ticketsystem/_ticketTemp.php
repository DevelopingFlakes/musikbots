<?php
if(isset($_POST['sendMessage'])){
	 $msg = "ticket_message_send";
	 $error = false;

	if($error == false) {
    $SQL = $db->prepare("INSERT INTO `ticket_messages` SET 
	`ticket_id` = :sideid,
	`writer_id` = :userid,
	`content` = :content,
	`role` = :role
	");
	
    $SQL->execute(array(
		":sideid" => $siteid,
		":userid" => $userid,
		":content" => $_POST['message_content'],
		":role" => $userrole
	)); 
		
	 if($userrole == "customer") {
		$webhook_content = "Es gibt eine neue Nachricht in Ticket **".$siteid."**";
	    include BASE_PATH.'resources/customer/ticketsystem/_sendWebhook.php';
	 }
	 include BASE_PATH.'notify/temp.php';
	}
	
}

if(isset($_POST['closeTicket'])){
	 $msg = "ticket_closed";

    $SQL = $db->prepare("UPDATE `tickets` SET 
	`state` = 'closed'
	
	WHERE `id` = :siteid
	");
	
    $SQL->execute(array(
		":siteid" => $siteid
	)); 

	 include BASE_PATH.'notify/temp.php';
								
}

?>

<div class="content-body">
        <div class="container">
            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6">
                        <div class="page-title-content">
                            <h3>Ticket #<?= $siteid; ?> <?php if($ticket['state'] == 'closed'){ ?> | <b>Dieses Ticket ist geschlossen</b><?php } ?></h3>
                            <p class="mb-2">Beschreibe dein Anliegen möglichst genau, damit wir dir schnell helfen können.</p>
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
				$SQLGETTICKETS = $db->prepare("SELECT * FROM `ticket_messages` WHERE `ticket_id` = :siteid");
				$SQLGETTICKETS->execute(array(":siteid" => $siteid));
				if ($SQLGETTICKETS->rowCount() != 0) {
				while ($ticketmsg = $SQLGETTICKETS -> fetch(PDO::FETCH_ASSOC)){ ?>
								
								<?php if($ticketmsg['role'] == 'customer') { ?>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
								</div>
								<?php } ?>

								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <div class="balance-stats">
										<p style="color:grey;">
											<?= $helper->nl2br2($ticketmsg['content']); ?>
											<br><br>
										</p>
                                        <p style="color:white;">
											Antwort von <?= $user->getDataById($ticketmsg['writer_id'], 'username'); ?>
																			
											<?php if($ticketmsg['role'] == 'team') { ?>
								             - Mitarbeiter
											<?php } ?>								   
										</p>
										<small>Gesendet: <?= $helper->formatDate($ticketmsg['created_at']); ?></small>
                                    </div>
                                </div>

								<?php if($ticketmsg['role'] == 'team') { ?>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
								</div>
								<?php } ?>
								
								<?php } } ?>

				<?php if($ticket['state'] == 'closed'){ ?>
								<div class="col-xl-12 col-lg-6 col-md-6 col-sm-6">
                                    <div class="balance-stats">
										<p style="color:grey;">Dieses Ticket wurde <b>geschlossen</b>.</p>
                                    </div>
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
								Bitte beachte: Das Ausnutzen unseres Ticketsystems kann zu einer Kontosperrung führen!
							</p>
						</div>
					</div>
                </div>

                <div class="col-xxl-3 col-xl-6 col-lg-6">
				</div>

				<?php if($ticket['state'] == 'open'){ ?>
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
									
                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Text <a style="color:red;">*</a></label>
										<textarea name="message_content" class="form-control" value=""></textarea>
									</div>
									
                                </div>
                                <div class="mt-3">

									<button type="submit" name="sendMessage" class="btn btn-primary mr-2">Nachricht senden</button>
									<button type="submit" name="closeTicket" class="btn btn-danger mr-2">Ticket schließen</button>
								</div>
                            </form>
                        </div>
                    </div>
					</div>
				<?php } ?>


            </div>
        </div>
    </div>