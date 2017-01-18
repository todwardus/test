<?php 
    require_once('include/header.php');
?>
<style>
    <?php   require_once('include/kereses.css'); ?>
    <?php   require_once('include/livesearch.css'); ?>
    <?php   require_once('include/termek.css'); ?>
</style>
<!-- Featherlight Lightbox -->
<link href="//cdn.rawgit.com/noelboss/featherlight/1.7.0/release/featherlight.min.css" type="text/css" rel="stylesheet" />
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
                <div class="input-group">
                    <input type="text" id="keyword" placeholder="Mit keresel?"  name="q" value="" autocomplete="off" onkeyup="showResult(this.value)"/>
                    <div id="livesearch"></div>
                    <div class="home_keres home_keres_gomb">
                        <button>&#128269; KERESÉS</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
   
<section class="zero-state full-width">
<article>
    <div class="card">
        

<div class="columns has-sections">
  <!--<ul class="tabs">
    <li id="arak"><a href="#arak">Boltok és árak</a></li>
    <li id="leiras"><a href="#leiras">Termékleírás</a></li>
  </ul>-->
  <div class="card-section" style="min-width:300px; max-width:800px;margin:0 auto;">
    
        <div style="height:200px;">
            <div class="img_wrap" style="text-align:left; margin-right:20px;">
                <a href="#" data-featherlight="<?php print $tpl['product']['url']; ?>">
                    <?php print '<img src="'.$tpl['product']['url'].'">'; ?>
                </a>
            </div>
            <h1 style="text-align:left; margin-left:20px;"><?php print $tpl['product']['name']; ?></h1>
            <h2 style="text-align:left;font-weight:bold;color:green;"><?php print ''. round($tpl['product']['netto']*(1+$tpl['product']['afa']/100),0); ?> Ft -tól</h2>
        </div>
        
        <table style="width:90%;" align="center">
          <!--<thead>
            <tr>
              <th>Bolt</th>
              <th>Ár</th>
              <th>Link</th>
            </tr>
          </thead>
          <tbody>-->
        <?php
        
        foreach($tpl['offers'] as $key => $value){
            print '<tr>
              <td><a href="#">'.$value['ceg_nev'].'</a></td>
              <td style="color:green;"><b>'.$value['price'].' Ft</b></td>
              <td>';
            if ($value['off']==1){
                print '<span class="tag orange">Csak személyesen</span> <a href="http://maps.google.com/?q='.$value['ceg_nev'].' '.$value['ceg_cim'].'" target="_blank">Térkép</a>';
            }else{
                print '<a href="'.URL.'Termek/Click/'.$value['id_offer'].'/'.time().'" target="_blank" rel="nofollow"><button>irány a bolt > </button></td>';
            }
            print '</tr>';
        }
        ?>
        
          </tbody>
        </table>
        <div style="text-align:left; mix-width:200px; max-width:800px; margin:0 auto; margin-top:50px;">
            <h1>Leírás</h1>
            <?php print $tpl['product']['description']; ?></div>

        <div style="color:#ccc;font-size:10px;text-align:left; padding-top:5%; padding-bottom:5%; line-height:110%;">
            *Oldalainkon a partnereink által szolgáltatott információk és árak tájékoztató jellegűek, melyek esetlegesen tartalmazhatnak téves információkat. A képek csak tájékoztató jellegűek és tartalmazhatnak tartozékokat, amelyek nem szerepelnek az alapcsomagban. A termékinformációk (kép, leírás vagy ár) előzetes értesítés nélkül megváltozhatnak. Az esetleges hibákért, elírásokért az BioBody nem felel.
        </div>
  </div>
</div>


        
</div>
</article>


            <?php 
                if (isset($tpl['ResultList'])){
                    foreach ($tpl['ResultList'] as $key => $value){
                        $value['name'] = str_ireplace($tpl['keyword'], '<b>'.strtoupper($tpl['keyword']).'</b>', $value['name'] );
                                                print '
                        <a href="'.URL.'termek/'.$value['sname'].'-'.$value['id'].'">
                            <div class="termek">
                                <div class="termek_kep">
                                    <img src="'. $value['url'].'">
                                </div>
                                <div class="termek_leiras">
                                    <a href="#">'. $value['name'].'</a>
                                    <div><b>'. $value['netto'].' Ft</b></div>
                                </div>
                            </div>
                        </a>';
                    }
                }
            ?>





        </div>
        
</section>
<?php
    require_once('include/footer.php');
?>
</main>


<!-- Featherlight Lightbox JS -->
<script src="//code.jquery.com/jquery-latest.js"></script>
<script src="//cdn.rawgit.com/noelboss/featherlight/1.7.0/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>