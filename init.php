<?php

require_once('helpers/sto_highchart_parser.class.php');

$page[0]['name'] = "kategorien";
$page[0]['file'] = "categories";
$page[0]['title'] = "Versprechen";
$page[1]['name'] = "suche";
$page[1]['file'] = "search";
$page[1]['urlrewrite'] = "searchrewrite";
$page[1]['doLink'] = "searchdolink";
$page[1]['title'] = "searchtitle";
$page[2]['name'] = "statistik";
$page[2]['file'] = "stats";
$page[2]['title'] = "Statistik";
$page[3]['name'] = "versprechen";
$page[3]['file'] = "list";
$page[3]['title'] = "listtitle";
$page[3]['urlrewrite'] = "listrewrite";
$page[3]['doLink'] = "listdolink";
$page[4]['name'] = "versprechen/detail";
$page[4]['file'] = "single";
$page[4]['urlrewrite'] = "singlerewrite";
$page[4]['doLink'] = "singledolink";
$page[4]['title'] = "singletitle";
$page[5]['name'] = "versprechen/gehalten";
$page[5]['file'] = "gehalten";
$page[5]['title'] = "Gehaltene Versprechen";
$page[6]['name'] = "versprechen/gebrochen";
$page[6]['file'] = "gebrochen";
$page[6]['title'] = "Gebrochene Versprechen";
$page[7]['name'] = "fehler-melden";
$page[7]['file'] = "report";
$page[7]['title'] = "Fehler melden";
$page[7]['doLink'] = "reportdolink";
$page[7]['urlrewrite'] = "reportrewrite";

KOM::registerPages($page);

function reportdolink($ar) {
    if (isset($ar['issueid'])) {
        $url = $ar['issueid'];
    } else {
        $url = "";
    }
    return $url;
}

function reportrewrite($ar) {
    if (isset($ar[1])) {
        $active['issueid'] = KOM::filteruri($ar[1]);
    }
    
    return $active;
        
}

function listtitle() {
    if (isset(KOM::$active['cat'])) {
        return KOM::$mainDB->getCategory(KOM::$active['cat'])->getName();
    } else {
        return "Alle Versprechen";
    }
}
function singletitle() {
    //rint_r(KOM::$active);
    return KOM::$issuelist[KOM::$active['issueid']];
}

function singledolink($ar) {
    $issueid = $ar['issueid'];
    return $issueid."--".KOM::$issuelist[$issueid]."/";
}

function singlerewrite($ar) {
    if (isset($ar[2]) && (strpos($ar[2], "--") > 0)) {
        $nrstr = substr($ar[2], 0, strpos($ar[2], "-"));
        if (is_numeric($nrstr)) {
            $active['issueid'] = $nrstr;
        }
    }
    
    return $active;
}

function listdolink($ar) {
    if (isset($ar['cat'])) {
        $url = KOM::filteruri(KOM::$mainDB->getCategory($ar['cat'])->getName())."/";
    } else {
        $url = "";
    }
    return $url;
}

function listrewrite($ar) {
    if (is_array(KOM::$mainDB->getCategories())) {
        foreach (KOM::$mainDB->getCategories() as $val) {
            $catarray[KOM::filteruri($val->getName())] = $val->getID();
        }
    }
    if (isset($ar[1]) && in_array(KOM::filteruri($ar[1]), array_keys($catarray))) {
        $active['cat'] = $catarray[KOM::filteruri($ar[1])];
    }
    
    return $active;
        
}

function searchtitle() {
    if (KOM::$active['searchstring']) {
        return "Suche: ".KOM::$active['searchstring'];
    } else {
        return "Suche";
    }
}

function searchrewrite($ar) {

    if ($ar[1] != "") {
        $ar[1] = str_replace("+", "{plus2669}", $ar[1]);
        $ar[1] = urldecode($ar[1]);
        $ar[1] = str_replace("{plus2669}", "+", $ar[1]);
        switch ($ar[1]) {
            case "versprechen": $st = "pledges"; break;
            case "ereignisse": $st = "states"; break;
            case "themen": $st = "issues"; break;
        }
        if ($_POST['searchstring'] != "") {
            return array("searchstring" => htmlspecialchars($_POST['searchstring']), "searchtype" => $st);
        } elseif (($st == "") && ($ar[1] != "")) {
            return array("searchstring" => htmlspecialchars($ar[1]));
        } elseif ($ar[2] != "") {
            $ar[2] = str_replace("+", "{plus2669}", $ar[2]);
            $ar[2] = urldecode($ar[2]);
            $ar[2] = str_replace("{plus2669}", "+", $ar[2]);
            return array("searchstring" => htmlspecialchars($ar[2]), "searchtype" => $st);
        } else {
            return array("searchtype" => $st);
        }
    } elseif ($_POST['searchstring'] != "") {
            return array("searchstring" => htmlspecialchars($_POST['searchstring']));
    } else {
        return array();
    }
}

function searchdolink($ar) {
    if (!$ar['searchtype']) $ar['searchtype'] = "";
    switch ($ar['searchtype']) {
        case "pledges": $url = "versprechen/"; break;
        case "states": $url = "ereignisse/"; break;
        case "issues": $url = "themen/"; break;
    }
    return $url.$ar['searchstring'];
}


$sitemap = array(
    array(
        "page"  =>  "home",
        "text"  =>  "Home",
    ),
    array(
        "page"  =>  "categories",
        "text"  =>  "Wahlversprechen",
        "submenu"    =>  "sitemap_wahlversprechen",
        "active"    => array("page" => "categories"),
    ),
    array(
        "page"  =>  "stats",
        "text"  =>  "Statistik",
    ),
    array(
        "page"  =>  "custompage",
        "text"  =>  "Info",
        "args"  => array("custompageid" => 3),
    ),
    array(
        "page"  =>  "custompage",
        "text"  =>  "Impressum",
        "args"  => array("custompageid" => 1),
    ),

);

$sitemap_wahlversprechen = array(
    array(
        "page"  =>  "categories",
        "text"  =>  "Versprechen nach Kategorien",
        "submenu"    =>  "sitemap_wahlversprechen_cat",
    ),
    array(
        "page"  =>  "list",
        "text"  =>  "Alle Versprechen",
    ),
);
$sitemap_wahlversprechen_cat = array();
foreach (KOM::$mainDB->getCategories("name") as $val) {
    if ($val->getDisabled()) continue;
    $temp = array(
        "text"  =>  $val->getName(),
        "page"  =>  "list",
        "args"  => array("cat" => $val->getID()),
    );
    $sitemap_wahlversprechen_cat[] = $temp;
}

function getTitle() {
    $page = KOM::$active['page'];
    
    if ($page == "custompage") {
        $pageid = KOM::$active['custompageid'];
        return KOM::$custompagelist[$pageid]." - ".KOM::$pagetitle;
    }
    
    if (isset(KOM::$pagesByFile[$page]["title"])) {
        $title = KOM::$pagesByFile[$page]["title"];
        if (function_exists($title)) {
            $rt = $title();
            if ($rt != "") {
                return $rt." - ".KOM::$pagetitle;
            } else {
                return KOM::$pagetitle;
            }
        } else {
            return $title." - ".KOM::$pagetitle;
        }
    } else {
        return KOM::$pagetitle;
    }
}

KOM::registerMenu("sitemap", $sitemap);
KOM::registerMenu("sitemap_wahlversprechen", $sitemap_wahlversprechen);
KOM::registerMenu("sitemap_wahlversprechen_cat", $sitemap_wahlversprechen_cat);
?>