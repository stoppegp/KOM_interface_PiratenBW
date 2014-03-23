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
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.stoppe-gp.de/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();

</script>
<noscript><p><img src="http://piwik.stoppe-gp.de/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
</body>
</html>