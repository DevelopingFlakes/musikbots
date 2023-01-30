<?php
$siteid = $helper->protect($_GET['key']);
$currPage = 'back_Deine Ticket'.$siteid;
include BASE_PATH.'app/controller/PageController.php';

$userrole = "customer";
?>

<?php include BASE_PATH.'resources/customer/_sidebar.php' ?>


<?php
$SQLGETTICKETS = $db->prepare("SELECT * FROM `tickets` WHERE `id` = :siteid AND `owner_id` = :userid");
$SQLGETTICKETS->execute(array(":siteid" => $siteid, ":userid" => $userid));
if ($SQLGETTICKETS->rowCount() != 0) {
while ($ticket = $SQLGETTICKETS -> fetch(PDO::FETCH_ASSOC)){ ?>

<?php include '_ticketTemp.php'; ?>


<?php } } ?>