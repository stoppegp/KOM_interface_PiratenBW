<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title><?=getTitle();?></title>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?=KOM::$site_url;?>/interface/css/layout.css">
        <link rel="icon" href="<?=KOM::$site_url;?>/interface/images/favicon.ico" type="image/x-icon">
        <script src="<?=KOM::$site_url;?>/interface/js/jquery-1.6.4.min.js"></script>
        <script src="<?=KOM::$site_url;?>/interface/js/highcharts.js"></script>
        <script type="text/javascript" src="<?=KOM::$site_url;?>/interface/js/socialshareprivacy/jquery.socialshareprivacy.js"></script>
        <script type="text/javascript">
        jQuery(document).ready(function($){
          if($('#socialshareprivacy').length > 0){
            $('#socialshareprivacy').socialSharePrivacy({
                services : {
                    facebook : {
                        'dummy_img' : '<?=KOM::$site_url;?>/interface/js/socialshareprivacy/socialshareprivacy/images/dummy_facebook.png'
                    },
                    twitter : {
                        'dummy_img' : '<?=KOM::$site_url;?>/interface/js/socialshareprivacy/socialshareprivacy/images/dummy_twitter.png'
                    },
                    gplus : {
                        'dummy_img' : '<?=KOM::$site_url;?>/interface/js/socialshareprivacy/socialshareprivacy/images/dummy_gplus.png'
                    }
                },
                'css_path' : '<?=KOM::$site_url;?>/interface/js/socialshareprivacy/socialshareprivacy/socialshareprivacy.css'
            }); 
          }
        });

        </script>
        <?php echo KOM::getStyles(); ?>
    </head>
    <body>
    <div id="main">
        <header id="header">
        <div id="pagetitle">
        <a href="<?=KOM::dolink("home", null, true);?>"><img src="<?=KOM::$site_url;?>/interface/images/title.png"></a>
        </div>
        <ul id="headermenu">
            <?php
                foreach(KOM::getMenu("sitemap") as $val) {
                    ?>
                    <li><a <?php echo ($val['active']) ? "class=\"active\"" : ""; ?> href="<?=$val['link'];?>"><?=$val['text'];?></a></li>
                    <?php
                    
                }
            ?>
        </ul>
        <div id="headersearch">
            <form method="post" action="<?=KOM::dolink("search", array("searchstring" => ""));?>">
                <input type="text" class="searchinput" placeholder="Suche..." name="searchstring" />
                <input type="submit" class="searchsubmit" value="Suche" />
            </form>
        </div>
        </header>
        
        <div id="maincontent">
        
        
