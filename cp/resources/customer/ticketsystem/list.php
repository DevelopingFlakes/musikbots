<?php
$currPage = 'back_Deine Tickets';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>

<?php
if(isset($_POST['createTicket'])){
	 $msg = "ticket_created";
	 $error = false;

	$SQLGETCLOSEDTICKETS = $db->prepare("SELECT * FROM `tickets` WHERE `owner_id` = :userid AND `state` = 'open'");
	$SQLGETCLOSEDTICKETS->execute(array(":userid" => $userid));
	if ($SQLGETCLOSEDTICKETS->rowCount() != 0) {
	while ($closed = $SQLGETCLOSEDTICKETS -> fetch(PDO::FETCH_ASSOC)){			
	}}
	
	if (!$SQLGETCLOSEDTICKETS->rowCount() == NULL){
	 $msg = "to_much_tickets_open";
	 $error = true;
	 include BASE_PATH.'notify/temp.php';
	}

	if($error == false) {
    $SQL = $db->prepare("INSERT INTO `tickets` SET 
	`owner_id` = :userid,
	`state` = 'open'
	");
	
    $SQL->execute(array(
		":userid" => $userid
	)); 
		
	 $webhook_content = "Es gibt ein neues Ticket";
	 include BASE_PATH.'resources/customer/ticketsystem/_sendWebhook.php';
	 include BASE_PATH.'notify/temp.php';
	}
	
}

?>

<div class="content-body">
        <div class="container">
            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6">
                        <div class="page-title-content">
                            <h3>Deine Tickets</h3>
                            <p class="mb-2">Hier kannst du mit unserem Support-Team in Kontakt treten</p>
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
				$SQLGETTICKETS = $db->prepare("SELECT * FROM `tickets` WHERE `owner_id` = :userid");
				$SQLGETTICKETS->execute(array(":userid" => $userid));
				if ($SQLGETTICKETS->rowCount() != 0) {
				while ($ticket = $SQLGETTICKETS -> fetch(PDO::FETCH_ASSOC)){ ?>
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <a href="ticket/view/<?= $ticket['id']; ?>">
                                    <div class="balance-stats">
                                        <h3><center><i class="fa fa-ticket-alt"></i><br> TICKET #<?= $ticket['id']; ?></center></h3>
										<?php if($ticket['state'] == 'open') { ?>
										<center><p style="color:grey;">Ticket ist offen</p></center>
										<?php  } ?>

										<?php if($ticket['state'] == 'closed') { ?>
										<center><p style="color:grey;">Ticket ist geschlossen</p></center>
										<?php  } ?>
                                    </div>
								</a>
                                </div>
								
								<?php } } ?>



								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
								<form method="POST">
                                <button type="submit" name="createTicket" class="balance-stats">
                                        <h3><center><i class="fa fa-plus"></i><br> Ticket erstellen</center></h3>
										<center><p style="color:grey;">Erstelle ein Support-Ticket</p></center>
								</button>
								</form>
                                </div>
								
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