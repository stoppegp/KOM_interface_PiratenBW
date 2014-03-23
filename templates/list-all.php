<div id="breadcrumbs">
<span><a href="<?=KOM::dolink("home");?>">Home</a></span>
<span><a href="<?=KOM::dolink("categories", null, true);?>">Wahlversprechen</a></span>
<span>Alle Versprechen</span>
</div>

<nav class="pagenav"><div class="pagenav-table">
    <ul>
        <li><a href="<?=KOM::dolink("categories", null, true);?>">Kategorien</a></li>
        <li><a href="<?=KOM::dolink("list", null, true);?>" class="active">Alle Versprechen</a></li>
        <li><a href="<?=KOM::dolink("gehalten", null, true);?>">Gehaltene Versprechen</a></li>
        <li><a href="<?=KOM::dolink("gebrochen", null, true);?>">Gebrochene Versprechen</a></li>
    </ul></div>
</nav>
<?php
$pledges = 0;
foreach ($database->getIssues("name") as $val) {
    $pledges += count($val->getPledges());
}
?>
<div>
Wir beobachten <?=$pledges;?> Versprechen bei <?php echo count($database->getIssues("name")); ?> Themen. 
<input type="checkbox" <?php echo (is_array(KOM::$active['cat']) || is_array(KOM::$active['party']) || is_array(KOM::$active['pst'])) ? "checked=\"checked\"" : ""; ?> class="switch" id="switch_filter"><label for="switch_filter" id="switch_filter_label" class="switch-label">Filter <?php echo (is_array(KOM::$active['cat']) || is_array(KOM::$active['party']) || is_array(KOM::$active['pst'])) ? "aktiv" : ""; ?></label>
<div id="filterswitch" class="switch-action">
<form method="post" action="<?=KOM::doLink("list", null, array("cat", "pst", "party"));?>">
<div id="filtercontainer">
<div id="filter">
<div class="filter_row">
<div id="filter_cat">
<h2>Kategorien</h2>
<?php
foreach (KOM::$mainDB->getCategories("name") as $cat) {
    if ($cat->getDisabled()) continue;
    ?>
    <input <?php echo (!is_array(KOM::$active['cat']) || in_array($cat->getID(), KOM::$active['cat'])) ? "checked=\"checked\"" : "" ?> type="checkbox" name="cat[<?=$cat->getID();?>] value="1" id="cat_<?=$cat->getID();?>"> <label for="cat_<?=$cat->getID();?>"><?=$cat->getName();?></label><br>
    <?php
}
?>
</div>
<div id="filter_status">
<h2>Status</h2>
<h3>Forderung</h3>
<?php
foreach (KOM::$mainDB->getPledgeStateTypes() as $pst) {
    if ($pst->getType() == 1) continue;
    ?>
    <input <?php echo (!is_array(KOM::$active['pst']) || in_array($pst->getID(), KOM::$active['pst'])) ? "checked=\"checked\"" : "" ?> type="checkbox" name="pst[<?=$pst->getID();?>] value="1" id="pst_<?=$pst->getID();?>"> <label for="pst_<?=$pst->getID();?>"><?=$pst->getName();?></label><br>
    <?php
}
?>
<h3>Zustand</h3>
<?php
foreach (KOM::$mainDB->getPledgeStateTypes() as $pst) {
    if ($pst->getType() == 0) continue;
    ?>
    <input <?php echo (!is_array(KOM::$active['pst']) || in_array($pst->getID(), KOM::$active['pst'])) ? "checked=\"checked\"" : "" ?> type="checkbox" name="pst[<?=$pst->getID();?>] value="1" id="pst_<?=$pst->getID();?>"> <label for="pst_<?=$pst->getID();?>"><?=$pst->getName();?></label><br>
    <?php
}
?>
</div>
<div id="filter_party">
<h2>Parteien</h2>
<?php
foreach (KOM::$mainDB->getParties("name") as $party) {
    if (!$party->getDoValue()) continue;
    ?>
    <input <?php echo (!is_array(KOM::$active['party']) || in_array($party->getID(), KOM::$active['party'])) ? "checked=\"checked\"" : "" ?> type="checkbox" name="party[<?=$party->getID();?>] value="1" id="party_<?=$party->getID();?>"> <label for="party_<?=$party->getID();?>"><?=$party->getName();?></label><br>
    <?php
}
?>
</div>
</div>
</div>
</div>
<div id="filter_submit"><button name="resetfilter" type="submit" value="resetfitler">Löschen</button><input type="submit" value="Anwenden"></div>
</form>
</div>
</div>


<?php include('list-list.php'); ?>