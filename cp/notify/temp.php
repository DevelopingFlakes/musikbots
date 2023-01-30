<?php if($msg == "settings_saved") { ?>
<script>
swal({
  title: "Erfolgreich gespeichert",
  text: "Deine Einstellungen wurden erfolgreich übernommen",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "bot_started") { ?>
<script>
swal({
  title: "Erfolgreich gestartet",
  text: "Der Bot wird nun gestartet, dieser Vorgang kann wenige Sekunden in Anspruch nehmen",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "bot_stopped") { ?>
<script>
swal({
  title: "💤",
  text: "Der Bot wird nun gestoppt, dieser Vorgang kann wenige Sekunden in Anspruch nehmen",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "bot_musikplay") { ?>
<script>
swal({
  title: "🎶",
  text: "Der Bot spielt die gewünschte Musik in wenigen Sekunden ab, let the Party begin!",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "bot_created") { ?>
<script>
swal({
  title: "Bot erstellt",
  text: "Der Bot konnte erfolgreich erstellt werden!",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "music_pause") { ?>
<script>
swal({
  title: "🔇",
  text: "Die Musik ist nun pausiert!",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "music_unpause") { ?>
<script>
swal({
  title: "🎶",
  text: "Die Musik ist nicht länger pausiert",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "server_voll") { ?>
<script>
swal({
  title: "ERROR",
  text: "Dieser Server ist voll! Wähle einen anderen",
  icon: "error"
});
</script>
<?php } ?>

<?php if($msg == "api_error") { ?>
<script>
swal({
  title: "ERROR",
  text: "Leider kam es zu einem API Fehler",
  icon: "error"
});
</script>
<?php } ?>

<?php if($msg == "channel_commander_on") { ?>
<script>
swal({
  title: "Aktiv",
  text: "Der Channel Commander ist nun aktiv",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "channel_commander_off") { ?>
<script>
swal({
  title: "Inaktiv",
  text: "Der Channel Commander ist nun inaktiv",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "all_bots_stopped") { ?>
<script>
swal({
  title: "Gestoppt",
  text: "Alle Bots werden gestoppt",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "ticket_created") { ?>
<script>
swal({
  title: "Erstellt",
  text: "Das Ticket wurde erstellt!",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "to_much_tickets_open") { ?>
<script>
swal({
  title: "ERROR",
  text: "Du hast bereits ein Ticket geöffnet",
  icon: "error"
});
</script>
<?php } ?>

<?php if($msg == "ticket_message_send") { ?>
<script>
swal({
  title: "Gesendet",
  text: "Deine Nachricht wurde abgesendet",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "ticket_closed") { ?>
<script>
swal({
  title: "Geschlossen!",
  text: "Das Ticket wurde geschlossen",
  icon: "success"
});
</script>
<?php } ?>

<?php if($msg == "bot_deleted") { ?>
<script>
swal({
  title: "Gelöscht!",
  text: "Der Bot wurde unwiederruflich gelöscht",
  icon: "success"
});
</script>
<?php } ?>