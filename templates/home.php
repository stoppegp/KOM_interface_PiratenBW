<div id="wkimage">
<span id="kmzitat">„In der Politik gibt es manchmal keine Gewähr dafür, dass man all seine Ziele erreicht.“</span>
<div id="GR_verteilung"></div>
</div>

<div id="buttons">
<div id="buttons_row">
<div id="button1"><a href="<? echo KOM::dolink("gehalten"); ?>"><span class="img"></span><span class="text">Gehaltene Versprechen</span></a></div>
<div id="button2"><a href="<? echo KOM::dolink("gebrochen"); ?>"><span class="img"></span><span class="text">Gebrochene Versprechen</span></a></div>
<div id="button3"><a href="<? echo KOM::dolink("categories"); ?>"><span class="img"></span><span class="text">Versprechen nach Kategorien</span></a></div>
<div id="button4"><a href="<? echo KOM::dolink("stats"); ?>"><span class="img"></span><span class="text">Statistik</span></a></div>
</div></div>

<div id="cont1">
    <div id="cont1_row">
    <div id="chronik">
        <h1>Letzte Ereignisse</h1>
        <div class="ereignisse">
        <?php
        
        $c = 0;
        foreach ($ausw->getStates("datum", "DESC") as $value) {
            ?>
            <div class="ereignis">
                <a href="<?=KOM::dolink("single", array("issueid" => $value->getIssue()->getID()));?>#state_<?=$value->getID();?>">
                <span class="ereignis_row">
                    <span class="datum"><?=date("d.m.Y", $value->getDatum());?></span>
                    <span class="box1">
                        <span class="issue"><?=$value->getIssue()->getName();?></span><br>
                        <span class="state"><?=$value->getName();?></span>
                    </span>
                </span>
                </a>
            </div>
            <?php
            if (++$c > 7) break;
        }
        
        ?>
       </div>
    </div>
    <div id="twitter" <?php echo (!is_array($statuses)) ? "style=\"display: none;\"" : ""; ?>><h1>Twitter</h1>
<?php
	function autolink($str, $attributes=array()) {
	    $attrs = '';
	    foreach ($attributes as $attribute => $value) {
	        $attrs .= " {$attribute}=\"{$value}\"";
	    }
	 
	    $str = ' ' . $str;
	    $str = preg_replace(
	        '`([^"=\'>])((http|https|ftp)://[^\s<]+[^\s<\.)])`i',
	        '$1<a href="$2"'.$attrs.'>$2</a>',
	        $str
	    );
	    $str = substr($str, 1);
	     
	    return $str;
	}

    if (is_array($statuses)) {
    foreach ($statuses as $key => $status) {
        if ($status->retweeted_status) $status = $status->retweeted_status;
            ?>
            <span class="twitter-status">
            <span class="twitter-title"><a href="https://twitter.com/<?=$status->user->screen_name;?>"><strong><?=$status->user->name;?></strong> @<?=$status->user->screen_name;?></a></span>
            <span class="twitter-text"><?php echo autolink($status->text); ?></span>
            <span class="twitter-datum"><a href="https://twitter.com/<?=$status->user->screen_name;?>/statuses/<?=$status->id_str;?>"><?php echo date("d.m.Y H:i", strtotime($status->created_at)); ?> Uhr</a></span>
            </span>
            <?php
        if ($key >=3) break;
    }
    }

?>
    </div>
    </div>
</div>

<h1>“In der Politik gibt es manchmal keine Gewähr dafür, dass man all seine Ziele erreicht.”</h1>
<p>Mit diesem Satz zu einem der zentralen Wahlversprechen von Bündnis 90/Die Grünen ließ sich Ministerpräsident Kretschmann zitieren. Jede Regierung verteilt im Wahlkampf eine lange Liste an Versprechen. Und nicht erst dieses Zitat wirft die Frage auf: Wie viele werden davon wirklich eingehalten?</p>
<p>Die Piratenpartei Baden-Württemberg versucht mit dem Kretschmann-O-Meter eine Antwort auf diese Frage für die Grün-Rote Landesregierung in Baden-Württemberg zu finden. Schlagen Sie nach, wie weit die Umsetzung der zentralen Wahlkampfversprechen bereits fortgeschritten ist und vergleichen Sie den Koalitionsvertrag mit den Positionen von Bündnis 90/Die Grünen, der SPD und der Piratenpartei.</p>

<h1>Fehler entdeckt?</h1>
<p>Das Kretschmann-O-Meter wird erst mit der nächsten Landtagswahl endgültig fertig sein, bis dahin kann es täglich Aktualisierungen und Erweiterungen geben. Da ständig neue politische Entscheidungen gefällt werden, können wir mit ehrenamtlicher Arbeit auch nicht auf die Minute aktuell sein. Sie haben einen Fehler entdeckt oder möchten etwas ergänzen? Dann melden Sie sich bei uns! Wir freuen uns über jede Unterstützung.</p>