<?php
    require_once(DIR_THEME.'/include/header.php');
?><style>
    <?php   require_once(DIR_THEME.'/include/kereses.css'); ?>
    <?php   require_once(DIR_THEME.'/include/livesearch.css'); ?>
    <?php   require_once(DIR_THEME.'/include/termek.css'); ?>
</style>
<style>
.column{margin-left:0 !important;}
</style>
<!-- Featherlight Lightbox 
<link href="//cdn.rawgit.com/noelboss/featherlight/1.7.0/release/featherlight.min.css" type="text/css" rel="stylesheet" />

<script>
    <?php   require_once(DIR_THEME.'/include/js/livesearch.js'); ?>
</script>
-->
<body>
<main>  
<h1 style="display:block; margin:0 auto;text-align:center;font-size:5vw;padding:20px; padding-bottom:50px;width:80vw;height:60px;">BioBody Partner Portál</h1>

<section  class="full-width">

<article style="background-color:#fafafa; margin:0; padding-left:40px; padding-right:40px;">
        <div id="menu_left" class="column three" style="background-color:#FFFFFF;border-radius:20px;padding:20px;max-width:230px;">
            
            <h3>Üdvözlünk<br><?php print $Partner->user['kap_nev'];?></h3>
            <ul style="list-style: none;margin-left:0; font-size:17px;line-height:230%;">
                <li><a class="menu_left_link" href="<?php print URL.'Partner/Summary'; ?>"><i class="icon-report"></i> Összegzés</a></li>
                <li><a class="menu_left_link" href="<?php print URL.'Partner/ProductList'; ?>"><i class="icon-product"></i> Megjelenő termékek</a></li>
                <li><a class="menu_left_link" href="<?php print URL.'Partner/MyShop'; ?>"><i class="icon-home"></i> Boltom adatai</a></li>
                <li><a class="menu_left_link" href="<?php print URL.'Partner/Account'; ?>"><i class="icon-account"></i> Fiók adatok</a></li>
                <!--<li><a class="menu_left_link" href="<?php print URL.'partner/Summary'; ?>"><i class="icon-gear"></i> Terméklista feltöltés</a></li>-->
                <!--<li><a class="menu_left_link" href="<?php print URL.'partner/Summary'; ?>"><i class="icon-payment"></i> Egyenlegfeltöltés</a></li>-->
                <li><a class="menu_left_link" href="<?php print URL.'Partner/GYIK'; ?>"><i class="icon-question"></i> GYIK</a></li>
                <li><a class="menu_left_link" href="<?php print URL.'Partner/Logout'; ?>"><i class="icon-close"></i> Kijelentkezés</a></i>
            </ul>
        </div>
