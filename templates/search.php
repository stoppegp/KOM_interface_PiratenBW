<div class="search">
<div class="issue head">Themen (<?php echo (is_array($ergI)) ? count($ergI) : '0'; ?>)</div>
<?php    
    if ($ergI) {
        $c = 0;
        foreach ($ergI as $val) {
            if (++$c > 3) {
                echo "<div class=\"issue\"><a href=\"".KOM::dolink("search", array("searchtype" => "issues"))."\">weitere ".(count($ergI)-3)." Ergebnisse anzeigen...</a></div>";
                break;
            }
            $newname = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getName());
            $newdesc = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getDesc());
            echo "<div class=\"issue\"><a href=\"".KOM::dolink("single", array("issueid" => $val->getID()))."\"><strong>".$newname."</strong><br>".$newdesc."</a></div>";
        }
    } else {
        echo "<div class=\"issue\">Nichts gefunden.</div>";
    }
?>
<div class="issue head">Versprechen (<?php echo (is_array($ergP)) ? count($ergP) : '0'; ?>)</div>
<?php
    if ($ergP) {
        $c = 0;
        foreach ($ergP as $val) {
            if (++$c > 3) {
                echo "<div class=\"issue\"><a href=\"".KOM::dolink("search", array("searchtype" => "pledges"))."\">weitere ".(count($ergP)-3)." Ergebnisse anzeigen...</a></div>";
                break;
            }
            $newname = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getName());
            $newdesc = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getDesc());
            echo "<div class=\"issue\"><a href=\"".KOM::dolink("single", array("issueid" => $val->getIssue()->getID()))."#pledge_".$val->getID()."\">".$val->getIssue()->getName()."<br><strong>".$val->getParty()->getName().": ".$newname."</strong><br>".$newdesc."</a></div>";
        }
    } else {
        echo "<div class=\"issue\">Nichts gefunden.</div>";
    }
?>
<div class="issue head">Ereignisse (<?php echo (is_array($ergS)) ? count($ergS) : '0'; ?>)</div>
<?php
    if ($ergS) {
        $c = 0;
        foreach ($ergS as $val) {
            if (++$c > 3) {
                echo "<div class=\"issue\"><a href=\"".KOM::dolink("search", array("searchtype" => "states"))."\">weitere ".(count($ergS)-3)." Ergebnisse anzeigen...</a></div>";
                break;
            }
            $newname = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getName());
            $newquotetext = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getQuoteText());
            echo "<div class=\"issue\"><a href=\"".KOM::dolink("single", array("issueid" => $val->getIssue()->getID()))."#state_".$val->getID()."\"><strong>".date("d.m.Y", $val->getDatum()).": ".$newname."</strong><br>".$newquotetext."</a></div>";
        }
    } else {
        echo "<div class=\"issue\">Nichts gefunden.</div>";
    }
?>
</div>