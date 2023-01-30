<?php
$currPage = 'back_Einen MusikBot erstellen';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php
if(isset($_POST['createBot'])){
	 $msg = "bot_created";
	 $error = false;

// Check for Server Limit [ START ]
$SQLGETSBOTSONSERV = $db->prepare("SELECT * FROM `bots` WHERE `server_id` = :servid");
$SQLGETSBOTSONSERV->execute(array(":servid" => $_POST['bot_server']));
if ($SQLGETSBOTSONSERV->rowCount() != 0) {
while ($serv2 = $SQLGETSBOTSONSERV -> fetch(PDO::FETCH_ASSOC)){
 } }

$SQLGETSERV = $db->prepare("SELECT * FROM `servers` WHERE `id` = :servid");
$SQLGETSERV->execute(array(":servid" => $_POST['bot_server']));
if ($SQLGETSERV->rowCount() != 0) {
while ($serv = $SQLGETSERV -> fetch(PDO::FETCH_ASSOC)){ 

$serv_limit = $serv['bot_limit'];

}}


	if ($serv_limit == $SQLGETSBOTSONSERV->rowCount()) {
		$error = true;
		$msg = "server_voll";
	}
// Check for Server Limit [ ENDE ]

if($error == false) {
$SQLGETSERV = $db->prepare("SELECT * FROM `servers`");
$SQLGETSERV->execute(array());
if ($SQLGETSERV->rowCount() != 0) {
while ($mainserv = $SQLGETSERV -> fetch(PDO::FETCH_ASSOC)){ 

$serverid = $mainserv['id'];

if($_POST['bot_server'] == $serverid){


$SQLGETSERV = $db->prepare("SELECT * FROM `servers` WHERE `id` = :serverid");
$SQLGETSERV->execute(array(":serverid" => $serverid));
if ($SQLGETSERV->rowCount() != 0) {
while ($serv = $SQLGETSERV -> fetch(PDO::FETCH_ASSOC)){ 

include BASE_PATH."app/sinusbot/autoload.php";
$sinusbot = new SinusBot\API($serv['url']);
$sinusbot->login($serv['username'], $serv['password']);
}}

}

} } // Mainserv


// Check for UUID
$getuuid = $sinusbot->createInstance($_POST['bot_name'], "ts3");

	if ($getuuid == NULL) {
		$error = true;
		$msg = "api_error";
	}
}


	if($error == false) {
    $SQL = $db->prepare("INSERT INTO `bots` SET 
	`name` = :bot_name,
	`owner_id` = :userid,
	`server_id` = :bot_server,
	`ext_id` = :ext_id
	");
	
    $SQL->execute(array(
		":bot_name" => $_POST['bot_name'],
		":userid" => $userid,
		":bot_server" => $_POST['bot_server'],
		":ext_id" => $getuuid,
	)); 
		
     header('Location: '.env('URL').'ts3musikbot/list');
	}// IF error = false

	 include BASE_PATH.'notify/temp.php';


}
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>
						



<div class="content-body">
        <div class="container active">


            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-12">
                        <div class="page-title-content">
							<h3><center>TS3MusikBot erstellen</center></h3>
                           <center><p class="mb-2">Hier kannst du einen TS3MusikBot erstellen</p></center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

				<?php if($getUserCurrentBots == $getUserBotLimit) { ?>
				
				<div class="col-xxl-3 col-xl-3 col-lg-3">
				</div>
				<center>
                <div class="col-xxl-6 col-xl-6 col-lg-6">
					<div class="card border-warning bg-info bg-opacity-25 mb-3">
						<div class="card-body">
							<p class="card-text text-white text-opacity-75">
								<b>Es ist ein Fehler aufgetreten</b>
								<br>
								Du hast das Limit deiner verfügbaren Bots bereits aufgebraucht! Sofern du dieses Limit
								erweitern lassen möchtest, kannst du dich jederzeit im Support melden.
							</p>
						</div>
					</div>
                </div>
				</center>
				<?php } ?>

                <div class="col-xxl-3 col-xl-12 col-lg-12">
                </div>


                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
									
                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Benutzerdefinierter Name <a style="color:red;">*</a></label>
										<input 
											   name="bot_name" 
											   type="text" class="form-control" 
											   value="<?= $bot['name']; ?>" 
											   required>
									</div>

                                    <!--<div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Standart Server <a style="color:red;">*</a></label>
										<input 
											   name="default_server" 
											   type="text" 
											   class="form-control" 
											   value="<?= $bot['default_server']; ?>" 
											   required>
									</div>-->

                                    <!--<div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Standart Server Passwort</label>
										<input 
											   name="default_server_pass" 
											   type="text" 
											   class="form-control" 
											   value="<?= $bot['default_server_pass']; ?>" 
											   >
									</div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Standart Server Channel</label>
										<input 
											   name="default_server_channel" 
											   type="number" 
											   class="form-control" 
											   value="<?= $bot['default_server_channel']; ?>" 
											   >
									</div>-->
									
									
									<div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										
										<label class="form-label">Server auswählen <a style="color:red;">*</a></label>
										
										<select name="bot_server" class="form-control" required>
											
										                <?php
                $SQLVIEWALLSERVER = $db->prepare("SELECT * FROM `servers`");
                $SQLVIEWALLSERVER->execute();
                if ($SQLVIEWALLSERVER->rowCount() != 0) {
                while ($server = $SQLVIEWALLSERVER -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php
$SQLGETSBOTSONSERV = $db->prepare("SELECT * FROM `bots` WHERE `server_id` = :serverid");
$SQLGETSBOTSONSERV->execute(array(":serverid" => $server['id']));
if ($SQLGETSBOTSONSERV->rowCount() != 0) {
while ($serv2 = $SQLGETSBOTSONSERV -> fetch(PDO::FETCH_ASSOC)){ ?>
<?php } } ?>

                                            <option value="
											    <?= $server['id']; ?>"><?= $server['name']; ?>
												| <?= $server['loc']; ?>
												| <?= $SQLGETSBOTSONSERV->rowCount(); ?>/<?= $server['bot_limit']; ?> Bots
											</option>
										
										<?php } } ?>
											
                                        </select>
									</div>
									
                                </div>
                                <div class="mt-3">

									<?php if($getUserCurrentBots < $getUserBotLimit) { ?>
									<button type="submit" name="createBot" class="btn btn-primary mr-2">Bot erstellen</button>
									<?php } else { ?>
									<button type="submit" name="" disabled class="btn btn-danger mr-2">
										Limit erreicht (<?= $getUserCurrentBots; ?>/<?= $getUserBotLimit; ?>)
									</button>
									<?php } ?>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
				
				
            </div> <!-- Ende Row 1 -->



        </div>
    </div>