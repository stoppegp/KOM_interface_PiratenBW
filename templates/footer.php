        </div>
        <footer id="footer">
            <div id="footer1">
                <div id="footer-follow">
                    <h1>Folgen Sie uns</h1>
                    Bleiben Sie mit <a href="https://www.facebook.com/PiratenBW">Facebook</a> und <a href="https://twitter.com/KOM_BW">Twitter</a> auf dem Laufenden.
                </div>
                <div id="footer-share">
                    <h1>Diese Seite teilen</h1>
                    Teilen Sie diese Seite mit Ihren Freunden und Bekannten.
                     <div id="socialshareprivacy"></div>
                </div>
                <div id="footer-report">
                    <h1>Fehler entdeckt?</h1>
                    Sie haben auf dieser Seite einen Fehler entdeckt? Wir freuen uns über jede Unterstützung.
                    <a id="reportbutton" href="<?=KOM::dolink("report");?>">Fehler melden</a>
                </div>
            </div>
            <div id="footer2">
                <h1>Sitemap</h1>
                <?php
                    
                echo printSitemap("sitemap");
                
                ?>
            </div>
            <div id="footer3">
            Ein Informationsportal der <a href="https://piratenpartei-bw.de">Piratenpartei Baden-Württemberg</a>.
            <div id="rgbf">Konzept & Design: <a href="http://rgb-factory.de/"><img style="vertical-align:middle;" src="<?=KOM::$site_url;?>/interface/images/rgb-factory_de.png" alt="rgb-factory" /></a></div>
            </div>
        </footer>
    </div>
</body>
</html>