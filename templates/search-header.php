<div id="breadcrumbs">
<span><a href="<?=KOM::dolink("home");?>">Home</a></span>
<span>Suche</span>
</div>
<h1>Ergebnisse für die Suche nach <span class="found"><em><?=KOM::$active['searchstring'];?></em></span></h1>
<nav class="pagenav"><div class="pagenav-table">
    <ul>
        <li><a href="<?php echo KOM::dolink("search", array("searchtype" => "")); ?>" <?php echo (KOM::$active['searchtype']=="") ? 'class="active"' : '' ?>>Übersicht</a></li>
        <li><a href="<?php echo KOM::dolink("search", array("searchtype" => "issues")); ?>" <?php echo (KOM::$active['searchtype']=="issues") ? 'class="active"' : '' ?>>Themen (<?php echo (is_array($ergI)) ? count($ergI) : '0'; ?>)</a></li>
        <li><a href="<?php echo KOM::dolink("search", array("searchtype" => "pledges")); ?>" <?php echo (KOM::$active['searchtype']=="pledges") ? 'class="active"' : '' ?>>Versprechen (<?php echo (is_array($ergP)) ? count($ergP) : '0'; ?>)</a></li>
        <li><a href="<?php echo KOM::dolink("search", array("searchtype" => "states")); ?>" <?php echo (KOM::$active['searchtype']=="states") ? 'class="active"' : '' ?>>Ereignisse (<?php echo (is_array($ergS)) ? count($ergS) : '0'; ?>)</a></li>
    </ul></div>
</nav>