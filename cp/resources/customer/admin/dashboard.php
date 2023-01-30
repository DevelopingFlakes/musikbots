<?php
$currPage = 'back_Admin Dashboard_admin';
include BASE_PATH.'app/controller/PageController.php';
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>

<?php
if(isset($_POST['startAllBotsNode01'])){


$serverid = "1";
include '_startAll.php';

}

if(isset($_POST['stopAllBotsNode01'])){

$serverid = "1";
include '_stopAll.php';

}

if(isset($_POST['startAllBotsNode02'])){


$serverid = "2";
include '_startAll.php';

}

if(isset($_POST['stopAllBotsNode02'])){

$serverid = "2";
include '_stopAll.php';

}
?>

<div class="content-body">
        <div class="container">
            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6">
                        <div class="page-title-content">
                            <h3>Admin Dashboard</h3>
                            <p class="mb-2">Hier kannst du globale Funktionen durchführen</p>
                        </div>
                    </div>
                </div>
            </div>
			
            <div class="row">

                <div class="col-xxl-9 col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
								
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <form method="POST">
									<button type="submit" name="startAllBotsNode01" class="balance-stats">
                                        <h3><center><i class="fa fa-redo"></i><br> Bots starten</center></h3>
										<center><p style="color:grey;">Gilt für Bots auf Node01</p></center>
									</button>
								</form>
                                </div>

								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <form method="POST">
									<button type="submit" name="stopAllBotsNode01" class="balance-stats">
                                        <h3><center><i class="fa fa-power-off"></i><br> Bots stoppen</center></h3>
										<center><p style="color:grey;">Gilt für Bots auf Node01</p></center>
									</button>
								</form>
                                </div>

								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <form method="POST">
									<button type="submit" name="startAllBotsNode02" class="balance-stats">
                                        <h3><center><i class="fa fa-redo"></i><br> Bots starten</center></h3>
										<center><p style="color:grey;">Gilt für Bots auf Node02</p></center>
									</button>
								</form>
                                </div>

								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <form method="POST">
									<button type="submit" name="stopAllBotsNode02" class="balance-stats">
                                        <h3><center><i class="fa fa-power-off"></i><br> Bots stoppen</center></h3>
										<center><p style="color:grey;">Gilt für Bots auf Node02</p></center>
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
								Hier kannst du globale Funktionen ausführen.
							</p>
						</div>
					</div>
                </div>


            </div>
        </div>
    </div>