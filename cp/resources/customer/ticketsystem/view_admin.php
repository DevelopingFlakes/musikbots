<?php
$siteid = $helper->protect($_GET['key']);
$currPage = 'team_Ticket'.$siteid.'_admin';
include BASE_PATH.'app/controller/PageController.php';

$userrole = "team";
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>


<?php
$SQLGETTICKETS = $db->prepare("SELECT * FROM `tickets` WHERE `id` = :siteid");
$SQLGETTICKETS->execute(array(":siteid" => $siteid));
if ($SQLGETTICKETS->rowCount() != 0) {
while ($ticket = $SQLGETTICKETS -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php include '_ticketTemp.php'; ?>


<?php } } ?>