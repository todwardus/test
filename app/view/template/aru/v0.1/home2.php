<?php require_once('include/header.php'); ?>
<style> 
    <?php require_once('include/home.css'); ?>
    <?php require_once('include/livesearch.css'); ?>
</style>
<script>
    <?php require_once('include/js/livesearch.js'); ?>
</script>
<body>

<main>
<header style="display:none">
    <!-- LOGO -->
    <div class="logo">
        LOGO
    </div>  
    <!-- MENÜ 
    <div class="menu">
        <a href="">Bejelentkezés</a> |
        <a href="">Regisztráció</a>
    </div>  -->
</header>
<section class="zero-state full-width home_section">
    <article>
        <h1 class="cim">BioBody.hu</h1>
        <h2 class="alcim">Bio- és natúr termék kereső</h2>
        
        <!-- KERESÉS -->
        <div class="search">
            <form method="post" action="">
                <div class="input-group home_keres">
                    <input type="text" id="keyword" placeholder="Mit keresel?"  name="q" autocomplete="off" onkeyup="showResult(this.value)"/>
                    <div id="livesearch"></div>
                </div>
                <div class="home_keres home_keres_gomb">
                    <input type="submit" value="&#128269; KERESÉS">
                </div>
            </form>
        </div>
                <!-- Menüsor 
        <div class="home_checkbox">

        <label><input type="checkbox" onclick="setAll();" name="option2a" checked="checked">Mindenhol</label>
        <label><input type="checkbox" onclick="rmAll();"  name="option2a">Élelmiszerek</label>
        <label><input type="checkbox" onclick="rmAll();"  name="option2a">Étrendkiegészítők</label>
        <label><input type="checkbox" onclick="rmAll();"  name="option2a">Szépségápolás</label>
        </div>-->
          
    </article>
    <div class="wrapper_outer" style="display:none">
        <div class="wrapper">
        <div class="category_box">
            <div>Élelmiszer</div>
            <?php 
                foreach ($tpl_cats['1'] as $key => $value){
                    print '<a href="#">'.@ $value['cname'].'</a> | ';
                }
            ?> <a href="#">Összes »</a>
            <div>Étrend-kiegészítő</div>
            <?php
                foreach ($tpl_cats['2'] as $key => $value){
                    print '<a href="#">'.@ $value['cname'].'</a> | ';
                }
            ?> <a href="#">Összes »</a>
            <div>Szépség</div>
            <?php
                foreach ($tpl_cats['3'] as $key => $value){
                    print '<a href="#">'.@ $value['cname'].'</a> | ';
                }
            ?> <a href="#">Összes »</a>
            <div>Problémákra</div>
            <?php
                foreach ($tpl_cats['4'] as $key => $value){
                    print '<a href="#">'.@ $value['cname'].'</a> | ';
                }
            ?> <a href="#">Összes »</a>
        </div>
        
        <div class="grid">
            <?php /*
                foreach ($tpl['ResultList'] as $key => $value){
                    print '
                        <div class="termek">
                            <div class="termek_kep"><img src="'. $value['url'].'"></div>
                            <div class="termek_leiras">
                                <a href="#">'. $value['name'].'</a>
                                <a href="#">'. $value['netto'].'</a>
                            </div>
                        </div>';
                }*/
            ?>
            
        </div>
        
        </div>
    </div>
</section>
<?php
    require_once('include/footer.php');
?>
</main>
<!-- Hotjar Tracking Code for biobody.hu 
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:355313,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
-->
</body>
</html>