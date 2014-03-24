<?php
    function printSitemap($menu, $top = true) {
        if ($top) {
            $ret = "<table><tr>";
        } else {
            $ret = "<ul>";
        }
        
        foreach(KOM::getMenu($menu) as $val) {
            if ($top) {
                $ret .= "<td>";
            } else {
                $ret .= "<li>";
            }
            
            $ret .= "<a href=\"".$val['link']."\">".$val['text']."</a>";
            
            if (($val['submenu'] != "") && is_array(KOM::getMenu($val['submenu']))) {
                $ret .= printSitemap($val['submenu'], false);
            }
            
            if ($top) {
                $ret .= "</td>";
            } else {
                $ret .= "</li>";
            }
        }
                        
        if ($top) {
            $ret .= "</tr></table>";
        } else {
            $ret .= "</ul>";
        }
        return $ret;
    }

    include(dirname(__FILE__).'./templates/footer.php');
?>