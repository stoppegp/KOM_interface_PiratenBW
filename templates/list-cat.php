<div id="breadcrumbs">
<span><a href="<?=KOM::dolink("home");?>">Home</a></span>
<span><a href="<?=KOM::dolink("categories", null, true);?>">Wahlversprechen</a></span>
<span><a href="<?=KOM::dolink("categories", null, true);?>">Kategorien</a></span>
<span><?=$catname;?></span>
</div>

<nav class="pagenav"><div class="pagenav-table">
    <ul>
        <li><a href="<?=KOM::dolink("categories", null, true);?>" class="active">Kategorien</a></li>
        <li><a href="<?=KOM::dolink("list", null, true);?>">Alle Versprechen</a></li>
        <li><a href="<?=KOM::dolink("gehalten", null, true);?>">Gehaltene Versprechen</a></li>
        <li><a href="<?=KOM::dolink("gebrochen", null, true);?>">Gebrochene Versprechen</a></li>
    </ul></div>
</nav>
<h1>Kategorie: <?=$catname;?></h1>

<?php include(dirname(__FILE__).'/list-list.php'); ?>