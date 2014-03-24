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
<?php include(dirname(__FILE__).'./filter.php'); ?>
<p>
<?=$pledges;?> Versprechen in <?php echo count($database->getIssues("name")); ?> Themen gefunden. 
</p>

<?php include(dirname(__FILE__).'./list-list.php'); ?>