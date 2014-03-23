<?php

$database = new Database(KOM::$dblink);
$database->setFilter("parties", array(1,2));
$database->loadContent();

$ausw = new Analysis($database);


$curnr = $ausw->getCurrentNumberOfPledgestatetypes();

foreach ($database->getPledgestatetypes() as $value) {
    if (isset($curnr[$value->getID()]) && ($curnr[$value->getID()]*$value->getMultipl() > 0)) {
        $chart1array[$value->getOrder()]['name'] = $value->getName();
        $chart1array[$value->getOrder()]['color'] = $value->getColour();
        $chart1array[$value->getOrder()]['y'] = $curnr[$value->getID()]*$value->getMultipl();
        $temp00 = $database->getGroupsOfPledgestatetype($value->getID());
        $chart1array[$value->getOrder()]['url'] = KOM::dolink("category", array("pstg" => $temp00[0]));
    }
}
ksort($chart1array);

$chart = new sto_highchart_parser("ausw_verteilung");
$chart->options['title']['text'] = "";
$chart->options['plotOptions']['pie']['animation'] = false;


$chart->options['series'][] = array(   'type' => 'pie',
                            'data' => array_values($chart1array),
                        );


                        
for ($a = $database->getOption("start_datum"); $a < time(); $a += 30*86400) {
    unset($temp0);
    $temp0 = $ausw->getNumberOfPledgestatetypesAtDatum($a);
    if (is_array($temp0)) {
        foreach ($database->getPledgestatetypes() as $value) {
            if (!isset($temp0[$value->getID()])) $temp0[$value->getID()] = "0";
            $c2d[$value->getID()][$a] = $temp0[$value->getID()]*$value->getMultipl();
            $order0[$value->getID()] = $value->getOrder();
        }
    }
}
$now = time();

        

        

foreach ($c2d as $key => $val) {
    $temp001 = $database->getGroupsOfPledgestatetype($key);
    $sno = $order0[$key];
    $temp00 = null;
    $temp00 = array(
        'name' => $database->getPledgestatetype($key)->getName(),
        'color' => $database->getPledgestatetype($key)->getColour(),
        'url' => KOM::dolink("category", array("pstg" => $temp001[0])),
        'fillOpacity' => "0.5",
    );
    if (!array_sum($val) == 0) {
        foreach ($val as $key2 => $val2) {
            if (!isset($valbef) || $valbef != $val2 || true) {
                //$temp00['data'][] = "[".$key2."000".",".$val2."]";  
                $ar['x'] = $key2."000";
                $ar['y'] = $val2;
                
                $temp00['data'][] = $ar;
            }
            $valbef = $val2;
        }
        $temp01 = $ausw->getNumberOfPledgestatetypesAtDatum($now);

        if (!isset($temp01[$key])) $temp01[$key] = "0";
            
        $ar['x'] = $now."000";
        $ar['y'] = $temp01[$key];
        $temp00['data'][] = $ar;
        unset($valbef);
        $arsno[$sno] = $temp00;
    }
}
krsort($arsno);

$chart2 = new sto_highchart_parser("ausw_verlauf");
$chart2->options['chart']['type'] = "area";
$chart2->options['chart']['zoomType'] = "x";
$chart2->options['title']['text'] = "";
$chart2->options['plotOptions']['area']['stacking'] = "normal";
$chart2->options['plotOptions']['area']['trackByArea'] = true;
$chart2->options['plotOptions']['area']['marker']['enabled'] = false;
$chart2->options['plotOptions']['area']['marker']['symbol'] = "circle";
$chart2->options['plotOptions']['area']['animation'] = false;
$chart2->options['xAxis']['max'] = $database->getOption("end_datum")."000";
$chart2->options['xAxis']['type'] = "datetime";
$chart2->options['yAxis']['min'] = 0;
$chart2->options['yAxis']['endOnTick'] = false;
$chart2->activateLinks("series");

foreach ($arsno as $val) {
    $chart2->options['series'][] = $val;
}
    include('templates/stats.php');



?>
<script>
<?php
echo $chart->render();
echo $chart2->render();
?>
</script>