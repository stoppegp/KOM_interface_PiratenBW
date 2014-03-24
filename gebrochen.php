<?php

$database = new Database(KOM::$dblink);
$database->setFilter("pledgestatetypegroup", 3);
$database->setFilter("parties", array(1,2,3));
KOM::registerStyle('interface/css/list.css', true);

$database->loadContent();

include(dirname(__FILE__).'./templates/gebrochen.php');




?>