<?php

$database = new Database(KOM::$dblink);
$databaseOP = new Database(KOM::$dblink);

KOM::registerStyle('interface/css/single.css', true);
KOM::registerStyle('interface/css/list.css', true);

if (isset(KOM::$active['issueid']) && is_numeric(KOM::$active['issueid'])) {
    $database->setFilter("issues", KOM::$active['issueid']);
    $databaseOP->setFilter("issues", KOM::$active['issueid']);
}
$database->setFilter("parties", array(1,2,3));
$databaseOP->setFilter("parties", array(4,5,6));
$database->loadContent();
$databaseOP->loadContent();
$issue = $database->getIssue(KOM::$active['issueid']);
$issueOP = $databaseOP->getIssue(KOM::$active['issueid']);

include('templates/single.php');



?>