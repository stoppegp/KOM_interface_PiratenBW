<?php

$database = new Database(KOM::$dblink);

KOM::registerStyle('interface/css/list.css', true);
KOM::registerStyle('interface/css/filter.css', true);

if (is_array($_REQUEST['cat'])) {
    KOM::$active['cat'] = array_keys($_REQUEST['cat']);
}
if (is_array($_REQUEST['party'])) {
    KOM::$active['party'] = array_keys($_REQUEST['party']);
}
if (is_array($_REQUEST['pst'])) {
    KOM::$active['pst'] = array_keys($_REQUEST['pst']);
}

if (isset($_REQUEST['resetfilter'])) {
    unset(KOM::$active['cat']);
    unset(KOM::$active['party']);
    unset(KOM::$active['pst']);
}

if (isset(KOM::$active['cat']) && is_array(KOM::$active['cat'])) {
    $database->setFilter("categories", KOM::$active['cat']);
}
if (isset(KOM::$active['party']) && is_array(KOM::$active['party'])) {
    $database->setFilter("parties", KOM::$active['party']);
} else {
    $database->setFilter("parties", array(1,2,3));
}
if (isset(KOM::$active['pst']) && is_array(KOM::$active['pst'])) {
    $database->setFilter("pledgestatetypeids", KOM::$active['pst']);
}
if (isset(KOM::$active['pstg']) && is_numeric(KOM::$active['pstg'])) {
    $database->setFilter("pledgestatetypegroup", KOM::$active['pstg']);
}

$database->loadContent();

if (isset(KOM::$active['cat']) && is_numeric(KOM::$active['cat']) && KOM::$mainDB->getCategory(KOM::$active['cat'])) {
    $catname = KOM::$mainDB->getCategory(KOM::$active['cat'])->getName();
    include('templates/list-cat.php');
} else {
    include('templates/list-all.php');
}



?>