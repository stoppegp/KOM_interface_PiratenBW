<div class="search">
<?php
    if ($ergI) {
        $c = 0;
        foreach ($ergI as $val) {
            $newname = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getName());
            $newdesc = preg_replace($searar, "<span class=\"found\">$0</span>", $val->getDesc());
            echo "<div class=\"issue\"><a href=\"".KOM::dolink("single", array("issueid" => $val->getID()))."\"><strong>".$newname."</strong><br>".$newdesc."</a></div>";
        }
    } else {
        echo "Nichts gefunden.";
    }
   
?>
</div>