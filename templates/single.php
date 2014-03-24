<div id="breadcrumbs">
<span><a href="<?=KOM::dolink("home");?>">Home</a></span>
<span><a href="<?=KOM::dolink("categories", null, true);?>">Wahlversprechen</a></span>
<span><?=$issue->getName();?></span>
</div>

<h1><?=$issue->getName();?></h1>
<p><?php
if ($issue->getDesc()) {
    echo $issue->getDesc();
}
?>
</p>
<h2>Versprechen</h2>
<div class="list">
<?php
        foreach (array(3,1,2) as $pid) {
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
                    <div>
                    <input type="checkbox" class="switch" id="pledge_<?=$pledge->getID();?>"><label class="switch-label" for="pledge_<?=$pledge->getID();?>" onclick=""><span class="pledge"><span class="pledge_row"><span class="pledge_party"><img alt="<?=$pledge->getParty()->getName();?>" src="<?=KOM::$site_url;?>/interface/images/parties/small/<?=$pledge->getParty()->getID();?>.jpg" /></span><span class="pledge_name">
                    <?=$pledge->getName();?></span><span class="pledge_status"><?=$pledge->getCurrentPledgeStateType()->getName();?></span><span class="pledge_ampel"><span class="ampel">
                    <?php
                    for ($a = 0; $a<=5; $a++) {
                        echo '<span class="ampelelement '.$ampel[$a].'"></span>';
                    }
                    
                    ?>
                    </span></span>
                    </span></span></label>
                    <div class="switch-action pledge-infos">
                    <?php
                    if ($pledge->getDesc()) {
                    ?>
                    <div class="pledge_desc">
                        <?php
                        echo $pledge->getDesc();
                        ?>
                    </div>
                    <?
                    }
                    ?>
                    <?php
                    if ($pledge->getQuoteText()) {
                    ?>
                    <div class="pledge_quote">
                        <span class="pledge_quote_quote">»<?php
                        echo $pledge->getQuoteText();
                        ?>«</span>
                        <span class="pledge_quote_source">(<a href="<?php echo $pledge->getQuoteURL(); ?>"><?php
                        echo $pledge->getQuoteSource();
                        ?></a>)
                        </span>
                    </div>
                    <?
                    }
                    ?>
                    <div>
                    <strong>Aktuelle Bewertung:</strong> <?=$pledge->getCurrentPledgeStateType()->getName();?>.
                    <?php if ($pledge->getCurrentState()) { ?>
                    (<a href="<?=KOM::dolink("single", array("issueid" => $issue->getID()));?>#state_<?=$pledge->getCurrentState()->getID();?>"><?=date("d.m.Y", $pledge->getCurrentState()->getDatum());?></a>)
                    <? } ?>
                    </div>
                    </div></div>
                    <?php
                }
            }
        }
    ?>
</div>
<?php
if ($issueOP && is_array($issueOP->getPledges()) && (count($issueOP->getPledges()) > 0)) {
?>
<h2>Opposition</h2>
<div class="list">
<?php
        foreach (array(4,5,6) as $pid) {
            if (is_array($issueOP->getPledgesOfParty($pid))) {
                foreach ($issueOP->getPledgesOfParty($pid) as $pledge) {
                    ?>
                    <div>
                    <input type="checkbox" class="switch" id="pledge_<?=$pledge->getID();?>"><label class="switch-label" for="pledge_<?=$pledge->getID();?>" onclick=""><span class="pledge"><span class="pledge_row"><span class="pledge_party"><img alt="<?=$pledge->getParty()->getName();?>" src="<?=KOM::$site_url;?>/interface/images/parties/small/<?=$pledge->getParty()->getID();?>.jpg" /></span><span class="pledge_name">
                    <?=$pledge->getName();?></span>
                    </span></span></label>
                    <div class="switch-action pledge-infos">
                    <?php
                    if ($pledge->getDesc()) {
                    ?>
                    <div class="pledge_desc">
                        <?php
                        echo $pledge->getDesc();
                        ?>
                    </div>
                    <?
                    }
                    ?>
                    <?php
                    if ($pledge->getQuoteText()) {
                    ?>
                    <div class="pledge_quote">
                        <span class="pledge_quote_quote">»<?php
                        echo $pledge->getQuoteText();
                        ?>«</span>
                        <span class="pledge_quote_source">(<a href="<?php echo $pledge->getQuoteURL(); ?>"><?php
                        echo $pledge->getQuoteSource();
                        ?></a>)
                        </span>
                    </div>
                    <?
                    }
                    ?>
                    </div></div>
                    <?php
                }
            }
        }
    ?>
</div>
<?php } ?>
    <?php if (is_array($issue->getStates("datum", "DESC")) && (count($issue->getStates("datum", "DESC")) > 0)) { ?>
<div class="list">
<h2>Verlauf</h2>
<?php
foreach ($issue->getStates("datum", "DESC") as $state) {
    ?>
    <div>
    <input type="checkbox" class="switch" id="state_<?=$state->getID();?>"><label class="switch-label" for="state_<?=$state->getID();?>" onclick="">
    <span class="state"><?php echo date("d.m.Y", $state->getDatum()); ?>: <strong><?php echo $state->getName(); ?></strong></span>
    </label>
    <div class="switch-action state-infos">
                    <div class="state_quote">
                        <span class="state_quote_quote">»<?php
                        echo $state->getQuoteText();
                        ?>«</span>
                        <span class="state_quote_source">(<a href="<?php echo $state->getQuoteURL(); ?>"><?php
                        echo $state->getQuoteSource();
                        ?></a>)
                        </span>
                    </div>
    </div>
    </div>
    <?
    
}

?>
</div>
<?php } ?>
<?php if ($issue->getComment()) { ?>
<h2>Kommentar</h2>
<div class="comment"><?php echo $issue->getComment(); ?></div>
<?php } ?>