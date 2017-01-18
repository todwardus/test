<?php
$folder = "functions/";

require_once($folder.'old.php');
require_once($folder.'tag.php');

//
function fokat ($type, $db=10){
	global $kapcsolat;
	$eredmeny = mysql_query( "
	SELECT *
	FROM idezetek
	WHERE t1='$type' or t2='$type'
	ORDER BY like_num DESC
	LIMIT 0,50", $kapcsolat );
	while ($sor = mysql_fetch_array( $eredmeny )){
		$return_sor[] = $sor;
	}
	return $return_sor;
}

//
function alkat ($cat){
	global $kapcsolat;
	$id_cat = cat_id_search($cat);
	
	$eredmeny = mysql_query( "
	SELECT *
	FROM idezetek
	WHERE k1='".$id_cat[1]."' or k2='".$cat[1]."'
	ORDER BY like_num DESC
	LIMIT  0,300 ", $kapcsolat );
	while ($sor = mysql_fetch_array( $eredmeny )){
				$return_sor[] = $sor;
	}
	return $return_sor;
}
 
//
function idezet($id_idezet){




}

//
function fokat_list (){
	global $code_type;

	foreach ($code_type as $kulcs => $ertek){
		$return_sor[] = $ertek;
	}
	return $return_sor;
}

// helyrerakja a type és kat-ot ahogy kellett volna
function fasza_sql(){
	global $kapcsolat, $code_cat;
	
			for ($i=0; $i<=14; $i++){
				foreach ($code_cat[$i] as $kulcs=>$ertek){
					mysql_query( "UPDATE idezetek SET t1='$i',k1='$kulcs' WHERE kat1 LIKE '$ertek'", $kapcsolat );
					mysql_query( "UPDATE idezetek SET t2='$i',k2='$kulcs' WHERE kat2 LIKE '$ertek'", $kapcsolat );
					print $i.'-'.$kulcs.'-'.$ertek.'<br>';
				}
			}
}






function desktop_menu_fent(){
	global $kapcsolat, $code_type, $code_type_seo, $domainom2;

	$return = '
<!--<button id="demo-menu-lower-left" class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-navigation__link" style="height:100%">
Témák</button>-->
<div>
<div class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
    for="demo-menu-lower-left"  style="max-height:80vh;width:75vw;  overflow-y: auto;">';

foreach($code_type as $kulcs => $ertek){
	if ($kulcs==0 or $kulcs==5 or $kulcs==10){//3column
		$return .= '<ul class="demo-list-two mdl-list" style="float:left">';
	}
	$return .= '<a href="'.$domainom2.$code_type_seo[$kulcs].'">
	  <li class="mdl-list__item mdl-list__item--two-line mdl-button mdl-js-button mdl-js-ripple-effect">
	  
	    <span class="mdl-list__item-primary-content">
	      <i class="mdl-list__item-avatar">'.mb_substr($ertek, 0,1,'UTF-8').'</i>
	      '.$ertek.'
			</span>
			
	</li></a>';
	if ($kulcs==4 or $kulcs==9 or $kulcs==15){
		$return .= '</ul>';
	}
}

$return .= '</div></div>';

return $return;
}

function desktop_menu_kategoria($type_id=4){
	global $kapcsolat, $code_cat, $code_cat_seo, $domainom2;
	$return = ''; 
	$return .= '<ul class="mdl-list lacy_kat" style="float:left"><b>Szerelem</b>';
	foreach($code_cat[$type_id] as $kulcs => $ertek){
		$return.= '<a href="'.$domainom2.'kategoria/'.$code_cat_seo[$type_id][$kulcs].'"><li class="mdl-list__item mdl-button mdl-js-button mdl-js-ripple-effect">'.$ertek.'</li></a>';
	}
	$return.= '</ul>';
return $return;
}








function desktop_menu_balra(){
	global $kapcsolat, $page, $id_type, $cat,$id_cat, $code_type, $code_type_seo, $code_cat, $code_cat_seo, $domainom2;

foreach($code_type as $type_id => $ertek){
		
		//$cat
		
		
		if 	(	($page['cat'] ==1 or $page['type']==1) and
					(( $type_id == $id_type and gettype($id_type)!="NULL") or ($type_id==$id_cat[0] and gettype($id_cat[0])!="NULL")
					)
				){$ha_nyitva = 'mdl-accordion--opened';}
		else{$ha_nyitva = '';}

		$return .= '<div class="mdl-accordion '.$ha_nyitva.'">
			<div class="mdl-navigation__link mdl-accordion__button bal_fokat_kulso" href="'.$domainom2 . $code_type_seo[$type_id].'">
      	<i class="material-icons mdl-accordion__icon mdl-animation--default">expand_more</i>
      	 <div class="bal_fokat">'.$ertek.'</div></div>
              <div class="mdl-accordion__content-wrapper">
          <div class="mdl-accordion__content mdl-animation--default">';
	foreach($code_cat[$type_id] as $kulcs => $ertek){
		if (($kulcs==$id_cat[1] and $id_cat[1]!=="") and ($type_id === $id_cat[0])){
			$ha_kat = 'bal_alkat_current_link';
		}else{$ha_kat = '';}
		$return.= '<a class="mdl-navigation__link bal_alkat '.$ha_kat.'" href="'.$domainom2.'kategoria/'.$code_cat_seo[$type_id][$kulcs].'">'.$ertek.'</a>';
	}  	
	
          $return .='</div>
        </div></div>';
}
	

return $return;
}


//Bal aldali menü
function mobile_bal_menu(){
	global $kapcsolat, $code_type, $code_type_seo, $domainom2;
	$return_sor = '<div class="android-drawer mdl-layout__drawer"><nav class="mdl-navigation">
										<span class="mdl-navigation__link" href="">Témák</span>
										<div class="android-drawer-separator"></div>';
	foreach($code_type as $kulcs => $ertek){
		$return_sor.= '<a class="mdl-navigation__link mdl-js-button mdl-js-ripple-effect" href="'.$domainom2.'kategoria/'.$code_type_seo[$kulcs].'">'.$ertek.'</a>';
	}
	//$return_sor=desktop_menu_balra();
	$return_sor.= '</nav></div>';

	return $return_sor;
}


function mobile_menu_kat($type_id=4){
	global $kapcsolat, $code_cat, $code_cat_seo, $domainom2;
	$return.=	'<ul id="kat_filter_ul" class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="kat_filter_gomb" >
							 <li disabled class="mdl-menu__item" style="text-align:center">Szerelem</li>';
	foreach($code_cat[$type_id] as $kulcs => $ertek){
		$return.=	'<a href="'.$domainom2.'kategoria/'.$code_cat_seo[$type_id][$kulcs].'"><li class="mdl-menu__item">'.$ertek.'</li></a>';
	}
	$return.=	' </ul>';
return $return;
}









function cat_id_search($cat) {
	global $code_cat_seo;
	foreach ($code_cat_seo as $kulcs1 => $tomb1) {
		foreach ($code_cat_seo[$kulcs1] as $kulcs2 => $ertek) {
			if($ertek==$cat){
				$return = array($kulcs1, $kulcs2);
				return $return;
			}
		}
	}
}


//kész
function website_title()
{
	global $page, $code_cat,$code_type, $id_type, $id_cat,$code_desc_seo, $idezet_sor;
	$cat_nev = $code_cat[$id_cat[0]][$id_cat[1]];
	//title
	if($page['idezetek']==1){$title = 'Idézet - Valakitől';} 
	if($page['cat']==1)	    {$title = $cat_nev.' idézetek';} 
	if($page['type']==1)    {$title = $code_type[$id_type].' - Idézetek';}
	if($page['idezet']==1)  {$title = $idezet_sor[szoveg].' - '.$idezet_sor[szerzo];}  

	$return = '<title>'.$title.'</title>';

	if($page['cat']==1){$return .='
		<META NAME="description" CONTENT="'.$title.'">
		<META NAME="keywords"    CONTENT="'.str_replace( "\"","", $title).'">';
	}
	
	if($page['type']==1){$return .='
		<META NAME="description" CONTENT="'.$code_desc_seo[$id_type].'">
		<META NAME="keywords"    CONTENT="'.str_replace( "\"","", $title).'">';
	}


$return .='
<meta property="og:site_name" content="❤ SzepIdezet.hu ❤ - Idézetek"/>
<meta property="og:title" content="'.$title.' - ❤ SzepIdezet.hu ❤"/>
<meta property="og:description" content="'.$title.'" />
<meta property="og:type" content="activity" />
<meta property="og:image" content="http://profile.ak.fbcdn.net/hprofile-ak-snc4/hs458.snc4/50555_178810635471140_8028368_n.jpg"/>
<meta property="fb:app_id" content="138034986254296"/>';


	return $return;
}

//kész
function idezet_sor ($idezet){
	global $kapcsolat;
	$eredmeny = mysql_query( "
		SELECT * FROM idezetek WHERE id='".$idezet."' ", $kapcsolat );
	$idezet_sor = mysql_fetch_array( $eredmeny );

	return $idezet_sor;
}

/*
idézet oldal az
*/
?>