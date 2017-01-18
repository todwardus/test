<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

      <div class="android-header mdl-layout__header mdl-layout__header--waterfall">
        <div class="mdl-layout__header-row">

        	<!-- Left aligned menu below button -->
       	<!--<button id="kat_filter_gomb" class="mdl-button mdl-js-button mdl-button--icon">
						  <i class="material-icons" id="kategoria">filter_list</i>
						</button>-->
						
<?php
	/* Mobile_menu_kat
	$code_cat
	$code_cat_seo;
	*/
/*
print '<ul id="kat_filter_ul" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="kat_filter_gomb" >
							 <li disabled class="mdl-menu__item" style="text-align:center">Szerelem</li>';
foreach($code_cat['4'] as $kulcs => $ertek){
print '
    <a href="'.URL.'kategoria/'.$code_cat_seo[4][$kulcs].'"><li class="mdl-menu__item">'.$ertek.'</li></a>';
	}
print ' </ul>';
*/?>
          <span class="android-title mdl-layout-title">
            <!--<img class="android-logo-image" src="http://szepidezet.hu/mdl/template/mdl/img/logo/02.png">-->
            <a href="<?php print URL; ?>">„Szép idézet”</a>
          </span>
          <!-- Add spacer, to align navigation to the right in desktop -->
          <div class="android-header-spacer mdl-layout-spacer">                

          </div>
          <div class="android-search-box mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right mdl-textfield--full-width">
            <form  id="search-form" action='' method='POST'>
                <label class="mdl-button mdl-js-button mdl-button--icon" for="search-field">
                  <i class="material-icons" onclick="$('#search-formNEM').submit();">search</i>
                </label>
                <div class="mdl-textfield__expandable-holder">
                  <input class="mdl-textfield__input" type="text" id="search-field" name="search-field">
                </div>
              </form>
           </div>
              
          <!-- Navigation -->
          <div class="android-navigation-container">
            <nav class="android-navigation mdl-navigation">
                
<?php 
//print desktop_menu_fent();

	print '
<button id="demo-menu-lower-left" class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-navigation__link" style="height:100%">
Témák</button>
<div>
<div class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
    for="demo-menu-lower-left"  style="max-height:80vh;width:75vw;  overflow-y: auto;">';
    
foreach($code_type as $kulcs => $ertek){
	if ($kulcs==0 or $kulcs==5 or $kulcs==10){//3column
		print '<ul class="demo-list-two mdl-list" style="float:left">';
	}
	print '<a href="'.URL.$code_type_seo[$kulcs].'">
	  <li class="mdl-list__item mdl-list__item--two-line mdl-button mdl-js-button mdl-js-ripple-effect">
	  
	    <span class="mdl-list__item-primary-content">
	      <i class="mdl-list__item-avatar">'.mb_substr($ertek, 0,1,'UTF-8').'</i>
	      '.$ertek.'
			</span>
			
	</li></a>';
	if ($kulcs==4 or $kulcs==9 or $kulcs==15){
		print '</ul>';
	}
}

print '</div></div>';

?>
							<!--<a class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-navigation__link mdl-typography--text-uppercase mdl-js-button mdl-js-ripple-effect mdl-button" href="">Szerzők</a>-->
            </nav>
          </div>
          <span class="android-mobile-title mdl-layout-title">
            <!--<img class="android-logo-image" src="http://szepidezet.hu/mdl/template/mdl/img/logo/02.png">-->
            <a href="<?php print URL; ?>">„Szép idézet”</a>
          </span>


        </div>
      </div>
<?php
//print mobile_bal_menu();

	print '<div class="android-drawer mdl-layout__drawer"><nav class="mdl-navigation">
										<span class="mdl-navigation__link" href="">Témák</span>
										<div class="android-drawer-separator"></div>';
	foreach($code_type as $kulcs => $ertek){
		print '<a class="mdl-navigation__link mdl-js-button mdl-js-ripple-effect" href="'.URL.'kategoria/'.$code_type_seo[$kulcs].'">'.$ertek.'</a>';
	}
	//$return_sor=desktop_menu_balra();
	print '</nav></div>';

?>
      <div class="android-content mdl-layout__content">
        <div class="demo-container mdl-grid">
          <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone lacy_bal">
<?php
//looks old
//print desktop_menu_kategoria(rand(0,14));
?> 



<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--overlay-drawer-button">
  <div class="mdl-layout__drawer">
    <div class="mdl-navigation">
<br><br><br>
<?php
//print desktop_menu_balra();
//	global $kapcsolat, $page, $id_type, $cat,$id_cat, $code_type, $code_type_seo, $code_cat, $code_cat_seo, $domainom2;

foreach($code_type as $type_id => $ertek){
		
		if( $tpl['selected']['id_type']==$type_id and isset($tpl['selected']['id_type'])){
		    $ha_nyitva = 'mdl-accordion--opened';
		}else{
		    $ha_nyitva = '';
		}

		print '<div class="mdl-accordion '.$ha_nyitva.'">
			<div class="mdl-navigation__link mdl-accordion__button bal_fokat_kulso" href="'.URL . $code_type_seo[$type_id].'">
      	<i class="material-icons mdl-accordion__icon mdl-animation--default">expand_more</i>
      	 <div class="bal_fokat">'.$ertek.'</div></div>
              <div class="mdl-accordion__content-wrapper">
          <div class="mdl-accordion__content mdl-animation--default">';
          
	foreach($code_cat[$type_id] as $kulcs => $ertek){
		if ($type_id == $tpl['selected']['id_type'] and $kulcs == $tpl['selected']['id_cat']  and isset($tpl['selected']['id_cat'])) {
			$ha_kat = 'bal_alkat_current_link';
		} else {
		    $ha_kat = '';
		}
		print '<a class="mdl-navigation__link bal_alkat '.$ha_kat.'" href="'.URL.'kategoria/'.$code_cat_seo[$type_id][$kulcs].'">'.$ertek.'</a>';
		
	}  	
	
          print '</div>
        </div></div>';
}


?>
    </div>
  </div>
</div>
       	
          	
          	
          </div>
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
            <div class="inner_full" style="width:100%; display: flex;">
            	<!--<div class="inner_left" style="width:1px; height:100%;"><img src="http://www.waterpolohair.com/uploads/4/6/4/6/4646772/9005151.png"></div>-->
            	<div class="inner_right">
		            <div class="idezet_szoveg">
<!-- Adsense optin #didntworked <div align="center">
    Több, mint 40.000 kategorizált idézet 8 év alatt, kövess te is facebookon :)<br>
<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FSzepIdezet.hu&tabs&width=500&height=154&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=138034986254296" width="500" height="154" style="border:none;overflow:hidden; margin: 0 auto;" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
</div>-->
<?php

/*if ($page['main']==1 ){ $sor =fokat(4,100);}
if ($page['type']==1 ){ $sor =fokat(4,100);}
if ($page['cat']==1)	{	$sor =alkat($cat);}
if ($page['idezet']==1)	{	$sor =array(idezet_sor($id_idezet));}
*/

if ( count($tpl['list']) > 0 ){
    foreach($tpl['list'] as $kulcs => $ertek){
    	print '<span class="megosztas"><a href="http://www.facebook.com/sharer.php?u='.URL.'Idezetek/'.$ertek['id'].'">'.$ertek['like_num'].' Megosztás</a><br>
    					<a href="'.URL.'Idezetek/'.$ertek['id'].'">Idézet</a></span>'.
    				nl2br($ertek['szoveg']).
    				'<div class="szerzo"><a href="'.URL.'szerzo/'.$ertek['szerzo_seo'].'">'.$ertek['szerzo'].'</a></div>';
    }
}
/*
if ($page['main']==1){
		$sor =fokat(4,10);
		foreach($sor as $kulcs => $ertek){
			print $ertek['szoveg'].'- '.$ertek['szerzo'].'<br><br>';
		}
	}
*/



?>
<?php
/*
print $tpl['page_next'];
print '|';
print $tpl['page_max'];
print '|';
print $tpl['list_count'];
print '|';
print $_SERVER['HTTP_HOST'];
print '|';
print $_SERVER["REQUEST_URI"];
*/
?>
<!--
<div class="paging_center">
    <a href="<?php //print $tpl['page_next']; ?>">
        <div class="paging_btn_next">Mutass még >></div>
    </a>
</div>
-->
								</div>
<!--
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Lájkolom ezt a szart :)</button>
-->      	
	          
	          
	          
	          
	          </div>
          	</div>
          </div>
        </div>
        <!--
        <footer class="demo-footer mdl-mini-footer">
          <div class="mdl-mini-footer--left-section">
            <ul class="mdl-mini-footer--link-list">
              <li><a href="#">Help</a></li>
              <li><a href="#"><?php print "Time:  " . number_format(( microtime(true) - TIME_START), 5)*1000 . "ms\n";?></a>
              	


              	
              	
              	</li>
            </ul>
          </div>
        </footer>-->



      </div>
    </div>
