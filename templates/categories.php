

<div id="breadcrumbs">
<span><a href="<?=KOM::dolink("home");?>">Home</a></span>
<span><a href="<?=KOM::dolink("categories", null, true);?>">Wahlversprechen</a></span>
<span>Kategorien</span>
</div>

<nav class="pagenav"><div class="pagenav-table">
    <ul>
        <li><a href="<?=KOM::dolink("categories", null, true);?>" class="active">Kategorien</a></li>
        <li><a href="<?=KOM::dolink("list", null, true);?>">Alle Versprechen</a></li>
        <li><a href="<?=KOM::dolink("gehalten", null, true);?>">Gehaltene Versprechen</a></li>
        <li><a href="<?=KOM::dolink("gebrochen", null, true);?>">Gebrochene Versprechen</a></li>
    </ul>
    </div>
</nav>

<div id="categoryboxes">
<div class="category_row">

    <?php
    $counter = 0;

        $bgcolors = array("", "#fe9500", "#00b71a", "#ae0000", "#00befe", "#a7008d", "#d8c600", "#007fae", "#6f7c00", "#a74b00", "#00db95", "#8405d5", "#6d6d6d", "#ff4800", "#b700a4");
        foreach (KOM::$mainDB->getCategories("name") as $cat) {
            if ($cat->getDisabled()) continue;
            $counter++;
            if ($counter == 5) {
                $counter = 1;
                ?>
                </div><div class="category_row">
                <?
            }
            

            
            $databaseGR = new Database(KOM::$dblink);
            $databaseGR->setFilter("categories", $cat->getID());
            $databaseGR->setFilter("parties", array(1,2));
            $databaseGR->loadContent();
            $auswGR = new Analysis($databaseGR);

            /* Aktuelle Verteilung */
            $nr = $auswGR->getCurrentNumberOfPledgestatetypes();
            $group_nr = array();
            $group_perc = array();
            if (is_array($nr)) {
                $compl = array_sum($nr);
                foreach ($databaseGR->getPledgestatetypegroups() as $value0) {
                    $group_nr[$value0->getID()] = 0;
                    foreach ($databaseGR->getPledgestatetypegroup($value0->getID())->getPledgestatetypes() as $value) {
                        if (isset($nr[$value->getID()])) {
                            $group_nr[$value0->getID()] += $nr[$value->getID()];
                        }
                    }
                    $group_perc[$value0->getID()] = floor($group_nr[$value0->getID()]/$compl*100);
                }
                
               $gesperc = array_sum($group_perc);
               if ($gesperc < 100) {
                    foreach ($databaseGR->getPledgestatetypegroups() as $value0) {
                        if ($group_perc[$value0->getID()] > 0) {
                            $group_perc[$value0->getID()] += (100-$gesperc);
                            break;
                        }
                    }
               }
                
            }
            ?>
            
            <a href="<?=KOM::dolink("list", array("cat"=>$cat->getID()));?>" class="categorybox" style="background-color:<?=next($bgcolors);?>"><span class="cbtextbox"><?=$cat->getName();?></span><span class="cbmeterbox"><span class="meter"><span class="meter-green" style="width: <?=$group_perc[2];?>%;"></span><span class="meter-red" style="width: <?=$group_perc[3];?>%;"></span></span></span></a>
            
            <?php
        }
    
    ?>

</div>
</div>