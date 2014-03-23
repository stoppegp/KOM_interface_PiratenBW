<div id="breadcrumbs">
<span><a href="<?=KOM::dolink("home");?>">Home</a></span>
<?php if (!isset(KOM::$active['stat'])) {
    echo "<span>Statistik</span>";
} else {
    echo "<span><a href=\"".KOM::dolink("stats", null, true)."\">Statistik</a></span>"; 
    echo "<span>";
    switch (KOM::$active['stat']) {
        case "koalitionsvertrag": echo "Koalitionsvertrag"; break;
        case "gruene": echo "Die Grünen"; break;
        case "spd": echo "SPD"; break;
    }
    echo "</span>";
}
?>
</div>
<nav class="pagenav"><div class="pagenav-table">
    <ul>
        <li><a href="<?=KOM::dolink("stats", null, true);?>" <?php echo (!isset(KOM::$active['stat'])) ? "class=\"active\"" : ""; ?>>Manuell</a></li>
        <li><a href="<?=KOM::dolink("stats", array("stat" => "koalitionsvertrag"), true);?>" <?php echo (KOM::$active['stat']=="koalitionsvertrag") ? "class=\"active\"" : ""; ?>>Koalitionsvertrag</a></li>
        <li><a href="<?=KOM::dolink("stats", array("stat" => "gruene"), true);?>" <?php echo (KOM::$active['stat']=="gruene") ? "class=\"active\"" : ""; ?>>Die Grünen</a></li>
        <li><a href="<?=KOM::dolink("stats", array("stat" => "spd"), true);?>" <?php echo (KOM::$active['stat']=="spd") ? "class=\"active\"" : ""; ?>>SPD</a></li>
    </ul></div>
</nav>

<?php
if (!isset(KOM::$active['stat'])) { ?>
<div style="overflow:auto;"><?php $hideOpp=true; include("filter.php"); ?></div>
<?php
} ?>
<ul>
<li><?=$ausw->getNumberOfPledges(false);?> Versprechen</li>
<li><?=count($database->getIssues());?> Themen</li>
</ul>
<div style="margin-top:20px;"id="ausw_verteilung"></div>
<div id="ausw_verlauf"></div>