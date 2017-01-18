<?php
    require_once('include/header.php');
?>
<style>
    <?php   require_once('include/kereses.css'); ?>
    <?php   require_once('include/livesearch.css'); ?>
</style>
<script>
    <?php   require_once('include/js/livesearch.js'); ?>
</script>
<body>
<main>  
    <div class="head_container">
        <!-- LOGO -->
        <div class="logo">
            <a href="<?php print URL; ?>">BioBody</a>
        </div>
        <!-- KERESÉS -->
        <div class="search">
            <form method="post" action="">
                <div class="input-group" display:inline-block;>
                    <input style="float:left;" type="text" id="keyword" placeholder="Mit keresel?"  name="q" value="<?php print $tpl['keyword']; ?>" autocomplete="off" onkeyup="showResult(this.value)"/>
                    <div id="livesearch"></div>
                    <div class="home_keres home_keres_gomb">
                        <button>&#128269; KERESÉS</button>
                    </div>
                </div>
            </form>
            <div class="search-filter-box" style="display:block;">
            <?php
                $url_all_cat = URL.KERESES;
                $url_all_cat .= (isset($tpl['keyword']))    ? $tpl['keyword']    : null;
                if(!isset($tpl['category'])){
                    print '<div class="search-filter search-filter-selected"><b>Összes</b></div>'; 
                }else{
                    print '<div class="search-filter"><a href="'.$url_all_cat.'">Összes</a></div>'; 
                }

            foreach($tpl['MenuCatsTop'] as $key => $value){
                if($value['db']>0){//only show if have result
                    if(strcasecmp ($tpl['category'], $value['name_seo'] )==0){
                        print '<div class="search-filter  search-filter-selected"><b>'.$value['name'].'</b> <small style="color:#666666;">('.$value['db'].')</small></div>';
                    }else{
                        print '<div class="search-filter"><a href="'.URL.KERESES.$value['name_seo'].'/'.$tpl['keyword'].'"><b>'.$value['name'].'</b> <small>('.$value['db'].')</small></a></div>';
                    }
                }
            }
            ?>
            </div>

        </div>
<!--
        MENÜ 
        <div class="menu">
            <a href="">Bejelentkezés</a> |
            <a href="">Regisztráció</a>
        </div>
-->
    </div>
   
<section class="zero-state full-width">
    <div class="menu-left">
        <div class="card left-pls">
        <?php
            foreach($tpl['MenuCatsLeft'] as $key => $value){
                if(isset($value['cat'])){
                    print '<div class="menu-left-cat-main">'.$value['name'].'</div><ul class="left-pls">';
                    foreach($value['cat'] as $key_02 => $value_02){
                        if(strcasecmp ($tpl['subcategory'], $value_02['sname'] )==0){
                            print '<li><b>'.$value_02['cname'].'</b> <span style="color:#666666; float:right; margin-right:20px;">'.$value_02['db'].'</span></li>';
                        }else{
                            print '<li><a href="'.URL.KERESES.$value_02['sname'].'/'.$tpl['keyword'].'"><b>'.$value_02['cname'].'</b> <span style="color:#48a5da; float:right; margin-right:20px;">'.$value_02['db'].'</span></a></li>';
                        }
                    }
                }
                print '</ul>';
            }
        ?>
        </div>
<!--
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
 bb product 
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9578695225444195"
     data-ad-slot="6274281263"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
-->
    </div>

        
        <div class="grid" style="margin-right:30px">
            <?php 
                if ($tpl['category']!="" OR $tpl['subcategory']!="" OR $tpl['keyword']!=""){
                    print '<div class="search-tags">';
                    $searchterm = ($tpl['keyword']!="") ? $tpl['keyword'] : null;
                    if (isset($tpl['category'])){
                        print'<span class="tag green collapsable">Kategória: '.$tpl['category_name'].' <a href="'.URL.KERESES.$searchterm.'"></a></span>';
                    }
                    if (isset($tpl['subcategory'])){
                        print'<span class="tag green collapsable">Kategória: '.$tpl['subcategory_name'].' <a href="'.URL.KERESES.$searchterm.'"></a></span>';
                    }
                    if($tpl['keyword']!=""){
                        print '<span class="tag yellow collapsable">Keresés: „'.$tpl['keyword'].'” <a href="'.URL.KERESES.$tpl['category'].$tpl['subcategory'].'"></a></span>';
                    }
                    print '</div>';
                }
            ?>       
<!--
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<div class="jobb_ad" style="display:inline-block; width:19vw;max-width:260px;height:260px; float:right;">
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9578695225444195"
     data-ad-slot="6274281263"
     data-ad-format="rectangle"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
-->
            
            <?php 
                if (isset($tpl['ResultList'])){
                    foreach ($tpl['ResultList'] as $key => $value){
                        $value['name'] = str_ireplace($tpl['keyword'], '<b>'.strtoupper($tpl['keyword']).'</b>', $value['name'] );
                        print '
                        <a href="'.URL.'Termek/'.$value['sname'].'-p'.$value['id'].'">
                            <div class="termek">
                                <div class="termek_kep">
                                    <img src="'. $value['url'].'">
                                </div>
                                <div class="termek_leiras">
                                    <a href="'.URL.'Termek/'.$value['sname'].'-p'.$value['id'].'">'. $value['name'].'</a>
                                    <div><b>'. round($value['netto']*(1+$value['afa']/100),0).' Ft</b></div>
                                </div>
                            </div>
                        </a>';
                    }
                }
            ?>
<!--
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
 bb product 
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9578695225444195"
     data-ad-slot="6274281263"
     data-ad-format="horizontal"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
-->

        </div>
        
</section></main>
<?php
    require_once('include/footer.php');
?>

</body>



</div>
</body>
</html>