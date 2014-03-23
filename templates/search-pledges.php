<div class="search">
<?php
    if ($ergP) {
        $c = 0;
        foreach ($ergP as $val) {
            $newname = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getName());
            $newdesc = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getDesc());
            echo "<div class=\"issue\"><a href=\"".KOM::dolink("single", array("issueid" => $val->getIssue()->getID()))."#pledge_".$val->getID()."\">".$val->getIssue()->getName()."<br><strong>".$val->getParty()->getName().": ".$newname."</strong><br>".$newdesc."</a></div>";
        }
    } else {
        echo "Nichts gefunden.";
    }
   
?>
</div>