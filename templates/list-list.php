<div class="list">
<?php
    foreach ($database->getIssues("name") as $issue) {
        ?>
        <a href="<?=KOM::dolink("single", array("issueid" => $issue->getID()));?>"><span class="issue"><?=$issue->getName();?></span></a>
        
        <?php
        foreach ($database->GetParties("order") as $party) {
            $pid = $party->getID();
            if (is_array($issue->getPledgesOfParty($pid))) {
                foreach ($issue->getPledgesOfParty($pid) as $pledge) {
                    switch ($pledge->getCurrentPledgeStateType()->getID()) {
                        case 1: $ampel = array("", "", "", "", "", ""); break;  //Nicht begonnen
                        case 2: $ampel = array("", "", "red", "", "", ""); break;  //An fremder Mehrheit gescheitert
                        case 3: $ampel = array("", "", "", "green", "green", ""); break;  //Zum Teil umgesetzt
                        case 4: $ampel = array("", "", "", "green", "green", "green"); break;  //Erfolgreich umgesetzt
                        case 5: $ampel = array("red", "red", "red", "", "", ""); break;  //Gegenteil umgesetzt
                        case 6: $ampel = array("", "", "", "green", "green", "green"); break;  //Zustand gewahrt
                        case 7: $ampel = array("", "", "red", "", "", ""); break;  //Zustand in Gefahr
                        case 8: $ampel = array("", "red", "red", "", "", ""); break;  //Zustand nicht gewahrt
                        case 10: $ampel = array("", "red", "red", "", "", ""); break;  //Nicht umgesetzt
                    }
                    ?>
                    <a class="pledge" href="<?=KOM::dolink("single", array("issueid" => $issue->getID()));?>#pledge_<?=$pledge->getID();?>"><span class="pledge_row"><span class="pledge_party"><img alt="<?=$pledge->getParty()->getName();?>" src="<?=KOM::$site_url;?>/interface/images/parties/small/<?=$pledge->getParty()->getID();?>.jpg" /></span><span class="pledge_name"><?=$pledge->getName();?></span>
                    <?php
                    if ($party->getDoValue() == true) {
                    ?>
                    <span class="pledge_status"><?=$pledge->getCurrentPledgeStateType()->getName();?></span><span class="pledge_ampel"><span class="ampel">
                    <?php
                    for ($a = 0; $a<=5; $a++) {
                        echo '<span class="ampelelement '.$ampel[$a].'"></span>';
                    }
                    
                    ?>
                    </span></span>
                    <?php } ?>
                    </span>
                    
                    </a>
                    <?php
                }
            }
        }
        ?>
        <!--</a>-->
        <?php
    }

?>

</div>