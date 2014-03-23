<?php

$database = new Database(KOM::$dblink);

KOM::registerStyle('interface/css/list.css', true);

if (isset(KOM::$active['cat']) && is_numeric(KOM::$active['cat'])) {
    $database->setFilter("categories", KOM::$active['cat']);
}
if (isset(KOM::$active['pstg']) && is_numeric(KOM::$active['pstg'])) {
    $database->setFilter("pledgestatetypegroup", KOM::$active['pstg']);
}

$database->loadContent();

if (isset(KOM::$active['cat']) && KOM::$mainDB->getCategory(KOM::$active['cat'])) {
    $catname = KOM::$mainDB->getCategory(KOM::$active['cat'])->getName();
    include('templates/list-cat.php');
} else {
    include('templates/list-all.php');
}



?>