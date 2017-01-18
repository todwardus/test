<?php
/*
$code_type
$code_type_seo
$domainom2
*/
print '
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
	

?>