<?php
    require_once(DIR_THEME.'/include/header.php');
?><style>
    <?php   require_once(DIR_THEME.'/include/kereses.css'); ?>
    <?php   require_once(DIR_THEME.'/include/livesearch.css'); ?>
    <?php   require_once(DIR_THEME.'/include/termek.css'); ?>
</style>
<!-- Featherlight Lightbox -->
<link href="//cdn.rawgit.com/noelboss/featherlight/1.7.0/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<!--
<script>
    <?php   require_once(DIR_THEME.'/include/js/livesearch.js'); ?>
</script>
-->
<body>
<style>
.column{margin-left:0 !important;}
</style>

<main>  
<h1 style="display:block; margin:0 auto;text-align:center;font-size:5vw;padding:20px; padding-bottom:50px;width:80vw;height:60px;">Hirdesse bioboltját a BioBody-n!</h1>

<section  class="full-width">

<article style="background-color:#fafafa; margin:0; padding-left:40px; padding-right:40px;">
        <div class="column three card-lift" style="background-color:#d2ffa8;border-radius:20px;padding:20px;max-width:230px;">
<form action="" method="POST">
    <fieldset>
        <h2>Bejelentkezés</h2>
        Email:
        <input name="email"     type="email"    value="<?php print (isset($_POST['email']) ? $_POST['email'] : null); ?>" required>
        Jelszó:
        <input name="password"  type="password" value="<?php print (isset($_POST['password']) ? $_POST['password'] : null); ?>" required>
        <input name="action"    type="hidden"   value="login">
        <div style="text-align:center;"><br><input name="submit"    type="submit"   value="Bejelentkezés"></div>
        </fieldset>
</form>

<div style="text-align:center;">
<a style="padding:10px;display:block; font-size:11px" href="#" data-featherlight="#password_recovery">Elfelejtett jelszó</a>
</div>

            <!--<h3>Üdvözlünk<br><?php print $Partner->user['kap_nev'];?>!</h3>-->
            <ul style="list-style: none;margin-left:0; font-size:17px;line-height:230%;">
                <!--<li><a class="menu_left_link" href="<?php print URL.'partner/Summary'; ?>"><i class="icon-report"></i> Összegzés</a></li>
                <li><a class="menu_left_link" href="<?php print URL.'partner/ProductList'; ?>"><i class="icon-product"></i> Megjelenő termékek</a></li>
                <li><a class="menu_left_link" href="<?php print URL.'partner/Summary'; ?>"><i class="icon-home"></i> Boltom adatai</a></li>
                <li><a class="menu_left_link" href="<?php print URL.'partner/Account'; ?>"><i class="icon-account"></i> Fiók adatok</a></li>
                <!--<li><a class="menu_left_link" href="<?php print URL.'partner/Summary'; ?>"><i class="icon-gear"></i> Terméklista feltöltés</a></li>
                <!--<li><a class="menu_left_link" href="<?php print URL.'partner/Summary'; ?>"><i class="icon-payment"></i> Egyenlegfeltöltés</a></li>
                <li><a class="menu_left_link" href="<?php print URL.'partner/GYIK'; ?>"><i class="icon-question"></i> GYIK</a></li>
                <li><a class="menu_left_link" href="<?php print URL.'partner/Logout'; ?>"><i class="icon-close"></i> Kijelentkezés</a></i>
                <li><a class="menu_left_link" href="<?php print URL.'partner/Logout'; ?>">Belépés</a></i>
                <li><a class="menu_left_link" href="<?php print URL.'partner/Logout'; ?>">Regisztráció</a></i>
                <li><a class="menu_left_link" href="<?php print URL.'partner/Logout'; ?>">Elfelejtett jelszó</a></i>
                <li><a class="menu_left_link" href="<?php print URL.'partner/Logout'; ?>">GYIK</a></i>-->
            </ul>
            
        </div>
        
<article style="padding-left:10px;">

<div class="card column twelve">
    <div class="alert error"    id="wrong_password"><dl><dt>Hibás email cím vagy jelszó.</dt><dd> </dd></dl></div>
    <div class="alert error"    id="invalid_email"><dl><dt>Hibás email cím</dt><dd> </dd></dl></div>
    <div class="alert notice"   id="register_thank_you"><dl><dt>Sikeresen regisztráltál, de még aktiválnod kell az email címed a belépéshez!</dt><dd>Az email címedre elküldtük az aktiváló linket.<br><br>Aktiválás után bal oldalt tudsz bejelentkezni.</dd></dl></div>
    <div class="alert warning"  id="email_already_in_use"><dl><dt>Ez email cím már foglalt!</dt><dd> TIPP: Használja az <a href="#" data-featherlight="#password_recovery">Elfelejtett jelszó</a> szolgáltatást.</dd></dl></div>
    <div class="alert error"    id="activation_failed"><dl><dt>Email cím aktiválása sikertelen!</dt><dd> TIPP: Használja az <a href="#" data-featherlight="#password_recovery">Elfelejtett jelszó</a> szolgáltatást.</dd></dl></div>

<h2>Mennyibe kerül a megjelenés?</h2>
<p><span class="highlight-warning">Jelenleg minden kategóriában 0 Ft-ért, azaz teljesen ingyen hirdethet.</span></p>

<h2>Miért érdemes az BioBody.hu-t választani?</h2>
    <ul>
    <li>Mert Magyarország első és egyetlen bio és natúr termékekre szakosodott keresője.</li>
    <li>Mert az egészségtudatos fogyasztók itt koncentrálódnak.</li>
    <li>Mert teljesen ingyenes hirdetési lehetőség a webáruházának.</li>
    </ul>
<h1>Legyen Ön is a partnerünk</h1>

<div class=" six card-lift" style="background-color:#ffcb72;padding:20px;border-radius:20px; width:380px !important;">
<form action="" method="POST">
    <h3>Regisztráljon ingyenesen itt:</h3>
        Email:
        <input name="email"     type="text"    value="" required>
        Cégnév:
        <input name="ceg_nev"   type="text"    value="" required>
        Kapcsolattartó neve:
        <input name="kap_nev"   type="text"    value="" required>
        Jelszó:
        <input name="password"  type="password" value="" pattern=".{5,40}" title="Legalább 6 karakter hosszú legyen a jelszó!" required>
        <input name="condition" type="checkbox" value="1" id="accept" required><label for="accept" style="display:inline-block;font-size: 13px;">Elolvastam és elfogadom a <a  href="http://biobody.hu/static/felhasznalasi_feltetelek" data-featherlight="iframe" data-featherlight-iframe-allowfullscreen="true" data-featherlight-iframe-width="800" data-featherlight-iframe-height="300">felhasználási feltételeket</a></label>
        <input name="action"    type="hidden"   value="register">
        <br><br><input name="submit"    type="submit"   value="Regisztrálok" style="display:block;">
</form>
</div>
        

        
        
<div class="lightbox hide" id="password_recovery">
    <h2>Jelszó visszaállítás</h2>
    <form action="" method="POST">
            Email:
            <input name="email"     type="email"    value="<?php print (isset($_POST['email'])    ? $_POST['email'] : null); ?>">
            <input name="action"    type="hidden"   value="passwordrecovery">
            <br><input name="submit"    type="submit"   value="Új jelszó kérése">
    </form>
</div>
    
    
</div>
</article>
<style>
    
</style>
    
<style>
    p, ul {font-size:16px; padding-bottom:20px;}
    .gyik h3{margin-bottom:5px;}
    h2{margin-bottom:5px;}
    .gyik .highlight-warning{font-size:18px;}
    .hide { display:none; }/*featherlighthz kelll*/

    .highlight-warning{font-size:24px;}
    .results{font-size:16px;}

.alert{display:none;}
#wrong_password:target{display:block;}
#invalid_email:target{display:block;}
#email_already_in_use:target{display:block;}
#register_thank_you:target{display:block;}
#register_thank_you:target{display:block;}


.card-lift {
  box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);
}
</style>
<?php require_once(DIR_THEME.'/page_partner/partner_footer.php'); ?>