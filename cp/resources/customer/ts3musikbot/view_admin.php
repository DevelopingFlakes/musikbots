<?php
$siteid = $helper->protect($_GET['key']);
$currPage = 'team_TS3MusikBot #'.$siteid.'_admin';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php
$SQLMAINGETBOT = $db->prepare("SELECT * FROM `bots` WHERE `id` = :siteid");
$SQLMAINGETBOT->execute(array(":siteid" => $siteid));
if ($SQLMAINGETBOT->rowCount() != 0) {
while ($bot = $SQLMAINGETBOT -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php include '_viewTemp.php'; ?>

<?php } } ?>



			 <?php if($SQLMAINGETBOT->rowCount() == 0){ ?>
<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>

<div class="row">
                <div class="col-xxl-2 col-xl-2 col-lg-2">
</div>

                <div class="col-xxl-8 col-xl-8 col-lg-8">
					<div class="card border-warning bg-info bg-opacity-25 mb-3">
						<div class="card-body">
							<p class="card-text text-white text-opacity-75">
								<b>Es ist ein Fehler aufgetreten</b>
								<br>
								Dieser Bot konnte nicht deinem Kundenkonto zugeordnet werden. Wende dich bitte an den Support.
							</p>
						</div>
					</div>
                </div>
</div>

               <?php } ?>