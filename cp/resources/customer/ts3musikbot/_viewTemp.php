<?php

$SQLGETSERV = $db->prepare("SELECT * FROM `servers`");
$SQLGETSERV->execute(array());
if ($SQLGETSERV->rowCount() != 0) {
while ($mainserv = $SQLGETSERV -> fetch(PDO::FETCH_ASSOC)){ 

$serverid = $mainserv['id'];

if($bot['server_id'] == $serverid){


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

$instance = $sinusbot->getInstanceByUUID($bot['ext_id']);

?>


<?php
if(isset($_POST['saveSettings'])){
	 $msg = "settings_saved";
	 $error = false;
	
$num = $_POST['default_server_port'];
$int = (int)$num;
$server_port = (float)$num;

	$instance->setVolume($_POST['bot_volumen']);

	$daten["nick"] = $_POST['bot_name'];
	$daten["serverHost"] = $_POST['default_server'];
	$daten["serverPassword"] = $_POST['default_server_pass'];
	$daten["channelName"] = $_POST['default_server_channel'];
	$daten["serverPort"] = $server_port;
	$daten["channelPassword"] = $_POST['default_channel_password'];
	
	if($_POST['channel_commander'] == "0"){
	$daten["channelCommander"] = false;
	}

	if($_POST['channel_commander'] == "1"){
	$daten["channelCommander"] = true;
	}
	
	$daten["ignoreChatServer"] = true;
	$daten["ignoreChatPrivate"] = true;
	$daten["ignoreChatChannel"] = true;

	if($_POST['desc_update'] == "0"){
	$daten["updateDescription"] = false;
	}

	if($_POST['desc_update'] == "1"){
	$daten["updateDescription"] = true;
	}

	$instance->setSettings($daten, $bot['ext_id']);

	if($error == false) {
    $SQL = $db->prepare("UPDATE `bots` SET 
	`name` = :bot_name,
	`default_server` = :default_server,
	`default_server_pass` = :default_server_pass,
	`default_server_channel` = :default_server_channel
	WHERE `id` = :siteid
	");
	
    $SQL->execute(array(
		":bot_name" => $_POST['bot_name'],
		":default_server" => $_POST['default_server'],
		":default_server_pass" => $_POST['default_server_pass'],
		":default_server_channel" => $_POST['default_server_channel'],
		":siteid" => $siteid
	));
		
	}// IF error = false

	 include BASE_PATH.'notify/temp.php';
     //header('Location: '.env('URL').'ts3musikbot/view/'.$siteid);


}

if(isset($_POST['startBot'])){
	 $msg = "bot_started";
	 $error = false;
	
	 $instance->spawn();
	
	$logoUrl = env("BOT_AVATAR");
    $instance->uploadAvatar($logoUrl);

	 include BASE_PATH.'notify/temp.php';
     //header('Location: '.env('URL').'ts3musikbot/view/'.$siteid);


}

if(isset($_POST['restartBot'])){
	 $msg = "bot_started";
	 $error = false;
	
	 $instance->kill();

	 include BASE_PATH.'notify/temp.php';
     //header('Location: '.env('URL').'ts3musikbot/view/'.$siteid);


}

if(isset($_POST['stopBot'])){
	 $msg = "bot_stopped";
	 $error = false;

	 $instance->kill();

	 include BASE_PATH.'notify/temp.php';
     //header('Location: '.env('URL').'ts3musikbot/view/'.$siteid);


}

if(isset($_POST['musicUnpause'])){
	 $msg = "music_unpause";
	 $error = false;


	$instance->playURL($bot['music_last']);

	 include BASE_PATH.'notify/temp.php';
     //header('Location: '.env('URL').'ts3musikbot/view/'.$siteid);


}

if(isset($_POST['musicPause'])){
	 $msg = "music_pause";
	 $error = false;

	 $instance->stop();

	 include BASE_PATH.'notify/temp.php';
     //header('Location: '.env('URL').'ts3musikbot/view/'.$siteid);


}

if(isset($_POST['playSong'])){
	$msg = "bot_musikplay";
	$error = false;
	
	$instance->playURL($_POST['play_stream_url']);
	
	//sleep(8);

    /*$SQL = $db->prepare("UPDATE `bots` SET 
	`music_last` = :music_last
	WHERE `id` = :siteid
	");
	
    $SQL->execute(array(
		":music_last" => $_POST['play_stream_url'],
		":siteid" => $siteid
	));*/

	 include BASE_PATH.'notify/temp.php';
     //header('Location: '.env('URL').'ts3musikbot/view/'.$siteid);


}

if(isset($_POST['deleteBot'])){
	$msg = "bot_deleted";
	$error = false;
	
    $SQL = $db->prepare("DELETE FROM `bots` WHERE `id` = :siteid ");
    $SQL->execute(array(":siteid" => $siteid));
    header('Location: '.env('URL').'ts3musikbot/list');
	$instance->delete();


}
?>



<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>

							

<div class="content-body">
        <div class="container active">


            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6">
                        <div class="page-title-content">
                            <h3>TS3MusikBot (<?= $bot['name']; ?> #<?= $bot['id']; ?>)</h3>
                            <p class="mb-2">Hier kannst du deinen TS3MusikBot verwalten und einstellen</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">


			 <?php if($SQLMAINGETBOT->rowCount() !== 0){ ?>
                <div class="col-xxl-3 col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
								
                <?php
                $SQLGETSERVER = $db->prepare("SELECT * FROM `servers` WHERE `id` = :serverid");
                $SQLGETSERVER->execute(array(":serverid" => $bot['server_id']));
                if ($SQLGETSERVER->rowCount() != 0) {
                while ($server = $SQLGETSERVER -> fetch(PDO::FETCH_ASSOC)){ ?>
								
								<div class="col-xl-12 col-lg-3 col-md-3 col-sm-3">
                                    <div class="balance-stats">
                                        <p><img src="<?= $server['logo']; ?>" width="15"> <?= $server['name']; ?></p>
                                    </div>
                                </div>
					<?php } }?>
								
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xxl-5">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
									
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Benutzerdefinierter Name <a style="color:red;">*</a></label>
										<input 
											   name="bot_name" 
											   type="text" class="form-control" 
											   value="<?= $bot['name']; ?>" 
											   required>
									</div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Standart Server <a style="color:red;">*</a></label>
										<input 
											   name="default_server" 
											   type="text" 
											   class="form-control" 
											   value="<?= $bot['default_server']; ?>" 
											   required>
									</div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Standart Server Port <a style="color:red;">*</a></label>
										<input 
											   name="default_server_port" 
											   type="text" 
											   class="form-control" 
											   value="<?= $instance->getServerPort(); ?>" 
											   required>
									</div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Standart Server Passwort</label>
										<input 
											   name="default_server_pass" 
											   type="text" 
											   class="form-control" 
											   value="<?= $bot['default_server_pass']; ?>" 
											   >
									</div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Bot-Sicherheitslevel</label>
										<input 
											   name="default_server_port" 
											   type="text" 
											   class="form-control" 
											   disabled
											   value="<?= $instance->getSettings()['identityLevel'] ?>" 
											   required>
									</div>

                                    <!--<div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Bot-Status</label>
										<input 
											   name="default_server_port" 
											   type="text" 
											   class="form-control" 
											   disabled
											   value="<?= $instance->getLog()['entries']['message']; ?>" 
											   required>
									</div>-->
									
									<hr>
									
									                                    
									<div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Standart Server Channel</label>
										<select name="default_server_channel" class="form-control">
											
											<?php $channel = $instance->getChannels(); ?>

											<?php if($bot['default_server_channel'] == NULL) { ?>
                                            <option value="">
												Keiner
											</option>
											<?php } ?>
											
											<?php for ($i = 0; $i < count($channel); $i++) { // Liste ausgeben { ?>
											<?php if($channel[$i]['id'] == $bot['default_server_channel']) { ?>
                                            <option value="<?= $channel[$i]['id']; ?>">
												<?= $channel[$i]['name']; ?>
											</option>
											<?php } ?>
											<?php } ?>

											<?php for ($i = 0; $i < count($channel); $i++) { // Liste ausgeben { ?>
                                            <option value="<?= $channel[$i]['id']; ?>">
												<?= $channel[$i]['name']; ?>
											</option>
											<?php } ?>

											<?php if($bot['default_server_channel'] ==! NULL) { ?>
                                            <option value="">
												Keiner
											</option>
											<?php } ?>
											
                                        </select>
									</div>

									<div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Derzeit verbunden in</label>
										<select name="" class="form-control">
											
											<?php $channel = $instance->getChannels(); ?>

											<?php if($instance->getStatus()['connStatus']['channelId'] == NULL) { ?>
                                            <option value="">
												Keiner
											</option>
											<?php } ?>
											
											<?php for ($i = 0; $i < count($channel); $i++) { // Liste ausgeben { ?>
											<?php if($channel[$i]['id'] == $instance->getStatus()['connStatus']['channelId']) { ?>
                                            <option value="<?= $channel[$i]['id']; ?>">
												<?= $channel[$i]['name']; ?>
											</option>
											<?php } ?>
											<?php } ?>
											
                                        </select>
									</div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Standart Channel Passwort</label>
										<input 
											   name="default_channel_password" 
											   type="text" 
											   class="form-control" 
											   value="<?= $instance->getSettings()['channelPassword']; ?>" 
											   >
									</div>
									
									<hr>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Lautstärke <a style="color:red;">*</a></label>
										<input 
											   name="bot_volumen" 
											   type="number"
											   min="1"
											   max="100"
											   class="form-control" 
											   value="<?= $instance->getVolume(); ?>" 
											   required>
									</div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Channel-Commander <a style="color:red;">*</a></label>
										<select name="channel_commander" class="form-control">
											
                                            <option value="0" <?php if($instance->getSettings()['channelCommander'] == NULL) {?> selected <?php } ?>>
												Inaktiv
											</option>

                                            <option value="1" <?php if($instance->getSettings()['channelCommander'] == true) {?> selected <?php } ?>>
												Aktiv
											</option>
											
                                        </select>
									</div>

                                    <!--<div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Songs in Bot Beschreibung</label>
										<select name="desc_update" class="form-control">
											
                                            <option value="0" <?php if($instance->getSettings()['updateDescription'] == NULL) {?> selected <?php } ?>>
												Inaktiv
											</option>

                                            <option value="1" <?php if($instance->getSettings()['updateDescription'] == true) {?> selected <?php } ?>>
												Aktiv
											</option>
											
                                        </select>
									</div>-->

                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Zuletzt gespielt:</label>
										<input 
											   type="text" 
											   class="form-control" 
											   value="<?= $instance->getStatus()['currentTrack']['tempTitle']; ?> von <?= $instance->getStatus()['currentTrack']['tempArtist']; ?>"
											   disabled>
										<small>Quelle: <?= $instance->getStatus()['currentTrack']['filename']; ?></small>
									</div>
									
                                </div>
                                <div class="mt-3">

									<button type="submit" name="saveSettings" class="btn btn-primary mr-2">Einstellungen Speichern</button>

									<button type="submit" name="musicUnpause" class="btn btn-success mr-2"><i class="fa fa-redo"></i></button>
									<button type="submit" name="musicPause" class="btn btn-danger mr-2"><i class="fa fa-pause"></i></button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
									
                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Bot-Status</label>
										
									<?php if($instance->getStatus()['running'] == '1') { ?>
									<?php $botstatus = "Der Bot ist Online"; ?>
									<?php } ?>

									<?php if($instance->getStatus()['running'] == '0') { ?>
									<?php $botstatus = "Der Bot ist Offline"; ?>
									<?php } ?>
										
										<input type="text" class="form-control" value="<?= $botstatus; ?>" disabled>
									</div>

                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Paketverlust</label>
										<input type="text" class="form-control" value="<?= $instance->getStatus()['connStatus']['packetLoss']; ?>% P/s" disabled>
									</div>

                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Verbindung</label>
										<input type="text" class="form-control" value="<?= $instance->getStatus()['connStatus']['bytesRecv']; ?> b/in | <?= $instance->getStatus()['connStatus']['bytesSent']; ?> b/out" disabled>
									</div>

                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Bot-ID</label>
										<input type="text" class="form-control" value="<?= $siteid; ?> (<?= $instance->getStatus()['v']; ?>)" disabled>
									</div>

                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">API-ID</label>
										<input type="text" class="form-control" value="<?= $bot['ext_id']; ?>" disabled>
									</div>
									
                                </div>
                                <div class="mt-3">
								
								
									<?php if($botstatus == 'Der Bot ist Offline') { ?>
									<button type="submit" name="startBot" class="btn btn-success mr-2">Bot starten</button>
									<?php } ?>

									<?php if($botstatus == 'Der Bot ist Online') { ?>
									<button type="submit" name="stopBot" class="btn btn-danger mr-2">Bot stoppen</button>
									<?php } ?>

									<a href="" name="" class="btn btn-primary mr-2"><i class="fa fa-redo"></i></a>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
				
				<?php } ?>
				
				<?php //print_r($instance->getSettings()); ?>
				
				
            </div> <!-- Ende Row 1 -->


            <div class="row">
				
                <div class="col-xxl-3">
				</div>

                <div class="col-xxl-5">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
									
                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Stream-URL (zu einem Stream)</label>
										<input 
											   name="play_stream_url" 
											   type="text" class="form-control" 
											   value="" 
											   required>
										
										<?php if($bot['music_last'] ==! NULL) { ?>
										<!--<small>Zuletzt abgespielt: <?= $bot['music_last']; ?></small>-->
										<?php } ?>
									</div>
									
                                </div>
                                <div class="mt-3">

									<button type="submit" name="playSong" class="btn btn-primary mr-2">Song abspielen</button>

								</div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
									
                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Bot unwiederruflich löschen</label>
										<br>
										<small>Vorsicht: Diese Aktion kann von niemanden rückgängig gemacht werden!</small>
									</div>
									
                                </div>
                                <div class="mt-3">

									<button type="submit" name="deleteBot" class="btn btn-danger mr-2"><i class="fa fa-trash"></i></button>

								</div>
                            </form>
                        </div>
                    </div>
				</div>

								<div class="col-xxl-3">
				</div>

                <div class="col-xxl-4">
                    <div class="card">
						<h4>Quick-Play Partner</h4>
						

               
				<?php
                $SQLGETQUICKPLAYSENDER = $db->prepare("SELECT * FROM `quick_play_sender` WHERE `role` = 'partner' order by `sort` DESC");
                $SQLGETQUICKPLAYSENDER->execute();
                if ($SQLGETQUICKPLAYSENDER->rowCount() != 0) {
                while ($sender = $SQLGETQUICKPLAYSENDER -> fetch(PDO::FETCH_ASSOC)){ ?>
						<div class="card-body">
                            <div class="table-responsive table-icon">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Station</th>
                                            <th>Name</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<form method="POST">

				<?php
                $SQLGETQUICKPLAY = $db->prepare("SELECT * FROM `quick_play` WHERE `sender` = :sender order by `sort` DESC");
                $SQLGETQUICKPLAY->execute(array("sender" => $sender['name']));
                if ($SQLGETQUICKPLAY->rowCount() != 0) {
                while ($qucikplay = $SQLGETQUICKPLAY -> fetch(PDO::FETCH_ASSOC)){ ?>
                                        <tr>
                                            <td><?= $qucikplay['sender']; ?></td>
                                            <td><?= $qucikplay['name']; ?></td>
											<input name="play_stream_url" hidden value="<?= $qucikplay['stream_url']; ?>">
                                            <td>
										<button type="submit" name="playSong" class="btn btn-success mr-2"><i class="fa fa-play"></i></button>
											</td>
                                        </tr>
						<?php } } ?>
										</form>

                                    </tbody>
                                </table>
                            </div>
                        </div>
						<br><br>
						<?php } } ?>
						
							

                        </div>
                    </div>

                <div class="col-xxl-4">
                    <div class="card">
						<h4>Quick-Play</h4>
						

               
				<?php
                $SQLGETQUICKPLAYSENDER = $db->prepare("SELECT * FROM `quick_play_sender` WHERE `role` = 'quickplay' order by `sort` DESC");
                $SQLGETQUICKPLAYSENDER->execute();
                if ($SQLGETQUICKPLAYSENDER->rowCount() != 0) {
                while ($sender = $SQLGETQUICKPLAYSENDER -> fetch(PDO::FETCH_ASSOC)){ ?>
						<div class="card-body">
                            <div class="table-responsive table-icon">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Station</th>
                                            <th>Name</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<form method="POST">

				<?php
                $SQLGETQUICKPLAY = $db->prepare("SELECT * FROM `quick_play` WHERE `sender` = :sender order by `sort` DESC");
                $SQLGETQUICKPLAY->execute(array("sender" => $sender['name']));
                if ($SQLGETQUICKPLAY->rowCount() != 0) {
                while ($qucikplay = $SQLGETQUICKPLAY -> fetch(PDO::FETCH_ASSOC)){ ?>
                                        <tr>
                                            <td><?= $qucikplay['sender']; ?></td>
                                            <td><?= $qucikplay['name']; ?></td>
											<input name="play_stream_url" hidden value="<?= $qucikplay['stream_url']; ?>">
                                            <td>
										<button type="submit" name="playSong" class="btn btn-success mr-2"><i class="fa fa-play"></i></button>
											</td>
                                        </tr>
						<?php } } ?>
										</form>

                                    </tbody>
                                </table>
                            </div>
                        </div>
						<br><br>
						<?php } } ?>
						
							

                        </div>
                    </div>


                </div>


			</div>
			


        </div>
    </div>