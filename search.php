<?php

    $database = new Database(KOM::$dblink);
    $database->loadContent();
    $search = new Search($database, KOM::$active['searchstring']);

    KOM::registerStyle('interface/css/search.css', true);
    
    foreach (explode(" ", KOM::$active['searchstring']) as $val0) {
        if (strpos("0".$val0, "+") == 1) {
            if (trim(substr($val0, 1)) != "") $searar[] = "/".strtolower(substr($val0, 1))."/i";
        } elseif (strpos("0".$val0, "-") == 1) {
        } else {
            if (trim($val0) != "") $searar[] = "/".strtolower($val0)."/i";
        }
    }
    $ergI = $search->doSearchIssues();
    $ergP = $search->doSearchPledges();
    $ergS = $search->doSearchStates();   
    include(dirname(__FILE__).'/templates/search-header.php');
    switch (KOM::$active['searchtype']) {
        case "issues":
            include(dirname(__FILE__).'/templates/search-issues.php');
            break;
        case "pledges":
            include(dirname(__FILE__).'/templates/search-pledges.php');
            break;
        case "states":
            include(dirname(__FILE__).'/templates/search-states.php');
            break;
        default:

            include(dirname(__FILE__).'/templates/search.php');
    }
    
?>