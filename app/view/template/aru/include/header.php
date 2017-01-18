<?php

/*
print round((TIME_CONTROLLER1-TIME_START)*1000,0).'ms';
print '<br><br>';
print round((microtime(true)-TIME_CONTROLLER1)*1000,0).'ms';
print '<br><br>';
print round((microtime(true)-TIME_START)*1000,0).'ms';
print '<br><br>';
print round((TIME_CONTROLLER2 - TIME_CONTROLLER1)*1000,1000).'ms';
print ' A ketto kozott<br><br>';
*/

?>
<!-- <?php print 'Loading time: '.round((microtime(true)-TIME_START)*1000,0).'ms'; ?> -->
<!-- <?php print 'Memory used: '.round((memory_get_usage()-MEMORY_START)/1024,0).'KB'; ?> -->
<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

<!-- Page info -->
<title><?php @ print $tpl['title'] ?></title>
<meta name="description" content="<?php @ print $tpl['desc']; ?>">
<meta name="author" content="BioBody.hu">

<!-- Page styles -->
<!-- <link href="<?php //print URL_PUBLIC; ?>/img/icon/favicon.ico" rel="icon" > -->
<link href="http://szepidezet.hu/public/img/icon/favicon.ico" rel="icon" >
<!--<link rel="stylesheet" href="http://www.uptowncss.com/css/uptown.css" > media="none" onload="if(media!='all')media='all'"-->

<!-- Facebook metadata -->
<meta property="og:site_name" content="BioBody.hu"/>
<meta property="og:title" content="<?php print $tpl['title']; ?>"/>
<meta property="og:description" content="<?php print $tpl['desc']; ?>" />
<meta property="og:type" content="activity" />
<meta property="og:image" content="http://profile.ak.fbcdn.net/hprofile-ak-snc4/hs458.snc4/50555_178810635471140_8028368_n.jpg"/>
<meta property="fb:app_id" content="<?php print ID_FB_APP; ?>"/>

<!-- Twitter metadata -->


<!-- Google Webmaster Tools verification -->


<!-- Tracking -->


<!-- Cookie -->
<?php require_once("module_cookielaw.php"); ?>

</head>
<body>
<style>

<?php
//ki kell rakni 1db css-be
//UptownCSS
require_once("style.css");
//My global extension for uptowncss
require_once('global.css');

?>
</style>

<style>
<?php
    print '#'.$_GET['error'].':target{display:block;}';
?>
</style>
