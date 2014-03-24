<?php
    KOM::registerStyle('interface/css/home.css', true);
    
    $database = new Database(KOM::$dblink);
    $database->loadContent();
    $ausw = new Analysis($database);
    
    $databaseGR = new Database(KOM::$dblink);
    $databaseGR->setFilter("parties", array(1,2));
    $databaseGR->loadContent();
    $auswGR = new Analysis($databaseGR);
    
    $nrGR = $auswGR->getCurrentNumberOfPledgestatetypes();
    
	$group_nrGR = array();
	
    foreach ($databaseGR->getPledgestatetypegroups() as $value0) {
        foreach ($databaseGR->getPledgestatetypegroup($value0->getID())->getPledgestatetypes() as $value) {
			if (!isset($group_nrGR[$value0->getID()])) {
				$group_nrGR[$value0->getID()] = 0;
			}
            $group_nrGR[$value0->getID()] += $nrGR[$value->getID()];
        }
    }
    
    /* Diagramm erstellen */
        $chart = new sto_highchart_parser("GR_verteilung");
        $chart->options['title']['text'] = "";
        $chart->options['chart']['plotShadow'] = true;
        $chart->options['chart']['backgroundColor'] = 'rgba(100, 200, 200, .0)';
        $chart->options['plotOptions']['pie']['dataLabels']['enabled'] = false;
        $chart->options['plotOptions']['pie']['dataLabels']['color'] = "#f00";
        $chart->options['plotOptions']['pie']['dataLabels']['connectorColor'] = "#00f";
        $chart->options['tooltip']['headerFormat'] = "";
        $chart->options['tooltip']['pointFormat'] = "{point.name}: {point.y}";
        $chart->options['tooltip']['percentageDecimals'] = 1;
        $chart->options['plotOptions']['pie']['animation'] = false;
        $chart->options['plotOptions']['pie']['shadow'] = true;
        //$chart->activateLinks();
        
        $chart->options['series'] = $auswGR->getChartseriesPieGroup(false, array(2 => array("sliced" => true)), 0.6);
         $chart->options['series'][0]['data'][0]['url'] = KOM::dolink("gehalten", null, null);
         $chart->options['series'][0]['data'][2]['url'] = KOM::dolink("gebrochen", null, null);
         $chart->options['series'][0]['data'][1]['url'] = KOM::dolink("categories", null, null);
         $chart->activateLinks();
        
    try {
    $twitter = new Twitter(TWITTER_API_KEY, TWITTER_API_SECRET, TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_SECRET);
    $statuses = $twitter->request('statuses/user_timeline', 'GET', array('count' => 20));
    } catch (Exception $e) {
        $statuses = false;
    }
    
    include(dirname(__FILE__).'./templates/home.php');
?>

<script type="text/javascript">

<?
echo $chart->render();
?>
</script>
