<h1>Fehler melden</h1>
<?php
if ($send_success) {
?>
<strong>Ihre Meldung wurde erfolgreich verschickt. Vielen Dank für Ihre Hilfe.</strong>
<?
}
?>
<form method="post">
<p><strong>Name:</strong><br><input type="text" name="name" id="name" style="width:100%;max-width:300px;"></p>
<p><strong>E-Mail:</strong><br><input type="text" name="email" id="name" style="width:100%;max-width:300px;"></p>
<select name="issue" style="max-width: 300px;width:100%;">
<optgroup label="Allgemein">
<option <?php echo (KOM::$active['issueid'] ? "" : "selected=\"selected\""); ?> value="0">Allgemein</option>
</optgroup>
<optgroup label="Themen">
<?php
$issues = KOM::$issuelist;
asort($issues);
foreach ($issues as $key => $val) {
    if ($key == KOM::$active['issueid']) {
        echo "<option selected=\"selected\" value=\"".$key."\">".$val."</option>";
    } else {
        echo "<option value=\"".$key."\">".$val."</option>";
    }
}
?>
</optgroup>
</select>

<p><strong>Meldung:</strong><br><textarea name="meldung" id="meldung" style="width:100%;max-width:600px;height:250px;"></textarea></p>
<p><input type="submit" value="Abschicken" name="report" id="report"></p>
</form>