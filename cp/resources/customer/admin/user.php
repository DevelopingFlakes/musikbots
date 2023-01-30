<?php
$siteid = $helper->protect($_GET['key']);
$currPage = 'team_Benutzerverwaltung_admin';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php
$SQLGETSEARCHEDUSER = $db->prepare("SELECT * FROM `users` WHERE `id` = :siteid");
$SQLGETSEARCHEDUSER->execute(array(":siteid" => $siteid));
if ($SQLGETSEARCHEDUSER->rowCount() != 0) {
while ($getuser = $SQLGETSEARCHEDUSER -> fetch(PDO::FETCH_ASSOC)){ 

?>


<?php
if(isset($_POST['saveSettings'])){
	 $msg = "settings_saved";
	 $error = false;

    $SQL = $db->prepare("UPDATE `users` SET 
	`username` = :username,
	`email` = :email,
	`bot_limit` = :bot_limit,
	`role` = :role
	WHERE `id` = :siteid
	");
	
    $SQL->execute(array(
		":username" => $_POST['username'],
		":email" => $_POST['email'],
		":bot_limit" => $_POST['bot_limit'],
		":role" => $_POST['role'],
		":siteid" => $siteid
	));
		

	 include BASE_PATH.'notify/temp.php';


}

if(isset($_POST['userBan'])){

    $SQL = $db->prepare("UPDATE `users` SET `state` = 'banned'
	WHERE `id` = :userid
	");
	
    $SQL->execute(array(
		":userid" => $siteid
	));
								 
}

if(isset($_POST['userUnban'])){

    $SQL = $db->prepare("UPDATE `users` SET `state` = 'active'
	WHERE `id` = :userid
	");
	
    $SQL->execute(array(
		":userid" => $siteid
	));
								 
}
?>

<?php } } ?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>

							

<div class="content-body">
        <div class="container active">


<?php
$SQLGETUSERINFO = $db->prepare("SELECT * FROM `users` WHERE `id` = :siteid");
$SQLGETUSERINFO->execute(array(":siteid" => $siteid));
if ($SQLGETUSERINFO->rowCount() != 0) {
while ($userinfo = $SQLGETUSERINFO -> fetch(PDO::FETCH_ASSOC)){ ?>
            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6">
                        <div class="page-title-content">
                            <h3>Benutzer (<?= $userinfo['username']; ?> #<?= $userinfo['id']; ?>)</h3>
                            <p class="mb-2">Hier kannst du einen Nutzer verwalten und dessen Konto anpassen</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">


			 <?php if($SQLGETUSERINFO->rowCount() !== 0){ ?>
                <div class="col-xxl-3 col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
								
                <?php
                $SQLGETUSERBOTS = $db->prepare("SELECT * FROM `bots` WHERE `owner_id` = :siteid");
                $SQLGETUSERBOTS->execute(array(":siteid" => $siteid));
                if ($SQLGETUSERBOTS->rowCount() != 0) {
                while ($bot = $SQLGETUSERBOTS -> fetch(PDO::FETCH_ASSOC)){ ?>
								
								<div class="col-xl-12 col-lg-3 col-md-3 col-sm-3">
									<a href="../ts3musikbot/view/<?= $bot['id']; ?>">
                                    <div class="balance-stats">
                                        <p><?= $bot['name']; ?> (<?= $bot['id']; ?>)</p>
                                    </div>
									</a>
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
										<label class="form-label">Benutername</label>
										<input 
											   name="username" 
											   type="text" class="form-control" 
											   value="<?= $userinfo['username']; ?>" 
											   required>
									</div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">E-Mail</label>
										<input 
											   name="email" 
											   type="text" 
											   class="form-control" 
											   value="<?= $userinfo['email']; ?>" 
											   required>
									</div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Bot-Limit</label>
										<input 
											   name="bot_limit" 
											   type="number"
											   min="3"
											   max="10000"
											   class="form-control" 
											   value="<?= $userinfo['bot_limit']; ?>" 
											   required>
									</div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Rolle (admin/customer)</label>
										<input 
											   name="role" 
											   type="text"
											   class="form-control" 
											   value="<?= $userinfo['role']; ?>" 
											   required>
									</div>

									
                                </div>
                                <div class="mt-3">

									<button type="submit" name="saveSettings" class="btn btn-primary mr-2">Einstellungen Speichern</button>

									<?php if($userinfo['state'] == 'active') { ?>
									<button type="submit" name="userBan" class="btn btn-danger mr-2"><i class="fa fa-lock"></i></button>
									<?php } ?>

									<?php if($userinfo['state'] == 'banned') { ?>
									<button type="submit" name="userUnban" class="btn btn-success mr-2"><i class="fa fa-lock-open"></i>
									</button>
									<?php } ?>

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
										<label class="form-label">IPv4</label>
										<input type="text" class="form-control" value="<?= $userinfo['user_addr']; ?>" disabled>
									</div>

                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Session-Token</label>
										<input type="text" class="form-control" value="<?= $userinfo['session_token']; ?>" disabled>
									</div>

                                    <div class="col-xxl-12 col-xl-6 col-lg-6 mb-3">
										<label class="form-label">Kontoerstellung</label>
										<input type="text" class="form-control" value="<?= $userinfo['created_at']; ?>" disabled>
									</div>
									
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
				
				<?php } ?>
				
				
            </div> <!-- Ende Row 1 -->



			</div>
			
			<?php } } ?>


			 <?php if($SQLGETSEARCHEDUSER->rowCount() == 0){ ?>

                <div class="col-xxl-12 col-xl-12 col-lg-12">
					<div class="card border-warning bg-info bg-opacity-25 mb-3">
						<div class="card-body">
							<p class="card-text text-white text-opacity-75">
								<b>Es ist ein Fehler aufgetreten</b>
								<br>
								Es gibt keinen Nutzer mit dieser ID (<?= $siteid; ?>). Bitte versuche es erneut
							</p>
						</div>
					</div>
                </div>

               <?php } ?>


        </div>
    </div>
