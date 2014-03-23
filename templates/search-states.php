<div class="search">
<?php
    if ($ergS) {
        $c = 0;
        foreach ($ergS as $val) {
            $newname = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getName());
            $newquotetext = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getQuoteText());
            echo "<div class=\"issue\"><a href=\"".KOM::dolink("single", array("issueid" => $val->getIssue()->getID()))."#state_".$val->getID()."\"><strong>".date("d.m.Y", $val->getDatum()).": ".$newname."</strong><br>".$newquotetext."</a></div>";
        }
    } else {
        echo "Nichts gefunden.";
    }
   
?>
</div>